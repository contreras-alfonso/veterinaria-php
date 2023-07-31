const btnAgregarNuevaCita = document.querySelector('.btnAgregarNuevaCita');
const divContenedorSelectMascota = document.querySelector('.divContenedorSelectMascota');
const divContenedorSelectVeterinario = document.querySelector('.divContenedorSelectVeterinario');
const formNuevaCitaModal = document.querySelector('#formNuevaCitaModal');
const btnNuevaCitaModal = document.querySelector('.btnNuevaCitaModal');
const contenedorSpinner = document.querySelector('.contenedorSpinner');
const btnAgregarDetalleCita = document.querySelector('.btnAgregarDetalleCita');
const agregarDetalleCitaForm = document.querySelector('#agregarDetalleCitaForm');
let arregloServiciosCita = [];
let checksServicios;
let tablaSercicios;
let tablaCitas;


document.addEventListener('DOMContentLoaded',()=>{
    btnAgregarNuevaCita.addEventListener('click',abrirModalNuevaCita);
    btnNuevaCitaModal.addEventListener('click',crearCita);
    btnAgregarDetalleCita.addEventListener('click',agregarDetalleCita);
    cargarMascotas();
    cargarVeterinariosHTML();
    cargarTablaServiciosCitas();
    cargarTablaCitas();

})

async function abrirModalCambiarEstado(idcita){
    // console.log(idcita);
    document.querySelector('.tituloModal').textContent = 'Estado de la cita N°'+idcita;
    document.querySelector('.contendorMascotasDeCliente').innerHTML = `<div class="col-md mb-md-0 mb-2">
    <div class="form-check custom-option custom-option-icon contenedorNombreMascotaCliente" onclick="cambiarEstadoCita(${idcita},1)" >
      <label class="form-check-label custom-option-content" for="customCheckboxSvg1">
        <span class="custom-option-body">
        <i class="check-verde fa-solid fa-circle-check"></i>
          <span class="custom-option-title">Realizado</span>
        </span>
      </label>
    </div>
  </div>


  <div class="col-md mb-md-0 mb-2">
    <div class="form-check custom-option custom-option-icon contenedorNombreMascotaCliente" onclick="cambiarEstadoCita(${idcita},0)" >
      <label class="form-check-label custom-option-content" for="customCheckboxSvg1">
        <span class="custom-option-body">
        <i class="delete-red fa-solid fa-circle-xmark"></i>
          <span class="custom-option-title">Cancelado</span>
        </span>
      </label>
    </div>
  </div>`
    $('#addNewCCModal').modal('show');
}

async function cambiarEstadoCita(idcita,estado){
    activarSpinner();
    const url = urlRuta+'controllers/citaController.php?opc=cambiarEstadoCita';
    const formData = new FormData();
    formData.append('idcita',idcita);
    formData.append('estado',estado);
    console.log([...formData]);

    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })

    const data = await response.json();

    if(data.status){
        alertaSuceso(data.msg);
        $('#addNewCCModal').modal('hide');
        tablaCitas.api().ajax.reload();
    }else{
        alertaError(data.msg);
    }

    desactivarSpinner();

}


async function crearCita(){
    contenedorSpinner.style.display = 'flex';
    const fechaProgramada = document.querySelector('#fechaNuevaCitaModal').value;
    let horaProgramada = (document.querySelector('#horaNuevaCitaModal').value);
    horaProgramada+= ":00";
    console.log(horaProgramada);
    let cruceHorario = await VerificarCruceDeHorarios(fechaProgramada,horaProgramada);
    console.log(cruceHorario);
    if(cruceHorario){
        alertaError('Hora de atención no disponible, debido a cruce de horarios.');
        return;
    }
    
    const tiempoEnMinutos = obtenerTiempoDeMinutosDeServiciosDeCita(arregloServiciosCita);
    const horaDeFinalizacionEsperada = obtenerHoraFinalizacionCita(horaProgramada,tiempoEnMinutos);
    // console.log(horaDeFinalizacionEsperada);
    const serviciosDeCitaString = obtenerServiciosString(arregloServiciosCita);
    const formData = new FormData(formNuevaCitaModal);
    formData.append('idservicios',serviciosDeCitaString);
    formData.append('hora_terminacion_esperada',horaDeFinalizacionEsperada);
    console.log([...formData]);
    const url = urlRuta+'controllers/citaController.php?opc=crearCita';
    const response = await fetch(url,{
        method:'POST',
        body:formData,
    });
    const data = await response.json();
    contenedorSpinner.style.display = 'none';
    if(data.status){
        $('#exLargeModal').modal('hide');
        alertaSuceso(data.msg);
        tablaCitas.api().ajax.reload();
        setTimeout(() => {
            window.location.href = urlRuta+'views/citas.php';
        }, 2000);
        return;
    }else{
        alertaError(data.msg)
    }


    

}

