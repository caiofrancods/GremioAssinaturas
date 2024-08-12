function filtroEscolhido(){
    var idFiltro = document.getElementById("filtro").value;


    window.location.href = "administrador.php?tipo="+idFiltro;

}

function filtroEscolhidoPublico(){
    var idFiltro = document.getElementById("filtro").value;

    
    window.location.href = "publica.php?tipo="+idFiltro;

}