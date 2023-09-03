var form = document.getElementById("login-form");

if (form.addEventListener) {
    form.addEventListener("submit", validaLogin);
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", validaLogin);
}

function validaLogin(evt) {
    var email = document.getElementById('login');
    var senha = document.getElementById('senhal');
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;


    /* Validação do campo email */
    caixa_email = document.querySelector('.msg-emaill');
    if (email.value == "") {
        caixa_email.innerHTML = "Favor preencher o E-mail";
        caixa_email.style.display = 'block';
        contErro += 1;
    } else if (filtro.test(email.value)) {
        caixa_email.style.display = 'none';
    } else {
        caixa_email.innerHTML = "Formato do E-mail inválido";
        caixa_email.style.display = 'block';
        contErro += 1;
    }

    /* Validação do campo senha */
    caixa_senha = document.querySelector('.msg-senhal');
    if (senha.value == "") {
        caixa_senha.innerHTML = "Favor preencher a Senha";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else if (senha.value.length < 6) {
        caixa_senha.innerHTML = "Favor preencher a Senha com o mínimo de 6 caracteres";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else {
        caixa_senha.style.display = 'none';
    }

    if (contErro > 0) {
        evt.preventDefault();
    }
}
