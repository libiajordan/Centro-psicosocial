document.addEventListener("DOMContentLoaded", function () {
    const crearRegistroBtn = document.getElementById("crearRegistroBtn");
    const formularioRegistro = document.getElementById("formularioRegistro");
    const cerrarFormularioBtn = document.getElementById("cerrarFormulario");

    crearRegistroBtn.addEventListener("click", function () {
        formularioRegistro.style.display = "block";
    });

    cerrarFormularioBtn.addEventListener("click", function () {
        formularioRegistro.style.display = "none";
    });
});

