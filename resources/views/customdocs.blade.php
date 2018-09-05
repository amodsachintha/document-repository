@extends('layouts.app')

@section('content')
    <style>
        .msgcheckbox {

        }
    </style>
    <div class="container">

        <div class="visible-print">
            <h1 style="text-align: center; color: #000063"><strong>ලේඛණාගාර තොරතුරු පිළිබද<br> දත්ත පද්ධතිය</strong></h1>
            <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
            <p style="text-align: center">{{new \Carbon\Carbon()}}</p>
        </div>

        <div class="row">
            <div class="col-md-12 hidden-print" align="center">
                <table class="table">
                    <thead>
                    <tr>
                        <td colspan="5" align="center">
                            <h3>දිස්විය යුතු තීරු</h3>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_id" value="form_id" checked> ගොනු අංකය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_name" value="form_name" checked> ගොනුවේ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="mf_no" value="mf_no" checked> MF අංකය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="start_date" value="form_start_date" checked> අාරම්භ කල දිනය</td>

                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="accepted_date" value="form_accepted_date" checked> ලේඛණාගාරයට අැතුලත් කල දිනය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_section" value="form_section" checked> අංශය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_sender_name" value="form_sender_name" checked> භාරදුන් නිලධාරියාගේ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_receiver_name" value="form_receiver_name" checked> භාරගත් නිලධාරියාගේ නම</td>


                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_recommender_name" value="form_recommender_name">නිර්දේශය ලබාදුන් මාන්ඩලික නිලධාරියාගේ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed_on" value="destroyed_on">ගොනුව විනාශ කළ දිනය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed" value="destroyed"> විනාශවී ද?</td>
                        <td></td>
                    </tr>

                    <tr align="center">
                        <td colspan="4"><h3>කොන්දේසි</h3></td>
                    </tr>

                    <tr>
                        <td>අාරම්භ කල දිනය- සිට: <input type="date" id="date_from"></td>
                        <td>දක්වා: <input type="date" id="date_to"></td>
                        <td><input type="checkbox" id="show_destroyed" value="destroyed" checked> විනාශ කරන ලද ගොනු දිස්වන්න</td>
                        <td>ගණන: <input type="number" value="20" id="size" min="1" max="1000" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-primary" onclick="ajaxfordocs()">යාවත්කාලීන කරන්න</button>
                        </td>
                        <td colspan="2" align="center">
                            <button class="btn btn-warning" onclick="window.print()" style="width: 150px">Print!</button>
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