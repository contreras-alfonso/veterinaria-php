<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
  <title>Mascotas | Orejotas y Colitas</title>
    <?php require('./cuerpo/head.php') ?>
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/flatpickr/flatpickr.css" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css" rel="stylesheet" />

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
            <?php $seccionSelected = 'mascotas'; require('./cuerpo/menu.php') ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
            <?php require('./cuerpo/navbar.php') ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
          
            <!-- / Menu -->

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orejotas y Colitas /</span> Mascotas</h4>

              <!-- DataTable with Buttons -->
              <div class="card">
                <div class="card-datatable table-responsive pt-0">
                <div class="contenedor_datatable">
                  
                <h5 class="card-title">Tabla mascotas</h5>
                
              
                <button data-target="#staticBackdrop" data-toggle="modal" class="btn btn-secondary create-new btn-primary btnAgregarMascota" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar nueva mascota</span></span></button> 
              

              </div>
                  <table class="datatables-basic table" id="tabla-mascotas">
                    <thead>
                      <tr>  
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Nacimiento</th>
                        <th>Raza</th>
                        <th>Especie</th>
                        <th>Peso</th>
                        <th>Dueño</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <!-- Modal to add new record -->
              <div class="offcanvas offcanvas-end" id="add-new-record">
                <div class="offcanvas-header border-bottom">
                  <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
                  <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                  <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
                    <div class="col-sm-12">
                      <label class="form-label" for="basicFullname">Full Name</label>
                      <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input
                          type="text"
                          id="basicFullname"
                          class="form-control dt-full-name"
                          name="basicFullname"
                          placeholder="John Doe"
                          aria-label="John Doe"
                          aria-describedby="basicFullname2"
                        />
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="basicPost">Post</label>
                      <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"><i class="ti ti-briefcase"></i></span>
                        <input
                          type="text"
                          id="basicPost"
                          name="basicPost"
                          class="form-control dt-post"
                          placeholder="Web Developer"
                          aria-label="Web Developer"
                          aria-describedby="basicPost2"
                        />
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="basicEmail">Email</label>
                      <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                        <input
                          type="text"
                          id="basicEmail"
                          name="basicEmail"
                          class="form-control dt-email"
                          placeholder="john.doe@example.com"
                          aria-label="john.doe@example.com"
                        />
                      </div>
                      <div class="form-text">You can use letters, numbers & periods</div>
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="basicDate">Joining Date</label>
                      <div class="input-group input-group-merge">
                        <span id="basicDate2" class="input-group-text"><i class="ti ti-calendar"></i></span>
                        <input
                          type="text"
                          class="form-control dt-date"
                          id="basicDate"
                          name="basicDate"
                          aria-describedby="basicDate2"
                          placeholder="MM/DD/YYYY"
                          aria-label="MM/DD/YYYY"
                        />
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="basicSalary">Salary</label>
                      <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input
                          type="number"
                          id="basicSalary"
                          name="basicSalary"
                          class="form-control dt-salary"
                          placeholder="12000"
                          aria-label="12000"
                          aria-describedby="basicSalary2"
                        />
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <!--/ DataTable with Buttons -->

              

              <hr class="my-5" />

              
            </div>

          
            <!--/ Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>

    <!-- / Layout wrapper -->

    <!-- Spinner -->
    <?php require('./cuerpo/spinner.php') ?>

    <!-- Edit User Modal -->
    <?php require('./modals/mascotaModal.php'); ?>

    <!-- Core JS -->
    <?php require('./cuerpo/corejs.php') ?>

    <!-- Page JS -->
    <script src="../assets/js/form-layouts.js"></script>
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../src/js/mascota.js"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>

  </body>
</html>
