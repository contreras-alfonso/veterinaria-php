/**
 * App Calendar Events
 */

"use strict";

let date = new Date();
let nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
let nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
let prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

async function pruebaCita() {
  const urlFetch =
    urlRuta + "controllers/citaController.php?opc=obtenerCitas";

  const response2 = await fetch(urlFetch);
  const data2 = await response2.json();
  return generarEventos(data2);
}

function generarEventos(citas) {
  let events = [];

  let estadoNuevo = "Business";
  citas.forEach((cita) => {
    const {
      idcita,
      idmascota,
      motivo,
      fecha_atencion,
      hora_programada,
      hora_terminacion_esperada,
      estado,
    } = cita;
    // console.log(Number(fecha_atencion.substring(8,10)));
    // console.log(Number(fecha_atencion.substring(5,7)));

    switch (estado) {
      case "3":
        estadoNuevo = "Holiday";
        break;
      case "2":
        estadoNuevo = "Business";
        break;
      case "1":
        estadoNuevo = "Holiday";
        break;
    }

    let objetoEvento = {
      id: idcita,
      url: "",
      title: `${hora_programada.substring(
        0,
        5
      )} - ${hora_terminacion_esperada.substring(0, 5)}`,
      allDay: true,
      start: new Date(
        date.getFullYear(),
        Number(fecha_atencion.substring(5, 7)) - 1,
        Number(fecha_atencion.substring(8, 10))
      ),
      end: new Date(
        date.getFullYear(),
        Number(fecha_atencion.substring(5, 7)) - 1,
        Number(fecha_atencion.substring(8, 10))
      ),
      extendedProps: {
        calendar: estadoNuevo,
      },
    };
    events.push(objetoEvento);
  });

  return;
}

// pruebaCita();
