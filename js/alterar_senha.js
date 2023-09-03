var form = document.getElementById("altera_senha");

if (form.addEventListener) {
	form.addEventListener("submit", validaAlteracao_Senha);
} else if (form.attachEvent) {
	form.attachEvent("onsubmit", validaAlteracao_Senha);
}

function validaAlteracao_Senha(evt) {
	var senha_a = document.getElementById('senha_a');
	var senha_n = document.getElementById('senha_n');
	var contErro = 0;

	/* Validação do campo senha antiga */
	caixa_senha_a = document.querySelector('.msg-senha_a');
	if (senha_a.value == "") {
		caixa_senha_a.innerHTML = "Favor preencher o campo com a senha antiga";
		caixa_senha_a.style.display = 'block';
		contErro += 1;
	} else if (senha_a.value.length < 6) {
		caixa_senha_a.innerHTML = "Favor preencher a Senha com o mínimo de 6 caracteres";
		caixa_senha_a.style.display = 'block';
		contErro += 1;
	} else {
		caixa_senha_a.style.display = 'none';
	}


	/* Validação do campo senha nova */
	caixa_senha_n = document.querySelector('.msg-senha_n');
	if (senha_n.value == "") {
		caixa_senha_n.innerHTML = "Favor preencher o campo com a senha nova";
		caixa_senha_n.style.display = 'block';
		contErro += 1;
	} else if (senha_n.value.length < 6) {
		caixa_senha_n.innerHTML = "Favor preencher a Senha com o mínimo de 6 caracteres";
		caixa_senha_n.style.display = 'block';
		contErro += 1;
	} else {
		caixa_senha_n.style.display = 'none';
	}

	if (contErro > 0) {
		evt.preventDefault();
	}
} 