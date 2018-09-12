@extends('layouts.app')

@section('content')
    <div class="container">

        @if(isset($msg))
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin-bottom: 10px">
                    @if($msg == 'fail')
                        <div class="alert alert-danger">
                            <h4>දෝෂයකි: {{$info}}</h4>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h4>සාර්ථකයි: {{$info}}</h4>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-bottom: 20px">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        මුරපදය වෙනස් කිරිම
                    </div>
                    <div class="panel-body">
                        <form action="/profile/password" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="password1">වර්තමාන මුරපදය අැතුලත් කරන්න</label>
                                <input type="password" name="password_old" id="password_old" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password1">නව මුරපදය අැතුලත් කරන්න</label>
                                <input type="password" name="password1" id="password1" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password2">නව මුරපදය නැවතත් අැතුලත් කරන්න</label>
                                <input type="password" name="password2" id="password2" class="form-control" required>
                            </div>
                            <div align="center" style="margin-top: 20px">
                                <input type="submit" value="මුරපදය වෙනස් කරන්න" class="btn btn-danger">
                            </div>
                        </form>
                    </div>
                </div>
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
@stop