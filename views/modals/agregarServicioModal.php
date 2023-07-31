                        <!-- Modal -->
                        <div class="modal fade" id="agregarServicioModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content" id="agregarServicioForm">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Agregar servicio</h5>
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
                                    <label for="agregarServicioModalNombre" class="form-label">Nombre</label>
                                    <input
                                      type="text"
                                      id="agregarServicioModalNombre"
                                      name="agregarServicioModalNombre"
                                      class="form-control"
                                      placeholder="Ingresa el nombre del servicio"
                                    />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarServicioModalDuracion" class="form-label">Duración promedio (min o horas)</label>
                                    <input 
                                    class="form-control" 
                                    type="text" 
                                    value="" 
                                    id="agregarServicioModalDuracion"
                                    name="agregarServicioModalDuracion"
                                    >
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarServicioModalPrecio" class="form-label">Precio S/.</label>
                                    <input
                                      type="number"
                                      id="agregarServicioModalPrecio"
                                      name="agregarServicioModalPrecio"
                                      class="form-control"
                                      placeholder="30"
                                    />
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="agregarServicioModalPrecioDescri" class="form-label">Descripción</label>
                                    <textarea 
                                    class="form-control" 
                                    id="agregarServicioModalPrecioDescri" 
                                    name="agregarServicioModalPrecioDescri" 
                                    rows="3"></textarea>
                                  </div>
                                </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary btnAgregarServicioModal">Agregar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>