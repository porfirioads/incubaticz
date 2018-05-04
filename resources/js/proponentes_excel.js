/**
 * Archivo: proponentes_excel.js
 *
 * Autor: Porfirio Ángel Díaz Sánchez
 *
 * Descripción: Este script genera el archivo de excel con los proponentes
 * registrados en la convovatoria de INCUBATICZ
 */

/**
 * Genera una tabla html con la lista de proponentes
 *
 * @param rows Es la lista de proponentes que se obtuvo de la petición al
 * servidor
 *
 * @returns {string} html de la tabla de proponentes
 */
function createProponentesTable(rows) {
    var headers = ['No.', 'Nombre', 'Primer Apellido', 'Segundo Apellido', 'Email',
        'Fecha de Nacimiento', 'Nivel de Estudios', 'Carrera o Posgrado',
        'Universidad', 'Proyecto'];

    var tableHtml = '<table>' +
        '<thead>' +
        '<tr>$tableHeaderCols</tr>' +
        '</thead>' +
        '<tbody>$tableBody</tbody>' +
        '</table>';

    var tableHeaderCols = '';

    var i, j;

    for (i = 0; i < headers.length; i++) {
        tableHeaderCols += '<th>' + headers[i] + '</th>';
    }

    tableHtml = tableHtml.replace('$tableHeaderCols', tableHeaderCols);

    var tableBody = '';

    for (i = 0; i < rows.length; i++) {
        tableBody += '<tr>';
        tableBody += '<td>' + rows[i].integrante_id + '</td>';
        tableBody += '<td>' + rows[i].nombre + '</td>';
        tableBody += '<td>' + rows[i].pri_apellido + '</td>';
        tableBody += '<td>' + rows[i].seg_apellido + '</td>';
        tableBody += '<td>' + rows[i].email + '</td>';
        tableBody += '<td>' + rows[i].nacimiento + '</td>';
        tableBody += '<td>' + rows[i].nivel_estudio + '</td>';
        tableBody += '<td>' + rows[i].carrera + '</td>';
        tableBody += '<td>' + rows[i].universidad + '</td>';
        tableBody += '<td>' + rows[i].proyecto + '</td>';
        tableBody += '</tr>';
    }

    tableHtml = tableHtml.replace('$tableBody', tableBody);

    return tableHtml;
}

var tab_text;
var data_type = 'data:application/vnd.ms-excel';

/**
 * Crea un archivo de excel a partir de una tabla html
 *
 * @param proponentesHtml Es la tabla html a partir de la cual se generará
 * el archivo de excel
 */
function createExcelDocument(proponentesHtml) {
    tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook>' +
        '<x:ExcelWorksheets><x:ExcelWorksheet>';

    tab_text = tab_text + '<x:Name>Error Messages</x:Name>';

    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes>' +
        '</x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook>' +
        '</xml></head><body>';

    tab_text = tab_text + "<table border='1px'>";
    tab_text = tab_text + proponentesHtml;

    tab_text = tab_text + '</table></body></html>';

    data_type = 'data:application/vnd.ms-excel';

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            navigator.msSaveBlob(blob, 'ProponentesIncubaticz2018.xls');
        }
    } else {
        $('#testAnchor')[0].click()
    }
}

/**
 * Evento que llama a agregar atributos al link de proponentes para que
 * descargue el archivo de excel generado
 */
$($("#testAnchor")[0]).click(function () {
    $('#testAnchor').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
    $('#testAnchor').attr('download', 'ProponentesIncubaticz2018.xls');
});

/**
 * Obtiene y formatea datos para generar el reporte de proponentes
 */
function createProponentesReport() {
    $.ajax({
        url: 'proponentes',
        type: 'GET',
        success: function (data) {
            var proponentesHtml = createProponentesTable(data);
            createExcelDocument(proponentesHtml);
        },
        error: function (error) {
            console.log('ERROR', data);
        }
    });
}

/**
 * Evento que llama a generar el reporte de proponentes
 */
$('#btnProponentes').click(function () {
    createProponentesReport();
});