document.addEventListener("DOMContentLoaded", function() {
    const nuevoRegistroBtn = document.getElementById("nuevoRegistroBtn");
    const tipoAntecedentes = document.getElementById("tipoAntecedentes");
    const formularioAntecedentes = document.getElementById("formularioAntecedentes");

    nuevoRegistroBtn.addEventListener("click", function() {
        formularioAntecedentes.innerHTML = ""; // Limpia el contenido anterior

        if (tipoAntecedentes.value === "familiares") {
            // Formulario de Antecedentes Familiares
            const form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "guardar_antecedentes.php");

            const labelQuirurgicos = document.createElement("label");
            labelQuirurgicos.textContent = "Antecedentes Quirúrgicos:";
            const inputQuirurgicos = document.createElement("input");
            inputQuirurgicos.setAttribute("type", "text");
            inputQuirurgicos.setAttribute("name", "quirurgicos");

            // Repite el proceso para otros campos como patológicos, traumáticos, etc.

            const submitBtn = document.createElement("button");
            submitBtn.setAttribute("type", "submit");
            submitBtn.textContent = "Guardar";

            form.appendChild(labelQuirurgicos);
            form.appendChild(inputQuirurgicos);
            // Agrega otros campos al formulario

            form.appendChild(submitBtn);
            formularioAntecedentes.appendChild(form);
        } else if (tipoAntecedentes.value === "personales") {
            // Formulario de Antecedentes Personales
            const form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "guardar_antecedentes.php");

            // Crea campos y etiquetas para antecedentes personales, similar al caso anterior

            const submitBtn = document.createElement("button");
            submitBtn.setAttribute("type", "submit");
            submitBtn.textContent = "Guardar";

            form.appendChild(labelCampo1);
            form.appendChild(inputCampo1);
            // Agrega otros campos al formulario

            form.appendChild(submitBtn);
            formularioAntecedentes.appendChild(form);
        }
    });
});
