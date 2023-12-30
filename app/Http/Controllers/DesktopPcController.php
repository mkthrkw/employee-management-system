<?php

namespace App\Http\Controllers;

use App\Models\DesktopPc;
use Illuminate\Http\Request;

class DesktopPcController extends Controller
{
    public $rules = [
        'status'            => 'required|integer',
        'name'              => 'required|max:50|unique:desktop_pcs',
        'cpu'               => 'nullable|max:100',
        'memory'            => 'nullable|max:50',
        'hdd'               => 'nullable|max:100',
        'vpn_connection_id' => 'nullable|max:50',
        'vpn_unique_id'     => 'nullable|max:100',
        'casting_navi'      => 'required|integer',
        'branch'            => 'required|integer',
        'arrival_date'      => 'nullable|date',
        'disposal_date'     => 'nullable|date',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new DesktopPc;
        $query = $query->select('desktop_pcs.*','accounts.name as account_name','accounts.employee_number as account_employee_number')
                        ->leftjoin('accounts','desktop_pcs.account_id','=','accounts.id');

        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                if(str_starts_with($key,'account_')){
                    $query = $query->where('accounts.'.str_replace('account_','',$key), "LIKE", "%{$value}%");
                    continue;
                }
                if(in_array($key,['status','casting_navi','branch'])){
                    $query = $query->wherein('desktop_pcs.'.$key,$value);
                    continue;
                }
                if(str_ends_with($key,'_from')){
                    $query = $query->where('desktop_pcs.'.str_replace('_from','',$key), ">=",$value);
                    continue;
                }
                if(str_ends_with($key,'_to')){
                    $query = $query->where('desktop_pcs.'.str_replace('_to','',$key), "<=",$value);
                    continue;
                }
                $query = $query->where('desktop_pcs.'.$key, "LIKE", "%{$value}%");
            }
        }

        $desktopPcs = $query->orderBy('desktop_pcs.id','desc')->paginate(25);
        return view('pages.desktop_pc.index',compact('desktopPcs','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.desktop_pc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $createDesktopPc = DesktopPc::create($request->all());
        return redirect()->route('desktop_pc.index')->with('success',"{$createDesktopPc->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(DesktopPc $desktopPc)
    {
        return view('pages.desktop_pc.show',compact('desktopPc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DesktopPc $desktopPc)
    {
        return view('pages.desktop_pc.edit',compact('desktopPc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DesktopPc $desktopPc)
    {
        $rules = $this->rules;
        $rules['name'] .= ',name,'.$desktopPc->id;
        $request->validate($rules);
        $desktopPc->fill($request->all())->save();
        return redirect()->route('desktop_pc.index')->with('success',$desktopPc->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DesktopPc $desktopPc)
    {
        //
        $desktopPc->delete();
        return redirect()->route('desktop_pc.index')->with('success',$desktopPc->name.'を削除しました。');
    }
}
