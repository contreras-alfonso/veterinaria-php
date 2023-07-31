const btnLoginUser = document.querySelector('#btnLoginUser');
const formUsuarioLogin = document.querySelector('#formUsuarioLogin');
const contenedorSpinner = document.querySelector('.contenedorSpinner');

window.addEventListener('DOMContentLoaded',()=>{
    btnLoginUser.addEventListener('click',buscarUsuario);
})

async function buscarUsuario(e){
    e.preventDefault();
    contenedorSpinner.style.display = 'flex';
    const url = urlRuta+'controllers/usuarioController.php?opc=buscarUsuario';
    const formData = new FormData(formUsuarioLogin);
    // console.log([...formData]);
    const response = await fetch(url,{
        method:'POST',
        body: formData,
    })
    const data = await response.json();
    // console.log(data);
    contenedorSpinner.style.display = 'none';
    if(data.status){
        alertaSuceso(data.msg);
        setTimeout(() => {
            window.location.href =  urlRuta+'views/clientes.php';
        }, 2000);
        return;
    }
    alertaError(data.msg);
}