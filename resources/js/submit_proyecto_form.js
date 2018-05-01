var errorsContainer = $('#modalFalloRegistro');

$('#modalExitoRegistro').on('hidden.bs.modal', function () {
    window.location = '/';
});

$('form').on('submit', function (e) {
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
            var modalBody = errorsContainer.find('.modal-body');
            modalBody.empty();
            modalBody.append('<ul>');

            data.responseJSON.errors.forEach(function (error, index) {
                modalBody.append('<li>' + error + '</li>');
            });

            modalBody.append('</ul>');

            $('#modalFalloRegistro').modal();

            console.log('error', data.responseJSON);
        }
    });
});
