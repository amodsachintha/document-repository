@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-8 col-md-offset-2" style="text-align: center">
                <h4 style="text-align: center; color: #000063">&nbsp;<strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong>&nbsp;</h4>
                <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
                @if(!isset($_GET['form_id']))
                    <p><a href="/lendings/archive" class="btn btn-primary hidden-print">පැරණි බැහරදීම්</a></p>
                @endif
                <p style="color: #7d1b06; font-size: large"><strong>බැහරට දීම</strong></p>
            </div>
        </div>

        <div class="row" style="margin-bottom: 15px; font-family: sans-serif">
            <div class="col-md-8 col-md-offset-2" style="color: black; ">
                <table class="table table-striped table-bordered" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ගොනු අංකය</th>
                        <th>ගොනුවේ නම</th>
                        <th>බැහර දුන් නිලධාරියාගේ නම</th>
                        <th>බැහර දුන් දිනය</th>
                        <th>ගෙවී ගිය දින ගණන</th>
                        <th class="hidden-print">නැවත භාර ගැනීම</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        @if(isset($_GET['form_id']))
                            @if($_GET['form_id'] == strval($row->form_id))
                                <tr style="background-color: #F7DC6F">
                            @endif
                        @else
                            <tr>
                                @endif

                                <td>{{$i++}}</td>
                                <td><a onclick="popitup({{"'/document?form_id=".$row->form_id."','".$row->form_id."'"}})">{{$row->form_id}}</a></td>
                                <td>{{$row->form_name}}</td>
                                <td>{{$row->lent_to}}</td>
                                <td>{{$row->lend_date}}</td>
                                <td>{{round((time()-strtotime($row->lend_date))/(60*60*24))}}</td>
                                <td class="hidden-print">
                                    <button class="btn btn-success" onclick="if(confirm('Are you sure?')){returnDocument({{$row->id}})}">නැවත භාර ගැනීම</button>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="hidden-print">
                                <td colspan="7" align="center">{{$data->links()}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($_SERVER['HTTP_REFERER']))
            <div class="row">
                <div class="col-md-8 col-md-offset-2" align="center">
                    <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-info">Back</a>
                </div>
            </div>
        @endif
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
                    alert("Return Failed!");
                }
            };
            ajax.send();
        }

        function popitup(url, windowName) {
            newwindow = window.open(url, windowName, 'height=900,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        }
    </script>

@endsection
