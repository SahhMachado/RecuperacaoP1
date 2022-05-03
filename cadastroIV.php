<!DOCTYPE html>
<?php
    include_once "acaoIV.php";
    include_once "utils.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $iv_v_idVenda = isset($_GET['iv_v_idVenda']) ? $_GET['iv_v_idVenda'] : "";
    if ($iv_v_idVenda > 0)
        $dados = buscarDados($iv_v_idVenda);
}
    $title = "Cadastro de Item Venda";
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
<a href="indexIV.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoIV.php">

        <p>Venda: </p>
            <select name="iv_v_idVenda"  id="iv_v_idVenda">
                <?php
                echo lista_venda(0);
                ?>
            </select>

        <p>Livro: </p>
            <select name="iv_l_id_livro"  id="iv_l_id_livro">
                <?php
                echo lista_livro(0);
                ?>
            </select>

            <p>Quantidade:</p>
                <input name="iv_quantidade" id="iv_quantidade" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['iv_quantidade']; ?>" placeholder="Digite a quantidade"><br>         
            
            <p>Valor Total:</p>
                <input name="iv_valor_total_item" id="iv_valor_total_item" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['iv_valor_total_item']; ?>" placeholder="Digite o valor total"><br>         
            
            <p>Data da venda:</p>
                <input name="iv_data_venda" id="iv_data_venda" type="date" required="true" value="<?php if ($acao == "editar") echo $dados['iv_data_venda']; ?>" placeholder="Digite a data da venda"><br>
            <br>
                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>