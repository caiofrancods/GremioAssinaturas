var nomesArray = [];

function adicionarElemento() {
    var select = document.getElementById('signatario');
    var selectedOption = select.value;
    var selectedId = selectedOption.substring(0, 2); // Extrair o ID do usuário
    var selectedNome = selectedOption.substring(3); // Extrair o nome do usuário

    // Atualize o array com o ID do usuário
    nomesArray.push(Number(selectedId));

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
    novoElemento.textContent = selectedNome;

    // Adicionar o botão de remoção (ícone "x" do Bootstrap)
    var botaoRemover = document.createElement('button');
    botaoRemover.type = 'button';
    botaoRemover.className = 'btn btn-danger btn-sm';
    botaoRemover.innerHTML = '<i class="bi bi-x"></i>';
    botaoRemover.onclick = function () {
        removerElemento(novoElemento, selectedId); // Passar o ID do usuário para a função de remoção
    };

    // Adicionar o botão à lista
    novoElemento.appendChild(botaoRemover);

    // Adicionar o novo elemento à lista <ul>
    listaUl.appendChild(novoElemento);

    // Atualizar o valor do campo oculto no formulário
    document.getElementById('nomesArray').value = JSON.stringify(nomesArray);
}

function removerElemento(elemento, idUsuario) {
    // Remover o elemento da lista
    elemento.parentNode.removeChild(elemento);
    // Encontrar o índice do ID do usuário no array
    var index = nomesArray.indexOf(Number(idUsuario));

    // Remover o ID do usuário do array usando splice
    if (index !== -1) { // Verificar se o ID do usuário foi encontrado
        nomesArray.splice(index, 1); // Remove o elemento no índice encontrado
    }

    // Atualizar o valor do campo oculto no formulário
    document.getElementById('nomesArray').value = JSON.stringify(nomesArray);
}

// Adicione esta função se quiser enviar o formulário em algum momento
function verificarElementos() {
    // Verificar se há pelo menos um elemento na lista
    if (nomesArray.length >= 1) {
        // Se houver, enviar o formulário
        document.getElementById('formulario').submit();
    } else {
        // Se não, emitir um alerta
        alert("Submeta ao menos um signatário");
    }
}
