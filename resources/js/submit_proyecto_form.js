var registroErrorsContainer = $('#modalFalloRegistro');
var formData = undefined;

$('#modalExitoRegistro').on('hidden.bs.modal', function () {
    window.location = '../index.php';
});

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

    pdfMake.createPdf(docDefinition).getBase64(prepareAndUploadPdf);
}

function createBlobFile(base64) {
    var byteCharacters = atob(base64);

    var byteNumbers = new Array(byteCharacters.length);

    for (var i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }

    var byteArray = new Uint8Array(byteNumbers);

    return new Blob([byteArray], {type: 'application/pdf'});
}

function prepareAndUploadPdf(base64) {
    var blob = createBlobFile(base64);
    formData.append('abstract', blob);
    sendRegistroProyectoHttpRequest(formData);
}

function sendRegistroProyectoHttpRequest(formData) {
    $('#modalRegistrando').modal({
        backdrop: 'static',
        keyboard: false
    });
    
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    $.ajax({
        url: 'registro',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log('success', data);
            var formsIntegrantes = $('form.formIntegranteProyecto');
            formsIntegrantes.find('.proyectoId').val(data.proyecto_id);

            console.log('hay ' + formsIntegrantes.length + ' forms de' +
                ' integrantes');

            sendRegistroIntegranteForm(formsIntegrantes, 0, data.proyecto_id);
        },
        error: function (data) {
            showRequestErrors(data.responseJSON, 0);
        }
    });
}

function sendRegistroIntegranteForm(forms, currentIndex, idProyecto) {
    formData = new FormData(forms[currentIndex]);

    if (currentIndex < forms.length) {
        sendRegistroIntegranteHttpRequest(formData,
            function success(data) {
                console.log('Integrante form ' + (1 + currentIndex) + ' success');
                console.log(data);
                sendRegistroIntegranteForm(forms, currentIndex + 1, idProyecto);
            },
            function error(error) {
                console.log('Integrante form ' + (1 + currentIndex) + ' error');
                console.log(error);
                showRequestErrors(error.responseJSON, idProyecto);
            });
    } else {
        $('#modalExitoRegistro').modal();
    }
}

function sendRegistroIntegranteHttpRequest(formData, successCallback, errorCallback) {
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    $.ajax({
        url: 'registro_integrante',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: successCallback,
        error: errorCallback
    });
}

function showRequestErrors(errorsArray, idProyecto) {
    setTimeout(() => {
        $('#modalRegistrando').modal('hide');
    }, 500);

    var modalBody = registroErrorsContainer.find('.modal-body');

    modalBody.append('<ul>');

    errorsArray.errors.forEach(function (error, index) {
        modalBody.append('<li>' + error + '</li>');
    });

    modalBody.append('</ul>');

    setTimeout(() => {
        $('#modalFalloRegistro').modal();
    }, 1000);

    if (idProyecto > 0) {
        deleteProject(idProyecto)
    }

    console.log('error', errorsArray);
}

function deleteProject(idProyecto) {
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    $.ajax({
        type: 'POST',
        url: 'delete_project',
        data: {proyecto_id: idProyecto},
        success: function (data) {
            console.log(data)
        },
        error: function (error) {
            console.log(error.responseJSON)
        }
    });
}

$('#modalFalloRegistro').on('hidden.bs.modal', function () {
    var modalBody = registroErrorsContainer.find('.modal-body');
    modalBody.empty();
});

