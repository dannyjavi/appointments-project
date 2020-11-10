$(document).ready(function(){
    
                $('#calendarioweb').fullCalendar({  // Rellenar calendario por defecto
                    header:{
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'month,agendaWeek'
                    },
                    editable:true,
                    defaultTimedEventDuration:"00:30:00",
                    timeFormat: 'hh:mm a',
                    //textColor: 'white',
                    slotLabelFormat:"HH:mm",                               
                    firstDay:1,
                    defaultDate: "2019-02-15",              
                    defaultView: 'month',                                   
                    allDaySlot: false,
                    weekends: false, // si activo true, muestra sabados y domingos
                    eventLimit: 3,// si pongo el limite el resto de eventos saldran en un popup
                    dayClick:function(date,jsEvent,view){
                        $('#btnAgregar').prop("disabled",false);
                        $('#btnModificar').prop("disabled",true);
                        $('#btnEliminar').prop("disabled",true);

                        limpiarFormulario(); 

                        var hora = date.format("h:mm a");
                        $('#txtHora').val(hora);
                        //este llamado de txtFecha funciona                       
                        $("#txtFecha").val($.fullCalendar.formatDate(date, 'YYYY-MM-DD'));
                        //$("#txtFecha").val(date.format());original develoteca que no funciona
                        $("#ModalEventos").modal();
                                                
                    },
                    
                    events: 'http://localhost/fullcalendardeveloteca/eventos.php',
                    eventClick:function(calEvent,jsEvent,view){
                        //$('#btnAgregar').prop("disabled",true);// eso es para que al existir el evento agregar este habilitado
                        $('#btnModificar').prop("disabled",false);//si hay un evento estara deshabilitado
                        $('#btnEliminar').prop("disabled",false);
                        $('#btnAgregar').removeClass("btn btn-primary").addClass('d-none');
                        //h5
                        $('#tituloEvento').html(calEvent.titulo);
                       //muestra la info a los inputs del modal
                        
                        $('#txtID').val(calEvent.id);
                        
                        $('#sesion').val(calEvent.tiempo);

                       
                        //esto me sirve para capturar la fecha y la hora en elmodal
                        FechaHora= calEvent.start._i.split(" ");
                        $('#txtFecha').val(FechaHora[0]);
                        $('#txtHora').val(FechaHora[1]);
                        //llamamos el modal
                        $('#ModalEventos').modal(); 
                    },
                    eventDrop:function(calEvent){
                        $('#txtID').val(calEvent.id);
                        $('#txtTitulo').val(calEvent.titulo);
                        $('#txtColor').val(calEvent.color);
                        $('#txtDescripcion').val(calEvent.descripcion);
                        $('#sesion').val(calEvent.sesion);

                        var fechaHora = calEvent.start.format().split("T");
                        $('#txtFecha').val(fechaHora[0]);
                        $('#txtHora').val(fechaHora[1]);

                        RecolectarDatosGUI();
                        EnviarInformacion('modificar',NuevoEvento,true);
                    },
                   
                    
                    //minTime: Inicial, // hora inicial del calendario
                    //maxTime:Fin ,   // hora final del calendario por vista-semana-mes-dia
                                  
                }); //FIN eventSelect                                 
                
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
                    
  /*      
function RecolectarDatosGUI(){
    
    NuevoEvento={
        id:$('#txtID').val(),
        titulo:$('#txtTitulo').val(),
        start:$('#txtFecha').val()+" "+$('#txtHora').val(),
        end:$('#txtFecha').val()+" "+$('#txtHora').val(),
        color:$('#txtColor').val(),
        descripcion:$('#txtDescripcion').val(),
        textColor:"#FFFFFF",
        sesion: $('#sesion').val()                  
    };
}*/// funciona perfecto

function RecolectarDatosGUI(){
    
    NuevoEvento={
        id:$('#txtID').val(),
        titulo:$('#txtTitulo').val(),
        start:$('#txtFecha').val()+" "+$('#txtHora').val(),
        end:$('#txtFecha').val()+" "+$('#txtHora').val(),
        sesion: $('#sesion').val()                  
    };
}

function EnviarInformacion(accion,objEvento,modal){
    $.ajax({
            type:'POST',
            url:'../localhost.ddns.net/eventos.php?accion='+accion,
            data:objEvento,
            success:function(msg){
                if(msg){
                    $('#calendarioweb').fullCalendar('refetchEvents');
                    if(!modal){
                        $('#ModalEventos').modal('toggle');
                     };
                   }
            },
            error:function(){
                alertify.alert("Hay un error en el calendario");
            }
        });//funciona sin problemas
}
/*todo funciona hasta aqui.*/

function limpiarFormulario(){
    $('#sesion').val('');
}

//intento de prueba