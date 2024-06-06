-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/05/2024 às 21:35
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
-- Banco de dados: `sevengardens`
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
(1, 1, 'Rua Exemplo', '123', 'Apt 456', 'Centro', 'Cidade Exemplo', 'EX', '12345-678'),
(2, 2, 'Avenida Lagoa Formosa', '13', 'Casa 13 - Condomínio', 'Inhoaíba', 'Rio de Janeiro', 'RJ', '23062080');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `idEstoque` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`idEstoque`, `idProduto`, `quantidade`) VALUES
(1, 1, 30),
(2, 2, 30),
(3, 3, 1),
(4, 4, 1),
(5, 5, 20),
(6, 6, 30),
(7, 7, 20);

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

--
-- Despejando dados para a tabela `pergunta_secreta`
--

INSERT INTO `pergunta_secreta` (`id`, `pergunta`, `resposta`, `id_usuario`) VALUES
(1, 'Qual o nome da sua mãe?', 'Elcilene do Nascimento de Souza', 2),
(2, 'Qual a data do seu nascimento?', '2004-06-07', 2),
(3, 'Qual a data do seu nascimento?', '2000-01-01', 1),
(4, 'Qual o CEP do seu endereço?', '23062080', 2),
(5, 'Qual o CEP do seu endereço?', '12345-678', 1);

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
(1, 'Rosa do Deserto He Feng', 50.00, 'Rosa do deserto importada, produtora Rose Chen. Muito florífera e exótica.', 'Enxertos', 'Dobradas', 'Front-end/img-produtos/IMG_20240317_000413.jpg'),
(2, 'Rosa do Deserto Star Cluster', 50.00, 'Rosa do deserto singela, amarela com fundo vermelho.', 'Enxertos', 'Singelas', 'Front-end/img-produtos/IMG_20240316_235300.jpg'),
(3, 'Rosa do Deserto Felipa', 50.00, 'Rosa do deserto singela e de semente, única.', 'Naturais (De semente)', 'Singelas', 'Front-end/img-produtos/IMG_20240317_001651.jpg'),
(4, 'Rosa do Deserto Ephygenia', 60.00, 'Rosa do Deserto singela de semente, única.', 'Naturais (De semente)', 'Singelas', 'Front-end/img-produtos/IMG_20240317_001732.jpg'),
(5, 'Rosa do Deserto Chocolate Especial (Lm)', 50.00, 'Rosa do deserto enxertada, produtor LM.', 'Enxertos', 'Singelas', 'Front-end/img-produtos/IMG_20240316_235636.jpg'),
(6, 'Rosa do Deserto Golden Faith (Perfumada)', 35.00, 'Rosa do deserto enxertada e perfumada.', 'Enxertos', 'Multipétalas', 'Front-end/img-produtos/IMG_20240316_235103.jpg'),
(7, 'Rosa do Deserto Escarlate (Cor Vibrante)', 50.00, 'Rosa do deserto enxertada, cor vibrante.', 'Enxertos', 'Dobradas', 'Front-end/img-produtos/IMG_20240317_002316.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tentativas_login`
--

CREATE TABLE `tentativas_login` (
  `id` int(11) NOT NULL,
  `data_tentativa` datetime NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Admin Master', '2000-01-01', 'N', 'Nome Materno Padrão', '00000000000', 'admin@example.com', '0000000000', 'adminM', '$2y$10$ovrTi3hoKCvKGzIwDegcaeqfxDESmtc2Qa9t1./KPwSK8M5DAKjqy', 'Master', 1),
(2, 'Felipe Nascimento de Souza', '2004-06-07', 'Homem cisgênero', 'Elcilene do Nascimento de Souza', '197.234.007-74', 'fn23886@gmail.com', '(21) 97539-', 'felipe', '$2y$10$mF0Iixa4DFgTE22GxH57.e9WxaMt28UAv.lkDP.Qfs7uxnc08tyhO', 'Cliente', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `idVenda` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `dataVenda` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco_completo`
--
ALTER TABLE `endereco_completo`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `endereco_completo_ibfk_1` (`idUsuario`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`idEstoque`),
  ADD KEY `estoque_ibfk_1` (`idProduto`);

--
-- Índices de tabela `historico_login`
--
ALTER TABLE `historico_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historico_login_ibfk_1` (`id_usuario`),
  ADD KEY `historico_login_ibfk_2` (`id_pergunta_secreta`);

--
-- Índices de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_pedido_ibfk_1` (`id_produto`),
  ADD KEY `item_pedido_ibfk_2` (`id_pedido`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `pedido_ibfk_1` (`id_cliente`);

--
-- Índices de tabela `pergunta_secreta`
--
ALTER TABLE `pergunta_secreta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_secreta_ibfk_1` (`id_usuario`);

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
  ADD KEY `tentativas_login_ibfk_1` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `vendas_ibfk_2` (`idProduto`),
  ADD KEY `vendas_ibfk_1` (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco_completo`
--
ALTER TABLE `endereco_completo`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `idEstoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `historico_login`
--
ALTER TABLE `historico_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tentativas_login`
--
ALTER TABLE `tentativas_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idVenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco_completo`
--
ALTER TABLE `endereco_completo`
  ADD CONSTRAINT `endereco_completo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`);

--
-- Restrições para tabelas `historico_login`
--
ALTER TABLE `historico_login`
  ADD CONSTRAINT `historico_login_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `historico_login_ibfk_2` FOREIGN KEY (`id_pergunta_secreta`) REFERENCES `pergunta_secreta` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `pergunta_secreta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tentativas_login`
--
ALTER TABLE `tentativas_login`
  ADD CONSTRAINT `tentativas_login_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;