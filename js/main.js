$(function(){
    let input_busqueda  = $('#txt_busqueda');
    listar('');
    tipoListado(input_busqueda);
    crearPaginacion();
    ejecutarAccion();
})

var limpiarBusqueda = () => {
    $('#txt_busqueda').val('');
}

// Quitar la alerta del Modal
var quitarAlerta = () => {
    $('#alerta').html('');
}

var limpiarBusqueda = () => {
    $('#txt_busqueda').val('');
}
// Desbloquear el botón 'Guardar Cambios'
var desbloquearBoton = () => {
    $('#btn_guardar_cambios').removeAttr('disabled');
}
var alerta = (opcion, respuesta) => {
    let mensaje = '';
    switch (opcion) {
        case 'insertar':
            mensaje = 'Usuario insertado correctamente.';
            break;
        case 'editar':
            mensaje = 'Información de usuario modificada con exito.';
            break;
        case 'eliminar':
            mensaje = 'Usuario eliminado exitosamente.';
            break;
    }
    switch (respuesta) {
        case 'BIEN':
            $('#alerta').html('<div class="alert alert-success text-center"><strong>¡BIEN! </strong>' + mensaje + '</div>');
            break;
        case 'ERROR':
            $('#alerta').html('<div class="alert alert-danger text-center"><strong>¡ERROR! </strong>Solicitud no procesada.</div>');
            break;
        case 'IGUAL':
            $('#alerta').html('<div class="alert alert-info text-center"><strong>¡ADVERTENCIA! </strong>Ha enviado los mismos datos.</div>');
            break;
        case 'VACIO':
            $('#alerta').html('<div class="alert alert-danger text-center"><strong>¡ERROR! </strong>No puede enviar datos vacíos.</div>');
            break;
    }
}

