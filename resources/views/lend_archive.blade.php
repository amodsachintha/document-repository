@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-8 col-md-offset-2" style="text-align: center">
                <h4 style="text-align: center; color: #000063">&nbsp;<strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong>&nbsp;</h4>
                <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
                <p><a href="/lendings" class="btn btn-primary">සක්‍රිය බැහරදීම්</a></p>
                <p style="color: #0d7d1e; font-size: large"><strong>පසුගිය බැහර දීම්</strong></p>
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
                        <th>නැවත භාර ගත් දිනය</th>
                        <th>දින ගණන</th>
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
                            <td>{{$row->return_date}}</td>
                            <td>{{round((strtotime($row->return_date) - strtotime($row->lend_date))/(60*60*24))}}</td>
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
        function popitup(url, windowName) {
            newwindow = window.open(url, windowName, 'height=900,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        }
    </script>
@endsection
