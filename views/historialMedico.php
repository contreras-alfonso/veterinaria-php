<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Clínica | Orejotas y Colitas</title>
    <link rel="stylesheet" href="../src/css/historialMedico.css">
    <link rel="stylesheet" href="../src/css/spinner_historialmedico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

</head>
<body>

    <div class="contenedor_spinner">
        <div class="spinner"></div>
    </div>

    <div class="contenedor_padre">
        <div class="cabecera">
            <div class="contenedorLogo"><i class="fa-solid fa-paw icono_logo"></i></div>
            <div class="contenedor_texto_cabecera">
                <p class="titulo_historia">Historia Clínica</p>
                <p class="titulo_historia">Clínica veterinaria Orejotas y Colitas</p>
                <p class="titulo_historia text_small"> Surco, Calle Monte Abeto 915</p>
            </div>

        </div>

        <div class="contenedor_tablas">
            <table class="tabla_info">
                <tr>
                    <td colspan="3">Fecha: <span class="textfecha"></span></td>
                </tr>

                <tr class="bg_purple">
                    <td  class="text_center color_purple">Datos del propietario</td>
                    <td  class="text_center color_purple" colspan="2">Datos del paciente</td>
                </tr>

                <tr>
                    <td>Nombres: <span class="textnombrescliente"></span></td>
                    <td>Nombre: <span class="textnombremascota"></span></td>
                    <td>Sexo: <span class="textsexomascota"></span></td>
                </tr>

                
                <tr>
                    <td>DNI: <span class="textdni"></span></td>
                    <td>Raza: <span class="textraza"></span></td>
                    <td>Especie: <span class="textespecie"></span></td>
                </tr>

                <tr>
                    <td>Dirección: <span class="textdireccion"></span></td>
                    <td>Fecha de nacimiento: <span class="textfechanacimientomascota"></span></td>
                    <td>Color: <span class="textcolormascota"></span></td>
                </tr>

                <tr>
                    <td>Teléfono: <span class="texttelefono"></span></td>
                    <td></td>
                    <td>Peso: <span class="textpesomascota"></span></td>
                </tr>

                <tr>
                    <td colspan="3">Correo Electrónico: <span class="textcorreo"></span></td>
                </tr>

                <tr class="bg_purple">
                      <td  class="text_center color_purple" colspan="3">Anamnesicos</td>
                </tr>

                <!-- <tr>
                    <td colspan="3">Ultima desparacitación (Fecha) : <span class="textultimadesparacitacion"></span></td>
                </tr> -->

                <tr>
                    <td colspan="3">Ultima Vacunación (Fecha/Dosis) : <span class="textultimavacunacion"></span></td>
                </tr>


            </table>
            <div class="contenedor_tabla_citas">
            <table class="tablaCitas">
                <tr class="bg_purple">
                    <td  class="text_center color_purple">Fecha plazmada</td>
                </tr>
                <tr>
                    <td  class="text_center"></td>
                </tr>
                <tr class="bg_purple">
                    <td  class="text_center color_purple">Medicinas Aplicadas</td>
                </tr>
                <tr>
                    <td>--</td>
                </tr>
                <tr class="bg_purple">
                    <td  class="text_center color_purple">Antecedentes</td>
                </tr>
                <tr>
                    <td>--</td>
                </tr>
                <tr class="bg_purple">
                    <td  class="text_center color_purple">Tratamiento</td>
                </tr>
                <tr>
                    <td>--</td>
                </tr>
            </table>
            </div>

        </div>
    </div>
</body>
<script src="../src/js/historialMedico.js"></script>
<script src="../src/js/general.js"></script>
</html>