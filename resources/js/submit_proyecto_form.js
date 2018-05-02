var registroErrorsContainer = $('#modalFalloRegistro');

$('#modalExitoRegistro').on('hidden.bs.modal', function () {
    window.location = '/';
});

$('#formRegistroProyecto').on('submit', function (e) {
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    e.preventDefault(e);
    $.ajax({
        url: '/registro',
        type: 'POST',
        data: new FormData(this),
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
});
