const divContenedorEditSelectMascota = document.querySelector('.divContenedorEditSelectMascota');
const divContenedorEditSelectVeterinario = document.querySelector('.divContenedorEditSelectVeterinario');
const btnEditarCitaModal = document.querySelector('.btnEditarCitaModal');
const formEditarCitaModal = document.querySelector('#formEditarCitaModal');
let horaCitaEditActual;
let fechaCitaEditActual;

let tablaEditSercicios;
let arregloEditServicios = [];
let checkServiciosEdit;

btnEditarCitaModal.addEventListener('click',editarCita);

async function editarCita(){
    activarSpinner();
    const fechaProgramada = document.querySelector('#fechaEditarCitaModal').value;
    let horaProgramada = (document.querySelector('#horaEditarCitaModal').value);
    horaProgramada+= ":00";

    if(horaCitaEditActual!=horaProgramada.slice(0,8) || fechaProgramada!=fechaCitaEditActual){
        let cruceHorario = await VerificarCruceDeHorarios(fechaProgramada,horaProgramada);

        if(cruceHorario){
            alertaError('Hora de atención no disponible, debido a cruce de horarios.');
            desactivarSpinner();
            return;
        }
    }

    const tiempoEnMinutos = obtenerTiempoDeMinutosDeServiciosDeCita(arregloEditServicios);
    const horaDeFinalizacionEsperada = obtenerHoraFinalizacionCita(horaProgramada,tiempoEnMinutos);
    // console.log(horaDeFinalizacionEsperada);
    const serviciosDeCitaString = obtenerServiciosString(arregloEditServicios);

    const formData = new FormData(formEditarCitaModal);
    formData.append('idservicios',serviciosDeCitaString);
    formData.append('hora_terminacion_esperada',horaDeFinalizacionEsperada);
    formData.append('idcita',document.querySelector('.btnEditarCitaModal').getAttribute('data-idcita'));
    console.log([...formData]);

    const url = urlRuta+'controllers/citaController.php?opc=editarCita';
    const response = await fetch(url,{
        method:'POST',
        body:formData,
    });
    const data = await response.json();
    desactivarSpinner();
    if(data.status){
        $('#editarModalCita').modal('hide');
        tablaCitas.api().ajax.reload();
        alertaSuceso(data.msg);
        setTimeout(() => {
            window.location.href = urlRuta+'views/citas.php';
        }, 2000);
        return;
    }else{
        alertaError(data.msg);
    }


}

async function abrirModalEditarCita(idcita){
    arregloEditServicios = [];
    activarSpinner();
    const {fecha_atencion,hora_programada,idveterinario,servicios,idmascota} = await obtenerDatosConIdCita(idcita);
    horaCitaEditActual = hora_programada;
    fechaCitaEditActual = fecha_atencion;
    cargarTablaEditServiciosCitas(servicios);
    cargarEditMascotas(idmascota);
    cargarEditVeterinarios(idveterinario);
    $('#horaEditarCitaModal').val(hora_programada);
    $('#fechaEditarCitaModal').val(fecha_atencion);
    document.querySelector('.btnEditarCitaModal').setAttribute('data-idcita',idcita)
    $('#editarModalCita').modal('show');

}

async function obtenerDatosConIdCita(idcita){
    const url = urlRuta+'controllers/citaController.php?opc=obtenerDatosConIdCita';
    const formData = new FormData();
    formData.append('idcita',idcita);
    const response = await fetch(url,{
        method:'POST',
        body:formData,
    })
    const data = await response.json();
    // console.log(data);
    return data;
}

async function cargarEditVeterinarios(idVeterinario){
    const url = urlRuta+'controllers/veterinarioController.php?opc=obtenerVeterinarios';
    const response = await fetch(url);
    const data = await response.json();
    // console.log(data);
    let contenidoSelect = `<select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 selectEditVeterinarios"
    name="veterinarioNuevaCitaModal"
    data-style="btn-default"
    data-live-search="true"
    >`;
    data.forEach(e=>{
        contenidoSelect+=`<option value="${e.idveterinario}" ${e.idveterinario == idVeterinario ? 'selected' : ''} data-tokens="ketchup mustard">${e.nombres} - ${e.dni}</option>`;
    })
    contenidoSelect += `</select>`;
    elementoSelect = document.createElement('div');
    elementoSelect.innerHTML = contenidoSelect;
    divContenedorEditSelectVeterinario.innerHTML = '<label for="nameExLarge" class="form-label">Veterinario</label>';
    divContenedorEditSelectVeterinario.appendChild(elementoSelect);
    $('.selectEditVeterinarios').selectpicker('render');

    desactivarSpinner();

}

