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
                    <thead>
                    <tr>
                        <td colspan="5" align="center">
                            <h3>Columns</h3>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_id" value="form_id" checked> Form ID</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_name" value="form_name" checked> Form Name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="mf_no" value="mf_no" checked> Form MF Number</td>
                        <td><input class="msgcheckbox" type="checkbox" id="start_date" value="form_start_date" checked> Form Start Date</td>

                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="accepted_date" value="form_accepted_date" checked> Form Accepted Date</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_section" value="form_section" checked> Form Section</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_sender_name" value="form_sender_name" checked> Form Sender name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_receiver_name" value="form_receiver_name" checked> Form Receiver name</td>


                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_recommender_name" value="form_recommender_name"> Form Recommender name</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed_on" value="destroyed_on"> Form Destroyed on</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed" value="destroyed"> Form Destroyed</td>
                        <td></td>
                    </tr>

                    <tr align="center">
                        <td colspan="4"><h3>Conditions</h3></td>
                    </tr>

                    <tr>
                        <td>Form start date from: <input type="date" id="date_from"></td>
                        <td>To: <input type="date" id="date_to"></td>
                        <td><input type="checkbox" id="show_destroyed" value="destroyed" checked> Show Destroyed</td>
                        <td>Documents: <input type="number" value="20" id="size" min="1" max="1000" required></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button class="btn btn-primary" onclick="ajaxfordocs()">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12" id="tableDiv" style="font-family: sans-serif;">
                </div>
            </div>


            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/custom.js') }}"></script>
            <script type="text/javascript">
                document.onload = ajaxfordocs();
                document.getElementById('date_from').valueAsDate = new Date();
                document.getElementById('date_to').valueAsDate = new Date();
            </script>
        </div>
    </div>
@endsection