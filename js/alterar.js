var form = document.getElementById("altera_form");

if (form.addEventListener) {
	form.addEventListener("submit", validaAlteracao);
} else if (form.attachEvent) {
	form.attachEvent("onsubmit", validaAlteracao);
}

function validaAlteracao(evt) {
	var senha = document.getElementById('senha');
	var contErro = 0;

	/* Validação do campo senha */
	caixa_senha = document.querySelector('.msg-senha');
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