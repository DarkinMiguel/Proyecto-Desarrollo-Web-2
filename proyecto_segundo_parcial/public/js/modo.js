// js/modo.js
document.addEventListener("DOMContentLoaded", () => {
  const modoBtn = document.getElementById("modoBtn");

  if (localStorage.getItem("modoOscuro") === "true") {
    document.body.classList.add("modo-oscuro");
    modoBtn.textContent = "Modo Claro";
  }

  modoBtn.addEventListener("click", () => {
    document.body.classList.toggle("modo-oscuro");

    if (document.body.classList.contains("modo-oscuro")) {
      modoBtn.textContent = "Modo Claro";
      localStorage.setItem("modoOscuro", "true");
    } else {
      modoBtn.textContent = "Modo Oscuro";
      localStorage.setItem("modoOscuro", "false");
    }
  });
});
