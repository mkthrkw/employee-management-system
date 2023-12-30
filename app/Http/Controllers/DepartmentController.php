<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public $rules = [
        'name'      => 'required|max:50',
        'parent_id' => 'required|integer',
        'depth'     => 'required|integer',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departmentModel = new Department;
        $query = $departmentModel;
        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                $query = $query->where($key, "LIKE", "%{$value}%");
            }
        }
        $departments = $query->orderBy('id','desc')->paginate(25);
        foreach($departments as $department){
            $department->fullname = trim($departmentModel->get_fullname($department),'/');
        }
        return view('pages.department.index',compact('departments','param'));
    }

        /**
     * Display a Organization chart.
     */
    public function chart()
    {
        //
        $departmentModel = new Department;
        foreach($departmentModel->where('parent_id',0)->get() as $parent){
            $chart[] = $departmentModel->get_tree($parent);
        }
        return view('pages.department.chart',compact('chart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departmentModel = new Department;
        $all_departments = $departmentModel->all();
        foreach($all_departments as $department){
            $department->fullname = trim($departmentModel->get_fullname($department),'/');
        }
        return view('pages.department.create',compact('all_departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        $param = $request->all();
        $departmentModel = new Department;
        if(intval($param['depth']) - $departmentModel->where('id',$param['parent_id'])->pluck('depth')->first()->value != 1){
            return redirect()->route('department.create')->withInput()->withErrors('Depth Lv を紐づけ先より1だけ大きく設定してください');
        }
        $create_department = $departmentModel->create($param);

        return redirect()->route('department.index')->with('success',"{$create_department->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $departmentModel = new Department;
        $department->parent = $departmentModel->where('id',$department->parent_id)->first();
        $department->fullname = trim($departmentModel->get_fullname($department),'/');
        return view('pages.department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $departmentModel = new Department;
        $select_departments = $departmentModel->all()->except($department->id);
        foreach($select_departments as $select_department){
            $select_department->fullname = trim($departmentModel->get_fullname($select_department),'/');
        }
        return view('pages.department.edit',compact('department','select_departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate($this->rules);
        $param = $request->all();
        $departmentModel = new Department;
        if(intval($param['depth']) - $departmentModel->where('id',$param['parent_id'])->pluck('depth')->first()->value != 1){
            return redirect()->route('department.edit',$department)->withInput()->withErrors('Depth Lv を紐づけ先より1だけ大きく設定してください');
        }
        $department->fill($param)->save();
        return redirect()->route('department.index')->with('success',$department->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return redirect()->route('department.index')->with('success',$department->name.'を削除しました。');
    }
}
