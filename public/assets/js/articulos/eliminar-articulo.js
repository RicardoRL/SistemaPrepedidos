document.addEventListener('DOMContentLoaded', function () {
  const formEliminar = document.getElementById('form-eliminar');

  document.querySelectorAll('.btn-eliminar').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      const id = this.dataset.id;
      const sweetAl= swal.mixin({
                      buttonsStyling: false,
                      customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light',
                        denyButton: 'btn btn-light',
                        input: 'form-control'
                      }
      });

      sweetAl.fire({
        title: '¿Deseas eliminar este artículo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        buttonsStyling: false,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-danger'
        }
      }).then(function(result) {
        if (result.value) {
          sweetAl.fire(
            'Eliminado',
            'El producto ha sido eliminado.',
            'success'
          ).then(() => {
            formEliminar.action = `/admin/articulos/${id}`;
            formEliminar.submit();
          });
        }
      });
    });
  });
});
