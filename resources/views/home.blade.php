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
                        <td><input type="text" style="color: black" class="form-control" id="search-text" placeholder="ලිපිගොනුවේ නම අැතුලත් කරන්න" onkeyup="ajaxme()"></td>
                        <td align="right">
                            <select class="form-control" id="search-type" style="width: 95%;" onchange="ajaxme()" required>
                                <option value="form_id">Form ID</option>
                                <option value="mf_no" selected>MF Number</option>
                                <option value="form_name">Form Name</option>
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

        <div class="row">
            <div class="col-md-8 col-md-offset-2" align="center" id="table" style="color: black">
            </div>
        </div>

    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        function ajaxme() {
            var ajax = new XMLHttpRequest();
            var search = $('#search-text').val();
            var type = $('#search-type').val();
            var resultsCount = document.getElementById('resultsCount');

            if (search.length === 0) {
                document.getElementById('table').innerHTML = null;
                resultsCount.innerHTML = null;
                resultsCount.setAttribute('class', 'alert alert-danger');
                resultsCount.appendChild(document.createTextNode("0 matching documents found!"));
            }
            if (search.length >= 2) {
                ajax.open("GET", "http://127.0.0.1:8000/search/endpoint?val=" + search + "&type=" + type, true);
                ajax.onload = function () {
                    var list = JSON.parse(ajax.responseText);

                    console.log(list);
                    var table = document.createElement('table');
                    var thead = document.createElement('thead');
                    table.setAttribute('class', 'table table-bordered table-hover text-center');
                    var headtr = document.createElement('tr');
                    var th1 = document.createElement('th');
                    th1.appendChild(document.createTextNode("#"));

                    var th2 = document.createElement('th');
                    th2.appendChild(document.createTextNode("Form ID"));

                    var th3 = document.createElement('th');
                    th3.appendChild(document.createTextNode("Form Name"));

                    var th4 = document.createElement('th');
                    th4.appendChild(document.createTextNode("MF Number"));

                    headtr.appendChild(th1);
                    headtr.appendChild(th2);
                    headtr.appendChild(th3);
                    headtr.appendChild(th4);

                    thead.appendChild(headtr);
                    table.appendChild(thead);
                    var tbody = document.createElement('tbody');

                    if (list.length === 0) {
                        document.getElementById('table').innerHTML = null;
                        var tr_empty = document.createElement('tr');
                        var td_empty = document.createElement('td');
                        td_empty.appendChild(document.createTextNode("EMPTY!"))
                        td_empty.setAttribute('colspan', '2');
                        tr_empty.appendChild(td_empty);
                        tbody.appendChild(tr_empty);
                        // document.getElementById('table').appendChild(table);

                        resultsCount.innerHTML = null;
                        resultsCount.setAttribute('class', 'alert alert-danger');
                        resultsCount.appendChild(document.createTextNode("0 matching documents found!"));
                    }
                    else {
                        resultsCount.innerHTML = null;
                        resultsCount.setAttribute('class', 'alert alert-success');
                        resultsCount.appendChild(document.createTextNode(list.length + " matching documents found!"));

                        for (var i = 0; i < list.length; i++) {
                            var tr = document.createElement('tr');

                            var td1 = document.createElement('td');
                            var td2 = document.createElement('td');
                            var td3 = document.createElement('td');
                            var link = document.createElement('a');
                            // link.setAttribute('href', '/document?form_id=' + list[i]['form_id']);
                            link.setAttribute('onclick','popitup("/document?form_id='+list[i]['form_id']+'","'+list[i]['form_id']+'")');
                            link.setAttribute('target', '_blank');
                            // link.innerHTML = list[i]['form_name'];
                            var td4 = document.createElement('td');

                            td1.appendChild(document.createTextNode((i + 1).toString()));
                            td2.appendChild(document.createTextNode(list[i]['form_id']));
                            td3.appendChild(link);
                            td4.appendChild(document.createTextNode(list[i]['mf_no']));

                            tr.appendChild(td1);
                            tr.appendChild(td2);
                            tr.appendChild(td3);
                            tr.appendChild(td4);

                            tbody.appendChild(tr);
                            table.appendChild(tbody);
                            document.getElementById('table').innerHTML = null;
                            document.getElementById('table').appendChild(table);
                        }
                    }

                };
                ajax.send();
            }
        }

        function popitup(url,windowName) {
            newwindow=window.open(url,windowName,'height=500,width=600');
            if (window.focus) {newwindow.focus()}
            return false;
        }

    </script>
@endsection
