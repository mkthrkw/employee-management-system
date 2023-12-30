<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class AccountDepartment extends Component
{
    public $isCatchModalOpen = false;
    public $isReleaseModalOpen = false;
    public $releaseId = null;
    public $releaseName = null;

    public $account;
    public $active_departments;
    public $select_departments = [];
    public $department;

    public function mount($account)
    {
        $this->account = $account;
        $this->department = new Department;
        $this->getReleaseList();
    }

    public function render()
    {
        return view('livewire.account-department',[
            'active_departments' => $this->active_departments,
            'select_departments' => $this->select_departments,
        ]);
    }


    // Make list
    public function getReleaseList()
    {
        $this->active_departments = $this->account->departments()->get();
        foreach($this->active_departments as $active_department){
            $active_department->fullname = trim($this->department->get_fullname($active_department),'/');
        }
        $this->active_departments = $this->active_departments->toArray();
    }

    public function getCatchList()
    {
        $this->select_departments = $this->department->all()
                                    ->except(array_column($this->active_departments,'id'))
                                    ->sortBy([['id','asc'],['depth','asc']]);
        foreach($this->select_departments as $select_department){
            $select_department->fullname = trim($this->department->get_fullname($select_department),'/');
        }
        $this->select_departments = $this->select_departments->toArray();
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
    public function release($department_id)
    {
        $this->account->departments()->detach($department_id);
        $this->getReleaseList();
        session()->flash('department_success', '所属部署を削除しました。');
        $this->isReleaseModalOpen = false;
    }

    public function catch($department_id)
    {
        $this->account->departments()->attach($department_id);
        $this->getReleaseList();
        session()->flash('department_success', '所属部署を割り当てました。');
        $this->isCatchModalOpen = false;
    }

}
