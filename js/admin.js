$(document).ready(function(){
    var date = new Date();
    
$('#calendar').fullCalendar({
        // Rellenar calendario por defecto
    //defaultDate: date,
    //defaultView: 'agendaWeek',
    //header: {
      //  left: 'prev,next today',
        //center: 'title',
        //right: 'listWeek,agendaWeek,agendaDay,month'
    //},
    //locale: 'es',
    //columnFormat: 'dddd',//formato de las columnas ej: lunes, martes // por defecto es: lun 3/7 mart 4/7
    //showNonCurrentDates: false,
    //noEventsMessage: "Es hora de un descanso, ¿te animas?",
    //fixedWeekCount: false,
    //nowIndicator: true,
    //editable: true,
    //slotDuration: '00:15:00',//mostrar celdas de 15 minutos
    //defaultTimedEventDuration:"00:15:00",
    //displayEventEnd:true,
    //timeFormat: 'hh:mm a',
    //textColor: 'white',
    //slotLabelFormat:"HH:mm",esto funciona para dar formato en el proyecto final no se configura
    //firstDay:1,
    //este funciona bien
    //defaultView: 'listMonth',
    //allDaySlot: false,
    //weekends: false, // si activo true, muestra sabados y domingos
    //eventLimit: 3,// si pongo el limite el resto de eventos saldran en un popup
    //navLinks: true,
    //eventLimitClick: 'week',
    //selectable: true,
    //selectHelper: true,
    //minTime: '13:00:00', // hora inicial del calendario
    //maxTime: '21:00:00',   // hora final del calendario por vista-semana-mes-dia
    //height: 'auto',
    /*dayClick:function(date,jsEvent,view,start){
        var check = $.fullCalendar.formatDate(date, 'YYYY-MM-DD');
        var today = moment(new Date()).format('YYYY-MM-DD');
        
        if (check >= today) {
        $('#btnAgregar').removeClass('d-none');
        $('#btnModificar').removeClass('btn btn-info');
        $('#btnEliminar').removeClass('btn btn-danger');

        limpiarFormulario(); 

        BuscaPaciente();

        var hora = date.format("HH:mm");
        
        $('#txtHora').val(hora);
        //este llamado de txtFecha funciona                       
        $("#txtFecha").val($.fullCalendar.formatDate(date, 'YYYY-MM-DD'));
        //$("#txtFecha").val(date.format());original develoteca que no funciona
        $("#nuevaCita").modal(); 
        }else {
        alertify.alert("NO SE PUEDE REALIZAR LA RESERVA EN UNA FECHA VENCIDA!", "Intenta de nuevo con una fecha acorde a la presente");
        }                                            
    },*/
    /*eventSources: [
        {
            url: 'http://localhost.ddns.net/models/eventos.php'
        },
        {
            url: 'http://localhost.ddns.net/models/eventos2.php',
            color: '#4A2386',
            borderColor: '#3547CB',
            textColor: '#fff',
        }
        ],*/
    /*eventClick:function(calEvent,jsEvent,view){
        $('#btnAgregar').removeClass("btn btn-primary").addClass('d-none');
        $('#btnModificar').removeClass("d-none").addClass('btn btn-info');
        $('#btnEliminar').removeClass("d-none").addClass('btn btn-danger');
        //h5
        $('#tituloEvento').html(calEvent.titulo);
        //muestra la info a los inputs del modal
        $('#txtID').val(calEvent.id);
        $('#txtTitulo').val(calEvent.titulo);
        $('#sesion').val(calEvent.sesion);
        $('#paciente_ID').val(calEvent.idPaciente);// id paciente de bd
        $('#paciente').val(calEvent.nombre);
        
        //esto me sirve para capturar la fecha y la hora en elmodal
        FechaHora= calEvent.start._i.split(" ");
        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);
        //llamamos el modal
        $('#nuevaCita').modal(); 
    },*/
    /*eventDrop:function(calEvent){
        $('#txtID').val(calEvent.id);
        $('#txtTitulo').val(calEvent.titulo);
        $('#sesion').val(calEvent.sesion);
        $('#paciente_ID').val(calEvent.idPaciente);// id paciente de bd

        var fechaHora = calEvent.start.format().split("T");
        $('#txtFecha').val(fechaHora[0]);
        $('#txtHora').val(fechaHora[1]);

        RecolectarDatosGUI();
        EnviarInformacion('modificar',NuevoEvento,true);
    }, */                  
    //pruebas nuevas
    /*eventAfterRender: function (event, element, view) { 
            if (view.name == "listWeek")
                {
                    element.find('.fc-list-item-title').append(event.titulo);
                }else{
                element.append(event.titulo);
            }
    }, 
    eventAfterAllRender: function () {
        $('.fc-widget-content').unbind('mouseenter mouseleave');
        $('.fc-widget-content').hover(function () {
            if (!$(this).html()) {
                var slots = $('.fc-day');
                for (i = 0; i < slots.length; i++) {
                    $(this).append('<td class="temp-cell" style="border: 0px; width:' + (Number(slots.width()) + 3) + 'px"></td>');
                }

                $(this).children('td').each(function () {
                        $(this).hover(function () {
                            $(this).html('<div class="current-time" style="padding-left: 5px;">' + $(this).parent().parent().data('time').substring(0, 5) + '</div>');
                        }, function () {
                        $(this).html('');
                    });
                });
            }
            }, function () {
            $(this).children('.temp-cell').remove();
        });
    },// eventAfterAllRender funciona**/
}); //FIN                
                
});//FIN CALENDARIO POR DEFECTO

