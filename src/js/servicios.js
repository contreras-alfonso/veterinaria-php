const btnAgregarServicio = document.querySelector('.btnAgregarServicio');
const agregarServicioForm = document.querySelector('#agregarServicioForm');
const btnAgregarServicioModal = document.querySelector('.btnAgregarServicioModal');
const editarServicioForm = document.querySelector('#editarServicioForm');
const btnEditarServicioModal = document.querySelector('.btnEditarServicioModal');
const contenedorSpinner = document.querySelector('.contenedorSpinner');

var tablaSercicios;

document.addEventListener("DOMContentLoaded",()=>{
    btnAgregarServicio.addEventListener('click',abrirModalNuevoServicio);
    btnAgregarServicioModal.addEventListener('click',agregarServicio);
    btnEditarServicioModal.addEventListener('click',editarServicio);
    cargarDataTable();
})

async function editarServicio(){
    contenedorSpinner.style.display = 'flex';
    const formDataVeterinario = new FormData(editarServicioForm);
    formDataVeterinario.append('idservicio',btnEditarServicioModal.getAttribute('data-id'));
    // console.log([...formDataVeterinario]);
    const url = urlRuta+'controllers/servicioController.php?opc=editarServicio';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataVeterinario,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        tablaSercicios.api().ajax.reload();
        $("#editarServicioModal").modal("hide");
        alertaSuceso(data.msg);
        return;
    }
    alertaError(data.msg);
}

function abrirModalEditarServicio(id){
    contenedorSpinner.style.display = 'flex';
    btnEditarServicioModal.setAttribute('data-id',id);
    obtenerDatosServicio(id);
}

async function obtenerDatosServicio(id){
    const formDataServicio = new FormData();
    formDataServicio.append('idservicio',id);
    const url = urlRuta+'controllers/servicioController.php?opc=obtenerServicio';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataServicio,
    })
    const data = await response.json();
    const {nombre,duracion,precio,descripcion} = data;
    document.querySelector('#editarServicioModalNombre').value = nombre;
    document.querySelector('#editarServicioModalDuracion').value = duracion;
    document.querySelector('#editarServicioModalPrecio').value = precio;
    document.querySelector('#editarServicioModalPrecioDescri').value = descripcion;
    // console.log(data);
    contenedorSpinner.style.display = 'none';
    $("#editarServicioModal").modal("show");
}

function abrirModalNuevoServicio(){
    agregarServicioForm.reset();
    $("#agregarServicioModal").modal('show');
}

async function agregarServicio(){
    agregarFetch(agregarServicioForm,"servicioController","agregarServicio",tablaSercicios,'agregarServicioModal');
}

function cargarDataTable(){
    contenedorSpinner.style.display = 'flex';
      
    tablaSercicios = $('#tabla-servicios').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/servicioController.php?opc=obtenerServicios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idservicio"},
            {"data":"nombre"},
            {"data":"duracion"},
            {"data":"precio"},
            {"data":"descripcion"},
            {"data":"opciones"},
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
