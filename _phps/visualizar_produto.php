<?php
    include "../_model/Produto.php";
    include "../_model/Imagem.php";
    include "../_dao/CategoriaDAO.php";
    session_start();

    if(!isset($_SESSION["add_produtos"]))
    {
        $produtos = array();
        $_SESSION["add_produtos"] = $produtos;
        $_SESSION["id_add_produtos"] = 0;
        $_SESSION["salvar_produto"] = true;
    }

    $id = $_SESSION["id_add_produtos"];
    $produtos = $_SESSION["add_produtos"];

    if($_POST["status"] == 1)
    {
        $produto = new Produto($_POST["nome"], $_POST["peso"], $_POST["validade"], $_POST["quantidade"], $_POST["preco"], new Imagem($_POST["imagem"], null), CategoriaDAO::listarPorId(new Categoria($_POST["categoria"], "", "", "")), $_POST["descricao"], $_SESSION["login"]);

        $produtos[$id] = $produto;
        $_SESSION["id_add_produtos"] = $id + 1;
        $_SESSION["add_produtos"] = $produtos;
    }
    else if($_POST["status"] == 2)
    {
        $produto = new Produto($_POST["nome"], $_POST["peso"], $_POST["validade"], $_POST["quantidade"], $_POST["preco"], new Imagem($_POST["imagem"], null), CategoriaDAO::listarPorId(new Categoria($_POST["categoria"], "", "", "")), $_POST["descricao"], $_SESSION["login"]);

        $produtos[$_POST["id"]] = $produto;
        $_SESSION["add_produtos"] = $produtos;

        $_SESSION["alt_produto"] = FALSE;
        $_SESSION["id_alt"] = FALSE;
    }

    if($_SESSION["add_produtos"] != FALSE)
    {
        foreach ($_SESSION["add_produtos"] as $key => $value)
        {
            if($value != null)
            {
                if($value->getCategoria() != null)
                {
                    echo "<div class=\"produto\">";
                    echo "<img class=\"img_visualizador\" src=\"".$value->getImagem()->getCaminho()."\"></img>";
                    echo "<div class=\"dados_produto\">";
                    echo "Nome: ".$value->getNome()."<br>";
                    echo "Quantidade: ".$value->getQuantidade()."<br>";
                    echo "Peso: ".$value->getPeso()."<br>";
                    echo "Preço: ".$value->getPreco()."<br>";
                    echo "Validade: ".$value->getValidade()."<br>";
                    echo "Categoria: ".$value->getCategoria()->getNome()."<br>";
                    echo "Descrição: ".$value->getDescricao()."<br>";
                    echo "</div>";
                    echo "<div class=\"btns_visuzalizar\">";
                    echo "<input type=\"button\" class=\"btn_visuzalizar\" value=\"A\" id=\"btnAlterar".$key."\" onclick=\"btnClick(".$key.", 0)\"/><br>";
                    echo "<input type=\"button\" class=\"btn_visuzalizar\" value=\"R\" id=\"btnRetirar".$key."\" onclick=\"btnClick(".$key.", 1
                    )\"/>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
    }
?>
