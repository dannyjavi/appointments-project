<div id="ModalConfiguracionHoras" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="panel panel-warning">

  <div class="panel-heading">CONFIGURACION HORARIO (trimestres) <button type="button" class="close" data-dismiss="modal">x</button></div>

 </div>
      <div class="modal-body">
             
            <div class="row"> 
              <div class="col-sm-12"> 
            <label class="title">MOSTRAR HORAS DEL HORARIO </label>
            </div>  
          <div class="col-sm-6">                
              <label>Desde</label>
              <input type="time" id="InicioHora" class="form-control">
        </div>
        <div class="col-sm-6">
              <label>Hasta</label>
              <input type="time" id="FinHora" class="form-control" ng-model="data.action.date">
        </div>    
      </div>         
        </div>
      <div class="modal-footer">
         <button class="btn btn-warning" id="ActualizarHorasHorario" data-dismiss="modal"> ACTUALIZAR </button>
      </div>
    </div>

  </div>
</div>
<!-- modal del calendario -->


<!-- Modal (agregar,modificar,elimina
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="txtID" name="txtID">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label> Titulo:<label>
                    <input type="text" id="txtTitulo" class="form-control" placeholder="titulo del evento">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label>Hora de la Cita </label>
                <input type="text" id="txtHora"  name="txtHora" class="form-control" />
        </div>
        <div class="form-group col-md-4">
            <label>Fecha </label>
            <input type="text" id="txtFecha" name="txtFecha" class="form-control" /> 
        </div>
        <div class="form-group">
            <label>Descripcion </label>
                <textarea id="txtDescripcion" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label>Color </label>
              <input class="form-control" type="color" id="txtColor" class="form-control" /><br/>
        </div>
        <div class="form-group col-md-4">
            <label for="">Duracion Sesion</label>
                   <select name="" id="sesion" class="form-control input-sm">
                        <option value="">Duracion</option>
                        <option value="00:30:00">Media Sesion</option>
                        <option value="01:00:00">Sesion Completa</option>
                   </select>
         </div>
        
      </div>
       <div class="modal-footer">      
          <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Cancelar Cita</button>
          <button type="button" id="btnAgregar" class="btn btn-primary">Reservar</button>
       </div>
    </div>
  </div>
</div>
==========================-->
<!-- agregar paciente 
<div class="modal fade" id="agregarPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Nombre</label>
        	  <input type="text" name="" id="nombre" class="form-control input-sm">
        	<label>Apellido</label>
        	  <input type="text" name="" id="apellido" class="form-control input-sm">
        	<label>Email</label>
        	  <input type="text" name="" id="email" class="form-control input-sm">
        	<label>telefono</label>
        	  <input type="number" name="" id="telefono" class="form-control input-sm">
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
      </div>
    </div>
  </div>
</div>-->

<!-- Modal (agregar,modificar,eliminar-->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>

                <div class="modal-body">
                        <form>
                            <div class="form-row">
                                     <div class="form-group col-md-4">
                                         <label for="paratitulo"> Titulo<label>
                                             <input type="text" id="txtTitulo" class="form-control" placeholder="titulo del evento">
                                     </div>
                                     <div class="form-group col-md-4">
                                         <label for="paraid"> ID<label>
                                         <input type="text" class="form-control" id="txtID" name="txtID">
                                     </div>
                                     <div class="form-group col-md-4">
                                         <label for="paraid">idPaciente<label>
                                         <input type="number" class="form-control" id="idPaciente" name="idPaciente"
                                          value="<?php echo $_SESSION['id_usuario'] ?>">
                                     </div>
                             </div>
                             <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="paracita">Hora de la Cita </label>
                                            <input type="text" id="txtHora"  name="txtHora" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="parafecha">Fecha </label>
                                        <input type="text" id="txtFecha" name="txtFecha" class="form-control" /> 
                                    </div>
                             </div>
                             
                             <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="paradescripcion">Descripcion </label>
                                            <textarea id="txtDescripcion" rows="3" ></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="paracolor">Color </label>
                                            <input type="hidden" id="txtColor" value="#80ff00" class="form-control" /><br/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Duracion Sesion</label>
                                        <select name="" id="sesion" class="form-control input-sm">
                                            <option value="00:30:00">Media Sesion</option>
                                            <option value="01:00:00">Sesion Completa</option>
                                        </select>
                                    </div>
                             </div>                            
                        </form>
                 </div>

                <div class="modal-footer">      
                    <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
                    <button type="button" id="btnEliminar" class="btn btn-danger">Cancelar Cita</button>
                    <button type="button" id="btnAgregar" class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </div>
</div>

