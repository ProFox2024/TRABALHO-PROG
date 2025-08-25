<?php
session_start();
if (!isset($_SESSION['idUsuario']) || !isset($_POST['idLivro'])) {
    header("location:index.php");
    exit;
}
require_once __DIR__ . "/vendor/autoload.php";
$livroOriginal = Livro::find($_POST['idLivro']);

// Verifique se o livro foi encontrado antes de continuar
if ($livroOriginal) {
    // Crie uma nova instância de LivroFavorito, passando idUsuario e idLivro
    $favorito = new LivroFavorito($_SESSION['idUsuario'], $livroOriginal->getidLivro());
    $favorito->save();
}
header("location:restrita.php");
exit;