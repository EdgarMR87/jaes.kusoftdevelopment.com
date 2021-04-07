function registroOK(url){
    swal({
        title: "Registro Exitoso",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = url;
    });
}

function actualizarOK(url){
    swal({
        title: "Actualizacion Correcta",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000
        }).then(() =>{
            window.location.href = url;
    });
}

function errorRegistro(error, link){
    swal({
        title: "Error en el registro",
        text: error,
        type: "warning"
    }).then(() => {
        window.location.href = link;
    });
}


function borrarOk(link){
    swal({
        title: "Se elimino el registro Exitosamente!",
        text: "Redireccionando en 2 segundos...",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = link;
    });
}