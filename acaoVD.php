<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/Venda.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $v_idVenda = isset($_GET['v_idVenda']) ? $_GET['v_idVenda'] : 0;
        
        $venda = new Venda("", "", "", "");
        $resultado = $venda->excluir($v_idVenda);
        header("location:indexVD.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $v_idVenda = isset($_POST['v_idVenda']) ? $_POST['v_idVenda'] : "";

        try{
        if ($v_idVenda == 0){
            $venda = new Venda("", $_POST['v_valor_total_venda'], $_POST['v_desconto'], $_POST['v_c_idCliente']);      
            $resultado = $venda->insere();
            header("location:indexVD.php");
        }else     
        $venda = new Venda($_POST['v_idVenda'], $_POST['v_valor_total_venda'], $_POST['v_desconto'], $_POST['v_c_idCliente']);
        $resultado = $venda->editar($v_idVenda);
        header("location:indexVD.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar venda.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($v_idVenda){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM venda WHERE v_idVenda = $v_idVenda");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['v_idVenda'] = $linha['v_idVenda'];
            $dados['v_valor_total_venda'] = $linha['v_valor_total_venda'];
            $dados['v_desconto'] = $linha['v_desconto'];
            $dados['v_c_idCliente'] = $linha['v_c_idCliente'];
        }
        return $dados;
    }
?>