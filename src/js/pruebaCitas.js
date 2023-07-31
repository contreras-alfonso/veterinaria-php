async function pruebaCita(){
const urlFetch = urlRuta+'controllers/citaController.php?opc=obtenerCitas';
const response2 = await fetch(urlFetch);
const data2 = await response2.json();
console.log(data2);
generarEventos(data2);
}

function generarEventos(citas){
    let events = [];
    citas.forEach(cita => {
        const {idcita,idmascota,motivo,fecha_atencion,hora_programada,hora_terminacion_esperada} = cita;
        let objetoEvento = {
            id: idcita,
            url: '',
            title: `${hora_programada} - ${hora_terminacion_esperada}`,
            start: new Date(date.getFullYear(), date.getMonth() + 1, 11),
            end: new Date(date.getFullYear(), date.getMonth() + 1, 11),
            allDay: false,
            extendedProps: {
              calendar: 'Business',
            }
        }
        events.push(objetoEvento);
    });
    console.log(events);
}

pruebaCita();