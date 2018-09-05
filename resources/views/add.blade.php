@extends('layouts.app')

@section('content')
    <div class="container" style="font-size: smaller; margin-bottom: 10px">
        <div class="row" style="margin-bottom: 30px">
            <div class="col-sm-12" style="">
                <h4 style="text-align: center; color: #000063">&nbsp;<strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong>&nbsp;</h4>
                <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
            </div>
        </div>

        @if(isset($msg))
            @if($msg == "ok")
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="alert alert-success">
                            ගොනුව අැතුලත් කිරීම සාර්ථකයි!
                        </div>
                    </div>
                </div>
            @elseif($msg == "fail")
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="alert alert-danger">
                            ගොනුව අැතුලත් කිරීම අසාර්ථකයි!
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div style="margin-bottom: 10px; margin-top: 25px">
            <p style="text-align: center; color: #2980B9; font-size: 14px"><strong>නව ලිපිගොනුවක දත්ත අැතුලත් කිරීම</strong></p>
        </div>

        <div class="row" style="color: black; font-family: sans-serif">
            <div class="col-md-8 col-md-offset-2">
                <form class="form" method="POST" action="/add">
                    <div class="form-group">
                        <label for="form-id" class=" col-form-label font-weight-bold">ලිපිගොනු අංකය</label>
                        <input type="text" class="form-control " name="form-id" required>
                    </div>
                    <div class="form-group">
                        <label for="form-name" class="col-form-label font-weight-bold">ලිපිගොනුවෙ නම</label>
                        <input type="text" class="form-control" name="form-name" required>
                    </div>
                    <div class="form-group">
                        <label for="form-start-date" class=" col-form-label font-weight-bold">ලිපිගොනුව අාරම්භ කල දිනය</label>
                        <input type="date" class="form-control" name="form-start-date" required>
                    </div>
                    <div class="form-group">
                        <label for="form-accepted-date" class=" col-form-label font-weight-bold">ලිපිගොනුව ලේඛනාගාරයට අැතුලත් කල දිනය</label>
                        <input type="date" class="form-control " name="form-accepted-date" required>
                    </div>
                    <div class="form-group">
                        <label for="form-section" class="col-form-label font-weight-bold">ලිපිගොනුව අයත් අංශය</label>
                        <select name="form-section" class="form-control" required>
                            <option value="">අංශය තොරන්න...</option>
                            <option value="1">සංවර්ධන</option>
                            <option value="2">යහපාලනය</option>
                            <option value="3">පරිපාලන</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="form-mf-no" class=" col-form-label font-weight-bold">ලිපිගොනුව ගබඩා කල MF අංකය</label>
                        <input type="text" class="form-control" name="form-mf-no" required>
                    </div>
                    <div class="form-group">
                        <label for="form-sender-name" class=" col-form-label font-weight-bold">ලේඛනාගාරයට ලිපිගොනුව භාරදුන් නිලධාරියාගේ නම</label>
                        <input type="text" class="form-control" name="form-sender-name" required>
                    </div>
                    <div class="form-group">
                        <label for="form-reciever-name" class=" col-form-label font-weight-bold">ලිපිගොනුව භාරගත් නිලධාරියාගේ නම</label>
                        <input type="text" class="form-control" name="form-receiver-name" required>
                    </div>
                    <div class="form-group">
                        <label for="form-recommender-name" class=" col-form-label font-weight-bold">නිර්දේශය ලබාදුන් මාන්ඩලික නිලධාරියාගේ
                            නම</label>
                        <input type="text" class="form-control" name="form-recommender-name" required>
                    </div>
                    <div align="center">
                        <input type="submit" style="width: 30%;; margin-bottom: 20px;" id="submit" class="btn btn-primary" value="තැන්පත් කරන්න">
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@endsection