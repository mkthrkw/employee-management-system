<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MailingList;

class AccountMailingList extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $account;
    public $active_mailing_lists;
    public $select_mailing_lists = [];

    public function mount($account)
    {
        $this->account = $account;
        $this->getReleaseList();
    }

    public function render()
    {
        return view('livewire.account-mailing-list',[
            'active_mailing_lists' => $this->active_mailing_lists,
            'select_mailing_lists' => $this->select_mailing_lists,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->active_mailing_lists = $this->account->mailing_lists()->get();
    }

    public function getCatchList()
    {
        $this->select_mailing_lists = MailingList::all()->diff($this->active_mailing_lists);
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
    public function release($mailing_list_id)
    {
        $this->account->mailing_lists()->detach($mailing_list_id);
        $this->getReleaseList();
        session()->flash('mailing_list_success', 'メーリングリストを削除しました。');
        $this->isReleaseModalOpen = false;
    }

    public function catch($mailing_list_id)
    {
        $this->account->mailing_lists()->attach($mailing_list_id);
        $this->getReleaseList();
        session()->flash('mailing_list_success', 'メーリングリストを割り当てました。');
        $this->isCatchModalOpen = false;
    }

}
