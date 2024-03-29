import {Grid} from "gridjs"
require("gridjs/dist/theme/mermaid.min.css")

let grid = new Grid({
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
        id: 'beginDate',
        name: 'Date de début'
    }, {
        id: 'endDate',
        name: 'Date de fin'
    }],
    style: {
        table: {
            width : '100%',
        },
    }
})
grid.render(document.getElementById("custom-datatable"));