var NuevoEvento;
    $('#btnAgregar').click(function(){ 
        RecolectarDatosGUI();
        EnviarInformacion('agregar',NuevoEvento);
    });
    //secuencia para eliminar un evento
    $('#btnEliminar').click(function(){ 
    RecolectarDatosGUI();
    EnviarInformacion('eliminar',NuevoEvento);
    });

    $('#btnModificar').click(function(){ 
        RecolectarDatosGUI();
        EnviarInformacion('modificar',NuevoEvento);
    });
                    
function RecolectarDatosGUI(){
    var d = new Date($('#txtFecha').val()+" "+ $('#txtHora').val());
    var segundos = d.getSeconds();
    var sesion = $('#sesion').val();
    d.setSeconds(segundos + sesion);

    NuevoEvento={
        titulo:$('#txtTitulo').val(),
        start:$('#txtFecha').val()+" "+ $('#txtHora').val(),
        end: $('#txtFecha').val() + " " + d.getHours() + ":" + d.getMinutes(),
        sesion: $('#sesion').val(),
        idPaciente: $('#paciente_ID').val(),
        id: $('#txtID').val()
    };    
}

function EnviarInformacion(accion,objEvento,modal){
    $.ajax({
            type:'POST',
            url:'http://localhost.ddns.net/models/eventos.php?accion='+accion,
            data:objEvento,
            success:function(msg){
                if(msg){
                    $('#calendar').fullCalendar('refetchEvents');
                    if(!modal){
                        console.log(modal);                  
                        $('#nuevaCita').modal();
                    };
                }
            },
            error:function(){
                alertify.alert("Hay un error en el calendario");
            }
        });//funciona sin problemas
}
/*todo funciona hasta aqui*/
function limpiarFormulario(){
    $('#paciente').val('');
    $('#txtTitulo').val('');
    $('#sesion').val('');
}
function BuscaPaciente(){
    $("#paciente").autocomplete({
            minLength: 1,
            source: "/buscador/buscar.php",
            select : function(event, ui){
                event.preventDefault();
                 $("#paciente").val(ui.item.label);
                 $("#paciente_ID").val(ui.item.value);
                  // start an alert which contains the value of proposal
              },
            response: function(event, ui) {
                if (ui.content.length === 0) {
                    $("#msgvacio").text("Paciente No registrado");
                } else {
                    $("#msgvacio").empty();
            }
        }
        });
        $( "#paciente").autocomplete("option", "appendTo", ".form-horizontal" );
}
//intento de prueba*/