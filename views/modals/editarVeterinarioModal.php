                        <!-- Modal -->
                        <div class="modal fade" id="editarVeterinarioModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content" id="editarVeterinarioForm">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Editar veterinario</h5>
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
                                    <label for="editarVetModalNombre" class="form-label">Nombre</label>
                                    <input
                                      type="text"
                                      id="editarVetModalNombre"
                                      name="editarVetModalNombre"
                                      class="form-control"
                                      placeholder="Ingresa el nombre"
                                    />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="editarVetModalApellidos" class="form-label">Apellidos</label>
                                    <input
                                      type="text"
                                      id="editarVetModalApellidos"
                                      name="editarVetModalApellidos"
                                      class="form-control"
                                      placeholder="Ingresa los apellidos"
                                    />
                                  </div>
                                </div>

                                <div class="row g-2 mb-3">
                                  <div class="col mb-0">
                                    <label for="editarVetModalEmail" class="form-label">Email</label>
                                    <input
                                      type="email"
                                      id="editarVetModalEmail"
                                      name="editarVetModalEmail"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="editarVetModalNacimiento" class="form-label">Fecha de nacimiento</label>
                                    <input
                                      type="date"
                                      id="editarVetModalNacimiento"
                                      name="editarVetModalNacimiento"
                                      class="form-control"
                                      placeholder="DD / MM / YY"
                                    />
                                  </div>

                                </div>


                                <div class="row">
                                <div class="col mb-3">
                                    <label for="editarVetModalDNI" class="form-label">DNI</label>
                                    <input
                                      type="text"
                                      id="editarVetModalDNI"
                                      name="editarVetModalDNI"
                                      class="form-control"
                                      placeholder="74256324"
                                    />
                                  </div>
                                  </div>

                                  <div class="row">
                                  <div class="col mb-3">
                                    <label for="editarVetModalTelefono" class="form-label">Telefono</label>
                                    <input
                                      type="text"
                                      id="editarVetModalTelefono"
                                      name="editarVetModalTelefono"
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
                                <button type="button" class="btn btn-primary btnEditarVetModal">Editar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>