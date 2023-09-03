var form = document.getElementById("marcar_partidaa");

if (form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt) {
    var cep = document.getElementById('cep');
    var uf = document.getElementById('uf');
    var cidade = document.getElementById('cidade');
    var bairro = document.getElementById('bairro');
    var rua = document.getElementById('rua');
    var num = document.getElementById('num');
    var contErro = 0;

    caixa_cep = document.querySelector('.msg-cep');
    if (cep.value == "") {
        caixa_cep.innerHTML = "Favor preencher o CEP";
        caixa_cep.style.display = 'block';
        contErro += 1;
    } else {
        caixa_cep.style.display = 'none';
    }

    caixa_uf = document.querySelector('.msg-uf');
    if (uf.value == "") {
        caixa_uf.innerHTML = "Favor preencher o Estado";
        caixa_uf.style.display = 'block';
        contErro += 1;
    } else {
        caixa_uf.style.display = 'none';
    }

    caixa_cidade = document.querySelector('.msg-cidade');
    if (cidade.value == "") {
        caixa_cidade.innerHTML = "Favor preencher o nome da Cidade";
        caixa_cidade.style.display = 'block';
        contErro += 1;
    } else {
        caixa_cidade.style.display = 'none';
    }

    caixa_bairro = document.querySelector('.msg-bairro');
    if (bairro.value == "") {
        caixa_bairro.innerHTML = "Favor preencher o nome do Bairro";
        caixa_bairro.style.display = 'block';
        contErro += 1;
    } else {
        caixa_bairro.style.display = 'none';
    }

    caixa_rua = document.querySelector('.msg-rua');
    if (rua.value == "") {
        caixa_rua.innerHTML = "Favor preencher o nome da Rua";
        caixa_rua.style.display = 'block';
        contErro += 1;
    } else {
        caixa_rua.style.display = 'none';
    }

    caixa_num = document.querySelector('.msg-num');
    if (num.value == "") {
        caixa_num.innerHTML = "Favor preencher o Numero do local";
        caixa_num.style.display = 'block';
        contErro += 1;
    } else {
        caixa_num.style.display = 'none';
    }

    if (contErro > 0) {
        evt.preventDefault();
    }
}