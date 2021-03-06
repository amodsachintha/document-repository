<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function getCustomDocumentLists()
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
                    ->orderBy('created_at', 'DESC')
                    ->limit($count)
                    ->get();
            } else {
                $res = DB::table('documents')
                    ->where('destroyed', 0)
                    ->where('form_start_date', '>=', $from)
                    ->where('form_start_date', '<=', $to)
                    ->orderBy('created_at', 'DESC')
                    ->limit($count)
                    ->get();
            }
        } else {
            if ($showDestroyed == "true") {
                $res = DB::table('documents')
                    ->limit($count)
                    ->orderBy('created_at', 'DESC')
                    ->get();
            } else {
                $res = DB::table('documents')
                    ->where('destroyed', 0)
                    ->limit($count)
                    ->orderBy('created_at', 'DESC')
                    ->get();
            }

        }
        return response()->json($res);

    }

    public function index()
    {
        return view('index2');
    }


}
