<!DOCTYPE html>
<?php
    include_once "acaoVD.php";
    include_once "utils.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $v_idVenda = isset($_GET['v_idVenda']) ? $_GET['v_idVenda'] : "";
    if ($v_idVenda > 0)
        $dados = buscarDados($v_idVenda);
}
    $title = "Cadastro de Venda";
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
<a href="indexVD.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoVD.php">
                
            <p>ID:</p>
                <input readonly  type="text" name="v_idVenda" id="v_idVenda" value="<?php if ($acao == "editar") echo $dados['v_idVenda']; else echo 0; ?>"><br>

            <p>Valor Total:</p>
                <input name="v_valor_total_venda" id="v_valor_total_venda" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['v_valor_total_venda']; ?>"
                placeholder="Digite o valor total"><br>         
            
            <p>Desconto:</p>
                <input name="v_desconto" id="v_desconto" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['v_desconto']; ?>" 
                placeholder="Digite o desconto"><br>
    <br>

        <p>Cliente: </p>
            <select name="v_c_idCliente"  id="v_c_idCliente">
                <?php
                echo lista_cliente(0);
                ?>
            </select>
        <br><br>
                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>