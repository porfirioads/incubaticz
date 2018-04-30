$('#selIntegrantes').change(function () {
    console.log('Seleccionó ' + $(this).val());

    var integrantesContainer = $('#integrantesContainer');
    var integranteTemplate = $('#integranteTemplate');
    var numIntegrantes = $(this).val();
    integrantesContainer.empty();

    for (var i = 1; i <= numIntegrantes; i++) {
        var integranteClone = integranteTemplate.clone();
        integranteClone.find('.numIntegrante').html('Integrante ' + i);
        var nombreIntegrante = integranteClone.find('.nombreIntegrante');
        nombreIntegrante.find('label').attr('for', 'nombreIntegrante' + i);
        nombreIntegrante.find('input').attr('id', 'nombreIntegrante' + i);
        nombreIntegrante.find('input').attr('name', 'nombreIntegrante' + i);
        var priApellido = integranteClone.find('.priApellido');
        priApellido.find('label').attr('for', 'priApellido' + i);
        priApellido.find('input').attr('id', 'priApellido' + i);
        priApellido.find('input').attr('name', 'priApellido' + i);
        var segApellido = integranteClone.find('.segApellido');
        segApellido.find('label').attr('for', 'segApellido' + i);
        segApellido.find('input').attr('id', 'segApellido' + i);
        segApellido.find('input').attr('name', 'segApellido' + i);
        var fechaNacimiento = integranteClone.find('.fechaNacimiento');
        fechaNacimiento.find('label').attr('for', 'fechaNacimiento' + i);
        fechaNacimiento.find('input').attr('id', 'fechaNacimiento' + i);
        fechaNacimiento.find('input').attr('name', 'fechaNacimiento' + i);
        var nivelEstudios = integranteClone.find('.nivelEstudios');
        nivelEstudios.find('label').attr('for', 'nivelEstudios' + i);
        nivelEstudios.find('select').attr('id', 'nivelEstudios' + i);
        nivelEstudios.find('select').attr('name', 'nivelEstudios' + i);
        var carrera = integranteClone.find('.carrera');
        carrera.find('label').attr('for', 'carrera' + i);
        carrera.find('input').attr('id', 'carrera' + i);
        carrera.find('input').attr('name', 'carrera' + i);
        var universidad = integranteClone.find('.universidad');
        universidad.find('label').attr('for', 'universidad' + i);
        universidad.find('input').attr('id', 'universidad' + i);
        universidad.find('input').attr('name', 'universidad' + i);
        var titulo = integranteClone.find('.titulo');
        titulo.find('label').attr('for', 'titulo' + i);
        titulo.find('input').attr('id', 'titulo' + i);
        titulo.find('input').attr('name', 'titulo' + i);
        var constanciaEstudios = integranteClone.find('.constanciaEstudios');
        constanciaEstudios.find('label').attr('for', 'constanciaEstudios' + i);
        constanciaEstudios.find('input').attr('id', 'constanciaEstudios' + i);
        constanciaEstudios.find('input').attr('name', 'constanciaEstudios' + i);
        var constanciaObligaciones = integranteClone.find('.constanciaObligaciones');
        constanciaObligaciones.find('label').attr('for', 'constanciaObligaciones' + i);
        constanciaObligaciones.find('input').attr('id', 'constanciaObligaciones' + i);
        constanciaObligaciones.find('input').attr('name', 'constanciaObligaciones' + i);
        var ine = integranteClone.find('.ine');
        ine.find('label').attr('for', 'ine' + i);
        ine.find('input').attr('id', 'ine' + i);
        ine.find('input').attr('name', 'ine' + i);
        var curp = integranteClone.find('.curp');
        curp.find('label').attr('for', 'curp' + i);
        curp.find('input').attr('id', 'curp' + i);
        curp.find('input').attr('name', 'curp' + i);
        var oficioProtesta = integranteClone.find('.oficioProtesta');
        oficioProtesta.find('label').attr('for', 'oficioProtesta' + i);
        oficioProtesta.find('input').attr('id', 'oficioProtesta' + i);
        oficioProtesta.find('input').attr('name', 'oficioProtesta' + i);

        integrantesContainer.append(integranteClone.html());

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            endDate: '0d',
            startView: 'decades'
        });
    }
});