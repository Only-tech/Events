emailjs.init("mSiePQQEQ-83LNBaf"); //clé publique

const form = document.getElementById("contact-form");
const status = document.getElementById("form-status");
const spinner = document.getElementById("loading-spinner");

form.addEventListener("submit", function(e) {
    e.preventDefault();
    spinner.style.display = "block";
    status.textContent = "";

    emailjs.sendForm("service_r7k5fdk", "template_1qncn8e", this)
    .then(() => {
        spinner.style.display = "none";
        status.textContent = "Message envoyé avec succès";
        status.style.color = "#0088aa";
        status.style.padding = '0.8em';
        status.style.borderRadius = "9999px";
        status.style.border = "1px #ffcc00 solid";
        status.style.boxShadow = "inset 0 0 12px rgba(245, 245, 245, 0.8)";
        form.reset();
    }, (error) => {
        spinner.style.display = "none";
        status.textContent = "Erreur : " + error.text;
        status.style.color = "#0088aa";
        status.style.padding = '0.8em';
        status.style.borderRadius = "9999px";
        status.style.boxShadow = "inset 0 0 2px #0088aa";
    });
});
