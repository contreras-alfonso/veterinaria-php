<!-- Edit User Modal -->
<div class="modal fade show" id="mascotaModal" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="mb-2 tituloModalMascota">Agregar nueva mascota</h3>
                        <p class="text-muted descriModalMascota">Agrega una nueva mascota para Orejotas y colitas</p>
                      </div>
                      <form id="mascotaForm" class="row g-3" onsubmit="return false">
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaNombre">Nombre de la mascota</label>
                          <input
                            type="text"
                            id="modalMascotaNombre"
                            name="modalMascotaNombre" 
                            class="form-control"
                            placeholder="choco"
                          />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaNacimiento">Nacimiento</label>
                          <input class="form-control" name="modalMascotaNacimiento" id="modalMascotaNacimiento" type="date" value="" id="html5-date-input">

                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaRaza">Raza</label>
                          <input
                            type="text"
                            id="modalMascotaRaza"
                            name="modalMascotaRaza"
                            class="form-control"
                            placeholder=""
                          />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaEspecie">Especie</label>
                          <select
                            id="modalMascotaEspecie"
                            name="modalMascotaEspecie"
                            class="form-select"
                            aria-label="Default select example"
                          >
                            <option selected value="Perro">Perro</option>
                            <option value="Gato">Gato</option>
                            <option value="Hamster">Hamster</option>
                            <option value="Loro">Loro</option>
                            <option value="Conejo">Conejo</option>
                          </select>
                          
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaPeso">Peso</label>
                          <input
                            type="text"
                            id="modalMascotaPeso"
                            name="modalMascotaPeso"
                            class="form-control modal-edit-tax-id"
                            placeholder="10kg"
                          />
                        </div>

                        <div class="col-12 col-md-6 contenedorSelectMascotas">

                        </div>


                        <!-- <div class="col-12 col-md-6">
                          <label class="form-label" for="modalMascotaInfoAdicional">Información adicional</label>
                          <div class="input-group">
                            <textarea class="form-control" name="modalMascotaInfoAdicional" id="modalMascotaInfoAdicional" rows="3"></textarea>
                          </div>
                        </div> -->


                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-primary me-sm-3 me-1 btnMascotaModal">Agregar mascota</button>
                          <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          >
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->