<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function searchEndpoint(Request $request){
        $search = $request->get('val');
        $type = $request->get('type');

        if(!isset($search) || !isset($type))
            return response()->json(["msg"=>"Incorrect request parameters"]);

        if($type=='form_id'){
            $res = DB::table('documents')
                ->select(['form_id','form_name','mf_no'])
                ->where('form_id','like','%'.$search.'%')
                ->orderBy('created_at','ASC')
                ->get();
        }
        elseif ($type == 'form_name'){
            $res = DB::table('documents')
                ->select(['form_id','form_name','mf_no'])
                ->where('form_name','like','%'.$search.'%')
                ->orderBy('created_at','ASC')
                ->get();
        }
        elseif($type == 'mf_no'){
            $res = DB::table('documents')
                ->select(['form_id','form_name','mf_no'])
                ->where('mf_no','like','%'.$search.'%')
                ->orderBy('created_at','ASC')
                ->get();
        }
        else{
            $res = ["No Documents found"];
        }
        return response()->json($res);
    }

    public function serveDocument(Request $request){
        $form_id = $request->get('form_id');
        if(isset($form_id)){
            $res = DB::table('documents')
                    ->where('form_id',$form_id)
                    ->first();
            return response()->json($res);
        }
        else{
            return response()->json(["msg"=>"Incorrect request parameters"]);
        }


    }





}
