<!-- Modal-->
		<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
			    	<!-- div para mostrar la alerta -->
			  	<div id="alerta"></div>
				<!-- Cabecera modal -->
			    	<div class="modal-header">
			       	 	<h5 class="modal-title h4 text-center text-uppercase">Insertar un nuevo usuario</h5>
			        	 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	 		 <span aria-hidden="true">&times;</span>
			       		 </button>
			     	</div>
			     	<!-- Fin cabecera modal -->

				<!-- Cuerpo  modal -->
			      	<div class="modal-body">
						<!-- Gif "Cargando" -->
						<div class="form-group d-none" id="gif">
							<label><img src="../images/ajax-loader.gif"> Procesando...</label>
						</div>
						
						<!-- collapse-->
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="headingOne">
							      <h4 class="panel-title">
							        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							          Datos personales
							        </a>
							      </h4>
							    </div>
							    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							      	<div class="panel-body">
								      	<form id="signupform" class="form-horizontal" role="form" method="POST" autocomplete="off">
											<!-- Campos ocultos -->
												<div class="form-group">
													<input type="hidden" id="opcion">
													<input type="hidden" id="idPaciente" value="">
												</div>
												<!-- Campo nombre -->
												<div class="form-group">
													<label for="nombre" class="col-md-2 control-label">Nombre:</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" required="true">
													</div>
												<!-- campo apellido -->
													<label for="apellido" class="col-md-2 control-label">Apellido:</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="" readonly="true" required="true">
													</div>
												</div>
												
												<div class="form-group">
													<label for="apellido2" class="col-md-2 control-label">Sgdo Apellido</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="sgdo apellido">
													</div>
													<label for="nacimiento" class="col-md-2 control-label">Nacimiento</label>
													<div class="col-md-4">
														<input type="date" class="form-control" id="nacimiento" name="nacimiento" >
													</div>
												</div>
												<div class="form-group">
													<label for="nif" class="col-md-2 control-label">DNI</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="nif" name="nif" placeholder="Dni - NIE - Pasaporte" required="true">
													</div>
													<label for="direccion" class="col-md-2 control-label">Direccion</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle / Avda / Plaza">
													</div>
												</div>
												<div class="form-group">
													<label for="cp" class="col-md-2 control-label">Cod Post</label>
													<div class="col-md-4">
														<input type="tel" class="form-control" id="cp" name="cp" placeholder="29008">
													</div>
													<label for="telefono" class="col-md-2 control-label">Telefono</label>
													<div class="col-md-4">
														<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="633..." required="true" pattern="/^[9|6|7][0-9]{8}$/" max="9">
													</div>
												</div>
												<!-- profesion - email -->
												<div class="form-group">
													<label for="profesion" class="col-md-2 control-label">Profesion</label>
													<div class="col-md-4">
														<input type="text" class="form-control" id="profesion" name="profesion" placeholder="Medico, Constructor, bombero, vendedor">
													</div>
													<label for="email" class="col-md-2 control-label">Email</label>
													<div class="col-md-4">
														<input type="email" class="form-control" id="email" name="email" placeholder="email" >
													</div>
												</div>
												<!-- referido -->
												<div class="form-group">
													<label for="referido" class="col-md-5 control-label">Conocido / Familiar de </label>
													<div class="col-md-7">
														<input type="text" class="form-control" id="referido" name="referido" placeholder="familiar o amigo de ..." >
													</div>
												</div>
										</form>									
							      	</div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="headingTwo">
							      <h4 class="panel-title">
							        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							          Datos Asistenciales
							        </a>
							      </h4>
							    </div>
							    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							      <div class="panel-body">
							             <form class="form-horizontal">
							                  <!-- diagnostico -->
							                  <input type="hidden" id="idDiagnostico">
								              <div class="form-group">
								                  <label for="antecedentes" class="col-md-2 control-label">Antecedentes</label>
								                  <div class="col-md-10">
								                    <textarea class="form-control" id="antecedentes" name="antecedentes" placeholder="Valoracion del profesional"></textarea>
								                  </div>
								              </div>
								              <div class="form-group">
								                  <label for="ttoprevio" class="col-md-2 control-label">Tratamientos Previos</label>
								                  <div class="col-md-10">
								                    <textarea class="form-control" id="ttoprevio" name="ttoprevio" placeholder="Valoracion del profesional"></textarea>
								                  </div>
								              </div>
								               <div class="form-group">
								                  <label for="diagnostico" class="col-md-2 control-label" placeholder="Valoracion del profesional">Diagnóstico</label>
								                  <div class="col-md-10">
								                    <textarea class="form-control" id="diagnostico" name="diagnostico" placeholder="Valoracion del profesional"></textarea>
								                  </div>
								              </div>
								              <div class="form-group">
								                  <label for="tratamiento" class="col-md-2 control-label" placeholder="Valoracion del profesional">Tratamiento Farmacológico</label>
								                  <div class="col-md-10">
								                    <textarea class="form-control" id="tratamiento" name="tratamiento" placeholder="Valoracion del profesional"></textarea>
								                  </div>
								              </div>
							            </form>
							      </div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="headingThree">
							      <h4 class="panel-title">
							        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							          Exploracion
							        </a>
							      </h4>
							    </div>
								    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								      <div class="panel-body">
								        	<form class="form-horizontal">
								                  <!-- diagnostico -->
								                  
													<div class="form-group">
														<label for="tipo" class="col-md-2 control-label">Tipo de Dolor</label>
														<div class="col-md-4">
															<textarea class="form-control" id="tipo" name="tipo" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="agravante" class="col-md-2 control-label">Agravantes</label>
														<div class="col-md-4">
															<textarea class="form-control" id="agravante" name="agravante" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label for="hernia" class="col-md-2 control-label" placeholder="Valoracion del profesional">Dx Hernia</label>
														<div class="col-md-4">
															<textarea class="form-control" id="hernia" name="hernia" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="restriccion" class="col-md-2 control-label" placeholder="Valoracion del profesional">Restriccion Movilidad</label>
														<div class="col-md-4">
															<textarea class="form-control" id="restriccion" name="restriccion" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<!-- antialgica-territorio-->
													<div class="form-group">
														<label for="antialgica" class="col-md-2 control-label" placeholder="Valoracion del profesional">Posición Antialgica</label>
														<div class="col-md-4">
															<textarea class="form-control" id="antialgica" name="antialgica" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="territorio" class="col-md-2 control-label" placeholder="Valoracion del profesional">Territorio de Dolor</label>
														<div class="col-md-4">
															<textarea class="form-control" id="territorio" name="territorio" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<!-- testing ---- reflejos -->
													<div class="form-group">
														<label for="testing" class="col-md-2 control-label" placeholder="Valoracion del profesional">Testing Muscular</label>
														<div class="col-md-4">
															<textarea class="form-control" id="testing" name="testing" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="reflejos" class="col-md-2 control-label" placeholder="Valoracion del profesional">Reflejos</label>
														<div class="col-md-4">
															<textarea class="form-control" id="reflejos" name="reflejos" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<!-- lasegue ---- palpacion -->
													<div class="form-group">
														<label for="lasegue" class="col-md-2 control-label" placeholder="Valoracion del profesional">Laségue</label>
														<div class="col-md-4">
															<textarea class="form-control" id="lasegue" name="lasegue" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="palpacion" class="col-md-2 control-label" placeholder="Valoracion del profesional">Palpacion Ciático y Piramidal</label>
														<div class="col-md-4">
															<textarea class="form-control" id="palpacion" name="palpacion" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<!-- balanceart ---- balancemusc -->
													<div class="form-group">
														<label for="balanceart" class="col-md-2 control-label" placeholder="Valoracion del profesional">Balance Articular</label>
														<div class="col-md-4">
															<textarea class="form-control" id="balanceart" name="balanceart" placeholder="Valoracion del profesional"></textarea>
														</div>
													
														<label for="balancemusc" class="col-md-2 control-label" placeholder="Valoracion del profesional">Balance Muscular</label>
														<div class="col-md-4">
															<textarea class="form-control" id="balancemusc" name="balancemusc" placeholder="Valoracion del profesional"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label for="alteraciones" class="col-md-2 control-label" placeholder="Valoracion del profesional">Alteraciones Neurológicas</label>
														<div class="col-md-10">
															<textarea class="form-control" id="alteraciones" name="alteraciones" placeholder="Valoracion del profesional"></textarea>
														</div>
								              		</div>
								            </form>
								      </div>
								    </div>
								  </div>
								</div>
						<!--fin collpase-->
			     	 </div>
			     	 <!-- Fin cuerpo modal -->

				<!-- Pie del modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btn_guardar_cambios">Guardar cambios</button>
				</div>
				<!-- Fin pie modal -->
			</div>
			</div>
		</div>
			<!-- Fin modal -->	
<!-- Modal 2 -->
