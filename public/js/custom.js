
//// SEARCH PAGE JS ////
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
        ajax.open("GET", "/search/endpoint?val=" + search + "&type=" + type, true);
        ajax.onload = function () {
            var list = JSON.parse(ajax.responseText);

            console.log(list);
            var table = document.createElement('table');
            table.setAttribute('style', '-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe');
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
                    link.setAttribute('onclick', 'popitup("/document?form_id=' + list[i]['form_id'] + '","' + list[i]['form_id'] + '")');
                    // link.setAttribute('target', '_blank');
                    link.innerHTML = list[i]['form_name'];
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

function popitup(url, windowName) {
    newwindow = window.open(url, windowName, 'height=500,width=600');
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}



///  VIEW ALL DOCS PAGE JS ///
function ajaxfordocs() {
    var ajax = new XMLHttpRequest();
    var count = document.getElementById("size").value;
    var size = getCols().length;
    ajax.open("GET", "/alldocsendpoint?" + getInputValues() + "&colsize=" + size + "&count=" + count, true);
    ajax.onload = function () {
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
    for (var i = 0; inputElements[i]; ++i) {
        if (inputElements[i].checked) {
            checkedValue.push(inputElements[i].value);
        }
    }
    return checkedValue;
}

function drawTable(list) {
    var tableDiv = document.getElementById('tableDiv');
    var table = document.createElement('table');
    table.setAttribute('class', 'table table-bordered table-hover');
    table.setAttribute('style', '-webkit-filter: drop-shadow(1px 2px 2px gray); margin: 2px; text-align: center; background-color: #fffffe')
    var thead = document.createElement('thead');
    var head_tr = document.createElement('tr');
    var cols = getCols();
    //creating coloumns
    for (var i = 0; i < cols.length; i++) {
        var head_td = document.createElement('td');
        head_td.setAttribute('class', 'bg-info');
        var colname = cols[i].toString().toUpperCase().replace('_', ' ').replace('_', ' ');
        head_td.appendChild(document.createTextNode(colname));
        head_tr.appendChild(head_td);
    }

    var tbody = document.createElement('tbody');
    //creating data rows..
    for (var k = 0; k < list.length; k++) {
        var body_tr = document.createElement('tr');
        for (var x = 0; x < cols.length; x++) {
            var body_td = document.createElement('td');
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
