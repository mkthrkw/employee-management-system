<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class AccountController extends Controller
{

    public $rules = [
        'status'            => 'required|integer',
        'employee_number'   => 'required|max:50|unique:accounts',
        'password'          => 'required|min:8|confirmed',
        'last_name'         => 'required|max:50',
        'first_name'        => 'required|max:50',
        'last_name_kana'    => 'required|max:50',
        'first_name_kana'   => 'required|max:50',
        'position'          => 'required|integer',
        'email'             => 'nullable|max:100',
        'bc_route_id'       => 'nullable|integer',
        'windows_username'  => 'nullable|max:50',
        'chatwork_aid'      => 'nullable|max:50',
        'role'              => 'required|integer',
        'joining_date'      => 'nullable|date',
        'leaving_date'      => 'nullable|date',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new Account;
        $param = $request->all();
        if($param){
            foreach($param as $key => $value){
                if(!$value)continue;
                if($key == 'page')continue;
                if(in_array($key,['status','position'])){
                    $query = $query->wherein($key,$value);
                    continue;
                }
                if(str_ends_with($key,'_from')){
                    $query = $query->where(str_replace('_from','',$key), ">=",$value);
                    continue;
                }
                if(str_ends_with($key,'_to')){
                    $query = $query->where(str_replace('_to','',$key), "<=",$value);
                    continue;
                }
                $query = $query->where($key, "LIKE", "%{$value}%");
            }
        }
        $accounts = $query->orderBy('id','desc')->paginate(25);
        return view('pages.account.index',compact('accounts','param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        $param = $request->all();
        $data['name'] = $param['last_name'].' '.$param['first_name'];
        $data['name_kana'] = $param['last_name_kana'].' '.$param['first_name_kana'];
        $data['password'] = Hash::make(trim($param['password']));
        if($param['email']){$data['email'] = $param['email'].'@staff-first.co.jp';}
        foreach(['last_name','first_name','last_name_kana','first_name_kana','password','email'] as $key){
            unset($param[$key]);
        }
        foreach($param as $k => $v){if($v){$data[$k] = $v;}}
        $createAccount = Account::create($data);

        return redirect()->route('account.index')->with('success',"{$createAccount->employee_number}:{$createAccount->name} さん が作成されました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('pages.account.show',compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $account['password'] = '';
        if($account['email']){$account['email'] = str_replace('@staff-first.co.jp','',$account->email);}
        $nameExplode = explode(' ',$account->name);
        $account['last_name'] = $nameExplode[0];
        $account['first_name'] = $nameExplode[1];
        $nameKanaExplode = explode(' ',$account->name_kana);
        $account['last_name_kana'] = $nameKanaExplode[0];
        $account['first_name_kana'] = $nameKanaExplode[1];

        return view('pages.account.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $rules = $this->rules;
        $rules['employee_number'] .= ',employee_number,'.$account->id;
        if(empty($request->password)){unset($rules['password']);}

        $request->validate($rules);
        $param = $request->all();

        $account->name = $param['last_name'].' '.$param['first_name'];
        $account->name_kana = $param['last_name_kana'].' '.$param['first_name_kana'];
        if($param['password']){$account->password = Hash::make(trim($param['password']));}
        if($param['email']){$account->email = $param['email'].'@staff-first.co.jp';}
        if($param['bc_route_id']){$account->bc_route_id = $param['bc_route_id'];}
        foreach(['last_name','first_name','last_name_kana','first_name_kana','password','email','bc_route_id'] as $key){
            unset($param[$key]);
        }
        $account->fill($param)->save();

        return redirect()->route('account.index')->with('success',$account->name.'の更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
        $account->delete();
        return redirect()->route('account.index')->with('success',$account->name.'を削除しました。');
    }
}
