<?php
    include_once "../_dao/MercadoDAO.php";
    session_start();

    $login = $_POST["txtLogin"];
    $senha = $_POST["txtSenha"];

    $mercado = new Mercado('', '', '', '', '', '', '', '', '', '', '', '', '', '', $login, $senha);

    $mercadoDAO = new MercadoDAO();

    $_SESSION["login"] = $mercadoDAO->verificaLogin($mercado);

    $url = "../";
    if($_SESSION["login"] != null)
        $url .= "index.php";
    else
        $url .= "login.php";

    header("Location: ".$url);
?>
