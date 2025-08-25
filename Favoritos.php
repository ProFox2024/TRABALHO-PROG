<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header("location:index.php");
    exit;
}

require_once __DIR__ . "/vendor/autoload.php";

// Busca os livros favoritos por este usuário
$livrosFavoritos = LivroFavorito::findByUsuario($_SESSION['idUsuario']);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styleRestrita.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Favoritos</title>
</head>
<body>
    <div class="container">
        <table>
            <br>
            <tr><h1>Favoritos</h1></tr>
            <br>
            <?php
            // Loop para exibir cada livro favorito
            foreach ($livrosFavoritos as $favorito) {
                // Encontra o objeto Livro correspondente usando o ID do favorito
                $livro = Livro::find($favorito->getIdLivro());

                // Se o livro for encontrado, exibe o título
                if ($livro) {
                    echo "<tr>";
                    echo "<td>" . $livro->getTitulo() . "</td>";
                    echo "<td>
                        <form action='removerFavorito.php' method='post'>
                            <input type='hidden' name='idFavorito' value='" . $favorito->getIdFavorito() . "'>
                            <button type='submit'>Remover</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <a href='restrita.php'>Voltar</a>
    </div>
</body>
</html>