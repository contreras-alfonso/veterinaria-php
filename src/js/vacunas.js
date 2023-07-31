let vacunasFaltantes = document.querySelectorAll('.vacunaFaltante');
const selectVacunas = document.querySelector('.selectVacunas');
const contenedorSelectVacunas = document.querySelector('#contenedorSelectVacunas');
const btnBuscarMascotaVacunacion = document.querySelector('#btnBuscarMascotaVacunacion');
const InputDniDueño = document.querySelector('.InputDniDueño');
const formVacunacion = document.querySelector('#formVacunacion');
const contenedorSpinner = document.querySelector('.contenedorSpinner');
const contendorMascotasDeCliente = document.querySelector('.contendorMascotasDeCliente');
const contenedorVacunasYnombreDeMascota = document.querySelector('.contenedorVacunasYnombreDeMascota');

window.addEventListener('DOMContentLoaded',()=>{
    activarSpinner();
    cargarSelectVacunas();
    btnBuscarMascotaVacunacion.addEventListener('click',buscarMascotaVacunacion);
})

function asignarEventovacunasFaltantes(vacunasFaltantes){
    vacunasFaltantes.forEach(e=>{
        e.addEventListener('click', preguntarCambioDeEstadoVacuna);
    })
}


async function buscarMascotaVacunacion(){
    contenedorVacunasYnombreDeMascota.innerHTML = '';
    if(!InputDniDueño.value){
        alertaError('Debe ingresar el DNI del dueño.');
        return;
    }
    const existeCliente = await buscarDuenoConDni(InputDniDueño.value);
    if(existeCliente==false){
        alertaError('No existe un cliente con el DNI ingresado.');
        desactivarSpinner();
        return;
    }

    const url = urlRuta + 'controllers/vacunaController.php?opc=buscarMascotaOmascotas';
    let formData = new FormData();
    formData.append('idVacuna',document.querySelector('.selectVacunas').children[0].value);
    formData.append('idDueño',existeCliente.idcliente);
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    });
    const data = await response.json();
    desactivarSpinner();
    if(!data.status){
        alertaError(data.msg);
        return;
    }
    // console.log(data.arrData);

    if(data.arrData.length>=2){
        abrirModalMascotasDelDueño(data.arrData);
    }else{
        buscarVacunasMascota(data.arrData[0].idmascota,data.arrData[0].nombre);
    }

}

async function buscarDuenoConDni(dni){
    activarSpinner();
    let existeCliente;
    const url = urlRuta + 'controllers/clienteController.php?opc=buscarDuenoPorDNI';
    let formData = new FormData();
    formData.append('dniDueño',dni);
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    });
    const data = await response.json();
    if(data.status){
        existeCliente = data.arrData;
    }else{
        existeCliente = false;
    }

    return existeCliente;
}

function buscarVacunasMascota(idmascota,nombre){
    $('#addNewCCModal').modal('hide');
    const datosVacunacionMascota = buscarDatosDeVacunacionDeMascotaConSuId(idmascota,nombre);

}

async function buscarDatosDeVacunacionDeMascotaConSuId(idMascota,nombre){
    activarSpinner();
    const url = urlRuta+'controllers/vacunaController.php?opc=buscarDatosVacunacionConID';
    const formData = new FormData();
    formData.append('idmascota',idMascota);
    formData.append('idservicio',document.querySelector('.selectVacunas').children[0].value);

    console.log([...formData]);

    const response = await fetch(url,{
      method: 'POST',
      body: formData,
    })
    const data = await response.json();
    console.log(data);
    desactivarSpinner();
    if(data.length==0){
      mostrarResultadosDeVacunacionDeLaMascotaVaciaHTML(document.querySelector('.selectVacunas').children[0].value,idMascota,nombre);
    }else{
      mostrarResultadosDeVacunacionDeLaMascotaHTML(data);
    }


}
async function mostrarResultadosDeVacunacionDeLaMascotaVaciaHTML(idservicio,idmascota,nombre){

  let contenido_resultado_vacunas = `<h4 class="my-5">Dosis de la mascota : ${nombre}</h4><div class="row">`;
  let numeroDosis = await obtenerCantidadDeDosis(idservicio);
  console.log(numeroDosis);
  for (let i = 1; i < Number(numeroDosis)+1; i++) {

       contenido_resultado_vacunas += `<div class="col-lg-4 col-6 mb-4" >
        <div class="card vacunaFaltante contenedorVacunaFaltante">
              <div class="card-body text-center contenedorVacunaFaltante" data-idmascota="${idmascota}" data-idservicio="${idservicio}" data-numerodosis="${i}">
                <div class="badge rounded-pill p-2 bg-label-danger mb-2">
                <i class="fa-solid fa-x"></i>
                </div>
                <h5 class="card-title mb-2 text-danger">${i}° Dosis faltante</h5>
                <small class="fw-bold">Fecha de vacunación:</small><br><span>--/--/----</span><br>
                <small class="fw-bold">Proxima visita:</small><br><span>--/--/----</span>
              </div>
        </div>
        </div>`

  }

  contenido_resultado_vacunas += `</div>`;

  contenedorVacunasYnombreDeMascota.innerHTML = contenido_resultado_vacunas;

  vacunasFaltantes = document.querySelectorAll('.vacunaFaltante');
  asignarEventovacunasFaltantes(vacunasFaltantes);
}

