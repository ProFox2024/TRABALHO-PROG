<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header("location:index.php");
}
require_once __DIR__."/vendor/autoload.php";

// ALTERADO: Agora busca apenas os livros que o usuário AINDA NÃO favoritou
$livros = Livro::findNaoFavoritadosPorUsuario($_SESSION['idUsuario']);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styleRestrita.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página dos Livros</title>
</head>
<body>
 <div class="container">
        <table>
            <br>
            <tr><h1>Lista Geral</h1></tr>
            <br>
            <?php
            foreach ($livros as $livro) {
                echo "<tr>";
                echo "<td>" . $livro->getTitulo() . "</td>";
                echo "<td>
                        <form action='adicionarFavorito.php' method='post'>
                            <input type='hidden' name='idLivro' value='" . $livro->getidLivro() . "'>
                            <button type='submit'>Favoritar</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>

        </table>
        <a href='sair.php'>Sair</a>
        <a href='Favoritos.php'>Favoritos</a>
    </div>
</body>
</html>




