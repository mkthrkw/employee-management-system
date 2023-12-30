<?php

namespace App\Http\Controllers;

use App\Models\BcRoute;
use Illuminate\Http\Request;

class BcRouteController extends Controller
{
    public $rules = [
        'name'          => 'required|max:50|unique:bc_routes',
        'display_memo1' => 'required|max:50',
        'display_memo2' => 'required|max:50',
        'display_memo3' => 'required|max:50',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new BcRoute;
        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                $query = $query->where($key, "LIKE", "%{$value}%");
            }
        }
        $bcRoutes = $query->orderBy('id','desc')->paginate(25);
        return view('pages.bc_route.index',compact('bcRoutes','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bc_route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $createBcRoute = BcRoute::create($request->all());
        return redirect()->route('bc_route.index')->with('success',"{$createBcRoute->name}を作成しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(BcRoute $bcRoute)
    {
        return view('pages.bc_route.show',compact('bcRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BcRoute $bcRoute)
    {
        return view('pages.bc_route.edit',compact('bcRoute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BcRoute $bcRoute)
    {
        $rules = $this->rules;
        $rules['name'] .= ',name,'.$bcRoute->id;
        $request->validate($rules);
        $bcRoute->fill($request->all())->save();
        return redirect()->route('bc_route.index')->with('success',$bcRoute->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BcRoute $bcRoute)
    {
        //
        $bcRoute->delete();
        return redirect()->route('bc_route.index')->with('success',$bcRoute->name.'を削除しました。');
    }
}
