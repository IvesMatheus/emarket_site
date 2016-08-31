<?php
    include_once "../_model/Mercado.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../_css/index.css">
    </head>
    <body>
        <header id="cabecalho">
            <div id="img_logo">
                <h1>meuMercadinho</h1>
                <h5>O mercadinho de vizinhança online</h5>
            </div>
            <nav id="menu">
                <ul class="ul_menu">
                    <li class="li_menu"><a href="../index.php">HOME</a></li>
                    <?php
                        $mercado = null;

                        if(isset($_SESSION["login"]))
                            $mercado = $_SESSION["login"];

                        if($mercado != null)
                        {
                            echo "<li class=\"li_menu\"><a href=\"produtos.php\">PRODUTOS</a></li>";
                            echo "<li class=\"li_menu\"><a href=\"mercado.php\">".$mercado->getNome()."</a></li>";
                        }
                        else
                            echo "<li class=\"li_menu\"><a href=\"login.php\">LOGIN</a></li>";
                    ?>
                </ul>
            </nav>
        </header>
        <div id="main">
            <form name="logout" action="../_phps/logout.php">
                <input class="button" type="submit" value="LOGOUT"/>
            </form>
        </div>
    </body>
</html>
