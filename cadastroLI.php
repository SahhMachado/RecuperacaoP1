<!DOCTYPE html>
<?php
    include_once "acaoLI.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $l_id_livro = isset($_GET['l_id_livro']) ? $_GET['l_id_livro'] : "";
    if ($l_id_livro > 0)
        $dados = buscarDados($l_id_livro);
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
<a href="indexLI.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoLI.php">
                
            <p>ID:</p>
                <input readonly  type="text" name="l_id_livro" id="l_id_livro" value="<?php if ($acao == "editar") echo $dados['l_id_livro']; else echo 0; ?>"><br>

            <p>Título:</p>
                <input name="l_titulo" id="l_titulo" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['l_titulo']; ?>" placeholder="Digite o título"><br>         
            
            <p>Ano de publicação:</p>
                <input name="l_ano_publicacao" id="l_ano_publicacao" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['l_ano_publicacao']; ?>" placeholder="Digite o ano"><br>
            
            <p>ISDN:</p>
                <input name="l_isdn" id="l_isdn" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['l_isdn']; ?>" placeholder="Digite o ISDN"><br>

            <p>Preço:</p>
                <input name="l_preco" id="l_preco" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['l_preco']; ?>" placeholder="Digite o preço"><br>
            <br>
                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>