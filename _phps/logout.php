<?php
    session_start();
    if(isset($_SESSION["login"]))
        $_SESSION["login"] = FALSE;
    if(isset($_SESSION["add_produtos"]))
        $_SESSION["add_produtos"] = FALSE;
    if(isset($_SESSION["id_add_produtos"]))
        $_SESSION["id_add_produtos"] = FALSE;
    if(isset($_SESSION["salvar_produto"]))
        $_SESSION["salvar_produto"] = FALSE;
    if(isset($_SESSION["alt_produto"]))
        $_SESSION["alt_produto"] = FALSE;
    if(isset($_SESSION["id_alt"]))
        $_SESSION["id_alt"] = FALSE;
    header("Location: ../index.php");
?>
