<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public $rules = [
        'name'                  => 'required|max:50',
        'address'               => 'required|max:50|unique:mailing_lists',
        'ext_send_permission'   => 'required|integer',
        'bc_route_id'           => 'nullable|integer',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new MailingList;
        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                $query = $query->where($key, "LIKE", "%{$value}%");
            }
        }
        $mailingLists = $query->orderBy('id','desc')->paginate(25);
        return view('pages.mailing_list.index',compact('mailingLists','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mailing_list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        foreach($request->all() as $k => $v){if($v){$data[$k] = $v;}}
        $createMailingList = MailingList::create($data);

        return redirect()->route('mailing_list.index')->with('success',"{$createMailingList->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(MailingList $mailingList)
    {
        return view('pages.mailing_list.show',compact('mailingList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailingList $mailingList)
    {
        return view('pages.mailing_list.edit',compact('mailingList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MailingList $mailingList)
    {
        $rules = $this->rules;
        $rules['address'] .= ',address,'.$mailingList->id;
        $request->validate($rules);
        foreach($request->all() as $k => $v){if($v){$data[$k] = $v;}}
        $mailingList->fill($data)->save();
        return redirect()->route('mailing_list.index')->with('success',$mailingList->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailingList $mailingList)
    {
        //
        $mailingList->delete();
        return redirect()->route('mailing_list.index')->with('success',$mailingList->name.'を削除しました。');
    }
}
