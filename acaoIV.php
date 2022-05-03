<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/ItemVenda.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $iv_v_idVenda = isset($_GET['iv_v_idVenda']) ? $_GET['iv_v_idVenda'] : 0;
        
        $itemVenda = new ItemV("", "", "", "", "");
        $resultado = $itemVenda->excluir($iv_v_idVenda);
        header("location:indexIV.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $iv_v_idVenda = isset($_POST['iv_v_idVenda']) ? $_POST['iv_v_idVenda'] : "";

        try{
        if ($iv_v_idVenda == 0){
            $itemVenda = new ItemV("", "", $_POST['iv_quantidade'], $_POST['iv_valor_total_item'], $_POST['iv_data_venda']);      
            $resultado = $itemVenda->insere();
            header("location:indexIV.php");
        }else     
        $itemVenda = new ItemV($_POST['iv_v_idVenda'], $_POST['iv_l_id_livro'], $_POST['iv_quantidade'], $_POST['iv_valor_total_item'], $_POST['iv_data_venda']);
        $resultado = $itemVenda->editar($iv_v_idVenda);
        header("location:indexIV.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar Item.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($iv_v_idVenda){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM Item_venda WHERE iv_v_idVenda = $iv_v_idVenda");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['iv_v_idVenda'] = $linha['iv_v_idVenda'];
            $dados['iv_l_id_livro'] = $linha['iv_l_id_livro'];
            $dados['iv_quantidade'] = $linha['iv_quantidade'];
            $dados['iv_valor_total_item'] = $linha['iv_valor_total_item'];
            $dados['iv_data_venda'] = $linha['iv_data_venda'];


        }
        return $dados;
    }
?>