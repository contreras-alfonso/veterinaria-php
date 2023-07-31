const urlRuta = 'https://orejotasycolitas.online/veterinaria/';

function activarSpinner(){
  contenedorSpinner.style.display = 'flex';
}

function desactivarSpinner(){
  contenedorSpinner.style.display = 'none';
}

function alertaSuceso(mensaje){
    Swal.fire({
        title: 'Good job!',
        text: `${mensaje}`,
        icon: 'success',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false,
        allowOutsideClick: false,
      });
}

function alertaPregunta(dosis,mensaje){
  Swal.fire({
    title: `${dosis}° dosis`,
    text: "¿Está seguro de cambiar el estado de la vacuna?",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonColor: '#3085d6',

    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-rojo'
      },

      buttonsStyling: false,
      allowOutsideClick: false,


  }).then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
            title: 'Genial!',
            text: `${mensaje}`,
            icon: 'success',
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false,
            allowOutsideClick: false,
    
          });
    }
  })
}

function alertaError(mensaje){
    Swal.fire({
        title: 'Oppss!',
        text: `${mensaje}`,
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false,
        allowOutsideClick: false,

      });
}

async function agregarFetch(formulario,controlador,opcion,nombretabla,nombreModal){
  contenedorSpinner.style.display = 'flex';
  const formData = new FormData(formulario);
  // console.log([...formData]);
  const url = urlRuta+`controllers/${controlador}.php?opc=${opcion}`;
  const response = await fetch(url,{
      method: 'POST',
      body: formData,
  })
  const data = await response.json();
  contenedorSpinner.style.display = 'none';
  if(data.status){
      nombretabla.api().ajax.reload();
      $(`#${nombreModal}`).modal("hide");
      alertaSuceso(data.msg);
      return;
  }
  alertaError(data.msg);
}

function cargarDataTable(variableTabla,idTabla,controlador,opcion,columnas){
    contenedorSpinner.style.display = 'flex';
      
    tablaMascotas = $('#tabla-mascotas').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/mascotaController.php?opc=obtenerMascotas",
            "dataSrc":""
        },
        "columns":[
            columnas.forEach(nombre=>{
              `{"data":"${nombre}"}`
            })
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
        
    });

    setTimeout(() => {
        contenedorSpinner.style.display = 'none';
    }, 1200);
}