<?php
session_start();

if (!isset($_SESSION['idUsuario']) || !isset($_POST['idFavorito'])) {
    header("location:index.php");
    exit;
}

require_once __DIR__ . "/vendor/autoload.php";

$favorito = LivroFavorito::find($_POST['idFavorito']);

// Acessa o ID do usuário usando o método público getIdUsuario()
if ($favorito && $favorito->getIdUsuario() == $_SESSION['idUsuario']) {
    $favorito->delete();
}

header("location:Favoritos.php");
exit;