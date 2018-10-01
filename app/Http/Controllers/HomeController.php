<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed', 'lent'])
                ->where('form_id', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($type == 'form_name') {
            $res = DB::table('documents')
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed', 'lent'])
                ->where('form_name', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($type == 'mf_no') {
            $res = DB::table('documents')
                ->select(['form_id', 'form_name', 'mf_no', 'destroyed', 'lent'])
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

            $isLent = DB::table('lendings')
                ->where('form_id', $form_id)
                ->where('lent',true)
                ->where('archived',false)
                ->count();

            $lending = DB::table('lendings')
                ->where('form_id', $form_id)
                ->where('lent',true)
                ->first();

            if ($isLent != 0) {
                return view('document', ['document' => $res, 'isLent' => $isLent, 'lending' => $lending]);
            } else {
                return view('document', ['document' => $res, 'isLent' => $isLent]);
            }

        } else {
            return response()->json(["msg" => "Incorrect request parameters"]);
        }
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


    public function showAddDocument()
    {
        $sections = DB::table('documents')
            ->select(['form_section'])
            ->distinct('form_section')
            ->get();

        $mfs = DB::table('documents')
            ->select(['mf_no'])
            ->distinct('mf_no')
            ->get();

        $officers = DB::table('documents')
            ->select(['form_recommender_name'])
            ->distinct('form_recommender_name')
            ->get();

        $senders = DB::table('documents')
            ->select(['form_sender_name'])
            ->distinct('form_sender_name')
            ->get();

        $receivers = DB::table('documents')
            ->select(['form_receiver_name'])
            ->distinct('form_receiver_name')
            ->get();

        return view('add', [
            'sections' => $sections,
            'mfs' => $mfs,
            'officers' => $officers,
            'senders' => $senders,
            'receivers' => $receivers,
        ]);
    }

    public function addDocument(Request $request)
    {
//        return response()->json($request->all());
        $form_id = $request->get('form-id');
        $form_name = $request->get('form-name');
        $form_start_date = $request->get('form-start-date');
        $form_given_date = $request->get('form-given-date');
        $form_accepted_date = $request->get('form-accepted-date');
        $form_section = $request->get('form-section');
        $form_to_be_destroyed = $request->get('to-be-destroyed');
        $form_mf_no = $request->get('form-mf-no');
        $form_sender_name = $request->get('form-sender-name');
        $form_receiver_name = $request->get('form-receiver-name');
        $form_recommender_name = $request->get('form-recommender-name');

        if ($form_id == null || $form_name == null || $form_mf_no == null) {
//            return abort(500,"Server Error");
            return view('add', ['msg' => 'fail', 'info' => 'අත්‍යාවශ්‍ය තොරතුරු අැතුලත් වී නැත!']);
        }

        $year = intval(date('Y')) + 10;

        if (!isset($form_start_date))
            $form_start_date = null;
        if (!isset($form_accepted_date))
            $form_accepted_date = null;
        if (!isset($form_given_date))
            $form_given_date = null;
        if (!isset($form_sender_name))
            $form_sender_name = "-";
        if (!isset($form_receiver_name))
            $form_receiver_name = "-";
        if (!isset($form_recommender_name))
            $form_recommender_name = "-";
        if (!isset($form_section))
            $form_section = "-";
        if (!isset($form_to_be_destroyed))
            $form_to_be_destroyed = date('Y-m-d',strtotime(date(strval($year).'-01-01')));

        $count = DB::table('documents')
            ->where('form_id', $form_id)
            ->count();

        if ($count != 0) {
            return view('add', ['msg' => 'fail', 'info' => 'මෙම ගොනු අංකය සහිත ලිපිගොනුවක් දැනටමත් පවතී!']);
        }

        DB::table('documents')
            ->insert([
                'form_id' => $form_id,
                'form_name' => $form_name,
                'form_start_date' => $form_start_date,
                'form_given_date' => $form_given_date,
                'form_accepted_date' => $form_accepted_date,
                'form_section' => $form_section,
                'to_be_destroyed' => $form_to_be_destroyed,
                'mf_no' => $form_mf_no,
                'form_sender_name' => $form_sender_name,
                'form_receiver_name' => $form_receiver_name,
                'form_recommender_name' => $form_recommender_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        return view('add', ['msg' => 'ok']);

    }


    public function showLendings()
    {
        return view('lend', ['data' => $this->loadLendings(), 'i' => 1]);
    }

    public function showArchive()
    {
        return view('lend_archive', ['data' => $this->loadArchive(), 'i' => 1]);
    }

    private function loadLendings()
    {
        return DB::table('lendings')
            ->where('lent', true)
            ->orderBy('lend_date', 'DESC')
            ->paginate(15);
    }

    private function loadArchive()
    {
        return DB::table('lendings')
            ->where('archived', true)
            ->orderBy('lend_date', 'DESC')
            ->paginate(15);
    }

    public function returnDocument(Request $request)
    {
        $id = $request->get('id');
        if (!isset($id)) {
            return response()->json(['status' => 'error', 'msg' => 'id not set']);
        } else {
            DB::table('lendings')
                ->where('id', $id)
                ->update([
                    'lent' => false,
                    'return_date' => date('Y-m-d'),
                    'archived' => true,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            $form_id = DB::table('lendings')
                ->select('form_id')
                ->where('id', $id)
                ->first();

            DB::table('documents')
                ->where('form_id', $form_id->form_id)
                ->update([
                    'lent' => false,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        }
        return response()->json(['status' => 'ok', 'msg' => 'success']);
    }

    public function addIndividualLendShow(Request $request)
    {
        $form_id = $request->get('form_id');
        if ($form_id != "" || $form_id != null) {
            $data = DB::table('documents')
                ->select(['form_id', 'form_name'])
                ->where('form_id', $form_id)
                ->first();
            return view('newlend', ['data' => $data]);
        }

        return "ERROR!";

    }

    public function addIndividualLend(Request $request)
    {
        $form_id = $request->get('form_id');
        $form_name = $request->get('form_name');
        $officer_name = $request->get('officer_name');

        $lendsInLendings = DB::table('lendings')
            ->where('form_id', $form_id)
            ->where('lent', true)
            ->count();

        if ($lendsInLendings != 0) {
            return "<script>alert('Lending Failed! Duplicate Lend Exists!'); window.close();</script>";
        }

        DB::table('lendings')
            ->insert([
                'form_id' => $form_id,
                'form_name' => $form_name,
                'lend_date' => date('Y-m-d'),
                'lent_to' => $officer_name,
                'lent' => true,
                'archived' => false,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        DB::table('documents')
            ->where('form_id', $form_id)
            ->update([
                'lent' => true,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return "<script>alert('Lending added successfully!'); window.close();</script>";
    }

    public function showProfile()
    {
        return view('profile');
    }

    public function changePassword(Request $request)
    {
        $password_old = $request->get('password_old');
        $password_new_1 = $request->get('password1');
        $password_new_2 = $request->get('password2');
        $user = Auth::user();

        if (strlen($password_new_1) < 6) {
            return view('profile', ['msg' => 'fail', 'info' => 'නව මුරපදයේ දිග අක්ෂර 6ක් හෝ ඊට වැඩි විය යුතුය!']);
        }

        if (!Hash::check($password_old, $user->password)) {
            return view('profile', ['msg' => 'fail', 'info' => 'වර්තමාන මුරපදය නොගැලපේ!']);
        }

        if (strcmp($password_new_1, $password_new_2) != 0) {
            return view('profile', ['msg' => 'fail', 'info' => 'නව මුරපද සමාන නොවේ!']);
        }

        $request->user()->fill([
            'password' => Hash::make($password_new_1),
        ])->save();

        return view('profile', ['msg' => 'ok', 'info' => 'මුරපදය සාර්ථකව වෙනස් කරන ලදී!']);

    }

    public function purgeDocument(Request $request)
    {
        if (Auth::user()->email != "secretary@divisional.lk")
            return "ERROR";

        $id = $request->get('id');
        if ($id == null)
            return response()->json(['status' => 'fail', 'msg' => 'invalid']);

        DB::table('documents')
            ->where('id', $id)
            ->delete();

        return response()->json(['status' => 'ok', 'msg' => 'success']);

    }

}
