import {DataTable} from "simple-datatables"

$(document).ready( function () {
    const dataTable = new DataTable(".datatables-custom", {
        searchable: true,
    });
});
