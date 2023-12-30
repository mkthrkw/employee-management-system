<?php

namespace App\Http\Livewire;
use App\Models\Account;

use Livewire\Component;

class BcRouteAccount extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $bc_route;
    public $active_bc_authorizers;
    public $select_bc_authorizers = [];

    public function mount($bc_route)
    {
        $this->bc_route = $bc_route;
        $this->getReleaseList();
    }
    public function render()
    {
        return view('livewire.bc-route-account',[
            'active_mailing_lists' => $this->active_bc_authorizers,
            'select_mailing_lists' => $this->select_bc_authorizers,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->active_bc_authorizers = $this->bc_route->bc_authorizers()->get();
    }

    public function getCatchList()
    {
        $this->select_bc_authorizers = Account::where('position','>=',5)->where('status',2)->get()->diff($this->active_bc_authorizers);
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
    public function release($bc_authorizer_id)
    {
        $this->bc_route->bc_authorizers()->detach($bc_authorizer_id);
        $this->getReleaseList();
        session()->flash('bc_authorizer_success', '承認者を削除しました。');
        $this->isReleaseModalOpen = false;
    }

    public function catch($bc_authorizer_id)
    {
        $this->bc_route->bc_authorizers()->attach($bc_authorizer_id);
        $this->getReleaseList();
        session()->flash('bc_authorizer_success', '承認者を割り当てました。');
        $this->isCatchModalOpen = false;
    }
}
