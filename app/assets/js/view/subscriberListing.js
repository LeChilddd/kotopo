import {Grid} from "gridjs"
require("gridjs/dist/theme/mermaid.min.css")
import {Parser} from "json2csv";

console.log(data)

let grid = new Grid({
    pagination:true,
    sort:true,
    data: data,
    columns: [{
        id: 'firstname',
        name: 'Prénom'
    }, {
        id: 'lastname',
        name: 'Nom de famille'
    }],
    style: {
        table: {
            width : '100%',
        },
    }
})

if (document.getElementById("custom-datatable")){
    grid.render(document.getElementById("custom-datatable"));
}

document.querySelector('#btn-csv').addEventListener('click', () => {
    const json2csvParser = new Parser();
    const csv = json2csvParser.parse(data);
    download(csv)
} )

const download = function (csv_data) {

    // Creating a Blob for having a csv file format
    // and passing the data with type
    const blob = new Blob([csv_data], { type: 'text/csv' });

    // Creating an object for downloading url
    const url = window.URL.createObjectURL(blob)

    // Creating an anchor(a) tag of HTML
    const a = document.createElement('a')

    // Passing the blob downloading url
    a.setAttribute('href', url)

    // Setting the anchor tag attribute for downloading
    // and passing the download file name
    a.setAttribute('download', `Liste_inscription_${title}`);

    // Performing a download with click
    a.click()
}

