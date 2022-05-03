<?php
require_once ("classes/Cliente.class.php");
require_once ("classes/Livro.class.php");
require_once("classes/Autor.class.php");
require_once("classes/Venda.class.php");

function exibir($chave, $dados){
    foreach($dados as $linha){
        $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
    }
    return $str;
}

function lista_cliente($id){
    $cliente = new Cliente("","","","");
    $lista = $cliente->buscar($id);
    return exibir(array('c_idCliente', 'c_nome'), $lista);
}


function lista_livro($id){
   $livro = new Livro("","","","","");
   $lista = $livro->buscar($id);
    return exibir(array('l_id_livro', 'l_titulo'), $lista);
}

function lista_venda($id){
    $venda = new Venda("","","","");
     $lista = $venda->buscar($id);
     return exibir(array('v_idVenda', 'v_idVenda'), $lista);
}

function lista_autor($id){
    try{
        $autor = new Autor("","","");
    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
    $lista = $autor->buscar($id);
    return exibir(array('a_idAutor', 'a_nome'), $lista);
}
?>