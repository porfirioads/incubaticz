$('#selIntegrantes').change(function () {
    console.log('Seleccionó ' + $(this).val());

    $('#numIntegrantes').val($(this).val());

    var integrantesContainer = $('#integrantesContainer');
    var integranteTemplate = $('#integranteTemplate');
    var numIntegrantes = $(this).val();
    integrantesContainer.empty();

    for (var i = 1; i <= numIntegrantes; i++) {
        var integranteClone = integranteTemplate.clone();
        integranteClone.find('.integranteLabel').html('Integrante ' + i);
        integranteClone.find('.numIntegrante').attr('value', i);

        integranteClone.find('form').attr('id', 'formIntegrante' + i);
        integranteClone.find('form').addClass('formIntegranteProyecto');
        integrantesContainer.append(integranteClone.html());

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '0d',
            startView: 'decades'
        });
    }
});