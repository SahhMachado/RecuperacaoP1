<!DOCTYPE html>
<?php
    include_once "acaoAU.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $a_idAutor = isset($_GET['a_idAutor']) ? $_GET['a_idAutor'] : "";
    if ($a_idAutor > 0)
        $dados = buscarDados($a_idAutor);
}
    $title = "Cadastro de Livro";
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
<a href="indexAU.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoAU.php">
                
            <p>ID:</p>
                <input readonly  type="text" name="a_idAutor" id="a_idAutor" value="<?php if ($acao == "editar") echo $dados['a_idAutor']; else echo 0; ?>"><br>

            <p>Nome:</p>
                <input name="a_nome" id="a_nome" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['a_nome']; ?>" placeholder="Digite o nome"><br>         
            
            <p>Sobrenome:</p>
                <input name="a_sobrenome" id="a_sobrenome" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['a_sobrenome']; ?>" placeholder="Digite o sobrenome"><br>
            
            <br>
                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>