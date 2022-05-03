<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Itens";
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
        <h3>Procurar Itens:</h3><br>
        <input type="text" name="procurar" id="procurar" size="25" placeholder="pesquisar"
        value="<?php echo $procurar;?>"><br><br>
    <button name="acao" id="acao" type="submit">Procurar</button>
    <br><br>
    <fieldset>
    <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
            <input type="radio" name="cnst" value="1" <?php if ($cnst == "1") echo "checked" ?>> Quantidade<br>
            <input type="radio" name="cnst" value="2" <?php if ($cnst == "2") echo "checked" ?>> Valor Total<br>
    <br><br>
    </form>

    <table>
            <tr><td><b>ID da Venda</b></td>
                <td><b>ID do Livro</b></td>
                <td><b>Quantidade</b></td>
                <td><b>Valor Total</b></td>
                <td><b>Data da Venda</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
    </tr> 
</div>
            
    <?php
        $pdo = Conexao::getInstance(); 

        if($cnst == 1){
            $consulta = $pdo->query("SELECT * FROM item_venda
                                     WHERE iv_quantidade LIKE '$procurar%' 
                                     ORDER BY iv_quantidade");}

        else if($cnst == 2){
            $consulta = $pdo->query("SELECT * FROM item_venda
                                     WHERE iv_valor_total_item LIKE '$procurar%' 
                                     ORDER BY iv_valor_total_item");}

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr>
            <td><?php echo $linha['iv_v_idVenda'];?></td>
            <td><?php echo $linha['iv_l_id_livro'];?></td>
            <td><?php echo $linha['iv_quantidade'];?></td>
            <td><?php echo number_format($linha['iv_valor_total_item'],2,',','.');?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['iv_data_venda']));?></td>

            <td><a href='cadastroIV.php?acao=editar&iv_v_idVenda=<?php echo $linha['iv_v_idVenda'];?>'><img src='img/edit.svg'></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoIV.php?acao=excluir&iv_v_idVenda={$linha['iv_v_idVenda']}')>
            <img src='img/excluir.svg'></a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
</body>
</html>