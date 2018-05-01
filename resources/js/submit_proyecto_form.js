var errorsContainer = $('#errorsContainer');

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
            errorsContainer.addClass('hidden')
        },
        error: function (data) {
            var alert = errorsContainer.find('.alert');
            alert.empty();

            alert.append('<ul>');

            data.responseJSON.errors.forEach(function (error, index) {
                alert.append('<li>' + error + '</li>');
            });

            alert.append('</ul>');

            errorsContainer.removeClass('hidden');

            console.log('error', data.responseJSON);
        }
    });
});
