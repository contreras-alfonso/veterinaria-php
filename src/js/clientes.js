const btnAgregarCliente = document.querySelector('.btnAgregarCliente');
const formCliente = document.querySelector('#editUserForm');
const contenedorSpinner = document.querySelector('.contenedorSpinner');

var tablaClientes;

window.addEventListener('DOMContentLoaded',()=>{
    cargarDatatableClientes();
    btnAgregarCliente.addEventListener('click',abrirModalNuevoCliente);
    formCliente.addEventListener('submit',agregarOeditarCliente);
    
})


function abrirModalEditarCliente(idcliente){

    formCliente.reset();
    document.querySelector('.tituloModalCliente').textContent = 'Editar Cliente';
    document.querySelector('.descriModalCliente').textContent = 'Edita un cliente para Orejotas y colitas';
    document.querySelector('.btnClienteModal').textContent = 'Editar';
    document.querySelector('.btnClienteModal').setAttribute('data-id',idcliente);
    obtenerDatosClienteAeditar(idcliente);
}

async function obtenerDatosClienteAeditar(idcliente){
    contenedorSpinner.style.display = 'flex';

    const id = idcliente;
    const formDataCliente = new FormData();
    formDataCliente.append('idcliente',JSON.stringify(id));
    // console.log([...formDataCliente]);
    const url = urlRuta+'controllers/clienteController.php?opc=obtenerCliente';
    const response = await fetch(url,{
        method: 'POST',
        body: formDataCliente,
    })
    const data = await response.json();
    $("#editUser").modal("show");
    contenedorSpinner.style.display = 'none';

    const {nombres,apellidos,dni,telefono,correo,direccion} = data;
    document.querySelector('#modalEditUserFirstName').value = nombres;
    document.querySelector('#modalEditUserLastName').value = apellidos;
    document.querySelector('#modalEditUserEmail').value = correo;
    document.querySelector('#modalEditDireccion').value = direccion;
    document.querySelector('#modalEditUserPhone').value = telefono;
    document.querySelector('#modalEditDNI').value = dni;
}

async function editarCliente(idCliente){
    contenedorSpinner.style.display = 'flex';

    const url = urlRuta+'controllers/clienteController.php?opc=editarCliente';
    const formDataCliente = new FormData(formCliente);
    formDataCliente.append('idcliente',JSON.stringify(idCliente));
    // console.log([...formDataCliente]);
    const respuesta = await fetch(url,{
        method: 'POST',
        body: formDataCliente,
    })
    const data = await respuesta.json();

    contenedorSpinner.style.display = 'none';

    if(data.status){
        alertaSuceso(data.msg);
        tablaClientes.api().ajax.reload();
        $("#editUser").modal("hide");
        return;
    }

    alertaError(data.msg);
}

function agregarOeditarCliente(e){
    e.preventDefault();
    const idCliente = Number(document.querySelector('.btnClienteModal').getAttribute('data-id'));
    idCliente === 0 ? agregarNuevoCliente() : editarCliente(idCliente) ;
}

async function agregarNuevoCliente(){
    contenedorSpinner.style.display = 'flex';

    //validar si existe el DNI de ese cliente, caso contrario continuar
    const existeDNI = await buscarDNIcliente(document.querySelector('#modalEditDNI').value);

    if(existeDNI){
        alertaError('El DNI ingresado ya existe.');
        contenedorSpinner.style.display = 'none';
        return;
    }


    const url = urlRuta+'controllers/clienteController.php?opc=agregarCliente';
    const formDataCliente = new FormData(formCliente);
    // console.log([...formcliente]);
    const respuesta = await fetch(url,{
        method: 'POST',
        body: formDataCliente,
    })
    const data = await respuesta.json();
    contenedorSpinner.style.display = 'none';

    // console.log(data);
    if(data.status){
        alertaSuceso(data.msg);
        tablaClientes.api().ajax.reload();
        $("#editUser").modal("hide");
        return;
    }

    alertaError(data.msg);

}

async function buscarDNIcliente(dni){
    const url = urlRuta+'controllers/clienteController.php?opc=buscarDuenoPorDNI';
    const formData = new FormData(formCliente);
    formData.append('dniDueño',dni);
    // console.log([...formcliente]);
    const respuesta = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await respuesta.json();
    return data.status;
}

function abrirModalNuevoCliente(){

    formCliente.reset();
    document.querySelector('.tituloModalCliente').textContent = 'Agregar nuevo cliente';
    document.querySelector('.descriModalCliente').textContent = 'Agrega un nuevo cliente para Orejotas y colitas';
    document.querySelector('.btnClienteModal').textContent = 'Agregar';
    $("#editUser").modal("show");
    document.querySelector('.btnClienteModal').setAttribute('data-id','0');
}

function cargarDatatableClientes(){

    contenedorSpinner.style.display = 'flex';
    
    tablaClientes = $('#tabla-clientes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/clienteController.php?opc=obtenerClientes",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcliente"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"dni"},
            {"data":"telefono"},
            {"data":"direccion"},
            {"data":"correo"},
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