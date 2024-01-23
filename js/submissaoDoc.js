var nomesArray = [];

function adicionarElemento() {
    var select = document.getElementById('signatario');
    var selectedOption = select.value;

    // Atualize o array com o nome do elemento
    nomesArray.push(selectedOption);

    // Certificar-se de que a lista <ul> já existe
    var listaUl = document.getElementById('lista');
    if (!listaUl) {
        listaUl = document.createElement('ul');
        listaUl.className = 'list-group';
        listaUl.id = 'lista-ul';
        document.getElementById('lista').appendChild(listaUl);
    }

    // Criar um novo elemento <li>
    var novoElemento = document.createElement('li');
    novoElemento.className = 'list-group-item d-flex justify-content-between align-items-center';
    novoElemento.textContent = selectedOption;

    // Adicionar o botão de remoção (ícone "x" do Bootstrap)
    var botaoRemover = document.createElement('button');
    botaoRemover.type = 'button';
    botaoRemover.className = 'btn btn-danger btn-sm';
    botaoRemover.innerHTML = '<i class="bi bi-x"></i>';
    botaoRemover.onclick = function () {
        removerElemento(novoElemento);
    };

    // Adicionar o botão à lista
    novoElemento.appendChild(botaoRemover);

    // Adicionar o novo elemento à lista <ul>
    listaUl.appendChild(novoElemento);

    // Atualizar o valor do campo oculto no formulário
    document.getElementById('nomesArray').value = JSON.stringify(nomesArray);
}

function removerElemento(elemento) {
    // Remover o elemento da lista
    elemento.parentNode.removeChild(elemento);

    // Remover o nome do array
    var nomeRemover = elemento.textContent.trim();
    nomesArray = nomesArray.filter(function (nome) {
        return nome !== nomeRemover;
    });

    // Atualizar o valor do campo oculto no formulário
    document.getElementById('nomesArray').value = JSON.stringify(nomesArray);
}

// Adicione esta função se quiser enviar o formulário em algum momento
function verificarElementos() {
    // Verificar se há pelo menos dois elementos na lista
    if (nomesArray.length >= 1) {
        // Se houver, enviar o formulário
        document.getElementById('formulario').submit();
    } else {
        // Se não, emitir um alerta
        alert("Submeta à pelo menos um signatário");
    }
}