@extends("layouts.app")

@section("content")
    <div class="container">
        <div style="margin-bottom: 50px">
            <h1 style="text-align: center; color: #000063"><strong>ලේඛණාගාර තොරතුරු පිළිබද<br> දත්ත පද්ධතිය</strong></h1>
            <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
        </div>
    </div>
    <div class="container" align="center">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>ලිපිගොනු දත්ත පද්ධතියට පිවිසෙන්න පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-success">
                        <button class="btn btn-success btn-lg" onclick="window.location.href='/search'" style="width: 90%"><strong>පිවිසෙන්න</strong></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"  style="margin-bottom: 10px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>නව ලිපි ගොනුවක දත්ත අැතුලත් කිරීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-danger">
                        <button class="btn btn-danger btn-lg" id="search" style="width: 90%"><strong>දත්ත අැතුලත් කිරීම</strong></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"  style="margin-bottom: 10px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>සියලු ගොනු වල ලයිස්තුවක් ලබා ගැනීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-info">
                        <button class="btn btn-info btn-lg" id="search" style="width: 90%"><strong>සියලු ගෙනු</strong></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"  style="margin-bottom: 10px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>බැහරට දීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-warning">
                        <button class="btn btn-warning btn-lg" id="search" style="width: 90%"><strong>බැහරට දීම</strong></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection