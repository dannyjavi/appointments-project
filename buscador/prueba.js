$(document).ready(function() {
$('#calendario').fullCalendar({    
    //elementos de la cabecera del calendario
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
        defaultView: 'agendaWeek',
        editable: true,
        selectable: true,
    //funcion que se activa al selecionar un dia en el calendario
    select: function(start, end, allDay) {
          endtime = $.fullCalendar.formatDate(end,'h:mm tt');
          starttime = $.fullCalendar.formatDate(start,'ddd, MMM d, h:mm tt');
          start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
          end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
          dayNamesShort: ['Dom','Lun','Mar','Mier','Jue','Vie','Sab'];
          var cuando = starttime + ' - ' + endtime;
          $("#ventanaModal #apptStartTime").val(start);
          $("#ventanaModal #apptEndTime").val(end);
          $("#ventanaModal #apptAllDay").val(allDay);
          $("#ventanaModal").dialog('open');
          $('#ventanaModal #cuando').text(cuando);
        
        calendar.fullCalendar('unselect');
      },
    //eventos, estos los recojo de un script php, pero aca me toca declararlos en javascript
    events: [                         
        {
            title  : 'evento',
            start  : '2013-09-16 17:00:00',
            end    : '2013-09-16 17:30:00',
            allday : false
        }
    ]
}); 
    //parametros de la ventana modal
$("#ventanaModal").dialog({
                      autoOpen: false,
                      resizable: false,
                      modal: true,
                      // show: 'explode',
                      // hide: 'blind'
                    });
    
    //funcion que se activa al dar click en guardar
    $("#guardar").on('click', function(e){
                     
                      e.preventDefault();
                      doSubmit();//llammamos a la funcion dosubmit
                      return false;
                })
    
function doSubmit(){
      $("#ventanaModal").dialog('close');
        start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
        end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
    //tomamos los valores de los inputs
        identificacion = $('#value').val();
        title = $('#paciente').val();
        descripcion = $('#descripcion').val();
        ini = $('#apptStartTime').val();
        fin = $('#apptEndTime').val();
    //enviamos los valores mediante ajax al script php
      $.ajax({
        url: 'php/agregar_eventos.php',
        data: 'identificacion='+ identificacion+ '&title='+ title+'&description='+ descripcion +'&start='+ ini +'&end='+ fin ,
        type: "POST",
        success: function(json) {
        alert('OK');
        }
        });
       //funcion que plasma en el calendario los eventos despues de pulsar el boton guardar   
      $("#calendar").fullCalendar('renderEvent',
          {
              title: title,
              start: ini,
              end: fin,
              allDay: ($('#apptAllDay').val() == "true"),
              description: $('#descripcion').val(),
          },
          true);
   }
//---------------------------------------------------------------    
//array que llena el autocompletado    
var datos = [
   {
      value: "12123",
      label:"yamid viloria"
   },
   {
      value: "14646212",//identificacion
      label:"juancho gonzales"//nombre
   }];
    //hacemos funcionar el autocomplete:
 $( "#paciente" ).autocomplete({
    //source: "php/buscarPaciente.php", este es el script php que trae los datos de los usuarios
        source: datos,//aca me toca utilizar un array declarado en javascript
 //-------------------------------------------------------------    
     //la siguiente funcion es la que llena los inputs al seleccionar una opcion de las que mustra el autocomplete
     select: function(event, ui){
      $("#paciente").val(ui.item.label);
     $("#identificacion").val(ui.item.value);
     return false;
   }    
    })
   .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "</a>" )
        .appendTo( ul );
  };    
    });