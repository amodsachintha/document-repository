@extends("layouts.app")

@section("content")
    <div class="container">

        <div class="row" align="center">
            <div class="col-md-8 col-md-offset-2" align="center">
                <img src="/img/logo_text.png" width=400px>
            </div>
        </div>

        <div style="margin-bottom: 50px">
            <h1 style="text-align: center; color: #000063"><strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong></h1>
            <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
        </div>
    </div>
    <div class="container" align="center" style="margin-top: 20px; margin-bottom: 20px">
        <div class="row" style="margin-bottom: 15px; margin-top: -20px">
            <div class="col-md-6">
                <div class="panel panel-success" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>ලිපිගොනු දත්ත පද්ධතියට පිවිසෙන්න පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-success">
                        <button class="btn btn-success btn-lg" onclick="window.location.href='/search'" style="width: 90%; color: #242424"><strong>පිවිසෙන්න</strong></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-danger" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>නව ලිපි ගොනුවක දත්ත අැතුලත් කිරීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-danger">
                        <button class="btn btn-danger btn-lg" onclick="window.location.href='/add'" style="width: 90%; color: #242424"><strong>දත්ත අැතුලත් කිරීම</strong></button>
                    </div>
                </div>
            </div>


        </div>
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-6">
                <div class="panel panel-info" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>සියලු ගොනු වල ලයිස්තුවක් ලබා ගැනීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-info">
                        <button class="btn btn-info btn-lg" onclick="window.location.href='/alldocuments'" id="search" style="width: 90%; color: #242424"><strong>සියලු ගොනු</strong></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-warning" style="-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>ලිපිගොනු බැහරට දීම් ලයිස්තුවක් ලෙස ලබා ගැනීමට පහත යෙදුම භාවිතා කරන්න</strong></h3>
                    </div>
                    <div class="panel-body bg-warning">
                        <button class="btn btn-warning btn-lg" onclick="window.location.href='/lendings'" id="search" style="width: 90%; color: #242424"><strong>බැහරට දීම</strong></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection