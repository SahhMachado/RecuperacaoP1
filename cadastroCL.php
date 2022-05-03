<!DOCTYPE html>
<?php
    include_once "acaoCL.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $c_idCliente = isset($_GET['c_idCliente']) ? $_GET['c_idCliente'] : "";
    if ($c_idCliente > 0)
        $dados = buscarDados($c_idCliente);
}
    $title = "Cadastro de Cliente";
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
<a href="indexCL.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoCL.php">
                
            <p>ID:</p>
                <input readonly  type="text" name="c_idCliente" id="c_idCliente" value="<?php if ($acao == "editar") echo $dados['c_idCliente']; else echo 0; ?>"><br>

            <p>Nome:</p>
                <input name="c_nome" id="c_nome" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['c_nome']; ?>"
                placeholder="Digite o nome"><br>         
            
            <p>CPF:</p>
                <input name="c_cpf" id="c_cpf" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['c_cpf']; ?>" 
                placeholder="Digite o CPF"><br>

            <p>Data de nascimento:</p>
                <input name="c_dt_nascimento" id="c_dt_nascimento" type="date" required="true" value="<?php if ($acao == "editar") echo $dados['c_dt_nascimento']; ?>">
                <br>
    <br>

                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>