                        <!-- Modal -->
                        <div class="modal fade" id="agregarVeterinarioModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content" id="agregarVeterinarioForm">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Agregar veterinario</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarVetModalNombres" class="form-label">Nombre</label>
                                    <input
                                      type="text"
                                      id="agregarVetModalNombre"
                                      name="agregarVetModalNombre"
                                      class="form-control"
                                      placeholder="Ingresa el nombre"
                                    />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarVetModalApellidos" class="form-label">Apellidos</label>
                                    <input
                                      type="text"
                                      id="agregarVetModalApellidos"
                                      name="agregarVetModalApellidos"
                                      class="form-control"
                                      placeholder="Ingresa los apellidos"
                                    />
                                  </div>
                                </div>

                                <div class="row g-2 mb-3">
                                  <div class="col mb-0">
                                    <label for="agregarVetModalEmail" class="form-label">Email</label>
                                    <input
                                      type="email"
                                      id="agregarVetModalEmail"
                                      name="agregarVetModalEmail"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="agregarVetModalNacimiento" class="form-label">Fecha de nacimiento</label>
                                    <input
                                      type="date"
                                      id="agregarVetModalNacimiento"
                                      name="agregarVetModalNacimiento"
                                      class="form-control"
                                      placeholder="DD / MM / YY"
                                    />
                                  </div>

                                </div>


                                <div class="row">
                                <div class="col mb-3">
                                    <label for="agregarVetModalDNI" class="form-label">DNI</label>
                                    <input
                                      type="text"
                                      id="agregarVetModalDNI"
                                      name="agregarVetModalDNI"
                                      class="form-control"
                                      placeholder="74256324"
                                    />
                                  </div>
                                  </div>

                                  <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarVetModalTelefono" class="form-label">Telefono</label>
                                    <input
                                      type="text"
                                      id="agregarVetModalTelefono"
                                      name="agregarVetModalTelefono"
                                      class="form-control"
                                      placeholder="981 632 128"
                                    />
                                  </div>
                                  </div>



                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary btnAgregarVetModal">Agregar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>