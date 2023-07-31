                        <!-- Modal -->
                        <div class="modal fade" id="editarServicioModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content" id="editarServicioForm">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Editar servicio</h5>
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
                                    <label for="editarServicioModalNombre" class="form-label">Nombre</label>
                                    <input
                                      type="text"
                                      id="editarServicioModalNombre"
                                      name="editarServicioModalNombre"
                                      class="form-control"
                                      placeholder="Ingresa el nombre del servicio"
                                    />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="editarServicioModalDuracion" class="form-label">Duración promedio (min o horas)</label>
                                    <input 
                                    class="form-control" 
                                    type="text" 
                                    value="" 
                                    id="editarServicioModalDuracion"
                                    name="editarServicioModalDuracion"
                                    >
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="editarServicioModalPrecio" class="form-label">Precio S/.</label>
                                    <input
                                      type="number"
                                      id="editarServicioModalPrecio"
                                      name="editarServicioModalPrecio"
                                      class="form-control"
                                      placeholder="30"
                                    />
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="editarServicioModalPrecioDescri" class="form-label">Descripción</label>
                                    <textarea 
                                    class="form-control" 
                                    id="editarServicioModalPrecioDescri"
                                    name="editarServicioModalPrecioDescri"
                                    rows="3"></textarea>
                                  </div>
                                </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary btnEditarServicioModal">Editar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>