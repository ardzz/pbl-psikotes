function append_text(txt) {
    var docbody = document.getElementsByTagName("body")[0];
    docbody.appendChild(document.createTextNode(txt));
    docbody.appendChild(document.createElement("br"));
}

function append_th(row, txt) {
    var tdata = document.createElement("th");
    tdata.appendChild(document.createTextNode(txt));
    row.appendChild(tdata);
}

function append_td(row, txt) {
    var tdata = document.createElement("td");
    tdata.appendChild(document.createTextNode(txt));
    row.appendChild(tdata);
}

function append_tr(table) {
    var trow = document.createElement("tr");
    for (var i = 1; i < arguments.length; ++i) {
        append_td(trow, arguments[i]);
    }
    table.appendChild(trow);
}

function make_table(find_id) {
    let table, thead, tbody, trow, i;
    let append_at_id = document.getElementById(find_id);
    table = document.createElement("table");
    table.setAttribute("class", "table border table-striped table-bordered display text-nowrap");
    table.setAttribute("id", "score_table");
    thead = document.createElement("thead");
    tbody = document.createElement("tbody");
    table.appendChild(thead);
    table.appendChild(tbody);
    append_at_id.appendChild(table);

    trow = document.createElement("tr");
    for (i = 1; i < arguments.length; ++i) {
        append_th(trow, arguments[i]);
    }
    thead.appendChild(trow);
    return tbody;
}
