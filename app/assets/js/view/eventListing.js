import {Grid} from "gridjs"
require("gridjs/dist/theme/mermaid.min.css")

new Grid({
    pagination:true,
    sort:true,
    data: data,
    columns: [{
        id: 'id',
        name: 'id',
        hidden: true
    }, {
        id: 'title',
        name: 'Intitulé'
    }, {
        id: 'beginAt',
        name: 'Date de début'
    }, {
        id: 'endAt',
        name: 'Date de fin'
    }],
    style: {
        table: {
            width : '100%',
        },
    }
}).render(document.getElementById("custom-datatable"));