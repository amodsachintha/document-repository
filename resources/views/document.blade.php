@extends('layouts.app')

@section('content')

    <div class="container" style="font-family: sans-serif; color: black">

        <div class="visible-print">
            <h1 style="text-align: center; color: #000063"><strong>ලේඛණාගාර තොරතුරු පිළිබද<br> දත්ත පද්ධතිය</strong></h1>
            <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
            <p style="text-align: center">{{new \Carbon\Carbon()}}</p>
        </div>

        <div class="jumbotron text-center" @if($document->destroyed)style="background-color: #E74C3C; color: white" @else style="background-color: #2ECC71" @endif>
            <h2>
                ගොනුවේ නම:
                <strong>{{$document->form_name}}</strong></h2>
            <h2>
                <h2>
                    ගොනු අංකය:
                    <strong>{{$document->form_id}}</strong></h2>
                {{--<h2>--}}
                {{--MF අංකය:--}}
                {{--<strong>{{$document->mf_no}}</strong></h2>--}}
                @if($isLent == 0)
                    @if(!$document->destroyed)
                        <p>
                            <button class="btn btn-lg btn-danger hidden-print" onclick="if (confirm('Are you sure?')){removeDocument({{$document->id}})} " role="button">ලිපිගොනුව විනාශ කරන්න</button>
                        </p>
                    @else
                        <p>විනාශ කළ දිනය: <strong>{{$document->destroyed_on}}</strong></p>
                    @endif
                @else
                    <label class="alert alert-warning" role="alert">LENT</label>
            @endif

        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>ගොනු අංකය:</td>
                        <td><strong>{{$document->form_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>ලිපිගොනුව‍ෙ නම</td>
                        <td><strong>{{$document->form_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>MF අංකය</td>
                        <td><strong>{{$document->mf_no}}</strong></td>
                    </tr>
                    <tr>
                        <td>ලිපිගොනුව අාරම්භ කල දිනය</td>
                        <td><strong>{{$document->form_start_date}}</strong></td>
                    </tr>
                    <tr>
                        <td>ලිපිගොනුව ලේඛණාගාරයට භාර දුන් දිනය</td>
                        <td><strong>{{$document->form_given_date}}</strong></td>
                    </tr>
                    <tr>
                        <td>ලිපිගොනුව ලේඛණාගාරයට භාරගත් දිනය</td>
                        <td><strong>{{$document->form_accepted_date}}</strong></td>
                    </tr>
                    <tr>
                        <td>විනාශ කළ යුතු දිනය</td>
                        <td><strong>{{$document->to_be_destroyed}}</strong></td>
                    </tr>
                    <tr>
                        <td>අංශය</td>
                        <td><strong>{{$document->form_section}}</strong></td>
                    </tr>
                    <tr>
                        <td>භාරදුන් නිලධාරියාගේ නම</td>
                        <td><strong>{{$document->form_sender_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>භාරගත් නිලධාරියාගේ නම</td>
                        <td><strong>{{$document->form_receiver_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>නිර්දේශය ලබාදුන් මාන්ඩලික නිලධාරියාගේ නම</td>
                        <td><strong>{{$document->form_recommender_name}}</strong></td>
                    </tr>

                    @if($isLent != 0)
                        <tr>
                            <td>බැහැරට දුන් නිළධාරියාගේ නම</td>
                            <td><strong>{{$lending->lent_to}}</strong></td>
                        </tr>
                    @endif

                    @if($document->destroyed)
                        <tr style="background-color: #D35400;">
                            <td>ගොනුව විනාශ කළ දිනය</td>
                            <td><strong>{{$document->destroyed_on}}</strong></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="row hidden-print" align="center">
            <button class="btn btn-info" id="print_btn" style="width: 100px;" onclick="window.print();">Print</button>
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->email == "secretary@divisional.lk")
            <div class="row hidden-print" align="center" style="margin-top: 10px">
                <button class="btn btn-danger" id="delete_btn" style="width: 100px;" onclick="if(confirm('Are you sure?')) {deleteDocument({{$document->id}});}"> Delete</button>
            </div>
        @endif

    </div>
    <script type="text/javascript">
        function deleteDocument(id) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/purge?id=" + id, true);
            ajax.onload = function () {
                var msg = JSON.parse(ajax.responseText);
                if (msg['status'] === 'ok') {
                    alert("Document Deleted!");
                    window.close();
                }
                else {
                    alert("Deletion Failed!");
                }
            };
            ajax.send();
        }

        function removeDocument(id) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/deletedocument?id=" + id, true);
            ajax.onload = function () {
                var msg = JSON.parse(ajax.responseText);
                if (msg['status'] === 'ok') {
                    alert("Document Deleted!");
                    window.location.reload();
                }
                else {
                    alert("Deletion Failed!");
                }
            };
            ajax.send();
        }
    </script>
@endsection