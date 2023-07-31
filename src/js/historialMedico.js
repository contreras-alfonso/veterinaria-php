const contenedor_spinner = document.querySelector('.contenedor_spinner');
const contenedor_tabla_citas = document.querySelector('.contenedor_tabla_citas');

document.addEventListener('DOMContentLoaded',()=>{
    // contenedor_spinner.style.display = 'flex';
    obtenerQueryString();
})

async function obtenerQueryString(){
contenedor_spinner.style.display = 'flex';
const params = new URLSearchParams(window.location.search);
const idm = params.get("idm");
// console.log(idm);
if(!idm){
    window.location.href = urlRuta+'views/mascotas.php';
    return;
}
const {nombres,dni,direccion,telefono,correo,nombre,raza,nacimiento,especie,peso} = await buscarDatosDeMascota(idm);
const dataCitas = await buscarCitasDeMascota(idm);
if(dataCitas.length==0){
    window.location.href = urlRuta+'views/mascotas.php';
    return;
}
mostrarDatosCitasHTML(dataCitas);
const datosUltimaVacunacion = await obtenerUltimaVacunacion(idm);
contenedor_spinner.style.display = 'none';
document.querySelector('.textfecha').textContent = '15/07/2023';
document.querySelector('.textnombrescliente').textContent = nombres;
document.querySelector('.textnombremascota').textContent = nombre;
document.querySelector('.textsexomascota').textContent = 'M';
document.querySelector('.textdni').textContent = dni;
document.querySelector('.textraza').textContent = raza;
document.querySelector('.textespecie').textContent = especie;
document.querySelector('.textdireccion').textContent = direccion;
document.querySelector('.textfechanacimientomascota').textContent = nacimiento;
document.querySelector('.textcolormascota').textContent = '-';
document.querySelector('.texttelefono').textContent = telefono;
document.querySelector('.textpesomascota').textContent = peso;
document.querySelector('.textcorreo').textContent = correo;
document.querySelector('.textultimavacunacion').textContent = datosUltimaVacunacion.fecha_aplicada.slice(0,10)+' | '+datosUltimaVacunacion.numero_dosis+"° "+datosUltimaVacunacion.nombre;

}

async function obtenerUltimaVacunacion(idm){
    const url = urlRuta+'controllers/vacunaController.php?opc=obtenerUltimaVacunacion';
    const formData = new FormData();
    formData.append('idmascota',idm)
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    return data;
}

function mostrarDatosCitasHTML(data){
    let contenidoTablaCitas = '';
    data.forEach(e=>{
        const {fecha_atencion,medicinas_aplicadas,antecedentes,tratamiento,motivo} = e;
        contenidoTablaCitas+=`<table class="tablaCitas">
        <tr class="bg_purple">
            <td  class="text_center color_purple">Fecha programada</td>
        </tr>
        <tr>
            <td  class="text_center">${fecha_atencion}</td>
        </tr>
        <tr class="bg_purple">
            <td  class="text_center color_purple">Medicinas Aplicadas</td>
        </tr>
        <tr>
            <td>${medicinas_aplicadas}</td>
        </tr>
        <tr class="bg_purple">
            <td  class="text_center color_purple">Antecedentes</td>
        </tr>
        <tr>
            <td>${antecedentes}</td>
        </tr>
        <tr class="bg_purple">
            <td  class="text_center color_purple">Tratamiento</td>
        </tr>
        <tr>
            <td>${tratamiento}</td>
        </tr>

        </tr>
        <tr class="bg_purple">
            <td  class="text_center color_purple">Motivo</td>
        </tr>
        <tr>
            <td>${motivo}</td>
        </tr>
    </table>`
    })

    contenedor_tabla_citas.innerHTML = contenidoTablaCitas;
    
}

async function buscarCitasDeMascota(idm){
    const url = urlRuta+'controllers/citaController.php?opc=obtenerCitasConIdMascota';
    const formData = new FormData();
    formData.append('idmascota',idm)
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    // console.log(data);
    return data;
}

async function buscarDatosDeMascota(idm){
    const url = urlRuta+'controllers/mascotaController.php?opc=obtenerMascotaYSusDueño';
    const formData = new FormData();
    formData.append('idmascota',idm)
    const response = await fetch(url,{
        method: 'POST',
        body: formData,
    })
    const data = await response.json();
    return data;
}