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
                            ගොනුව අැතුලත් කිරීම අසාර්ථකයි! {{$info}}
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
                        <input type="date" class="form-control" name="form-start-date">
                    </div>

                    <div class="form-group">
                        <label for="form-given-date" class=" col-form-label font-weight-bold">ලිපිගොනුව ලේඛණාගාරයට භාර දුන් දිනය</label>
                        <input type="date" class="form-control" name="form-given-date">
                    </div>

                    <div class="form-group">
                        <label for="form-accepted-date" class=" col-form-label font-weight-bold">ලිපිගොනුව ලේඛණාගාරයට භාරගත් දිනය</label>
                        <input type="date" class="form-control " name="form-accepted-date" >
                    </div>
                    <div class="form-group">
                        <label for="to_be_destroyed" class=" col-form-label font-weight-bold">විනාශ කළ යුතු දිනය</label>
                        <input type="date" class="form-control" name="to-be-destroyed">
                    </div>
                    <div class="form-group">
                        <label for="form-section" class="col-form-label font-weight-bold">ලිපිගොනුව අයත් අංශය</label>
                        <input type="text" list="sections" class="form-control">
                        <datalist id="sections">
                            @if(isset($sections))
                                @foreach($sections as $section)
                                    <option>{{$section->form_section}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="form-mf-no" class=" col-form-label font-weight-bold">ලිපිගොනුව ගබඩා කල MF අංකය</label>
                        <input type="text" class="form-control" name="form-mf-no" list="mfs" required>
                        <datalist id="mfs">
                            @if(isset($mfs))
                                @foreach($mfs as $mf)
                                    <option>{{$mf->mf_no}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="form-sender-name" class=" col-form-label font-weight-bold">ලේඛණාගාරයට ලිපිගොනුව භාරදුන් නිලධාරියාගේ නම</label>
                        <input type="text" class="form-control" name="form-sender-name" list="senders">
                        <datalist id="senders">
                            @if(isset($senders))
                                @foreach($senders as $sender)
                                    <option>{{$sender->form_sender_name}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="form-reciever-name" class=" col-form-label font-weight-bold">ලිපිගොනුව භාරගත් නිලධාරියාගේ නම</label>
                        <input type="text" class="form-control" name="form-receiver-name" list="receivers">
                        <datalist id="receivers">
                            @if(isset($receivers))
                                @foreach($receivers as $receiver)
                                    <option>{{$receiver->form_receiver_name}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="form-recommender-name" class=" col-form-label font-weight-bold">නිර්දේශය ලබාදුන් මාන්ඩලික නිලධාරියාගේ
                            නම</label>
                        <input type="text" class="form-control" name="form-recommender-name" list="officers">
                        <datalist id="officers">
                            @if(isset($officers))
                                @foreach($officers as $officer)
                                    <option>{{$officer->form_recommender_name}}</option>
                                @endforeach
                            @endif
                        </datalist>
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