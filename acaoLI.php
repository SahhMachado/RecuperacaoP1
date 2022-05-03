<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/Livro.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $l_id_livro = isset($_GET['l_id_livro']) ? $_GET['l_id_livro'] : 0;
        
        $livro = new Livro("", "", "", "", "");
        $resultado = $livro->excluir($l_id_livro);
        header("location:indexLI.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $l_id_livro = isset($_POST['l_id_livro']) ? $_POST['l_id_livro'] : "";

        try{
        if ($l_id_livro == 0){
            $livro = new Livro("", $_POST['l_titulo'], $_POST['l_ano_publicacao'], $_POST['l_isdn'], $_POST['l_preco']);      
            $resultado = $livro->insere();
            header("location:indexLI.php");
        }else     
        $livro = new Livro($_POST['l_id_livro'], $_POST['l_titulo'], $_POST['l_ano_publicacao'], $_POST['l_isdn'], $_POST['l_preco']);
        $resultado = $livro->editar($l_id_livro);
        header("location:indexLI.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar livro.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($l_id_livro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM livro WHERE l_id_livro = $l_id_livro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['l_id_livro'] = $linha['l_id_livro'];
            $dados['l_titulo'] = $linha['l_titulo'];
            $dados['l_ano_publicacao'] = $linha['l_ano_publicacao'];
            $dados['l_isdn'] = $linha['l_isdn'];
            $dados['l_preco'] = $linha['l_preco'];


        }
        return $dados;
    }
?>