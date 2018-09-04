<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function searchEndpoint(Request $request)
    {
        $search = $request->get('val');
        $type = $request->get('type');

        if (!isset($search) || !isset($type))
            return response()->json(["msg" => "Incorrect request parameters"]);

        if ($type == 'form_id') {
            $res = DB::table('documents')
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed'])
                ->where('form_id', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($type == 'form_name') {
            $res = DB::table('documents')
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed'])
                ->where('form_name', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($type == 'mf_no') {
            $res = DB::table('documents')
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed'])
                ->where('mf_no', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->get();
        } else {
            $res = ["No Documents found"];
        }
        return response()->json($res);
    }

    public function serveDocument(Request $request)
    {
        $form_id = $request->get('form_id');
        if (isset($form_id)) {
            $res = DB::table('documents')
                ->where('form_id', $form_id)
                ->first();
            return view('document', ['document' => $res]);
        } else {
            return response()->json(["msg" => "Incorrect request parameters"]);
        }


    }

    public function getCustomDocumentLists(Request $request)
    {
        return view('customdocs');
    }

    public function allDocsEndpoint(Request $request)
    {
        $cols = $request->all();
        $size = intval($request->get('colsize'));
        $count = intval($request->get('count'));

        $from = $request->get('from');
        $to = $request->get('to');

        $showDestroyed = $request->get('showdestroyed');
        $str = array();
        $i = 0;
        foreach ($cols as $col) {
            if ($i < $size) {
                $i++;
                array_push($str, strval($col));

            } else
                break;
        }

        if (isset($from) && isset($to)) {
            if ($showDestroyed == "true") {
                $res = DB::table('documents')
                    ->where('form_start_date', '>=', $from)
                    ->where('form_start_date', '<=', $to)
                    ->orderBy('form_start_date', 'DESC')
                    ->limit($count)
                    ->get();
            } else {
                $res = DB::table('documents')
                    ->where('destroyed', 0)
                    ->where('form_start_date', '>=', $from)
                    ->where('form_start_date', '<=', $to)
                    ->orderBy('form_start_date', 'DESC')
                    ->limit($count)
                    ->get();
            }
        } else {
            if ($showDestroyed == "true") {
                $res = DB::table('documents')
                    ->limit($count)
                    ->orderBy('form_start_date', 'DESC')
                    ->get();
            } else {
                $res = DB::table('documents')
                    ->where('destroyed', 0)
                    ->limit($count)
                    ->orderBy('form_start_date', 'DESC')
                    ->get();
            }

        }
        return response()->json($res);

    }

    public function deleteDocument(Request $request)
    {

        $id = $request->get('id');
        if (isset($id)) {
            DB::table('documents')
                ->where('id', $id)
                ->update([
                    'destroyed' => true,
                    'destroyed_on' => date('Y-m-d'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            return response()->json(['status' => 'ok', 'id' => $request->get('id')]);
        }
        return response()->json(['status' => 'fail', 'id' => $request->get('id')]);
    }


}
