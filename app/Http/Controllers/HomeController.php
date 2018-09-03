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

    public function mfEndpoint(Request $request){
        $search = $request->get('val');
        $type = $request->get('type');
        if($type=='form_id'){
            $res = DB::table('documents')
                ->where('form_id','like','%'.$search.'%')
                ->get();
        }
        elseif ($type == 'form_name'){
            $res = DB::table('documents')
                ->where('form_name','like','%'.$search.'%')
                ->get();
        }
        elseif($type == 'mf_no'){
            $res = DB::table('documents')
                ->where('mf_no','like','%'.$search.'%')
                ->get();
        }
        else{
            $res = ["No Documents found"];
        }
        return response()->json($res);
    }





}
