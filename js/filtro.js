function filtroEscolhido(){
    var idFiltro = document.getElementById("filtro").value;

    window.location.href = "administrador.php?tipo="+idFiltro;

    // $.ajax({
    //     url  : 'controle/filtros.php',
    //     type : 'post',
    //     data : {
    //         idFiltro : idFiltro
    //     }
    // })
    // .done(function(resultado){
    //     console.log(resultado);
    // });
}