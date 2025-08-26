<?php
class LivroFavorito implements ActiveRecord {
    private int $idFavorito;
    private int $idUsuario;
    private int $idLivro;
    
    // Construtor
    public function __construct(int $idUsuario = null, int $idLivro = null) {
        $this->idUsuario = $idUsuario;
        $this->idLivro = $idLivro;
    }

    // Métodos Getters e Setters
    public function getIdFavorito(): int {
        return $this->idFavorito;
    }
    
    public function setIdFavorito(int $idFavorito): void {
        $this->idFavorito = $idFavorito;
    }
    
    public function getIdUsuario(): int {
        return $this->idUsuario;
    }
    
    public function setIdUsuario(int $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    public function getIdLivro(): int {
        return $this->idLivro;
    }
    
    public function setIdLivro(int $idLivro): void {
        $this->idLivro = $idLivro;
    }
    
    // Método para salvar um novo favorito
    public function save(): bool {
        $conexao = new MySQL();
        $sql = "INSERT INTO livrosFavoritos (idUsuario, idLivro) VALUES ('{$this->idUsuario}', '{$this->idLivro}')";
        return $conexao->executa($sql);
    }
    
    // Método para deletar um favorito
    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM livrosFavoritos WHERE idFavorito = {$this->idFavorito}";
        return $conexao->executa($sql);
    }
    
    // Método para encontrar por ID
    public static function find($idFavorito): self {
        $conexao = new MySQL();
        $sql = "SELECT * FROM livrosFavoritos WHERE idFavorito = {$idFavorito}";
        $resultado = $conexao->consulta($sql);

        if (count($resultado) === 0) {
            throw new Exception("Favorito não encontrado.");
        }
        
        $favorito = new LivroFavorito($resultado[0]['idUsuario'], $resultado[0]['idLivro']);
        $favorito->setIdFavorito($resultado[0]['idFavorito']);
        return $favorito;
    }
    
    // Método para encontrar todos
    public static function findAll(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM livrosFavoritos";
        $resultados = $conexao->consulta($sql);
        $favoritos_result = [];
        foreach ($resultados as $resultado) {
            $f = new LivroFavorito($resultado['idUsuario'], $resultado['idLivro']);
            $f->setIdFavorito($resultado['idFavorito']);
            $favoritos_result[] = $f;
        }
        return $favoritos_result;
    }
    
    // Método para encontrar por usuário
    public static function findByUsuario($idUsuario) {
        $conexao = new MySQL();
        $sql = "SELECT * FROM livrosFavoritos WHERE idUsuario = {$idUsuario}";
        $resultados = $conexao->consulta($sql);
        $favoritos_result = [];
        foreach ($resultados as $resultado) {
            $f = new LivroFavorito($resultado['idUsuario'], $resultado['idLivro']);
            $f->setIdFavorito($resultado['idFavorito']);
            $favoritos_result[] = $f;
        }
        return $favoritos_result;
    }
}