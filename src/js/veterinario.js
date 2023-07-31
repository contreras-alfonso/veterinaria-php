const btnAgregarVeterinario = document.querySelector('.btnAgregarVeterinario');
const agregarVeterinarioForm = document.querySelector('#agregarVeterinarioForm');
const editarVeterinarioForm = document.querySelector('#editarVeterinarioForm');
const contenedorSpinner = document.querySelector('.contenedorSpinner');
const btnAgregarVetModal = document.querySelector('.btnAgregarVetModal');
const btnEditarVetModal = document.querySelector('.btnEditarVetModal');
var tablaVeterinarios;

document.addEventListener('DOMContentLoaded',()=>{
    btnAgregarVeterinario.addEventListener('click',abrirModalAgregarVeterinario);
    btnAgregarVetModal.addEventListener('click',agregarVeterinario);
    btnEditarVetModal.addEventListener('click',editarVeterinario);
    cargarTablaVeterinarios();
})

async function editarVeterinario(){
    contenedorSpinner.style.display = 'flex';
    const formDataVeterinario = new FormData(editarVeterinarioForm);
    formDataVeterinario.append('idveterinario',btnEditarVetModal.getAttribute('data-id'));
    console.log([...formDataVeterinario]);
    const url = urlRuta+'controllers/veterinarioController.php?opc=editarVeterinario';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataVeterinario,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        tablaVeterinarios.api().ajax.reload();
        $("#editarVeterinarioModal").modal("hide");
        alertaSuceso(data.msg);
        return;
    }
    alertaError(data.msg);

}

function abrirModalEditarVeterinario(idvet){
    contenedorSpinner.style.display = 'flex';
    btnEditarVetModal.setAttribute('data-id',idvet);
    obtenerDatosVeterinario(idvet);
}

async function obtenerDatosVeterinario(id){

    const formDataVeterinario = new FormData();
    formDataVeterinario.append('idveterinario',id);
    const url = urlRuta+'controllers/veterinarioController.php?opc=obtenerVeterinario';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataVeterinario,
    })
    const data = await response.json();
    const {nombres,apellidos,dni,correo,telefono,nacimiento} = data;
    document.querySelector('#editarVetModalNombre').value = nombres;
    document.querySelector('#editarVetModalApellidos').value = apellidos;
    document.querySelector('#editarVetModalEmail').value = correo;
    document.querySelector('#editarVetModalNacimiento').value = nacimiento;
    document.querySelector('#editarVetModalDNI').value = dni;
    document.querySelector('#editarVetModalTelefono').value = telefono;
    contenedorSpinner.style.display = 'none';
    $("#editarVeterinarioModal").modal("show");
}


async function agregarVeterinario(){
    contenedorSpinner.style.display = 'flex';
    const formDataVeterinario = new FormData(agregarVeterinarioForm);
    console.log([...formDataVeterinario]);
    const url = urlRuta+'controllers/veterinarioController.php?opc=agregarVeterinario';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataVeterinario,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        tablaVeterinarios.api().ajax.reload();
        $("#agregarVeterinarioModal").modal("hide");
        alertaSuceso(data.msg);
        return;
    }
    alertaError(data.msg);
}

function abrirModalAgregarVeterinario(){
    $("#agregarVeterinarioModal").modal("show");
    agregarVeterinarioForm.reset();

}

function cargarTablaVeterinarios(){
    contenedorSpinner.style.display = 'flex';
    
    tablaVeterinarios = $('#tabla-veterinarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/veterinarioController.php?opc=obtenerVeterinarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idveterinario"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"dni"},
            {"data":"correo"},
            {"data":"telefono"},
            {"data":"nacimiento"},
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