// ----------------------------------------------------Ejecutar la acción seleccionada por el usuario----------------------------------------------------
var ejecutarAccion = () => {
    $('#btn_guardar_cambios').on('click', function() {
        let opcion = $('#opcion').val();
        let idPaciente = $('#idPaciente').val();
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let apellido2 = $('#apellido2').val();
        let nacimiento = $('#nacimiento').val();
        let nif = $('#nif').val();
        let direccion = $('#direccion').val();
        let cp = $('#cp').val();
        let telefono = $('#telefono').val();
        let profesion = $('#profesion').val();
        let email = $('#email').val();
        let referido = $('#referido').val();
        let antecedentes = $('#antecedentes').val();
        let ttoprevio = $('#ttoprevio').val();
        let diagnostico = $('#diagnostico').val();
        let tratamiento = $('#tratamiento').val();
        let tipo    = $('#tipo').val();
        let agravante   =   $('#agravante').val();
        let hernia      =   $('#hernia').val();
        let restriccion      =   $('#restriccion').val();
        let antialgica      =   $('#antialgica').val();
        let territorio      =   $('#territorio').val();
        let testing      =   $('#testing').val();
        let reflejos      =   $('#reflejos').val();
        let lasegue      =   $('#lasegue').val(); 
        let palpacion      =   $('#palpacion').val(); 
        let balanceart      =   $('#balanceart').val(); 
        let balancemusc      =   $('#balancemusc').val();
        let alteraciones      =   $('#alteraciones').val(); 
        

        var ajaxData = {
            opcion: $('#opcion').val(),
            idPaciente: $('#idPaciente').val(),
            nombre: $('#nombre').val(),
            apellido: $('#apellido').val(),
            apellido2: $('#apellido2').val(),
            nacimiento: $('#nacimiento').val(),
            nif: $('#nif').val(),
            direccion: $('#direccion').val(),
            cp: $('#cp').val(),
            telefono: $('#telefono').val(),
            profesion: $('#profesion').val(),
            email: $('#email').val(),
            referido: $('#referido').val(),
            antecedentes : $('#antecedentes').val(),
            ttoprevio : $('#ttoprevio').val(),
            diagnostico : $('#diagnostico').val(),
            tratamiento : $('#tratamiento').val(),
            tipo    : $('#tipo').val(),
            agravante   :   $('#agravante').val(),
            hernia      :   $('#hernia').val(),
            restriccion :   $('#restriccion').val(),
            antialgica:    $('#antialgica').val(),
            territorio:  $('#territorio').val(),
            testing:    $('#testing').val(),
            reflejos:   $('#reflejos').val(),
            lasegue:   $('#lasegue').val(), 
            palpacion:   $('#palpacion').val(),
            balanceart:   $('#balanceart').val(), 
            balancemusc:   $('#balancemusc').val(),
            alteraciones:  $('#alteraciones').val()     
        }        
        $.ajax({
            beforeSend: function() {
                $('#gif').toggleClass('d-none');
            },
            url: '../controllers/controllerActions.php',
            method: 'POST',
            data: ajaxData
        }).done(function(data) {
            $('#gif').toggleClass('d-none');
            alerta(opcion, data);
            listar('');
            crearPaginacion();
            if (opcion == 'eliminar' && data == 'BIEN') {
                $('#btn_guardar_cambios').attr('disabled', true);
            }
            if (opcion == 'insertar' && data == 'BIEN') {
                $('#idPaciente').val('');
                $('#nombre').val('');
                $('#apellido').val('');
                $('#apellido2').val('');
                $('#nacimiento').val('');
                $('#nif').val('');
                $('#direccion').val('');
                $('#cp').val('');
                $('#telefono').val('');
                $('#profesion').val('');
                $('#email').val('');
                $('#referido').val('');
                $('#antecedentes').val('');
                $('#ttoprevio').val('');
                $('#diagnostico').val('');
                $('#tratamiento').val('');
                $('#tipo').val('');
                $('#agravante').val('');
                $('#hernia').val('');
                $('#restriccion').val('');
                $('#antialgica').val('');
                $('#territorio').val('');
                $('#testing').val('');
                $('#reflejos').val('');
                $('#lasegue').val('');
                $('#palpacion').val('');
                $('#balanceart').val('');
                $('#balancemusc').val('');
                $('#alteraciones').val('');
                $('#ventanaModal').modal('hide');
            }
        });
    });
}
//---------------- preparar datos-----------
var prepararDatos = () => {
    let values = [];
    // Evento botón editar' n
    $('#table .editar').on('click', function() {
        values = ciclo($(this));
        $('#opcion').val('editar');
        $('#idPaciente').val(values[0]);
        $('#nombre').val(values[1]).removeAttr('disabled');
        $('#apellido').val(values[2]).removeAttr('disabled');
        $('#apellido2').val(values[3]).removeAttr('disabled');
        $('#nacimiento').val(values[4]).removeAttr('disabled');
        $('#nif').val(values[5]).removeAttr('disabled');
        $('#direccion').val(values[6]).removeAttr('disabled');
        $('#cp').val(values[7]).removeAttr('disabled');
        $('#telefono').val(values[8]).removeAttr('disabled');
        $('#profesion').val(values[9]).removeAttr('disabled');
        $('#email').val(values[10]).removeAttr('disabled');
        $('#referido').val(values[11]).removeAttr('disabled');
        $('#antecedentes').val(values[12]).removeAttr('disabled');
        $('#ttoprevio').val(values[13]).removeAttr('disabled');
        $('#diagnostico').val(values[14]).removeAttr('disabled');
        $('#tratamiento').val(values[15]).removeAttr('disabled');
        $('#tipo').val(values[16]).removeAttr('disabled');
        $('#agravante').val(values[17]).removeAttr('disabled');
        $('#hernia').val(values[18]).removeAttr('disabled');
        $('#restriccion').val(values[19]).removeAttr('disabled');
        $('#antialgica').val(values[20]).removeAttr('disabled');
        $('#territorio').val(values[21]).removeAttr('disabled');
        $('#testing').val(values[22]).removeAttr('disabled');
        $('#reflejos').val(values[23]).removeAttr('disabled');
        $('#lasegue').val(values[24]).removeAttr('disabled');
        $('#palpacion').val(values[25]).removeAttr('disabled');
        $('#balanceart').val(values[26]).removeAttr('disabled');
        $('#balancemusc').val(values[27]).removeAttr('disabled');
        $('#alteraciones').val(values[28]).removeAttr('disabled');
        cambiarTitulo('Editar información');
        quitarAlerta();
        limpiarBusqueda();
        desbloquearBoton();
    });
    // Evento botón eliminar
    $('#table .eliminar').on('click', function() {
        values = ciclo($(this));
        $('#opcion').val('eliminar');
        $('#idPaciente').val(values[0]);
        $('#nombre').val(values[1]).attr('disabled', true);
        $('#apellido').val(values[2]).attr('disabled', true);
        $('#apellido2').val(values[3]).attr('disabled', true);
        $('#nacimiento').val(values[4]).attr('disabled', true);
        $('#nif').val(values[5]).attr('disabled', true);
        $('#direccion').val(values[6]).attr('disabled', true);
        $('#cp').val(values[7]).attr('disabled', true);
        $('#telefono').val(values[8]).attr('disabled', true);
        $('#profesion').val(values[9]).attr('disabled', true);
        $('#email').val(values[10]).attr('disabled', true);
        $('#referido').val(values[11]).attr('disabled', true);
        $('#antecedentes').val(values[12]).attr('disabled',true);
        $('#ttoprevio').val(values[13]).attr('disabled',true);
        $('#diagnostico').val(values[14]).attr('disabled',true);
        $('#tratamiento').val(values[15]).attr('disabled',true);
        $('#tipo').val(values[16]).attr('disabled',true);
        $('#agravante').val(values[17]).attr('disabled',true);
        $('#hernia').val(values[18]).attr('disabled',true);
        $('#restriccion').val(values[19]).attr('disabled',true);
        $('#antialgica').val(values[20]).attr('disabled',true);
        $('#territorio').val(values[21]).attr('disabled',true);
        $('#testing').val(values[22]).attr('disabled',true);
        $('#reflejos').val(values[23]).attr('disabled',true);
        $('#lasegue').val(values[24]).attr('disabled',true);
        $('#palpacion').val(values[25]).attr('disabled',true);
        $('#balanceart').val(values[26]).attr('disabled',true);
        $('#balancemusc').val(values[27]).attr('disabled',true);
        $('#alteraciones').val(values[28]).attr('disabled',true);
        cambiarTitulo('Eliminar usuario');
        quitarAlerta();
        limpiarBusqueda();
        desbloquearBoton();
    });
    // Evento btotón insertar
    $('#btn_insertar').on('click', function() {
        $('#opcion').val('insertar');
        $('#idPaciente').val('');
        $('#nombre').val('').removeAttr('disabled');
        $('#apellido').val('').removeAttr('disabled');
        $('#apellido2').val('').removeAttr('disabled');
        $('#nacimiento').val('').removeAttr('disabled');
        $('#nif').val('').removeAttr('disabled');
        $('#direccion').val('').removeAttr('disabled');
        $('#cp').val('').removeAttr('disabled');
        $('#telefono').val('').removeAttr('disabled');
        $('#profesion').val('').removeAttr('disabled');
        $('#email').val('').removeAttr('disabled');
        $('#referido').val('').removeAttr('disabled');
        $('#antecedentes').val('').removeAttr('disabled');
        $('#ttoprevio').val('').removeAttr('disabled');
        $('#diagnostico').val('').removeAttr('disabled');
        $('#tratamiento').val('').removeAttr('disabled');
        $('#tipo').val('').removeAttr('disabled');
        $('#agravante').val('').removeAttr('disabled');
        $('#hernia').val('').removeAttr('disabled');
        $('#restriccion').val('').removeAttr('disabled');
        $('#antialgica').val('').removeAttr('disabled');
        $('#territorio').val('').removeAttr('disabled');
        $('#testing').val('').removeAttr('disabled');
        $('#reflejos').val('').removeAttr('disabled');
        $('#lasegue').val('').removeAttr('disabled');
        $('#palpacion').val('').removeAttr('disabled');
        $('#balanceart').val('').removeAttr('disabled');
        $('#balancemusc').val('').removeAttr('disabled');
        $('#alteraciones').val('').removeAttr('disabled');
        cambiarTitulo('Insertar paciente');
        quitarAlerta();
        limpiarBusqueda();
        desbloquearBoton();
    });
}

