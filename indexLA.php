<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Livro Autor";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $cnst = isset($_POST['cnst']) ? $_POST['cnst'] : 1;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title> 
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
         body{
            background-color: #e5ddee;
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
        }

        button{
            background-color: #9178af;
            border-radius: 10px;
            border: none;
            font-weight: bold;
        }

        input{
            background-color: #b4a0cd;
            border-radius: 10px;
            border: none;
        }

        header{
            background-image: url("img/header1.jpg");
            padding: 20px;
            font-weight: bold;
        }

        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            color: #b4a0cd;
        }

        td{
            padding-right: 20px;
        }

        div{
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <?php
    include_once('menu.php');
    ?>
</header>

<div>
    <form method="post">
        <h3>Procurar:</h3><br>
        <input type="text" name="procurar" id="procurar" size="25" placeholder="pesquisar"
        value="<?php echo $procurar;?>"><br><br>
    <button name="acao" id="acao" type="submit">Procurar</button>
    <br><br>
    <fieldset>
    <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
            <input type="radio" name="cnst" value="1" <?php if ($cnst == "1") echo "checked" ?>> Id do livro<br>
            <input type="radio" name="cnst" value="1" <?php if ($cnst == "2") echo "checked" ?>> Id do Autor<br>
    <br><br>
    </form>

    <table>
            <tr><td><b>ID do livro</b></td>
                <td><b>ID do autor</b></td>
    </tr> 
</div>
            
    <?php
        $pdo = Conexao::getInstance(); 

        if($cnst == 1){
            $consulta = $pdo->query("SELECT * FROM livro_autor
                                     WHERE la_livro_l_id_livro LIKE '$procurar%' 
                                     ORDER BY la_livro_l_id_livro");
        }else {
            $consulta = $pdo->query("SELECT * FROM livro_autor
                                     WHERE la_autor_a_idAutor LIKE '$procurar%' 
                                     ORDER BY la_autor_a_idAutor");
        }

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        <tr>
            <td><?php echo $linha['la_livro_l_id_livro'];?></td>
            <td><?php echo $linha['la_autor_a_idAutor'];?></td>

            <td><a href='cadastroLA.php?acao=editar&la_livro_l_id_autor=<?php echo $linha['la_livro_l_id_autor'];?>'><img src='img/edit.svg'></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoLI.php?acao=excluir&la_livro_l_id_autor={$linha['la_livro_l_id_autor']}')>
            <img src='img/excluir.svg'></a><br>"; ?></td>
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
</body>
</html>