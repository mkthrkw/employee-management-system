<?php

namespace App\Http\Controllers;

use App\Models\LaptopPc;
use Illuminate\Http\Request;

class LaptopPcController extends Controller
{
    public $rules = [
        'status'            => 'required|integer',
        'name'              => 'required|max:50|unique:laptop_pcs',
        'device_name'       => 'nullable|max:50',
        'cpu'               => 'nullable|max:100',
        'memory'            => 'nullable|max:100',
        'branch'            => 'required|integer',
        'arrival_date'      => 'nullable|date',
        'disposal_date'     => 'nullable|date',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new LaptopPc;
        $query = $query->select('laptop_pcs.*','accounts.name as account_name','accounts.employee_number as account_employee_number')
                        ->leftjoin('accounts','laptop_pcs.account_id','=','accounts.id');

        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                if(str_starts_with($key,'account_')){
                    $query = $query->where('accounts.'.str_replace('account_','',$key), "LIKE", "%{$value}%");
                    continue;
                }
                if(in_array($key,['status','branch'])){
                    $query = $query->wherein('laptop_pcs.'.$key,$value);
                    continue;
                }
                if(str_ends_with($key,'_from')){
                    $query = $query->where('laptop_pcs.'.str_replace('_from','',$key), ">=",$value);
                    continue;
                }
                if(str_ends_with($key,'_to')){
                    $query = $query->where('laptop_pcs.'.str_replace('_to','',$key), "<=",$value);
                    continue;
                }
                $query = $query->where('laptop_pcs.'.$key, "LIKE", "%{$value}%");
            }
        }

        $laptopPcs = $query->orderBy('laptop_pcs.id','desc')->paginate(25);
        return view('pages.laptop_pc.index',compact('laptopPcs','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.laptop_pc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $createLaptopPc = LaptopPc::create($request->all());
        return redirect()->route('laptop_pc.index')->with('success',"{$createLaptopPc->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(LaptopPc $laptopPc)
    {
        return view('pages.laptop_pc.show',compact('laptopPc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaptopPc $laptopPc)
    {
        return view('pages.laptop_pc.edit',compact('laptopPc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaptopPc $laptopPc)
    {
        $rules = $this->rules;
        $rules['name'] .= ',name,'.$laptopPc->id;
        $request->validate($rules);
        $laptopPc->fill($request->all())->save();
        return redirect()->route('laptop_pc.index')->with('success',$laptopPc->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaptopPc $laptopPc)
    {
        //
        $laptopPc->delete();
        return redirect()->route('laptop_pc.index')->with('success',$laptopPc->name.'を削除しました。');
    }
}
