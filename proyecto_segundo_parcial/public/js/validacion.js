const form = document.querySelector(".login-form");
form.addEventListener("submit", e => {
    const user = form.username.value.trim();
    const pass = form.password.value.trim();
    if(!user || !pass) {
        e.preventDefault();
        alert("Todos los campos son obligatorios.");
    }
});
