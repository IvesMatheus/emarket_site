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
                <ul class="ul_menu">
                    <li class="li_menu"><a href="index.php">HOME</a></li>
                    <?php
                        $mercado = null;

                        if(isset($_SESSION["login"]))
                            $mercado = $_SESSION["login"];

                        if($mercado != null)
                        {
                            echo "<li class=\"li_menu\"><a href=\"_telas/produtos.php\">PRODUTOS</a></li>";
                            echo "<li class=\"li_menu\"><a href=\"_telas/mercado.php\">".$mercado->getNome()."</a></li>";
                        }
                        else
                            echo "<li class=\"li_menu\"><a href=\"_telas/login.php\">LOGIN</a></li>";
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
                <h3 class="subtitle">Feche seu contrato conosco</h3>
                <p id="contato">
                    Telefones para contato:
                </p>
                <ul>
                    <li>(92) 98169-6266</li>
                </ul>
                <p id="contato">
                    Email: <br>impsa@icomp.ufam.edu.br<br>
                    Endereço:<br>Rua Comandante Henrique Bastos nº 5553<br>
                    Bairro da Paz - CEP 69.049-070
                </p>
            </div>
        </div>
    </body>
</html>
