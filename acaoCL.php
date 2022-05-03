<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/Cliente.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $c_idCliente = isset($_GET['c_idCliente']) ? $_GET['c_idCliente'] : 0;
        
        $cliente = new Cliente("", "", "", "");
        $resultado = $cliente->excluir($c_idCliente);
        header("location:indexCL.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $c_idCliente = isset($_POST['c_idCliente']) ? $_POST['c_idCliente'] : "";

        try{
        if ($c_idCliente == 0){
            $cliente = new Cliente("", $_POST['c_nome'], $_POST['c_cpf'], $_POST['c_dt_nascimento']);      
            $resultado = $cliente->insere();
            header("location:indexCL.php");
        }else     
        $cliente = new Cliente($_POST['c_idCliente'], $_POST['c_nome'], $_POST['c_cpf'], $_POST['c_dt_nascimento']);
        $resultado = $cliente->editar($c_idCliente);
        header("location:indexCL.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar cliente.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($c_idCliente){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cliente WHERE c_idCliente = $c_idCliente");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['c_idCliente'] = $linha['c_idCliente'];
            $dados['c_nome'] = $linha['c_nome'];
            $dados['c_cpf'] = $linha['c_cpf'];
            $dados['c_dt_nascimento'] = $linha['c_dt_nascimento'];
        }
        return $dados;
    }
?>