async function VerificarCruceDeHorarios(fecha,hora){
    console.log(fecha);
    const formData = new FormData();
    formData.append('fecha_atencion',fecha);
    console.log([...formData]);
    const url = urlRuta+'controllers/citaController.php?opc=obtenerCitasPorFecha';
    const response = await fetch(url,{
        method:'POST',
        body:formData,
    });
    const data = await response.json();
    console.log(data.length);
    contenedorSpinner.style.display = 'none';
    let cruce = false;

  
    if(data.length!==0){
    data.forEach(e=>{
        const {hora_programada,hora_terminacion_esperada} = e;
        const hora_programadaMilisegundos = transformarTiempoAMilisegundos(hora_programada);
        const hora_terminacion_esperadaMilisegundos = transformarTiempoAMilisegundos(hora_terminacion_esperada);
        const hora_programada_cita_Actual = transformarTiempoAMilisegundos(hora);

        console.log({
            hora_programada,
            hora_terminacion_esperada,
        })

        if(hora_programadaMilisegundos<= hora_programada_cita_Actual && hora_programada_cita_Actual <= hora_terminacion_esperadaMilisegundos ){
            console.log(hora_programadaMilisegundos+"<="+hora_programada_cita_Actual+"<="+hora_terminacion_esperadaMilisegundos);
            cruce = true;
        }
        
    })
    }else{
        cruce = false;
    }

    return cruce;
}

function transformarTiempoAMilisegundos(hora){
    // Hora en formato "HH:MM:SS"
    var horaTexto = hora;

    // Separar las partes de la hora
    var partesHora = horaTexto.split(":");

    // Obtener las horas, minutos y segundos
    var horas = parseInt(partesHora[0]);
    var minutos = parseInt(partesHora[1]);
    var segundos = parseInt(partesHora[2]);

    // Calcular los milisegundos totales
    var milisegundosTotales = (horas * 3600 + minutos * 60 + segundos) * 1000;

    return (milisegundosTotales); // Salida: 4800000
}

function obtenerTiempoDeMinutosDeServiciosDeCita(arregloServiciosCita){
    let tiempo = 0;
    arregloServiciosCita.forEach(e=>{
        tiempo+= Number(e.duracion);
    })
    return tiempo;
}

function obtenerHoraFinalizacionCita(horaProgramada,minutosDeServicios){
    // Hora inicial en formato "HH:MM"
    var horaInicial = horaProgramada;

    // Cantidad de minutos a sumar
    var minutosASumar = minutosDeServicios;

    // Convertir la hora inicial a un objeto Date
    var fechaHora = new Date();
    var partesHoraInicial = horaInicial.split(":");
    fechaHora.setHours(parseInt(partesHoraInicial[0]));
    fechaHora.setMinutes(parseInt(partesHoraInicial[1]));

    // Sumar los minutos a la hora inicial
    fechaHora.setMinutes(fechaHora.getMinutes() + minutosASumar);

    // Obtener la nueva hora y minutos
    var horaFinal = fechaHora.getHours() + ':' + (fechaHora.getMinutes() < 10 ? '0' : '') + fechaHora.getMinutes();

    return horaFinal; // Salida: 13:10
}

function obtenerServiciosString(arregloServiciosCita){
    let StringServiciosCita = '';
    arregloServiciosCita.forEach(e=>{
        StringServiciosCita += e.id+','; 
    })
    const StringServiciosCitaSinComa = StringServiciosCita.substring(0,StringServiciosCita.length-1);
    return StringServiciosCitaSinComa;
}

