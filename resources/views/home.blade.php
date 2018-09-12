@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 40px; font-family: sans-serif">
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-8 col-md-offset-2" style="">
                <h4 style="text-align: center; color: #000063">&nbsp;<strong>ලේඛණාගාර තොරතුරු පිළිබද දත්ත පද්ධතිය</strong>&nbsp;</h4>
                <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table">
                    <tr class="bg-info">
                        <td><input type="text" style="color: black" class="form-control" id="search-text" placeholder="ලිපිගොනුවේ නම අැතුලත් කරන්න" onkeyup="ajaxme()" autofocus></td>
                        <td align="right">
                            <select class="form-control" id="search-type" style="width: 95%;" onchange="ajaxme()" required>
                                <option value="form_id">ගොනු අංකය</option>
                                <option value="mf_no" selected>MF අංකය</option>
                                <option value="form_name">ගොනුවේ නම</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="text-muted">
                        <td colspan="2">
                            <small class="small" style="text-align: left; color: brown">*තොරතුරු ලබා ගැනීමට බළාපොරොත්තු ව ලිපිගොනුවේ නම අැතුලත් කරන්න</small>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div id="resultsCount">
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-8 col-md-offset-2" align="center" id="table">
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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
@endsection
