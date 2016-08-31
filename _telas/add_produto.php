<?php
    include "../_model/Produto.php";
    include "../_model/Imagem.php";
    include "../_model/Mercado.php";
    include "../_model/Categoria.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../_css/index.css">
        <script language=\"javascript\" src=\"../_js/visualizar_produto.js\"></script>
    </head>
    <body onload="carregarVisualizador(0)">
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
            <div id="add_produto">
                <form name="add_produto" method="post" action="../_phps/addProduto.php">
                    <?php
                        $produto = new Produto();
                        if(isset($_SESSION["alt_produto"]))
                        {
                            if($_SESSION["alt_produto"] != FALSE)
                                $produto = $_SESSION["alt_produto"];
                        }
                    ?>

                    <div class="campos_novo_produto">
                        <img class="novo_produto" src="<?= $produto->getImagem() != null ? $produto->getImagem()->getCaminho() : "" ?>" id="imgProduto"></igm><br>
                        <input type="button" class="button_img" value="Procurar Imagem" id="btnProcurarImagem"/>
                        <input type="file" class="button_img" value="Carregar Imagem" id="btnCarregarImagem" onchange="carregarImagem()"/>
                    </div>
                    <div class="campos_novo_produto">
                        Nome<br>
                        <input type="text" id="txtNome" class="text_login" value="<?= $produto->getNome() ?>"/><br>
                        Quantidade<br>
                        <input type="number" id="txtQuantidade" class="text_login" min="1" value="<?= ($produto->getNome() == "") ?  "" : $produto->getQuantidade() ?>"><br>
                        Peso<br>
                        <input type="text" id="txtPeso" class="text_login" value="<?= ($produto->getNome() == "") ?  "" : $produto->getPeso() ?>"/><br>
                        Preço<br>
                        <input type="text" id="txtPreco" class="text_login" value="<?= ($produto->getNome() == "") ?  "" : $produto->getPreco() ?>"/><br>
                        Validade<br>
                        <input type="date" id="txtValidade" class="text_login" value="<?= ($produto->getNome() == "") ?  "" : $produto->getValidade() ?>"/><br>
                        Categoria<br>
                        <select id="sltCategoria" <?= $produto->getCategoria() != null ? "value='".$produto->getCategoria()->getId()."'" : '' ?> >
                            <?php
                                include "../_dao/CategoriaDAO.php";
                                $categoriaDAO = new CategoriaDAO();
                                $categorias = $categoriaDAO->listar();

                                foreach ($categorias as $key => $value)
                                    echo "<option value=\"".$value->getId()."\">".$value->getNome()."</option>";
                            ?>
                        </select>
                    </div>
                    Descrição<br>
                    <textarea id="txtDescricao" cols="50" rows="3"><?= $produto->getDescricao() ?></textarea>
                    <div class="btn_add">
                        <input id="btn_add" type="button" value="<?= ($produto->getNome() != "") ? "Alterar" : "Adicionar" ?>" name="btnAdd" class="button" <?= ($produto->getNome() != "") ? "onclick=\"btnAlterar(".$_SESSION["id_alt"].")\"" : "onclick=\"carregarVisualizador(1)\"" ?>/>
                        <input id="btn_limpar" type="<?= ($produto->getNome() != "") ? "button" : "reset" ?>" value="<?= ($produto->getNome() != "") ? "Cancelar" : "Limpar" ?>" name="btnClear" class="button" <?= ($produto->getNome() != "") ? "onclick=\"btnCancelar()\"" : "" ?> />
                    </div>
                </form>
            </div>
            <div id="menu">
                <form name="menu" action="../_phps/salvar_produtos.php">
                    <input id="btnSalvar" type="submit" value="Salvar" class="button" name="btnSalvar"/>
                </form>
            </div>
            <div id="visualizar_produto">
                <!-- MOSTRA TODOS OS PRODUTOS ADD QUE SERÃO SALVOS NO BD -->
            </div>
        </div>
        <div id="rodape">
            teste
        </div>
        <script language="javascript" src="../_js/add_produto.js"></script>
    </body>
</html>
