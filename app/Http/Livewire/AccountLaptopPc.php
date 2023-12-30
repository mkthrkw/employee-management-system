<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LaptopPc;

class AccountLaptopPc extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $account;
    public $lent_laptop_pcs;
    public $stock_laptop_pcs = [];

    public function mount($account)
    {
        $this->account = $account;
        $this->getReleaseList();
    }

    public function render()
    {
        return view('livewire.account-laptop-pc',[
            'lent_laptop_pcs' => $this->lent_laptop_pcs,
            'stock_laptop_pcs' => $this->stock_laptop_pcs,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->lent_laptop_pcs = $this->account->laptop_pcs()->get();
    }

    public function getCatchList()
    {
        $this->stock_laptop_pcs = LaptopPc::where('status',1)->get();
    }


    // For modal
    public function openReleaseModal($id, $name)
    {
        $this->releaseId = $id;
        $this->releaseName = $name;
        $this->isReleaseModalOpen = true;
    }

    public function closeReleaseModal()
    {
        $this->isReleaseModalOpen = false;
    }

    public function openCatchModal()
    {
        $this->getCatchList();
        $this->isCatchModalOpen = true;
    }

    public function closeCatchModal()
    {
        $this->isCatchModalOpen = false;
    }


    // Action
    public function release($laptop_pc_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却]';
        $laptop_pc = LaptopPc::where('id',$laptop_pc_id)->first();
        $laptop_pc->update([
            'account_id' => null,
            'status' => 1,
            'memo' => $laptop_pc->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('laptop_pc_success', 'ノートPCを返却しました。');
        $this->isReleaseModalOpen = false;
    }

    public function releaseBroken($laptop_pc_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却(故障)]';
        $laptop_pc = LaptopPc::where('id',$laptop_pc_id)->first();
        $laptop_pc->update([
            'account_id' => null,
            'status' => 3,
            'memo' => $laptop_pc->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('laptop_pc_success', 'ノートPCを返却(故障)しました。');
        $this->isReleaseModalOpen = false;
    }

    public function catch($laptop_pc_id)
    {
        $laptop_pc = LaptopPc::where('id',$laptop_pc_id)->first();
        $laptop_pc->update([
            'account_id' => $this->account->id,
            'status' => 2,
        ]);
        $this->getReleaseList();
        session()->flash('laptop_pc_success', 'ノートPCをレンタルしました。');
        $this->isCatchModalOpen = false;
    }
}
