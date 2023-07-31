                      <!-- Extra Large Modal -->
                      <div class="modal fade" id="editarModalCita" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel4">Editar cita</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <form action="" id="formEditarCitaModal">
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3 divContenedorEditSelectMascota">
                                  <label for="nameExLarge" class="form-label">Mascota (nombre mascota - DNI dueño)</label>

                                </div>
                              </div>
                              <div class="row g-2 mb-2">
                              <div class="col mb-0">
                                  <label for="fechaEditarCitaModal" class="form-label">Fecha programada</label>
                                  <input type="date" id="fechaEditarCitaModal" name="fechaEditarCitaModal" class="form-control" placeholder="DD / MM / YY" />
                                </div>
                                <div class="col mb-0">
                                  <label for="horaEditarCitaModal" class="form-label">Hora de atención</label>
                                  <input class="form-control" id="horaEditarCitaModal" name="horaEditarCitaModal" type="time" value="12:00:00" id="html5-time-input">
                                </div>
                              </div>

                              <div class="row">
                                <div class="col mb-2 divContenedorEditSelectVeterinario">
                                  <label for="nameExLarge" class="form-label">Veterinario</label>
                                </div>
                              </div>
<!-- 
                              <div class="row">
                                <div class="col mb-3">
                                  <label for="motivoNuevaCitaModal" class="form-label exampleFormControlTextarea1">Motivo</label>
                                  <textarea class="form-control" id="motivoNuevaCitaModal" name="motivoNuevaCitaModal" rows="3"></textarea>
                                </div>
                              </div> -->


                              <div class="row mt-1">
                                <div class="col mb-2">
                                  <label for="nameExLarge" class="form-label">Servicios</label>
                                  <div class="card">
                                    <div class="card-datatable table-responsive pt-0">
                                      <table class="datatables-basic table" id="tabla-editarServiciosCitas">
                                        <thead>
                                          <tr>  
                                            <th>Nombre</th>
                                            <th>Precio S/.</th>
                                            <th>Duración Promedio (minutos)</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            </form>

                            

                            <div class="modal-footer">
                              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <button type="button" class="btn btn-primary btnEditarCitaModal">Editar cita</button>
                            </div>
                          </div>
                        </div>
                      </div>