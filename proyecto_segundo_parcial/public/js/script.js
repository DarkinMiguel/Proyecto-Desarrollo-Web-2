// VALIDACIÓN FORMULARIO

document.getElementById("formContacto").addEventListener("submit", (e) => {
  const nombre = document.getElementById("nombre").value.trim();
  const correo = document.getElementById("correo").value.trim();
  const mensaje = document.getElementById("mensaje").value.trim();

  if (nombre === "" || correo === "" || mensaje === "") {
    alert("Debe completar todos los campos.");
    e.preventDefault();
    return;
  }

  if (!correo.includes("@")) {
    alert("Ingrese un correo válido.");
    e.preventDefault();
  }
});

function enviarMensaje() {
  const nombre = document.getElementById("nombre").value.trim();
  const correo = document.getElementById("correo").value.trim();
  const mensaje = document.getElementById("mensaje").value.trim();

  if (nombre === "" || correo === "" || mensaje === "") {
    alert("Debe completar todos los campos.");
  } else {
    alert(
      "Mensaje enviado a nuestro equipo. ¡Gracias por contactarnos! Saludos, " +
        nombre
    );
  }
}


