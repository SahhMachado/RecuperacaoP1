<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/LivroAutor.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $la_livro_l_id_livro = isset($_GET['la_livro_l_id_livro']) ? $_GET['la_livro_l_id_livro'] : 0;
        
        $livroA = new LivroA("","");
        $resultado = $LivroA->excluir($la_livro_l_id_livro);
        header("location:indexLA.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $la_livro_l_id_livro = isset($_POST['la_livro_l_id_livro']) ? $_POST['la_livro_l_id_livro'] : "";

        try{
        if ($la_livro_l_id_livro == 0){
            $livroA = new LivroA("", $_POST['la_autor_a_idAutor']);      
            $resultado = $LivroA->insere();
            header("location:indexLA.php");
        }else     
        $livroA = new LivroA($_POST['la_livro_l_id_livro'], $_POST['la_autor_a_idAutor']);
        $resultado = $livroA->editar($la_livro_l_id_livro);
        header("location:indexLA.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar Livro Autor.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($la_livro_l_id_livro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM LivroA WHERE la_livro_l_id_livro = $la_livro_l_id_livro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['la_livro_l_id_livro'] = $linha['la_livro_l_id_livro'];
            $dados['la_autor_a_idAutor'] = $linha['la_autor_a_idAutor'];
        }
        return $dados;
    }
?>