var ciclo = (selector) => {
    let datos = [];
    $(selector).parents('tr').find('td').each(function(i) {
        if (i < 30) {
            datos[i] = $(this).text();
        } else {
            return false;
        }
    });
    return datos;
}

var cambiarTitulo = (titulo) => {
    $('.modal-header .modal-title').text(titulo);
}
//-------------------- PAGINACION------------------
var cambiarPagina = () => {
    $('.page-item>.page-link').on('click', function() {
        $.ajax({
            url: '../controllers/controllerList.php',
            method: 'POST',
            data: {
                pagina: $(this).text()
            },
        }).done(function(data) {
            $('#div_tabla').html(data);
            prepararDatos();
        });
    });
}

var crearPaginacion = () => {
    $.ajax({
        url: '../controllers/controllerPagination.php',
        method: 'POST'
    }).done(function(data) {
        $('#pagination li').remove();
        for (var i = 1; i < data; i++) {
            $('#pagination').append('<li class="page-item"><a class="page-link text-muted" href="#">' + i + '</a></li>');
        }
        cambiarPagina();
    });
}

// ---------------------------------------------------Listar personas---------------------------------------------------
let listar =(param)=>{
    $.ajax({
        url: '../controllers/controllerList.php',
        method: 'POST',
        data:{
            termino: param
        }
    }).done(function(data){
        $('#div_tabla').html(data);
        prepararDatos();     
    });
};

let tipoListado = (input) => {
    $(input).on('keyup', function() {
        let termino = '';
        if ($(this).val() != '') {
            termino = $(this).val();
        }
        listar(termino);
    });
}