async function obtenerCantidadDeDosis(idservicio){
  activarSpinner();
  const url = urlRuta+'controllers/vacunaController.php?opc=obtenerVacunaPorID';
  const formData = new FormData();
  formData.append('idservicio',idservicio);
  const response = await fetch(url,{
    method: 'POST',
    body: formData,
  })
  const data = await response.json();
  desactivarSpinner();
  return data.cantidad_dosis;
}

function mostrarResultadosDeVacunacionDeLaMascotaHTML(data){
    
    console.log(data);


    let contenido_resultado_vacunas = `<h4 class="my-5">Dosis de la mascota : ${data[0].nombre_mascota}</h4><div class="row">`;


        data.forEach(e=>{
       
          const {cantidad_dosis,dias_espera,fecha_aplicada,idmascota,idservicio,nombre_mascota,nombre_vacuna,numero_dosis} = e;
          contenido_resultado_vacunas+= `<div class="col-lg-4 col-6 mb-4">

          <div class="card">
            <div class="card-body text-center">
              <div class="badge rounded-pill p-2 bg-label-success mb-2">
              <i class="fa-solid fa-check"></i>
              </div>
              <h5 class="card-title mb-2 text-success">${numero_dosis}° Dosis aplicada</h5>
              <small class="fw-bold">Fecha de vacunación:</small><br><span>${fecha_aplicada}</span><br>
              <small class="fw-bold">Proxima visita:</small><br><span>dentro de ${dias_espera} dias</span>
            </div>
          </div>
  
      </div>`

        })
        
                const ultimoElemento = data[data.length - 1];
        console.log(ultimoElemento.numero_dosis);

        for (let i = Number(ultimoElemento.numero_dosis)+1; i < Number(data[0].cantidad_dosis)+1; i++) {

        contenido_resultado_vacunas += `<div class="col-lg-4 col-6 mb-4" >
        <div class="card vacunaFaltante contenedorVacunaFaltante">
              <div class="card-body text-center contenedorVacunaFaltante" data-idmascota="${data[0].idmascota}" data-idservicio="${data[0].idservicio}" data-numerodosis="${i}">
                <div class="badge rounded-pill p-2 bg-label-danger mb-2">
                <i class="fa-solid fa-x"></i>
                </div>
                <h5 class="card-title mb-2 text-danger">${i}° Dosis faltante</h5>
                <small class="fw-bold">Fecha de vacunación:</small><br><span>--/--/----</span><br>
                <small class="fw-bold">Proxima visita:</small><br><span>--/--/----</span>
              </div>
        </div>
        </div>`

        }



    contenido_resultado_vacunas += `</div>`;

    contenedorVacunasYnombreDeMascota.innerHTML = contenido_resultado_vacunas;

    vacunasFaltantes = document.querySelectorAll('.vacunaFaltante');
    asignarEventovacunasFaltantes(vacunasFaltantes);
}

