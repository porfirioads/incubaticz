var registroErrorsContainer = $('#modalFalloRegistro');

$('#modalExitoRegistro').on('hidden.bs.modal', function () {
    window.location = '/';
});

var formData = undefined;

$('#formRegistroProyecto').on('submit', function (e) {
    e.preventDefault(e);
    formData = new FormData(this);
    generateProjectPdf();
});

function generateProjectPdf() {
    var titulo = $('#txtNombreProyecto').val();
    var descripcion = $('#txtDescripcion').val();
    var impactoSocial = $('#txtImpactoSocial').val();
    var factibilidad = $('#txtFactibilidad').val();
    var cronograma = $('#txtCronograma').val();
    var metodologia = $('#txtMetodologia').val();
    var resultados = $('#txtResultados').val();
    var plan = $('#txtPlanNegocios').val();

    var docDefinition = {
        content: [
            {text: titulo, style: 'header1'},
            {text: '\n', style: 'paragraph'},
            {text: 'Descripción', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: descripcion, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Impacto Social', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: impactoSocial, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Análisis de Factibilidad del Proyecto', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: factibilidad, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Cronograma de Actividades', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: cronograma, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Metodología', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: metodologia, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Resultados Esperados', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: resultados, style: 'paragraph'},
            {text: '\n', style: 'paragraph'},
            {text: 'Plan de Negocios', style: 'header2'},
            {text: '\n', style: 'paragraph'},
            {text: plan, style: 'paragraph'}
        ],

        styles: {
            header1: {
                fontSize: 22,
                bold: true,
                alignment: 'center'
            },
            header2: {
                fontSize: 18,
                bold: true,
                alignment: 'center'
            },
            paragraph: {
                alignment: 'justify'
            }
        }
    };

    var pdf = pdfMake.createPdf(docDefinition).getBase64(prepareAndUploadPdf);
}

function createBlobFile(base64) {
    var byteCharacters = atob(base64);

    var byteNumbers = new Array(byteCharacters.length);

    for (var i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }

    var byteArray = new Uint8Array(byteNumbers);

    var blob = new Blob([byteArray], {type: 'application/pdf'});

    return blob;
}

function prepareAndUploadPdf(base64) {
    var blob = createBlobFile(base64);
    formData.append('abstract', blob);
    sendFormHttpRequest(formData);
}

// function generateProjectAbstractPdf() {
//     var doc = new jsPDF();
//
//     var specialElementHandlers = {
//         '#editor': function (element, renderer) {
//             return true;
//         }
//     };
//
//     var abstractHtml = '<h1>$titulo</h1>' +
//         '<h2>Descripción</h2>' +
//         '<p>$descripcion</p>' +
//         '<h2>Impacto Social</h2>' +
//         '<p>$impactoSocial</p>' +
//         '<h2>Análisis de Factibilidad del Proyecto</h2>' +
//         '<p>$factibilidad</p>' +
//         '<h2>Cronograma de Actividades</h2>' +
//         '<p>$cronograma</p>' +
//         '<h2>Metodología</h2>' +
//         '<p>$metodologia</p>' +
//         '<h2>Resultados Esperados</h2>' +
//         '<p>$resultados</p>' +
//         '<h2>Plan de Negocios</h2>' +
//         '<p>$plan</p>'+
//         '<p>&aacute;</p>'+
//         '<p>\u00E1</p>'+
//         '<p>&#xE1;</p>';
//
//     var titulo = $('#txtNombreProyecto').val();
//     var descripcion = $('#txtDescripcion').val();
//     var impactoSocial = $('#txtImpactoSocial').val();
//     var factibilidad = $('#txtFactibilidad').val();
//     var cronograma = $('#txtCronograma').val();
//     var metodologia = $('#txtMetodologia').val();
//     var resultados = $('#txtResultados').val();
//     var plan = $('#txtPlanNegocios').val();
//
//     abstractHtml = abstractHtml.replace('$titulo', titulo);
//     abstractHtml = abstractHtml.replace('$descripcion', descripcion);
//     abstractHtml = abstractHtml.replace('$impactoSocial', impactoSocial);
//     abstractHtml = abstractHtml.replace('$factibilidad', factibilidad);
//     abstractHtml = abstractHtml.replace('$cronograma', cronograma);
//     abstractHtml = abstractHtml.replace('$metodologia', metodologia);
//     abstractHtml = abstractHtml.replace('$resultados', resultados);
//     abstractHtml = abstractHtml.replace('$plan', plan);
//
//     console.log(abstractHtml);
//
//     doc.fromHTML(abstractHtml, 15, 15, {
//         'width': 170,
//         'elementHandlers': specialElementHandlers
//     });
//
//     return doc;
// }

//////////////

function sendFormHttpRequest(formData) {
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    $.ajax({
        url: '/registro',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log('success', data);
            $('#modalExitoRegistro').modal();
        },
        error: function (data) {
            var modalBody = registroErrorsContainer.find('.modal-body');
            modalBody.empty();
            modalBody.append('<ul>');

            data.responseJSON.errors.forEach(function (error, index) {
                modalBody.append('<li>' + error + '</li>');
            });

            modalBody.append('</ul>');

            console.log(modalBody);

            $('#modalFalloRegistro').modal();

            console.log('error', data.responseJSON);
        }
    });
}