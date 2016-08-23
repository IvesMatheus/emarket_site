<?php
    include_once "_model/Mercado.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="_css/index.css">
    </head>
    <body>
        <header id="cabecalho">
            <div id="img_logo">
                <h1>meuMercadinho</h1>
                <h5>O mercadinho de vizinhança online</h5>
            </div>
            <nav id="menu">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <?php
                        $mercado = null;

                        if(isset($_SESSION["login"]))
                            $mercado = $_SESSION["login"];

                        if($mercado != null)
                        {
                            echo "<li><a href=\"produtos.php\">PRODUTOS</a></li>";
                            echo "<li><a href=\"mercado.php\">".$mercado->getNome()."</a></li>";
                        }
                        else
                            echo "<li><a href=\"login.php\">LOGIN</a></li>";
                    ?>
                </ul>
            </nav>
        </header>
        <div id="main">
            <div id="sobre">
                <h3>Conheça meuMercadinho</h3>
                <h3 class="subtitle">O que é</h3>
                <p><span class="termo_destaque">meuMercadinho</span> é um sistema na qual você pode montar sua própria loja online para vender os produtos de seu mercado!</p>
            </div>
            <div id="lateral">

            </div>
        </div>
    </body>
</html>
