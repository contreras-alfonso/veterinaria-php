const btnPruebaModal = document.querySelector('.btnPruebaModal');
const contenedorSpinner = document.querySelector('.contenedorSpinner');
const modalMascotaSelectClientes = document.querySelector('#modalMascotaSelectClientes');
const mascotaForm = document.querySelector('#mascotaForm');
const btnAgregarMascota = document.querySelector('.btnAgregarMascota');
const btnMascotaModal = document.querySelector('.btnMascotaModal');
const contenedorSelectMascotas = document.querySelector('.contenedorSelectMascotas');

var tablaMascotas;

window.addEventListener('DOMContentLoaded',()=>{

    mascotaForm.addEventListener('submit',agregarOeditarMascota);
    btnAgregarMascota.addEventListener('click',abrirModalAgregarMascota);
    cargarTablaMascota();
    $('.chosen-select').chosen();

})

async function abrirModalEditarMascota(idMascota){
    document.querySelector('.tituloModalMascota').textContent = 'Editar mascota';
    document.querySelector('.descriModalMascota').textContent = 'Edita la información de una mascota de Orejotas y colitas';
    btnMascotaModal.setAttribute('data-id',idMascota);
    btnMascotaModal.textContent = 'Editar mascota';


    
    const urlClientes = urlRuta+'controllers/clienteController.php?opc=obtenerClientes';
    contenedorSpinner.style.display = 'flex';
    const responseClientes = await fetch(urlClientes);
    const dataClientes = await responseClientes.json();

    agregarOptionHTML(dataClientes);
    obtenerDatosMascota();
}


async function abrirModalAgregarMascota(){
    const url = urlRuta+'controllers/clienteController.php?opc=obtenerClientes';
    contenedorSpinner.style.display = 'flex';
    const response = await fetch(url);
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    agregarOptionHTML(data);
    document.querySelector('.tituloModalMascota').textContent = 'Agregar nueva mascota';
    document.querySelector('.descriModalMascota').textContent = 'Agrega una nueva mascota para Orejotas y colitas';
    document.querySelector('#modalMascotaNombre').value = '';
    document.querySelector('#modalMascotaRaza').value = '';
    document.querySelector('#modalMascotaEspecie').value = 'Perro';
    // document.querySelector('#modalMascotaInfoAdicional').textContent = '';
    document.querySelector('#modalMascotaPeso').value = '';
    document.querySelector('#modalMascotaNacimiento').value = '';
    btnMascotaModal.textContent = 'Agregar mascota';
    btnMascotaModal.textContent = 'Agrega mascota';
    btnMascotaModal.setAttribute('data-id','0');
    $("#mascotaModal").modal("show");
}

function agregarOptionHTML(usuarios){


    let contenidoSelect = `<label class="form-label" for="modalMascotaSelectClientes">Cliente</label><select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 modalMascotaSelectClientes"
    name="modalMascotaSelectClientes"
    data-style="btn-default"
    data-live-search="true"
    >`;

    usuarios.forEach(usuario => {
        contenidoSelect+=`<option value="${usuario.idcliente}">${usuario.dni}</option>`;
    });

    contenidoSelect += `</select>`;

    contenedorSelectMascotas.innerHTML = contenidoSelect;

    console.log()

    $('.modalMascotaSelectClientes').selectpicker('render');

    
}

function editarClienteOptionHTML(usuarios){


    let contenidoSelect = `<label class="form-label" for="modalMascotaSelectClientes">Cliente</label><select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 modalMascotaSelectClientes"
    name="modalMascotaSelectClientes"
    data-style="btn-default"
    data-live-search="true"
    >`;

    usuarios.forEach(usuario => {
        contenidoSelect+=`<option ${e.idcliente == idVeterinario ? 'selected' : ''} value="${usuario.idcliente}">${usuario.dni}</option>`;
    });

    contenidoSelect += `</select>`;

    contenedorSelectMascotas.innerHTML = contenidoSelect;

    console.log()

    $('.modalMascotaSelectClientes').selectpicker('render');

    
}

function agregarOeditarMascota(e){
    e.preventDefault();
    const id = btnMascotaModal.getAttribute('data-id');
    id == 0 ? agregarMascota() : editarMascota() ;
}

async function editarMascota(){
    contenedorSpinner.style.display = 'flex';
    const formData = new FormData(mascotaForm);
    formData.append('idmascota',btnMascotaModal.getAttribute('data-id'));
    console.log([...formData]);
    const url = urlRuta+'controllers/mascotaController.php?opc=editarMascota';
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        tablaMascotas.api().ajax.reload();
        $("#mascotaModal").modal("hide");
        alertaSuceso(data.msg);
        return;
    }
    alertaError(data.msg);
}

async function obtenerDatosMascota(){
    const idMascota = btnMascotaModal.getAttribute('data-id');
    const formData = new FormData();
    formData.append('idmascota',idMascota);
    const url = urlRuta+'controllers/mascotaController.php?opc=obtenerMascota';
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    formatearCamposHTML(data);
    $("#mascotaModal").modal("show");

}

function formatearCamposHTML({especie,idcliente,idmascota,informacion_adicional,nacimiento,nombre,peso,raza}){
    document.querySelector('#modalMascotaNombre').value = nombre;
    document.querySelector('#modalMascotaRaza').value = raza;
    document.querySelector('#modalMascotaEspecie').value = especie;
    // document.querySelector('#modalMascotaInfoAdicional').textContent = informacion_adicional;
    document.querySelector('#modalMascotaPeso').value = peso;
    document.querySelector('#modalMascotaNacimiento').value = nacimiento;
    console.log(idcliente);
    // document.querySelector('.modalMascotaSelectClientes').children[0].value = idcliente;
    // console.log(document.querySelector('.modalMascotaSelectClientes').children[0].value);
    // $('.modalMascotaSelectClientes').selectpicker('render');

    const select2 = $('.modalMascotaSelectClientes').eq(1);
    select2.selectpicker('val', (idcliente+""));

    
}

async function agregarMascota(){
    contenedorSpinner.style.display = 'flex';
    const formData = new FormData(mascotaForm);
    console.log([...formData]);
    const url = urlRuta+'controllers/mascotaController.php?opc=agregarMascota';
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        tablaMascotas.api().ajax.reload();
        $("#mascotaModal").modal("hide");
        alertaSuceso(data.msg);
        return;
    }
    alertaError(data.msg);
}

function verHistorialMedico(idmascota){
    console.log(idmascota);
    const url = urlRuta+'views/historialMedico.php?idm='+idmascota;
    window.open(url,"_blank")
}

function cargarTablaMascota(){
    contenedorSpinner.style.display = 'flex';
    
    tablaMascotas = $('#tabla-mascotas').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/mascotaController.php?opc=obtenerMascotasYSusDueños",
            "dataSrc":""
        },
        "columns":[
            {"data":"idmascota"},
            {"data":"nombre"},
            {"data":"nacimiento"},
            {"data":"raza"},
            {"data":"especie"},
            {"data":"peso"},
            {"data":"nombres"},
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

