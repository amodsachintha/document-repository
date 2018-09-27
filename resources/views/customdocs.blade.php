@extends('layouts.app')

@section('content')
    <style>
        .msgcheckbox {

        }
    </style>
    <div class="container">

        <div class="visible-print">
            <h1 style="text-align: center; color: #000063"><strong>ලේඛණාගාර තොරතුරු පිළිබද<br> දත්ත පද්ධතිය</strong></h1>
            <p class="lead" style="text-align: center">දික්වැල්ල ප්‍රාදේශිය සභාව</p>
            <p style="text-align: center">{{new \Carbon\Carbon()}}</p>
        </div>

        <div class="row">
            <div class="col-md-12 hidden-print" align="center">
                <table class="table">
                    <thead>
                    <tr>
                        <td colspan="5" align="center">
                            <h3>දිස්විය යුතු තීරු</h3>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_id" value="form_id" checked> ලිපිගොනු අංකය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_name" value="form_name" checked> ලිපිගොනුව‍ෙ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="mf_no" value="mf_no" checked> MF අංකය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="start_date" value="form_start_date" checked> ලිපිගොනුව අාරම්භ කල දිනය</td>

                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="given_date" value="form_given_date" checked> ලිපිගොනුව ලේඛණාගාරයට භාර දුන් දිනය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="accepted_date" value="form_accepted_date" checked> ලිපිගොනුව ලේඛණාගාරයට භාරගත් දිනය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_section" value="form_section" checked> අංශය</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_sender_name" value="form_sender_name" checked> භාරදුන් නිලධාරියාගේ නම</td>
                    </tr>
                    <tr>
                        <td><input class="msgcheckbox" type="checkbox" id="form_receiver_name" value="form_receiver_name" checked> භාරගත් නිලධාරියාගේ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="form_recommender_name" value="form_recommender_name">නිර්දේශය ලබාදුන් මාන්ඩලික නිලධාරියාගේ නම</td>
                        <td><input class="msgcheckbox" type="checkbox" id="to_be_destroyed" value="to_be_destroyed" checked> විනාශවී කල යුතු දිනය?</td>
                        <td><input class="msgcheckbox" type="checkbox" id="destroyed_on" value="destroyed_on">ගොනුව විනාශ කළ දිනය</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="4"><input class="msgcheckbox" type="checkbox" id="destroyed" value="destroyed"> විනාශවී ද?</td>
                    </tr>

                    <tr align="center">
                        <td colspan="4"><h3>කොන්දේසි</h3></td>
                    </tr>

                    <tr>
                        <td>අාරම්භ කල දිනය- සිට: <input type="date" id="date_from"></td>
                        <td>දක්වා: <input type="date" id="date_to"></td>
                        <td><input type="checkbox" id="show_destroyed" value="destroyed" checked> විනාශ කරන ලද ගොනු දිස්වන්න</td>
                        <td>ගණන: <input type="number" value="20" id="size" min="1" max="1000" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-primary" onclick="ajaxfordocs()">යාවත්කාලීන කරන්න</button>
                        </td>
                        <td colspan="2" align="center">
                            <button class="btn btn-warning" onclick="window.print()" style="width: 150px">Print!</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12" id="tableDiv" style="font-family: sans-serif;">
                </div>
            </div>

            @if(isset($_SERVER['HTTP_REFERER']))
                <div class="row">
                    <div class="col-md-8 col-md-offset-2" align="center">
                        <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-info">Back</a>
                    </div>
                </div>
            @endif


            <script src="{{ asset('js/jquery.min.js') }}"></script>
{{--            <script src="{{ asset('js/custom.js') }}"></script>--}}
            <script type="text/javascript">

                function ajaxfordocs() {
                    var ajax = new XMLHttpRequest();
                    var count = document.getElementById("size").value;
                    var size = getCols().length;
                    var showDestroyed = document.getElementById('show_destroyed');

                    var date_from = document.getElementById('date_from');
                    var date_to = document.getElementById('date_to');

                    ajax.open("GET", "/alldocsendpoint?" + getInputValues() + "&colsize=" + size + "&count=" + count + "&showdestroyed=" + showDestroyed.checked + "&from=" + date_from.value + "&to=" + date_to.value, true);
                    ajax.onload = function () {
                        // console.log(ajax.responseText);
                        var list = JSON.parse(ajax.responseText);
                        drawTable(list);
                    };
                    ajax.send();
                }

                function getInputValues() {
                    var checkedValue = new Array();
                    var inputElements = document.getElementsByClassName('msgcheckbox');
                    for (var i = 0; inputElements[i]; ++i) {
                        if (inputElements[i].checked) {
                            checkedValue.push(inputElements[i].value + "=" + inputElements[i].value);
                        }
                    }
                    return checkedValue.join('&');
                }

                function getCols() {
                    var checkedValue = new Array();
                    var inputElements = document.getElementsByClassName('msgcheckbox');
                    // checkedValue.push('#');
                    for (var i = 0; inputElements[i]; ++i) {
                        if (inputElements[i].checked) {
                            checkedValue.push(inputElements[i].value);
                        }
                    }
                    return checkedValue;
                }

                function drawTable(list) {
                    var tableDiv = document.getElementById('tableDiv');
                    tableDiv.innerHTML = null;
                    var table = document.createElement('table');
                    table.setAttribute('class', 'table table-bordered table-hover');
                    table.setAttribute('style', '-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe');
                    var thead = document.createElement('thead');
                    var head_tr = document.createElement('tr');
                    var cols = getCols();
                    //creating coloumns HEAD

                    var n_td = document.createElement('td');
                    n_td.appendChild(document.createTextNode("#"));
                    head_tr.appendChild(n_td);


                    for (var i = 0; i < cols.length; i++) {
                        var head_td = document.createElement('td');
                        head_td.setAttribute('class', 'bg-info');
                        var colname = cols[i].toString().toUpperCase().replace('_', ' ').replace('_', ' ');
                        head_td.appendChild(document.createTextNode(colname));
                        head_tr.appendChild(head_td);
                    }

                    var tbody = document.createElement('tbody');
                    //creating data rows.. BODY
                    for (var k = 0; k < list.length; k++) {
                        var body_tr = document.createElement('tr');

                        var nb_td = document.createElement('td');
                        nb_td.appendChild(document.createTextNode((k + 1).toString()));
                        body_tr.appendChild(nb_td);

                        if (list[k]['destroyed'] === 1) {
                            list[k]['destroyed'] = '✔';
                            body_tr.setAttribute('style', 'background-color: #ae2c1f; color: white');
                        }
                        else {
                            // list[k]['destroyed'] = '✖';
                            list[k]['destroyed'] = '';
                            body_tr.setAttribute('style', 'background-color: #239B56; color: black');
                        }


                        for (var x = 0; x < cols.length; x++) {
                            var body_td = document.createElement('td');
                            if (cols[x] === 'to_be_destroyed') {
                                var now = new Date();
                                var then = new Date(list[k]['to_be_destroyed']);

                                if (list[k]['to_be_destroyed'] !== null) {
                                    if (then.getTime() <= now.getTime()){
                                        body_td.setAttribute('style', 'background-color: #F4D03F; color: black');
                                    }
                                }
                            }
                            body_td.appendChild(document.createTextNode(list[k][cols[x]]));
                            body_tr.appendChild(body_td);
                        }
                        tbody.appendChild(body_tr);
                    }

                    thead.appendChild(head_tr);
                    table.appendChild(thead);
                    table.appendChild(tbody);
                    tableDiv.innerHTML = null;
                    tableDiv.appendChild(table);
                }

                document.onload = ajaxfordocs();

                document.getElementById('date_from').valueAsDate = new Date();
                document.getElementById('date_to').valueAsDate = new Date();
            </script>
        </div>
    </div>
@endsection