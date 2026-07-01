
let zoomAcessibilidade = parseInt(localStorage.getItem("zoomAcessibilidade"), 10);

if (isNaN(zoomAcessibilidade)) {
    zoomAcessibilidade = 100;
}

function aplicarZoomAcessibilidade() {
    // Usa zoom porque o site tem vários font-size com clamp() e vw.
    // Assim aumenta a página inteira de forma perceptível.
    document.body.style.zoom = zoomAcessibilidade + "%";

    // Compatibilidade com alguns navegadores
    document.body.style.setProperty("-moz-transform", "scale(" + (zoomAcessibilidade / 100) + ")");
    document.body.style.setProperty("-moz-transform-origin", "top left");

    document.body.setAttribute("data-zoom-acessibilidade", zoomAcessibilidade + "%");
    localStorage.setItem("zoomAcessibilidade", zoomAcessibilidade);
}

function aumentarFonte() {
    zoomAcessibilidade = parseInt(localStorage.getItem("zoomAcessibilidade"), 10);

    if (isNaN(zoomAcessibilidade)) {
        zoomAcessibilidade = 100;
    }

    if (zoomAcessibilidade < 200) {
        zoomAcessibilidade += 10;
        aplicarZoomAcessibilidade();
    }
}

function diminuirFonte() {
    zoomAcessibilidade = parseInt(localStorage.getItem("zoomAcessibilidade"), 10);

    if (isNaN(zoomAcessibilidade)) {
        zoomAcessibilidade = 100;
    }

    if (zoomAcessibilidade > 70) {
        zoomAcessibilidade -= 10;
        aplicarZoomAcessibilidade();
    }
}

function abrirAcessibilidade() {
    const menu = document.getElementById("menuAcessibilidade");

    if (menu) {
        menu.classList.toggle("mostrar-acessibilidade");
    }
}

function modoContraste() {
    document.body.classList.toggle("modo-contraste");
    document.body.classList.remove("modo-escuro");

    if (document.body.classList.contains("modo-contraste")) {
        localStorage.setItem("acessibilidade", "contraste");
    } else {
        localStorage.removeItem("acessibilidade");
    }
}

function altoContraste() {
    modoContraste();
}

function modoEscuro() {
    document.body.classList.toggle("modo-escuro");
    document.body.classList.remove("modo-contraste");

    if (document.body.classList.contains("modo-escuro")) {
        localStorage.setItem("acessibilidade", "escuro");
    } else {
        localStorage.removeItem("acessibilidade");
    }
}


function lerPagina() {
    const conteudo = document.querySelector("main");
    const texto = conteudo ? conteudo.innerText : document.body.innerText;

    const fala = new SpeechSynthesisUtterance(texto);
    fala.lang = "pt-BR";

    speechSynthesis.cancel();
    speechSynthesis.speak(fala);
}

function pararLeitura() {
    speechSynthesis.cancel();
}

function restaurarAcessibilidade() {
    zoomAcessibilidade = 100;
    document.body.style.zoom = "100%";
    document.body.style.removeProperty("-moz-transform");
    document.body.style.removeProperty("-moz-transform-origin");
    document.body.removeAttribute("data-zoom-acessibilidade");

    document.body.classList.remove("modo-escuro");
    document.body.classList.remove("modo-contraste");

    localStorage.removeItem("zoomAcessibilidade");
    localStorage.removeItem("tamanhoFonte");
    localStorage.removeItem("acessibilidade");
}

function resetarAcessibilidade() {
    restaurarAcessibilidade();
}

document.addEventListener("DOMContentLoaded", function () {
    const modo = localStorage.getItem("acessibilidade");
    zoomAcessibilidade = parseInt(localStorage.getItem("zoomAcessibilidade"), 10);

    if (isNaN(zoomAcessibilidade)) {
        zoomAcessibilidade = 100;
    }

    aplicarZoomAcessibilidade();

    if (modo === "escuro") {
        document.body.classList.add("modo-escuro");
    }

    if (modo === "contraste") {
        document.body.classList.add("modo-contraste");
    }
});
