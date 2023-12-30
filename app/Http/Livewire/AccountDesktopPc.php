<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DesktopPc;

class AccountDesktopPc extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $account;
    public $lent_desktop_pcs;
    public $stock_desktop_pcs = [];

    public function mount($account)
    {
        $this->account = $account;
        $this->getReleaseList();
    }

    public function render()
    {
        return view('livewire.account-desktop-pc',[
            'lent_desktop_pcs' => $this->lent_desktop_pcs,
            'stock_desktop_pcs' => $this->stock_desktop_pcs,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->lent_desktop_pcs = $this->account->desktop_pcs()->get();
    }

    public function getCatchList()
    {
        $this->stock_desktop_pcs = DesktopPc::where('status',1)->get();
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
    public function release($desktop_pc_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却]';
        $desktop_pc = DesktopPc::where('id',$desktop_pc_id)->first();
        $desktop_pc->update([
            'account_id' => null,
            'status' => 1,
            'memo' => $desktop_pc->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('desktop_pc_success', 'デスクトップPCを返却しました。');
        $this->isReleaseModalOpen = false;
    }

    public function releaseBroken($desktop_pc_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却(故障)]';
        $desktop_pc = DesktopPc::where('id',$desktop_pc_id)->first();
        $desktop_pc->update([
            'account_id' => null,
            'status' => 3,
            'memo' => $desktop_pc->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('desktop_pc_success', 'デスクトップPCを返却(故障)しました。');
        $this->isReleaseModalOpen = false;
    }


    public function catch($desktop_pc_id)
    {
        $desktop_pc = DesktopPc::where('id',$desktop_pc_id)->first();
        $desktop_pc->update([
            'account_id' => $this->account->id,
            'status' => 2,
        ]);
        $this->getReleaseList();
        session()->flash('desktop_pc_success', 'デスクトップPCをレンタルしました。');
        $this->isCatchModalOpen = false;
    }

}
