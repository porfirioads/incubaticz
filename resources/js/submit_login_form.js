var loginErrorsContainer = $('#modalFalloLogin');

$('#modalExitoRegistro').on('hidden.bs.modal', function () {
    window.location = '/';
});

$('#formLogin').on('submit', function (e) {
    $.ajaxSetup({
        header: $('meta[name="_token"]').attr('content')
    });
    e.preventDefault(e);
    $.ajax({
        url: '/login',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            window.location = '../';
        },
        error: function (data) {
            console.log(data);
            var modalBody = loginErrorsContainer.find('.modal-body');
            modalBody.empty();
            modalBody.append('<ul>');

            data.responseJSON.errors.forEach(function (error, index) {
                modalBody.append('<li>' + error + '</li>');
            });

            modalBody.append('</ul>');

            $('#modalFalloLogin').modal();
        }
    });
});

