<?php
    include_once "../_dao/ProdutoDAO.php";
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
            <?php
                if(isset($_SESSION["login"]))
                {
                    $mercado = $_SESSION["login"];
                    $produtoDAO = new ProdutoDAO();

                    $produtos  = $produtoDAO->listarPorMercado($mercado);

                    if($produtos[0] == null)
                    {
                        echo "<p id=\"msg_not_produto\">Você não possui nenhum produto cadastrado ainda. Comece a montar seu mercado<br><div  id=\"cadastrar_produto\"><a id=\"aqui\" href=\"add_produto.php\">[AQUI]</a></div></p>";
                    }
                    else
                    {
                        echo "<div id=\"menu_produto\"><input id=\"add_produto\"type=\"button\" class=\"button_menu\" value=\"Adicionar mais produtos\"></div>";

                        foreach ($produtos as $key => $value)
                        {
                            echo "<div class=\"produto1\">";
                            echo "<div class=\"produto_1\">";
                            echo "<img class=\"img_produtos\" src=\"\"></img>";
                            echo "<div class=\"dados\">";
                            echo "Nome:<label id=\"nome".$key."\" class=\"lbl_produto\">".$value->getNome()."</label><br>";
                            echo "Peso:<label id=\"peso".$key."\" class=\"lbl_produto\">".$value->getPeso()."</label><br>";
                            echo "Validade:<label id=\"validade".$key."\" class=\"lbl_produto\">".$value->getValidade()."</label><br>";
                            echo "Preço:<label id=\"preco".$value->getPreco()."\" class=\"lbl_produto\">".$value->getPreco()."</label>R$<br>";
                            echo "Categoria:<label id=\"categoria".$key."\" class=\"lbl_produto\">".$value->getCategoria()->getNome()."</label><br>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class=\"descricao\">";
                            echo "Descricao:<label id=\"descricao".$key."\" class=\"lbl_produto\">".$value->getDescricao()."</label>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
                else
                {
                    # pedir login novamente
                }
            ?>
        </div>
        <script language="javascript" src="../_js/produtos.js"></script>
    </body>
</html>
