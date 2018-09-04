@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-8 col-md-offset-2" style="text-align: center">
                <h4 style="text-align: center; color: #000063">&nbsp;<strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong>&nbsp;</h4>
                <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
                <p style="color: #2a88bd; font-size: large"><strong>බැහරට දීම</strong></p>
            </div>
        </div>

        <div class="row" style="margin-bottom: 15px; font-family: sans-serif" >
            <div class="col-md-8 col-md-offset-2" style="color: black; ">
                <table class="table table-striped table-bordered" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Form ID</th>
                        <th>Form Name</th>
                        <th>Lent to</th>
                        <th>Lend Date</th>
                        <th>Days Elapsed</th>
                        <th>Return</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><a onclick="popitup({{"'/document?form_id=".$row->form_id."','".$row->form_id."'"}})">{{$row->form_id}}</a></td>
                            <td>{{$row->form_name}}</td>
                            <td>{{$row->lent_to}}</td>
                            <td>{{$row->lend_date}}</td>
                            <td>{{round((time()-strtotime($row->lend_date))/(60*60*24))}}</td>
                            <td>
                                <button class="btn btn-success" onclick="if(confirm('Are you sure?')){returnDocument({{$row->id}})}">Return</button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" align="center">{{$data->links()}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function returnDocument(id) {
            console.log(id);
            var ajax = new XMLHttpRequest();
            ajax.open('GET', '/lendings/return?id=' + id, true);
            ajax.onload = function () {
                var data = JSON.parse(ajax.responseText);
                if (data['status'] === 'ok') {
                    alert("Success!");
                    window.location.reload();
                }
                else {
                    alert("Deletion Failed!");
                }
            };
            ajax.send();
        }

        function popitup(url, windowName) {
            newwindow = window.open(url, windowName, 'height=900,width=600');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        }
    </script>

@endsection
