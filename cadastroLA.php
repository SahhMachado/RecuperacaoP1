<!DOCTYPE html>
<?php
    include_once "acaoLA.php";
    include_once "utils.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $la_livro_l_id_livro = isset($_GET['la_livro_l_id_livro']) ? $_GET['la_livro_l_id_livro'] : "";
    if ($la_livro_l_id_livro > 0)
        $dados = buscarDados($la_livro_l_id_livro);
}
    $title = "Cadastro de Livro Autor";
// var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <style>
        body{
            background-color: #e5ddee;
            margin: 20px;
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

        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            color: #b4a0cd;
        }
    </style>
</head>

<body>
    <br>
<a href="indexLA.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoLA.php">
                
        <p>Livro: </p>
            <select name="la_livro_l_id_livro"  id="la_livro_l_id_livro">
                <?php
                echo lista_livro(0);
                ?>
            </select>
        
        <br>
        <br>

        <p>Autor: </p>
            <select name="la_autor_a_idAutor"  id="la_autor_a_idAutor">
                <?php
                echo lista_autor(0);
                ?>
            </select>

            <br><br>

                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>