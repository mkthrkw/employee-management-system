<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DevelopController extends Controller
{
    //
    public function sql(Request $request)
    {
        return view('pages.develop.sql');
    }

    //
    public function sqlExecute(Request $request)
    {
        $sql = $request->input('sql');
        $key = $request->input('key');
        $env_key = config('env.DEVELOP_SQL_EXECUTE_KEY') ?? env('DEVELOP_SQL_EXECUTE_KEY');
        $ng_list = ['update','delete','insert','alter','create','drop','execute','grant','truncate'];

        try{
            if(!Gate::allows('gate', 'gate8')){
                throw new \Exception("権限がありません。");
            }

            if($key != $env_key){
                throw new \Exception("実行キーが違います。");
            }

            foreach($ng_list as $ng){
                if(preg_match("/".$ng." /i", $sql)){
                    throw new \Exception("使用禁止のアクションです。");
                }
            }

            $data = DB::select($sql);
            $display_type = $request->input('display_type');
            return view('pages.develop.sql',compact('data','display_type','sql'));

        }catch(\Exception $e){
            $msg = $e->getMessage();
            return view('pages.develop.sql',compact('msg'));
        }
    }
}
