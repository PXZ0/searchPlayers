var form = document.getElementById("proposta_cont");

if (form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt) {
    var posicao = document.getElementById('posicao');
    var preco = document.getElementById('preco');
    var contErro = 0;

    caixa_posicao = document.querySelector('.msg-posicao');
    if (posicao.value == "") {
        caixa_posicao.innerHTML = "Favor preencher a Posição que o Atleta Jogara!";
        caixa_posicao.style.display = 'block';
        contErro += 1;
    } else {
        caixa_posicao.style.display = 'none';
    }

    caixa_preco = document.querySelector('.msg-preco');
    if (preco.value == "0") {
        caixa_preco.innerHTML = "Favor preencher o valor do contrato!";
        caixa_preco.style.display = 'block';
        contErro += 1;
    } else {
        caixa_preco.style.display = 'none';
    }

    if (contErro > 0) {
        evt.preventDefault();
    }
}