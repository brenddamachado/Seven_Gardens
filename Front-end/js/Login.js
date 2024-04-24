validaLogin = function () {
    const usuario = document.getElementById("login").value.toLowerCase();
    const senha = document.getElementById("senha").value;

    const objetoUsuario = localStorage.getItem(usuario);
    const usuarioEncontrado = JSON.parse(objetoUsuario);
        if (usuarioEncontrado != null && usuarioEncontrado.senha === senha) {
            usuarioEncontrado.isLogged = true;
            const usuarioEncontradoString = JSON.stringify(usuarioEncontrado);
            localStorage.setItem(usuario, usuarioEncontradoString);
            location.href = '#';
        } else {
            alert('Usuário ou senha incorretos');
        }
}

function limparCampos() {
    const email = document.querySelector("#email");
    const senha = document.querySelector("#senha");
    email.value = "";
    senha.value = "";
  }

// hamburger  
let hamburger = document.getElementById("hamburguer");
let mobileMenu = document.getElementById("mobile");
let closeButton = document.querySelector(".close-btn");

hamburger.addEventListener("click", function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener("click", function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});