function abrirModalMascotasDelDueño(data){
    let contenidoMascotas = ''
    data.forEach(e=>{
        contenidoMascotas+= `<div class="col-md mb-md-0 mb-2">
        <div class="form-check custom-option custom-option-icon data-idmascota="${e.idmascota}" onclick="buscarVacunasMascota(${e.idmascota},'${e.nombre}')" contenedorNombreMascotaCliente">
          <label class="form-check-label custom-option-content" for="customCheckboxSvg1">
            <span class="custom-option-body">
            <i class="fa-solid fa-paw"></i>
              <span class="custom-option-title">${e.nombre}</span>
            </span>
          </label>
        </div>
      </div>`;
    })
    contendorMascotasDeCliente.innerHTML = contenidoMascotas;
    $('#addNewCCModal').modal('show');
}

async function cargarSelectVacunas(){

    const url = urlRuta + 'controllers/vacunaController.php?opc=buscarVacunas';
    const response = await fetch(url);
    const data = await response.json();

    // console.log(data);
    
    
    let contenidoSelect = `<select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 selectVacunas"
    data-style="btn-default"
    data-live-search="true"
    name="idVacuna"
  >
  `;
    data.forEach(e=>{
        const {idservicio,nombre} = e;
        contenidoSelect += `<option value="${idservicio}">${nombre}</option>`;
    })

    contenidoSelect += `</select>`;
    contenedorSelectVacunas.innerHTML = contenidoSelect;
    $('.selectVacunas').selectpicker('render');
    desactivarSpinner();
}

function preguntarCambioDeEstadoVacuna(e){
    if(e.target.classList.contains('contenedorVacunaFaltante')){
      const idmascota = e.target.getAttribute('data-idmascota');
      const idservicio = e.target.getAttribute('data-idservicio');
      const numerodosis = e.target.getAttribute('data-numerodosis');
      Swal.fire({
        title: `${numerodosis}° dosis`,
        text: "¿Está seguro de cambiar el estado de la dosis?",
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
            // Swal.fire({
            //     title: 'Genial!',
            //     text: `qweqew`,
            //     icon: 'success',
            //     customClass: {
            //       confirmButton: 'btn btn-primary'
            //     },
            //     buttonsStyling: false,
            //     allowOutsideClick: false,
        
            //   });
              //cambiarDiseñoCardVacuna(idmascota,idservicio,numerodosis);
              actualizarEstadoDeVacuna(idmascota,idservicio,numerodosis);
        }
      })
    }
    // alertaPregunta('4','Estado de la dosis cambiada correctamente.')
}

async function actualizarEstadoDeVacuna(idmascota,idservicio,numerodosis){
  activarSpinner();
  const url = urlRuta+'controllers/vacunaController.php?opc=actualizarEstadoDeVacuna';
  const formData = new FormData();
  formData.append('idmascota',idmascota);
  formData.append('idservicio',idservicio);
  formData.append('numerodosis',numerodosis);
  const response = await fetch(url,{
    method: 'POST',
    body: formData,
  })
  const data = await response.json();
  desactivarSpinner();
  console.log(data);
  if(data.status){
    alertaSuceso(data.msg);
    cambiarDiseñoCardVacuna(idmascota,idservicio,numerodosis);
  }else{
    alertaError(data.msg);
  }
}

function cambiarDiseñoCardVacuna(idmascota,idservicio,numerodosis){
  const elemento = document.querySelector(`.contenedorVacunaFaltante[data-numerodosis='${numerodosis}']`);
  elemento.classList.remove('contenedorVacunaFaltante');
  console.log(elemento)
  elemento.innerHTML = `<div class="badge rounded-pill p-2 bg-label-success mb-2">
  <i class="fa-solid fa-check"></i>
  </div>
  <h5 class="card-title mb-2 text-success">${numerodosis}° Dosis aplicada</h5>
  <small class="fw-bold">Fecha de vacunación:</small><br><span>${obtenerFecha()}</span><br>
  <small class="fw-bold">Proxima visita:</small><br><span>dentro de 30 dias</span>`;
}

function obtenerFecha(){
  // Obtener la fecha actual
const fechaActual = new Date();

// Obtener el día, el mes y el año
const dia = fechaActual.getDate();
const mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0, por lo que se suma 1
const anio = fechaActual.getFullYear();

// Formatear la fecha
const fechaFormateada = `${dia.toString().padStart(2, '0')}/${mes.toString().padStart(2, '0')}/${anio}`;
return fechaFormateada;
}
