import {Grid} from "gridjs"
require("gridjs/dist/theme/mermaid.min.css")

new Grid({
    pagination:true,
    sort:true,
    data: data,
    style: {
        table: {
            width : '100%',
        },
    }
}).render(document.getElementById("custom-datatable"));