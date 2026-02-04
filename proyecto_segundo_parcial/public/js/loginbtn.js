document.addEventListener("DOMContentLoaded", () => {
  const btnUsuario = document.getElementById("btnUsuario");
  const panelUsuario = document.getElementById("panelUsuario");
  const cerrarPanel = document.getElementById("cerrarPanel");

  if (!btnUsuario || !panelUsuario || !cerrarPanel) return;

  // Toggle al hacer clic en el icono de usuario
  btnUsuario.addEventListener("click", (e) => {
    e.preventDefault();
    panelUsuario.classList.toggle("activo");
  });

  // Cerrar con la "X"
  cerrarPanel.addEventListener("click", () => {
    panelUsuario.classList.remove("activo");
  });
});
