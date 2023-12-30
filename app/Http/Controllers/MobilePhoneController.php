<?php

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use Illuminate\Http\Request;

class MobilePhoneController extends Controller
{
    public $rules = [
        'status'        => 'required|integer',
        'name'          => 'nullable|max:50',
        'provider'      => 'nullable|max:50',
        'phone_number'  => 'required|max:50|unique:mobile_phones',
        'branch'        => 'required|integer',
        'arrival_date'  => 'nullable|date',
        'disposal_date' => 'nullable|date',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new MobilePhone;
        $query = $query->select('mobile_phones.*','accounts.name as account_name','accounts.employee_number as account_employee_number')
                        ->leftjoin('accounts','mobile_phones.account_id','=','accounts.id');

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
                    $query = $query->wherein('mobile_phones.'.$key,$value);
                    continue;
                }
                if(str_ends_with($key,'_from')){
                    $query = $query->where('mobile_phones.'.str_replace('_from','',$key), ">=",$value);
                    continue;
                }
                if(str_ends_with($key,'_to')){
                    $query = $query->where('mobile_phones.'.str_replace('_to','',$key), "<=",$value);
                    continue;
                }
                $query = $query->where('mobile_phones.'.$key, "LIKE", "%{$value}%");
            }
        }

        $mobilePhones = $query->orderBy('mobile_phones.id','desc')->paginate(25);
        return view('pages.mobile_phone.index',compact('mobilePhones','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mobile_phone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $createMobilePhone = MobilePhone::create($request->all());
        return redirect()->route('mobile_phone.index')->with('success',"{$createMobilePhone->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(MobilePhone $mobilePhone)
    {
        return view('pages.mobile_phone.show',compact('mobilePhone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MobilePhone $mobilePhone)
    {
        return view('pages.mobile_phone.edit',compact('mobilePhone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MobilePhone $mobilePhone)
    {
        $rules = $this->rules;
        $rules['phone_number'] .= ',phone_number,'.$mobilePhone->id;
        $request->validate($rules);
        $mobilePhone->fill($request->all())->save();
        return redirect()->route('mobile_phone.index')->with('success',$mobilePhone->phone_number.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobilePhone $mobilePhone)
    {
        //
        $mobilePhone->delete();
        return redirect()->route('mobile_phone.index')->with('success',$mobilePhone->name.'を削除しました。');
    }
}