function serviciosAagregar(e){

    const id = e.target.getAttribute('data-id');
    const nombre = e.target.getAttribute('data-nombre');
    const precio = e.target.getAttribute('data-precio');
    const duracion = e.target.getAttribute('data-duracion');

    if(e.target.checked){
        //creando el objetoServicio
       const objeto = {
        id,
        nombre,
        precio,
        duracion
       }
       //agregando a mi arreglo el objeto creado
    //    arregloEditServicios = [];
       arregloEditServicios.push(objeto);
    }else{
        arregloEditServicios = arregloEditServicios.filter(servicioObjeto=>{return servicioObjeto.id !== id});
    }

    console.log(arregloEditServicios);
}

function cargarCheckServiciosSegunId(checkServiciosEdit,servicios){

    console.log(servicios);

    const arregloPorComa = servicios.split(',');
    
    console.log(arregloPorComa); // Muestra el arreglo en la consola

    // checkServiciosEdit.forEach(e=>{
    //     if(servicios==e.getAttribute('data-id')){
    //         console.log('agregando');
    //         e.checked=true;
    //         const objetoServicio = {
    //             id:e.getAttribute('data-id'),
    //             nombre:e.getAttribute('data-nombre'),
    //             precio:e.getAttribute('data-precio'),
    //             duracion:e.getAttribute('data-duracion'),
    //         }
    //         arregloEditServicios.push(objetoServicio);

    //     }
    // })

    checkServiciosEdit.forEach(checkbox => {
        const checkboxId = checkbox.getAttribute('data-id');
      
        if (arregloPorComa.includes(checkboxId)) {
          checkbox.checked = true;
          console.log('Checkbox agregado:', checkboxId);
      
          const objetoServicio = {
            id: checkbox.getAttribute('data-id'),
            nombre: checkbox.getAttribute('data-nombre'),
            precio: checkbox.getAttribute('data-precio'),
            duracion: checkbox.getAttribute('data-duracion'),
          };
          arregloEditServicios.push(objetoServicio);
        }
      });

    console.log(arregloEditServicios);

}


async function cargarEditMascotas(idMascota){
    const url = urlRuta + "controllers/mascotaController.php?opc=obtenerMascotasYSusDueños";
    const response = await fetch(url);
    const data = await response.json();
    let contenidoSelect = `<select
    id="selectpickerLiveSearch"
    class="selectpicker w-100 selectEditMascotaCita"
    name="mascotaNuevaCitaModal"
    data-style="btn-default"
    data-live-search="true"
    >`;
    data.forEach(e=>{
        contenidoSelect+=`<option value="${e.idmascota}" ${e.idmascota == idMascota ? 'selected' : ''} data-tokens="ketchup mustard">${e.nombre} - ${e.dni}</option>`;
    })
    contenidoSelect += `</select>`;
    elementoSelect = document.createElement('div');
    elementoSelect.innerHTML = contenidoSelect;
    divContenedorEditSelectMascota.innerHTML = '<label for="nameExLarge" class="form-label">Mascota (nombre mascota - DNI dueño)</label>';
    divContenedorEditSelectMascota.appendChild(elementoSelect);
    $('.selectEditMascotaCita').selectpicker('render');
}


function cargarTablaEditServiciosCitas(servicios){
      
    tablaEditSercicios = $('#tabla-editarServiciosCitas').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":async function (a, callback, settings) {
              const url = urlRuta + "controllers/servicioController.php?opc=obtenerServiciosEditarCheck";
              const response = await fetch(url);
              const data = await response.json();
              callback({ data });
                //asignando evento a los checkbox
                checkServiciosEdit = document.querySelectorAll('.checkEditServicio');
                cargarCheckServiciosSegunId(checkServiciosEdit,servicios);
                checkServiciosEdit.forEach(e=>{
                    e.addEventListener('click',serviciosAagregar);
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