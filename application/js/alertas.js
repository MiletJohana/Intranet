function alertSuccess(text, url, opcion) {

    Swal.fire({

        title: text,

        icon: "success",

        allowOutsideClick: false,

        allowEscapeKey: false,

        allowEnterKey: false,

    }).then((result) => {

        if (result.isConfirmed && opcion == 2) {

            window.location.href = url;

        } 

        if (result.isConfirmed && opcion == 3) {
          $('#'+url).DataTable().ajax.reload();
        } 

        if (result.isConfirmed && opcion == 4) {
          window.location.reload();
        } 

    });

}



function alertWarning(text){

    Swal.fire({

        title: text,

        icon: "warning"

    });

}



function alertWarningSize(){

  Swal.fire({

      title: 'Lo siento, el archivo que estás intentando subir es demasiado grande. Intenta reducir su tamaño a menos de 4 MB para poder cargarlo correctamente',

      icon: "warning"

  });

}



function alertError(text) {

    Swal.fire({

        title: text,

        icon: "error"

    });

}



function alertInfo(text) {

  Swal.fire({

      title: text,

      icon: "info"

  });

}



function alertRevisarPerm(opcion, mensaje, funcion) {

    if(opcion==1){

        Swal.fire({

            title: mensaje,

            icon: "success",

            allowOutsideClick: false,

            allowEscapeKey: false,

            allowEnterKey: false,

            showDenyButton: true,

            confirmButtonText: "Ok",

            denyButtonText: `Ver`

          }).then((result) => {

            if (result.isDenied) {

                alert("a");

                mostrarSeg(0, 'Seguimiento', '../permisos/seguimiento.php' , 2215);

            }

          });

    } else {

        Swal.fire({

            title: mensaje,

            icon: "warning",

            allowOutsideClick: false,

            allowEscapeKey: false,

            allowEnterKey: false,

            showDenyButton: true,

            confirmButtonText: "Ok",

            denyButtonText: `Soporte`

          }).then((result) => {

            if (result.isDenied) {

                window.open(funcion, '_blank');

            }

          });

    }

}



function alertaSuccessCorres(id_seg, id_estSeg, text) {

    Swal.fire({

        title: text,

        icon: "success",

        allowOutsideClick: false,

        allowEscapeKey: false,

        allowEnterKey: false,

        showDenyButton: true,

        confirmButtonText: "Ver",

        denyButtonText: `Cerrar`

      }).then((result) => {

        if (result.isConfirmed) {

            mostrarCorr(id_seg, id_estSeg);

            $('#largeModal').modal('show');

        }

      });

}



function alertSuccessCotizador(mensaje, url) {

        Swal.fire({

            title: mensaje,

            icon: "success",

            allowOutsideClick: false,

            allowEscapeKey: false,

            allowEnterKey: false,

            showDenyButton: true,

            confirmButtonText: "Ok",

            denyButtonText: `Ver Cliente`

          }).then((result) => {

            if (result.isDenied) {

                window.location.href = url;

            }

          });

}



function toastSuccess(text) {

    const Toast = Swal.mixin({

        toast: true,

        position: "top-end",

        showConfirmButton: false,

        timer: 5000,

        timerProgressBar: true,

        iconColor: 'white',

        customClass: {

          popup: 'colored-toast-success',

        },

        didOpen: (toast) => {

          toast.onmouseenter = Swal.stopTimer;

          toast.onmouseleave = Swal.resumeTimer;

        }

      });

      Toast.fire({

        icon: "success",

        title: text

      });

}



function toastError(text) {

    const Toast = Swal.mixin({

        toast: true,

        position: "top-end",

        showConfirmButton: false,

        timer: 5000,

        timerProgressBar: true,

        iconColor: 'white',

        customClass: {

          popup: 'colored-toast-error',

        },

        didOpen: (toast) => {

          toast.onmouseenter = Swal.stopTimer;

          toast.onmouseleave = Swal.resumeTimer;

        }

      });

      Toast.fire({

        icon: "error",

        title: text

      });

}



function toastWarning(text) {

  const Toast = Swal.mixin({

      toast: true,

      position: "top-end",

      showConfirmButton: false,

      timer: 5000,

      timerProgressBar: true,

      iconColor: 'white',

      customClass: {

        popup: 'colored-toast-warning',

      },

      didOpen: (toast) => {

        toast.onmouseenter = Swal.stopTimer;

        toast.onmouseleave = Swal.resumeTimer;

      }

    });

    Toast.fire({

      icon: "warning",

      title: text

    });

}

function toastSuccess_reload(text, table) {

  const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast-success',
      },

      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
        $('#'+table).DataTable().ajax.reload();
      }

    });

    Toast.fire({

      icon: "success",

      title: text

    });

}



function validarSize(id) {

  let archivo =  document.getElementById(id).files[0].size;



  if (archivo <= 4194304){

    opcion = 1;

  } else {

    opcion = 2;

  }

  

  return opcion;

}



function cargar(opcion){

  const loader = document.getElementById('alert-loader');

  if(opcion==1){

    loader.classList.add('modal-backdrop');

    loader.classList.add('fade');

    loader.classList.add('show');

    loader.innerHTML='<div class="d-flex flex-column align-items-center justify-content-center" style="height:100vh;"><span class="loader"></span><p class="text-white mt-2">Cargando...</p></div>';

  } else{

    loader.classList.remove('modal-backdrop');

    loader.classList.remove('fade');

    loader.classList.remove('show');

    loader.innerHTML='';



  }

}

function alertaMantenimiento() {
  Swal.fire({
    title: "Aplicativo en Mantenimiento",
    text: "Estamos trabajando para mejorar su experiencia. Volveremos en breve. Si surge alguna duda, contacta con el equipo de desarrollo.",
    imageUrl: "https://www.liderdelemprendimiento.com/wp-content/uploads/2021/04/Mantenimiento.png",
    imageWidth: 280,
    imageHeight: 200,
    imageAlt: "Imagen Mantenimiento"
  });
}