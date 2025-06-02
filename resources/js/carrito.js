// Estructura básica del carrito
let carrito = [];

// Función para agregar al carrito
function agregarAlCarrito(producto) {
  const existe = carrito.find(p => p.id === producto.id);
  if (existe) {
    if (existe.cantidad + 1 <= producto.stock) {
      existe.cantidad++;
    }
  } else {
    producto.cantidad = 1;
    carrito.push(producto);
  }

  actualizarCarritoModal();
}

// Función para actualizar el contenido del carrito en el modal
function actualizarCarritoModal() {
  const tbody = document.getElementById('lista-carrito');
  tbody.innerHTML = '';

  carrito.forEach(producto => {
    const subtotal = producto.cantidad * producto.precio_pesos;

    const fila = document.createElement('tr');
    fila.id = `fila-${producto.id}`;
    fila.innerHTML = `
      <td colspan="2">${producto.nombre}</td>
      <td>
        <input type="number"
               value="${producto.cantidad}"
               min="1"
               max="${producto.stock}"
               class="form-control form-control-sm cantidad-input">
      </td>
      <td>$${producto.precio_pesos.toFixed(2)}</td>
      <td>$${producto.precio_dolares.toFixed(2)}</td>
      <td class="subtotal">$${subtotal.toFixed(2)}</td>
      <td>
        <button class="btn btn-sm btn-danger btn-eliminar" data-id="${producto.id}">
          <i class="ph-trash"></i>
        </button>
      </td>
    `;

    tbody.appendChild(fila);

    fila.querySelector('.btn-eliminar').addEventListener('click', () => {
      eliminarDelCarrito(producto.id);
    });

    const inputCantidad = fila.querySelector('.cantidad-input');
    inputCantidad.addEventListener('input', () => {
      cambiarCantidad(producto.id, inputCantidad.value);
    });
  });

  actualizarTotales();
}

function cambiarCantidad(id, nuevaCantidad) {
  const producto = carrito.find(p => p.id === id);
  if (!producto) return;

  const cantidad = Math.max(1, Math.min(producto.stock, parseInt(nuevaCantidad) || 1));
  producto.cantidad = cantidad;

  // Actualizar el subtotal de ese producto
  const fila = document.getElementById(`fila-${id}`);
  if (fila) {
    const celdaSubtotal = fila.querySelector('.subtotal');
    if (celdaSubtotal) {
      const nuevoSubtotal = cantidad * producto.precio_pesos;
      celdaSubtotal.textContent = `$${nuevoSubtotal.toFixed(2)}`;
    }
  }

  actualizarTotales();
}


function actualizarTotales() {
  let subtotal = 0;
  let totalDolares = 0;

  carrito.forEach(p => {
    subtotal += p.precio_pesos * p.cantidad;
    totalDolares += p.precio_dolares * p.cantidad;
  });

  document.getElementById('carrito-subtotal').textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById('carrito-total-dolares').textContent = `$${totalDolares.toFixed(2)}`;
}

function eliminarDelCarrito(id) {
  const index = carrito.findIndex(p => p.id === id);
  if (index !== -1) {
    carrito.splice(index, 1);
    actualizarCarritoModal();
  }
}


// Vincular botones "Agregar al carrito"
document.addEventListener('DOMContentLoaded', function () {
  const botones = document.querySelectorAll('.btn-agregar-carrito');

  botones.forEach(btn => {
    btn.addEventListener('click', () => {
      const producto = {
        id: parseInt(btn.dataset.id),
        nombre: btn.dataset.nombre,
        descripcion_corta: btn.dataset.descripcionCorta,
        descripcion_larga: btn.dataset.descripcionLarga,
        precio_pesos: parseFloat(btn.dataset.precioPesos),
        precio_dolares: parseFloat(btn.dataset.precioDolares),
        stock: parseInt(btn.dataset.stock)
      };

      agregarAlCarrito(producto);
    });
  });
});
