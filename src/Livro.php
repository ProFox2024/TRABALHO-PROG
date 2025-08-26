<?php

class Livro implements ActiveRecord {

    private int $idLivro;

    public function __construct(private string $titulo, private string $capa) {}

    public function setIdLivro(int $idLivro): void {
        $this->idLivro = $idLivro;
    }

    public function getIdLivro(): int {
        return $this->idLivro;
    }

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function setCapa(string $capa): void {
        $this->capa = $capa;
    }

    public function getCapa(): string {
        return $this->capa;
    }

    /**
     * ADICIONADO: Método que busca os livros que o usuário ainda não favoritou.
     * @param int $idUsuario O ID do usuário para o qual os livros não favoritados serão buscados.
     * @return array Um array de objetos Livro que o usuário ainda não favoritou.
     */
    public static function findNaoFavoritadosPorUsuario(int $idUsuario): array {
        $sql = "SELECT l.idLivro, l.titulo, l.capa FROM livros l
                LEFT JOIN livrosFavoritos lf ON l.idLivro = lf.idLivro AND lf.idUsuario = {$idUsuario}
                WHERE lf.idFavorito IS NULL";
        
        $conexao = new MySQL();
        $resultados = $conexao->consulta($sql);

        $livros_result = [];
        foreach ($resultados as $resultado) {
            $l = new Livro($resultado['titulo'], $resultado['capa']);
            $l->setIdLivro($resultado['idLivro']);
            $livros_result[] = $l;
        }
        return $livros_result;
    }

    // Salvar (INSERT ou UPDATE)
    public function save(): bool {
        $conexao = new MySQL();
        if (isset($this->idLivro)) {
            $sql = "UPDATE livros SET titulo = '{$this->titulo}', capa = '{$this->capa}' WHERE idLivro = {$this->idLivro}";
        } else {
            $sql = "INSERT INTO livros (titulo, capa) VALUES ('{$this->titulo}', '{$this->capa}')";
        }
        return $conexao->executa($sql);
    }

    // Buscar por ID
    public static function find($idLivro): Livro {
        $conexao = new MySQL();
        $sql = "SELECT * FROM livros WHERE idLivro = {$idLivro}";
        $resultado = $conexao->consulta($sql);
        
        if (count($resultado) === 0) {
            throw new Exception("Livro não encontrado.");
        }
        
        $l = new Livro($resultado[0]['titulo'], $resultado[0]['capa']);
        $l->setIdLivro($resultado[0]['idLivro']);
        return $l;
    }

    // Deletar
    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM livros WHERE idLivro = {$this->idLivro}";
        return $conexao->executa($sql);
    }

    // Listar todos os livros
    public static function findAll(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM livros";
        $resultados = $conexao->consulta($sql);
        $livros_result = array();
        foreach ($resultados as $resultado) {
            $l = new Livro($resultado['titulo'], $resultado['capa']);
            $l->setIdLivro($resultado['idLivro']);
            $livros_result[] = $l;
        }
        return $livros_result;
    }
}