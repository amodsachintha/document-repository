@extends('layouts.app')

@section('content')
    <style>
        .msgcheckbox {

        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
                <table class="table">
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_id" value="form_id" checked> Form ID</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_name" value="form_name" checked> Form Name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="mf_no" value="mf_no" checked> Form MF Number</td>
                        <td><input class="msgcheckbox" type="checkbox" id="start_date" value="form_start_date" checked> Form Start Date</td>
                        <td><input class="msgcheckbox" type="checkbox" id="accepted_date" value="form_accepted_date" checked> Form Accepted Date</td>
                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_section" value="form_section" checked> Form Section</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_sender_name" value="form_sender_name" checked> Form Sender name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_receiver_name" value="form_receiver_name" checked> Form Receiver name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_recommender_name" value="form_recommender_name" checked> Form Recommender name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed_on" value="destroyed_on" checked> Form Destroyed on</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="msgcheckbox" type="checkbox" id="destroyed" value="destroyed" checked> Form Destroyed</td>
                        <td colspan="3">Documents: <input type="number" value="20" id="size" min="1" max="1000" required></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">
                            <button class="btn btn-primary" onclick="ajaxfordocs()">Update</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="tableDiv" style="font-family: sans-serif;">
            </div>
        </div>


        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script type="text/javascript">
            document.onload = ajaxfordocs();
        </script>
    </div>
@endsection