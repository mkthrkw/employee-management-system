<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MobilePhone;

class AccountMobilePhone extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $account;
    public $lent_mobile_phones;
    public $stock_mobile_phones = [];

    public function mount($account)
    {
        $this->account = $account;
        $this->getReleaseList();
    }

    public function render()
    {
        return view('livewire.account-mobile-phone',[
            'lent_mobile_phones' => $this->lent_mobile_phones,
            'stock_mobile_phones' => $this->stock_mobile_phones,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->lent_mobile_phones = $this->account->mobile_phones()->get();
    }

    public function getCatchList()
    {
        $this->stock_mobile_phones = MobilePhone::where('status',1)->get();
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
    public function release($mobile_phone_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却]';
        $mobile_phone = MobilePhone::where('id',$mobile_phone_id)->first();
        $mobile_phone->update([
            'account_id' => null,
            'status' => 1,
            'memo' => $mobile_phone->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('mobile_phone_success', '社用携帯を返却しました。');
        $this->isReleaseModalOpen = false;
    }

    public function releaseBroken($mobile_phone_id)
    {
        $message = '['.date("Y-m-d H:i:s").' '.$this->account->name.'さん返却(故障)]';
        $mobile_phone = MobilePhone::where('id',$mobile_phone_id)->first();
        $mobile_phone->update([
            'account_id' => null,
            'status' => 3,
            'memo' => $mobile_phone->memo.$message,
        ]);
        $this->getReleaseList();
        session()->flash('mobile_phone_success', '社用携帯を返却(故障)しました。');
        $this->isReleaseModalOpen = false;
    }

    public function catch($mobile_phone_id)
    {
        $mobile_phone = MobilePhone::where('id',$mobile_phone_id)->first();
        $mobile_phone->update([
            'account_id' => $this->account->id,
            'status' => 2,
        ]);
        $this->getReleaseList();
        session()->flash('mobile_phone_success', '社用携帯をレンタルしました。');
        $this->isCatchModalOpen = false;
    }
}
