var form = document.getElementById("regi_camp");

if (form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt) {
    var cep = document.getElementById('cep');
    var uf = document.getElementById('uf');
    var cidade = document.getElementById('cidade');
    var nome = document.getElementById('nome');
    var quantidade = document.getElementById('quantidade');
    var num = document.getElementById('taxa');
    var premio = document.getElementById('premio');
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

    caixa_nome = document.querySelector('.msg-nome');
    if (nome.value == "") {
        caixa_nome.innerHTML = "Favor preencher o nome do Campeonato";
        caixa_nome.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nome.style.display = 'none';
    }

    caixa_quantidade = document.querySelector('.msg-quantidade');
    if (quantidade.value == "") {
        caixa_qauntidade.innerHTML = "Favor preencher a qauntidade de times";
        caixa_quantidade.style.display = 'block';
        contErro += 1;
    } else {
        caixa_quantidade.style.display = 'none';
    }

    caixa_taxa = document.querySelector('.msg-taxa');
    if (taxa.value == "") {
        caixa_taxa.innerHTML = "Favor preencher a taxa de inscrição";
        caixa_taxa.style.display = 'block';
        contErro += 1;
    } else {
        caixa_taxa.style.display = 'none';
    }

    caixa_premio = document.querySelector('.msg-premio');
    if (premio.value == "") {
        caixa_premio.innerHTML = "Favor preencher a premiação do campeonato";
        caixa_premio.style.display = 'block';
        contErro += 1;
    } else {
        caixa_premio.style.display = 'none';
    }

    if (contErro > 0) {
        evt.preventDefault();
    }
}