async function cargarVeterinariosHTML(){
    const url = urlRuta+'controllers/veterinarioController.php?opc=obtenerVeterinarios';
    const response = await fetch(url);
    const data = await response.json();
    // console.log(data);
    let contenidoSelect = `<select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 selectVeterinarios"
    name="veterinarioNuevaCitaModal"
    data-style="btn-default"
    data-live-search="true"
    >`;
    data.forEach(e=>{
        contenidoSelect+=`<option value="${e.idveterinario}" data-tokens="ketchup mustard">${e.nombres} - ${e.dni}</option>`;
    })
    contenidoSelect += `</select>`;
    elementoSelect = document.createElement('div');
    elementoSelect.innerHTML = contenidoSelect;
    divContenedorSelectVeterinario.appendChild(elementoSelect);
    $('.selectVeterinarios').selectpicker('render');

}

async function cargarMascotas(){
    const url = urlRuta + "controllers/mascotaController.php?opc=obtenerMascotasYSusDueños";
    const response = await fetch(url);
    const data = await response.json();
    let contenidoSelect = `<select
    id="selectpickerLiveSearch"
    class="selectpicker w-100"
    name="mascotaNuevaCitaModal"
    data-style="btn-default"
    data-live-search="true"
    >`;
    data.forEach(e=>{
        contenidoSelect+=`<option value="${e.idmascota}" data-tokens="ketchup mustard">${e.nombre} - ${e.dni}</option>`;
    })
    contenidoSelect += `</select>`;
    elementoSelect = document.createElement('div');
    elementoSelect.innerHTML = contenidoSelect;
    divContenedorSelectMascota.appendChild(elementoSelect);
    $('#selectpickerLiveSearch').selectpicker('render');
}

function agregarOquitarServicios(e){
    const id = e.target.getAttribute('data-id');
    const nombre = e.target.getAttribute('data-nombre');
    const precio = e.target.getAttribute('data-precio');
    const duracion = e.target.getAttribute('data-duracion');

    if(e.target.checked){
        //creando el objetoServicio
       const objetoServicio = {
        id,
        nombre,
        precio,
        duracion
       }
       //agregando a mi arreglo el objeto creado
       arregloServiciosCita.push(objetoServicio);
    }else{
        arregloServiciosCita = arregloServiciosCita.filter(servicioObjeto=>{return servicioObjeto.id !== id});
    }

    // console.log(arregloServiciosCita);
}


function abrirModalNuevaCita(){
    $('#exLargeModal').modal('show');
}

async function agregarDetalleCita(){
    activarSpinner();
    idcita = (btnAgregarDetalleCita.value);
    const formData = new FormData(agregarDetalleCitaForm);
    formData.append('idcita',idcita);
    console.log([...formData]);
    const url = urlRuta+'controllers/citaController.php?opc=agregarDetalleCita';
    const response = await fetch(url,{
        method:'POST',
        body:formData,
    });
    const data = await response.json();
    desactivarSpinner();
    if(data.status){
        $('#detalleCitaModal').modal('hide');
        alertaSuceso(data.msg);
        tablaCitas.api().ajax.reload();
    }else{
        alertaError(data.msg)
    }
}

function abrirModalAgregarDetallesCita(idcita){
    $('#detalleCitaModal').modal('show');
    $('.btnAgregarDetalleCita').val(idcita);
}

function cargarTablaCitas(){
    
    tablaCitas = $('#tabla-citas').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": urlRuta+"controllers/citaController.php?opc=obtenerCitasRelacionadas",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcita"},
            {"data":"nombre"},
            {"data":"fecha_atencion"},
            {"data":"hora_programada"},
            {"data":"hora_terminacion_esperada"},
            {"data":"estado"},
            {"data":"opciones"},
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
        
    });
    
    
}

function cargarTablaServiciosCitas(){
      
    tablaSercicios = $('#tabla-serviciosCitas').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":async function (a, callback, settings) {
              const url = urlRuta + "controllers/servicioController.php?opc=obtenerServiciosCheck";
              const response = await fetch(url);
              const data = await response.json();
              callback({ data });
                //asignando evento a los checkbox
                checksServicios = document.querySelectorAll('.checkServicio');
                checksServicios.forEach(e=>{
                    e.addEventListener('click',agregarOquitarServicios);
                })
          },
        "columns":[
            {"data":"nombre"},
            {"data":"precio"},
            {"data":"duracion"},
            {"data":"opciones"},
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
        
    });


}