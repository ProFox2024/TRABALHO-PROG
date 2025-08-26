-- Banco de dados para sistema de login + lista de livros
-- phpMyAdmin SQL Dump
-- versão 5.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `Trabalho_Livros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Trabalho_Livros`;


CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `livros` (
  `idLivro` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `capa` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `livros`
  ADD PRIMARY KEY (`idLivro`);

ALTER TABLE `livros`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `livros` (`titulo`, `capa`) VALUES
('O Senhor dos Anéis', 'https://exemplo.com/capas/senhor_dos_aneis.jpg'),
('Harry Potter e a Pedra Filosofal', 'https://exemplo.com/capas/harry_potter1.jpg'),
('O Hobbit', 'https://exemplo.com/capas/o_hobbit.jpg'),
('As Crônicas de Nárnia', 'https://exemplo.com/capas/cronicas_narnia.jpg'),
('1984', 'https://exemplo.com/capas/1984.jpg'),
('A Revolução dos Bichos', 'https://exemplo.com/capas/revolucao_bichos.jpg'),
('O Código Da Vinci', 'https://exemplo.com/capas/codigo_davinci.jpg'),
('Inferno', 'https://exemplo.com/capas/inferno.jpg'),
('O Pequeno Príncipe', 'https://exemplo.com/capas/pequeno_principe.jpg'),
('Dom Casmurro', 'https://exemplo.com/capas/dom_casmurro.jpg'),
('Memórias Póstumas de Brás Cubas', 'https://exemplo.com/capas/memorias_postumas.jpg'),
('A Menina que Roubava Livros', 'https://exemplo.com/capas/menina_roubava_livros.jpg'),
('O Alquimista', 'https://exemplo.com/capas/alquimista.jpg'),
('Cem Anos de Solidão', 'https://exemplo.com/capas/cem_anos_solidao.jpg'),
('O Nome do Vento', 'https://exemplo.com/capas/nome_do_vento.jpg'),
('A Guerra dos Tronos', 'https://exemplo.com/capas/guerra_dos_tronos.jpg'),
('O Silmarillion', 'https://exemplo.com/capas/silmarillion.jpg'),
('It - A Coisa', 'https://exemplo.com/capas/it_a_coisa.jpg'),
('O Iluminado', 'https://exemplo.com/capas/iluminado.jpg'),
('Orgulho e Preconceito', 'https://exemplo.com/capas/orgulho_preconceito.jpg');

CREATE TABLE `livrosFavoritos` (
  `idLivro` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idFavorito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `livrosFavoritos`
  ADD PRIMARY KEY (`idFavorito`);

ALTER TABLE `livrosFavoritos`
  MODIFY `idFavorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `livrosFavoritos`
  ADD CONSTRAINT `livrosFavoritos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

ALTER TABLE `livrosFavoritos`
  ADD CONSTRAINT `livrosFavoritos_ibfk_2` FOREIGN KEY (`idLivro`) REFERENCES `livros` (`idLivro`);

COMMIT;