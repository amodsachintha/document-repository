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
               ගොණු අංකය:
                <strong>{{$document->form_id}}</strong></h2>
            <h2>
                MF අංකය:
                <strong>{{$document->mf_no}}</strong></h2>
            @if(!$document->destroyed)
                <p><button class="btn btn-lg btn-danger hidden-print" onclick="if (confirm('Are you sure?')){removeDocument({{$document->id}})} " role="button">Remove Document</button></p>
            @else
                <p>විනාශ කළ දිනය: <strong>{{$document->destroyed_on}}</strong></p>
            @endif

        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>Form ID:</td>
                        <td><strong>{{$document->form_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Name</td>
                        <td><strong>{{$document->form_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form MF Number</td>
                        <td><strong>{{$document->mf_no}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Start Date</td>
                        <td><strong>{{$document->form_start_date}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Accepted date</td>
                        <td><strong>{{$document->form_accepted_date}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Section</td>
                        <td><strong>{{$document->form_section}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Sender Name</td>
                        <td><strong>{{$document->form_sender_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Receiver Name</td>
                        <td><strong>{{$document->form_receiver_name}}</strong></td>
                    </tr>
                    <tr>
                        <td>Form Recommender Name</td>
                        <td><strong>{{$document->form_recommender_name}}</strong></td>
                    </tr>
                    @if($document->destroyed)
                    <tr style="background-color: #D35400;">
                        <td>Form Destroyed On</td>
                        <td><strong>{{$document->destroyed_on}}</strong></td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function removeDocument(id) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET","/deletedocument?id="+id,true);
            ajax.onload = function () {
                var msg = JSON.parse(ajax.responseText);
                if(msg['status'] === 'ok'){
                    alert("Document Deleted!");
                    window.location.reload();
                }
                else{
                    alert("Deletion Failed!");
                }
            };
            ajax.send();
        }
    </script>

@endsection