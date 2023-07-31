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
    <link rel="stylesheet" href="../src/css/spinnerVacunas.css" />

    <link href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css" rel="stylesheet" />

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
            <?php $seccionSelected = 'vacunacion'; require('./cuerpo/menu.php') ?>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orejotas y Colitas /</span> Vacunación</h4>
              <div class="row">

              <div class="col-md-5 mb-4">
                          <label for="selectpickerLiveSearch" class="form-label">Vacuna</label>
                          <div id="contenedorSelectVacunas">
                          </div>

              </div>

              <div class="col-md-5 mb-4">
                          <label for="TypeaheadBasic" class="form-label">DNI del dueño</label>
                          <input
                            id="TypeaheadBasic"
                            class="InputDniDueño form-control typeahead"
                            type="text"
                            autocomplete="off"
                            placeholder="Ejm: 74805162"
                            name="dniDueño"
                          />
              </div>

              <div class="col-md-2 mb-4">
              <label for="TypeaheadBasic" class="form-label"></label>
              <button type="button" id="btnBuscarMascotaVacunacion" class="form-control btn btn-primary waves-effect waves-light">Buscar</button>
              </div>

              

              </div>

              <div class="contenedorSpinnerVacunas displayNone">
              <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
              </div>
              </div>

            <div class="contenedorVacunasYnombreDeMascota">


              </div>
             
              <!-- <hr class="my-5" /> -->

              
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
    <?php require('./modals/modalSeleccionMascota.php'); ?>

    <!-- Core JS -->
    <?php require('./cuerpo/corejs.php') ?>

    <!-- Page JS -->
    <script src="../assets/js/form-layouts.js"></script>
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../src/js/vacunas.js"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>

  </body>
</html>
