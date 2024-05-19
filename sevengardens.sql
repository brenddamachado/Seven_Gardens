-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/05/2024 às 20:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sevengardens` < Crie o banco com esse nome e importe o script
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco_completo`
--

CREATE TABLE `endereco_completo` (
  `idEndereco` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco_completo`
--

INSERT INTO `endereco_completo` (`idEndereco`, `idUsuario`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(8, 2, 'Rua Micronesia', '195', 'Rua dois 31', 'Campo Grande', 'Rio de Janeiro', 'RJ', '23015070'),
(9, 3, 'Rua Micronesia', '195', 'Rua dois 31', 'Campo Grande', 'Rio de Janeiro', 'RJ', '23015070'),
(10, 4, 'Rua Micronesia', '195', 'Rua dois 31', 'Campo Grande', 'Rio de Janeiro', 'RJ', '23015070');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_login`
--

CREATE TABLE `historico_login` (
  `id` int(11) NOT NULL,
  `horarioLogin` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pergunta_secreta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `horarioPedido` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pergunta_secreta`
--

CREATE TABLE `pergunta_secreta` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(255) NOT NULL,
  `resposta` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `subcategoria` varchar(50) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `nome`, `preco`, `descricao`, `categoria`, `subcategoria`, `imagem`) VALUES
(4, 'Rosa do Deserto Star Cluster', 50.00, 'Rosa do deserto singela na cor amarela com vermelho.', 'singelas', 'Enxerto', 'Front-end/img-produtos/IMG_20240316_235300.jpg'),
(5, 'Rosa do Deserto Nusa', 50.00, 'Multipétalas amarela', 'dobradas', 'Enxerto', 'Front-end/img-produtos/IMG_20240316_235200.jpg'),
(6, 'Rosa do Deserto Felipa', 50.00, 'Singela natural de semente.', 'singelas', 'Semente', 'Front-end/img-produtos/IMG_20240317_001651.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tentativas_login`
--

CREATE TABLE `tentativas_login` (
  `id` int(11) NOT NULL,
  `data_tentativa` datetime NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tentativas_login`
--

INSERT INTO `tentativas_login` (`id`, `data_tentativa`, `id_usuario`) VALUES
(43, '2024-05-13 21:03:53', 0),
(44, '2024-05-15 09:38:55', 2),
(45, '2024-05-15 10:44:28', 2),
(46, '2024-05-15 10:49:03', 2),
(47, '2024-05-15 10:50:57', 2),
(48, '2024-05-15 10:53:39', 1),
(49, '2024-05-15 10:54:11', NULL),
(50, '2024-05-15 10:54:12', NULL),
(51, '2024-05-15 10:54:12', NULL),
(52, '2024-05-15 10:54:12', NULL),
(53, '2024-05-15 10:54:30', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome_completo` varchar(80) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(20) NOT NULL,
  `nome_materno` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone_celular` varchar(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('Cliente','Colaborador','Master') NOT NULL,
  `ativado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome_completo`, `data_nascimento`, `sexo`, `nome_materno`, `cpf`, `email`, `telefone_celular`, `user_name`, `senha`, `tipo_usuario`, `ativado`) VALUES
(1, 'Admin Master', '2000-01-01', 'N', 'Nome Materno Padrão', '00000000000', 'admin@example.com', '0000000000', 'adminM', '$2y$10$6jwEU6QZKUYvPCxY9hxiWONWgfSa9YlEAKYNIto9EXbCPA.bpsDtC', 'Master', 1),
(2, 'Ingridy da Silva Sousa', '2024-05-13', 'Mulher cisgênero', 'Evaneide Torres da Silva', '011.675.811-21', 'yume_owned@hotmail.com', '(21) 98151-', 'aaaaaa', '$2y$10$4uudBhMyFJVA8ATpaHqthe7jRbQQL.iLFRGcKom507GTv4npnC3O6', 'Cliente', 1),
(3, 'Brenda da Silva Sousa', '1992-03-09', 'Mulher cisgênero', 'Zanza Mae da Brenda', '011.675.811-21', 'brenda@hotmail.com', '(21) 98151-', 'bbbbbb', '$2y$10$mGyobKnv2wGACCg9INRNy..Hgf6IpHtJ1cMYwCwDEizXhTS6ZaxcO', 'Cliente', 1),
(4, 'Usuario de teste teste ', '1992-03-09', 'Homem cisgênero', 'mae do usuario teste ', '163.477.407-88', 'testedabrenda@hotmail.com', '(21) 98151-', 'pppppp', '$2y$10$prXXun3xCvBFvsJCjQjCGeO5cymEfUx98WVfJf5kmo7PYgqH7pb6u', 'Cliente', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco_completo`
--
ALTER TABLE `endereco_completo`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `historico_login`
--
ALTER TABLE `historico_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`id_usuario`),
  ADD KEY `id_pergunta_secreta` (`id_pergunta_secreta`);

--
-- Índices de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `pergunta_secreta`
--
ALTER TABLE `pergunta_secreta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices de tabela `tentativas_login`
--
ALTER TABLE `tentativas_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco_completo`
--
ALTER TABLE `endereco_completo`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `historico_login`
--
ALTER TABLE `historico_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pergunta_secreta`
--
ALTER TABLE `pergunta_secreta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tentativas_login`
--
ALTER TABLE `tentativas_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco_completo`
--
ALTER TABLE `endereco_completo`
  ADD CONSTRAINT `endereco_completo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `historico_login`
--
ALTER TABLE `historico_login`
  ADD CONSTRAINT `historico_login_ibfk_1` FOREIGN KEY (`id_pergunta_secreta`) REFERENCES `pergunta_secreta` (`id`);

--
-- Restrições para tabelas `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`idProduto`),
  ADD CONSTRAINT `item_pedido_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`idPedido`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `pergunta_secreta`
--
ALTER TABLE `pergunta_secreta`
  ADD CONSTRAINT `pergunta_secreta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `tentativas_login`
--
ALTER TABLE `tentativas_login`
  ADD CONSTRAINT `tentativas_login_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
