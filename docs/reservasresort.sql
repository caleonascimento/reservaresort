-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Ago-2022 às 14:53
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `reservasresort`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_grupo`
--

CREATE TABLE `acesso_grupo` (
  `id_grupo` int(11) NOT NULL COMMENT 'ID',
  `id_grupo_pai` int(11) DEFAULT NULL COMMENT 'Grupo Pai',
  `nome` varchar(150) NOT NULL DEFAULT '' COMMENT 'Nome',
  `ativo` smallint(1) DEFAULT 1 COMMENT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Grupo de Usuários' ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `acesso_grupo`
--

INSERT INTO `acesso_grupo` (`id_grupo`, `id_grupo_pai`, `nome`, `ativo`) VALUES
(1, NULL, 'Administrador', 1),
(2, NULL, 'Servidor', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_grupo_usuario`
--

CREATE TABLE `acesso_grupo_usuario` (
  `id_grupo_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `inserido_por` varchar(255) DEFAULT NULL,
  `alterado_por` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `acesso_grupo_usuario`
--

INSERT INTO `acesso_grupo_usuario` (`id_grupo_usuario`, `id_grupo`, `id_usuario`, `inserido_por`, `alterado_por`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_log`
--

CREATE TABLE `acesso_log` (
  `id_log` int(11) NOT NULL COMMENT 'Acesso',
  `usuario` varchar(100) DEFAULT NULL COMMENT 'Usuario',
  `tabela` varchar(100) DEFAULT NULL COMMENT 'Tabela',
  `operacao` varchar(100) DEFAULT NULL COMMENT 'Operacao',
  `data_log` datetime DEFAULT NULL COMMENT 'DataLog',
  `descricao` longtext DEFAULT NULL COMMENT 'Descricao',
  `sql_descricao` text DEFAULT NULL COMMENT 'SqlDescricao',
  `ativo` tinyint(1) DEFAULT NULL COMMENT 'Ativo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Log' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_modulo_transacao`
--

CREATE TABLE `acesso_modulo_transacao` (
  `id_modulo_transacao` int(11) NOT NULL COMMENT 'Id',
  `id_modulo_transacao_0` int(11) DEFAULT NULL COMMENT 'Módulo Principal',
  `id_modulo_transacao_pai` int(11) DEFAULT NULL COMMENT 'Pai',
  `nome` varchar(200) NOT NULL COMMENT 'Nome',
  `titulo` varchar(255) NOT NULL COMMENT 'Título',
  `tipo` tinyint(4) NOT NULL COMMENT 'Tipo(Módulo/Url /operação)',
  `menu` tinyint(1) DEFAULT NULL COMMENT 'Menu',
  `inserido_por` varchar(255) DEFAULT NULL COMMENT 'Inserido',
  `alterado_por` varchar(255) DEFAULT NULL COMMENT 'Alterado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Módulo Transação' ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `acesso_modulo_transacao`
--

INSERT INTO `acesso_modulo_transacao` (`id_modulo_transacao`, `id_modulo_transacao_0`, `id_modulo_transacao_pai`, `nome`, `titulo`, `tipo`, `menu`, `inserido_por`, `alterado_por`) VALUES
(1, NULL, NULL, 'admin', 'Area Adinistrativa', 0, NULL, NULL, NULL),
(2, 1, 1, 'acesso', 'Acesso e Permissão', 0, NULL, NULL, NULL),
(3, 1, 2, 'AcessoGrupo', 'Grupos', 1, NULL, NULL, NULL),
(4, 1, 3, 'preparaLista', 'Listar Grupos', 2, NULL, NULL, NULL),
(5, 1, 3, 'preparaFormulario', 'Formulário Grupo', 2, NULL, NULL, NULL),
(6, 1, 5, 'Cadastrar', 'Cadastrar Grupo', 3, NULL, NULL, NULL),
(7, 1, 5, 'Alterar', 'Alterar Grupo', 3, NULL, NULL, NULL),
(8, 1, 5, 'Detalhar', 'Detalhar Grupo', 3, NULL, NULL, NULL),
(9, 1, 3, 'processaFormulario', 'Processa Formulário Grupo', 2, NULL, NULL, NULL),
(10, 1, 9, 'Cadastrar', 'Processa Cadastro Grupo', 3, NULL, NULL, NULL),
(11, 1, 9, 'Alterar', 'Processa Alteração Grupo', 3, NULL, NULL, NULL),
(12, 1, 9, 'Excluir', 'Excluir Grupo', 3, NULL, NULL, NULL),
(13, 1, 2, 'AcessoUsuario', 'Usuários', 1, NULL, NULL, NULL),
(14, 1, 13, 'preparaLista', 'Listar Usuários', 2, NULL, NULL, NULL),
(15, 1, 13, 'preparaFormulario', 'Formulário Usuário', 2, NULL, NULL, NULL),
(16, 1, 15, 'Cadastrar', 'Cadastrar Usuário', 3, NULL, NULL, NULL),
(17, 1, 15, 'Alterar', 'Alterar Usuário', 3, NULL, NULL, NULL),
(18, 1, 15, 'Detalhar', 'Detalhar Usuário', 3, NULL, NULL, NULL),
(19, 1, 13, 'processaFormulario', 'Processa Formulário Usuário', 2, NULL, NULL, NULL),
(20, 1, 19, 'Cadastrar', 'Processa Cadastro Usuário', 3, NULL, NULL, NULL),
(21, 1, 19, 'Alterar', 'Processa Alteração Usuário', 3, NULL, NULL, NULL),
(22, 1, 19, 'Excluir', 'Excluir Usuário', 3, NULL, NULL, NULL),
(23, 1, 2, 'AcessoModuloTransacao', 'Módulos/Transações', 1, NULL, NULL, NULL),
(24, 1, 23, 'preparaLista', 'Listar Módulos/Transações', 2, NULL, NULL, NULL),
(25, 1, 23, 'preparaFormulario', 'Formulário Módulos/Transações', 2, NULL, NULL, NULL),
(26, 1, 25, 'Cadastrar', 'Cadastrar Módulo/Transação', 3, NULL, NULL, NULL),
(27, 1, 25, 'Alterar', 'Alterar Módulo/Transação', 3, NULL, NULL, NULL),
(28, 1, 25, 'Detalhar', 'Detalhar Módulo/Transação', 3, NULL, NULL, NULL),
(29, 1, 23, 'processaFormulario', 'Processa Formulário Módulo/Transação', 2, NULL, NULL, NULL),
(30, 1, 29, 'Cadastrar', 'Processa Cadastro Módulo/Transação', 3, NULL, NULL, NULL),
(31, 1, 29, 'Alterar', 'Processa Alteração Módulo/Transação', 3, NULL, NULL, NULL),
(32, 1, 29, 'Excluir', 'Excluir Módulo/Transação', 3, NULL, NULL, NULL),
(33, 1, 2, 'AcessoPermissaoGrupo', 'Permissão', 1, NULL, NULL, NULL),
(34, 1, 33, 'preparaLista', 'Listar Permissões', 2, NULL, NULL, NULL),
(35, 1, 33, 'preparaFormulario', 'Formulário de Permissão', 2, NULL, NULL, NULL),
(36, 1, 35, 'Cadastrar', 'Cadastrar Permissão', 3, NULL, NULL, NULL),
(37, 1, 35, 'Alterar', 'Alterar Permissão', 3, NULL, NULL, NULL),
(38, 1, 35, 'Detalhar', 'Detalhar Permissão', 3, NULL, NULL, NULL),
(39, 1, 33, 'processaFormulario', 'Processa Formulário de Permissões', 2, NULL, NULL, NULL),
(40, 1, 39, 'Cadastrar', 'Processa Cadastro Permissão', 3, NULL, NULL, NULL),
(41, 1, 39, 'Alterar', 'Processa Alteração Permissão', 3, NULL, NULL, NULL),
(42, 1, 39, 'Excluir', 'Excluir Permissão', 3, NULL, NULL, NULL),
(43, 1, 2, 'AcessoGrupoUsuario', 'Grupo Usuário', 1, NULL, NULL, NULL),
(44, 1, 43, 'processaFormulario', 'Processa Grupo Usuário', 2, NULL, NULL, NULL),
(45, 1, 44, 'Cadastrar', 'Cadastrar Usuario Grupo', 3, NULL, NULL, NULL),
(46, 1, 44, 'Excluir', 'Exclui Usuario Grupo', 3, NULL, NULL, NULL),
(58, 1, 13, 'viewUser', 'Meus Dados', 2, NULL, NULL, NULL),
(59, 1, 13, 'notificacoes', 'Notificações', 2, NULL, NULL, NULL),
(60, 1, 1, 'cotas', 'Cotas', 0, NULL, NULL, NULL),
(61, 1, 60, 'Empreendimento', 'Empreendimentos', 1, NULL, NULL, NULL),
(62, 1, 61, 'preparaLista', 'Listar Empreendimentos', 2, NULL, NULL, NULL),
(63, 1, 61, 'preparaFormulario', 'Formulario', 2, NULL, NULL, NULL),
(64, 1, 63, 'Cadastrar', 'Cadastrar Empreendimento', 3, NULL, NULL, NULL),
(65, 1, 61, 'processaFormulario', 'Processa Formulario', 2, NULL, NULL, NULL),
(66, 1, 65, 'Cadastrar', 'Processa cadastro', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_permissao_grupo`
--

CREATE TABLE `acesso_permissao_grupo` (
  `id_permissao_grupo` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT 0 COMMENT 'Grupo de Usuário',
  `id_modulo_transacao` int(11) NOT NULL DEFAULT 0 COMMENT 'Modulo/Transação',
  `permissao` tinyint(1) DEFAULT NULL COMMENT 'Permissão'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Permissão' ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `acesso_permissao_grupo`
--

INSERT INTO `acesso_permissao_grupo` (`id_permissao_grupo`, `id_grupo`, `id_modulo_transacao`, `permissao`) VALUES
(4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_usuario`
--

CREATE TABLE `acesso_usuario` (
  `id` int(11) NOT NULL COMMENT 'Código Usuário',
  `nome` varchar(255) DEFAULT NULL COMMENT 'Nome',
  `login` varchar(30) NOT NULL COMMENT 'Login',
  `senha` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT 'Senha',
  `email` varchar(300) DEFAULT NULL COMMENT 'E-mail',
  `Geracao` datetime DEFAULT NULL COMMENT 'Gerado em',
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usuário' ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `acesso_usuario`
--

INSERT INTO `acesso_usuario` (`id`, `nome`, `login`, `senha`, `email`, `Geracao`, `ultimo_acesso`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'caleo86@gmail.com', '2022-07-13 18:48:28', '2022-08-01 17:50:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanhantes`
--

CREATE TABLE `acompanhantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` int(15) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `id_reserva_locador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cota`
--

CREATE TABLE `cota` (
  `id` int(11) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empreendimento`
--

CREATE TABLE `empreendimento` (
  `id` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `tipo` int(1) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id` int(11) NOT NULL COMMENT 'id',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'Usuário',
  `tipo` enum('TAREFA','MENSAGEM','ALERTA') DEFAULT NULL COMMENT 'Tipo',
  `mensagem` varchar(500) DEFAULT NULL COMMENT 'Mensagem',
  `visualizada` tinyint(1) DEFAULT NULL COMMENT 'Visualizada?',
  `link` varchar(300) DEFAULT NULL COMMENT 'Link',
  `ativo` tinyint(1) DEFAULT NULL COMMENT 'Ativa?',
  `Geracao` datetime DEFAULT NULL COMMENT 'Criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`id`, `id_usuario`, `tipo`, `mensagem`, `visualizada`, `link`, `ativo`, `Geracao`) VALUES
(1, 1, 'TAREFA', 'Tarefa de teste', 0, NULL, 1, '2021-04-23 14:31:06'),
(2, 1, 'MENSAGEM', 'Mensagem de teste', 1, '?', 1, '2021-04-23 14:35:46'),
(3, 1, 'MENSAGEM', 'The next generation of our icon library + toolkit is coming with more icons, more styles, more services, and more awesome. Pre-order now to get access to our alpha and future releases!', 1, NULL, 1, '2021-04-23 14:36:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva_cota`
--

CREATE TABLE `reserva_cota` (
  `id` int(11) NOT NULL,
  `periodo_ini` date NOT NULL,
  `periodo_fim` date NOT NULL,
  `id_cota` int(11) NOT NULL,
  `locacao` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva_locador`
--

CREATE TABLE `reserva_locador` (
  `id` int(11) NOT NULL,
  `id_reserva_cota` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

CREATE TABLE `unidade` (
  `id` int(11) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `descricao` text DEFAULT NULL,
  `lotacao` int(2) DEFAULT NULL,
  `id_empreendimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(10) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `fone` varchar(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `id_acesso_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acesso_grupo`
--
ALTER TABLE `acesso_grupo`
  ADD PRIMARY KEY (`id_grupo`) USING BTREE,
  ADD KEY `id_grupo_pai` (`id_grupo_pai`) USING BTREE;

--
-- Índices para tabela `acesso_grupo_usuario`
--
ALTER TABLE `acesso_grupo_usuario`
  ADD PRIMARY KEY (`id_grupo_usuario`) USING BTREE,
  ADD UNIQUE KEY `id_grupo_2` (`id_grupo`,`id_usuario`) USING BTREE,
  ADD KEY `id_grupo` (`id_grupo`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Índices para tabela `acesso_log`
--
ALTER TABLE `acesso_log`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Índices para tabela `acesso_modulo_transacao`
--
ALTER TABLE `acesso_modulo_transacao`
  ADD PRIMARY KEY (`id_modulo_transacao`) USING BTREE,
  ADD KEY `id_acesso_pai` (`id_modulo_transacao_pai`) USING BTREE,
  ADD KEY `id_modulo_transacao_0` (`id_modulo_transacao_0`) USING BTREE;

--
-- Índices para tabela `acesso_permissao_grupo`
--
ALTER TABLE `acesso_permissao_grupo`
  ADD PRIMARY KEY (`id_permissao_grupo`) USING BTREE,
  ADD KEY `id_grupo` (`id_grupo`) USING BTREE,
  ADD KEY `id_modulo_transacao` (`id_modulo_transacao`) USING BTREE;

--
-- Índices para tabela `acesso_usuario`
--
ALTER TABLE `acesso_usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `acesso_usuario_ibfk_2` (`login`) USING BTREE,
  ADD UNIQUE KEY `login` (`login`) USING BTREE;

--
-- Índices para tabela `acompanhantes`
--
ALTER TABLE `acompanhantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reserva_locador` (`id_reserva_locador`);

--
-- Índices para tabela `cota`
--
ALTER TABLE `cota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuario` (`id_usuario`),
  ADD KEY `FK_unidade` (`id_unidade`);

--
-- Índices para tabela `empreendimento`
--
ALTER TABLE `empreendimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Índices para tabela `reserva_cota`
--
ALTER TABLE `reserva_cota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cota` (`id_cota`);

--
-- Índices para tabela `reserva_locador`
--
ALTER TABLE `reserva_locador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `FK_reserva_cota` (`id_reserva_cota`);

--
-- Índices para tabela `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empreendimento` (`id_empreendimento`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_acesso_usuario` (`id_acesso_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acesso_grupo`
--
ALTER TABLE `acesso_grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `acesso_grupo_usuario`
--
ALTER TABLE `acesso_grupo_usuario`
  MODIFY `id_grupo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `acesso_log`
--
ALTER TABLE `acesso_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Acesso';

--
-- AUTO_INCREMENT de tabela `acesso_modulo_transacao`
--
ALTER TABLE `acesso_modulo_transacao`
  MODIFY `id_modulo_transacao` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `acesso_permissao_grupo`
--
ALTER TABLE `acesso_permissao_grupo`
  MODIFY `id_permissao_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `acesso_usuario`
--
ALTER TABLE `acesso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código Usuário', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `acompanhantes`
--
ALTER TABLE `acompanhantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cota`
--
ALTER TABLE `cota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empreendimento`
--
ALTER TABLE `empreendimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `reserva_cota`
--
ALTER TABLE `reserva_cota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reserva_locador`
--
ALTER TABLE `reserva_locador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acesso_grupo`
--
ALTER TABLE `acesso_grupo`
  ADD CONSTRAINT `acesso_grupo_ibfk_1` FOREIGN KEY (`id_grupo_pai`) REFERENCES `acesso_grupo` (`id_grupo`);

--
-- Limitadores para a tabela `acesso_grupo_usuario`
--
ALTER TABLE `acesso_grupo_usuario`
  ADD CONSTRAINT `acesso_grupo_usuario_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `acesso_grupo` (`id_grupo`),
  ADD CONSTRAINT `acesso_grupo_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `acesso_usuario` (`id`);

--
-- Limitadores para a tabela `acesso_modulo_transacao`
--
ALTER TABLE `acesso_modulo_transacao`
  ADD CONSTRAINT `acesso_modulo_transacao_ibfk_1` FOREIGN KEY (`id_modulo_transacao_pai`) REFERENCES `acesso_modulo_transacao` (`id_modulo_transacao`),
  ADD CONSTRAINT `acesso_modulo_transacao_ibfk_2` FOREIGN KEY (`id_modulo_transacao_0`) REFERENCES `acesso_modulo_transacao` (`id_modulo_transacao`);

--
-- Limitadores para a tabela `acesso_permissao_grupo`
--
ALTER TABLE `acesso_permissao_grupo`
  ADD CONSTRAINT `acesso_permissao_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `acesso_grupo` (`id_grupo`),
  ADD CONSTRAINT `acesso_permissao_grupo_ibfk_2` FOREIGN KEY (`id_modulo_transacao`) REFERENCES `acesso_modulo_transacao` (`id_modulo_transacao`);

--
-- Limitadores para a tabela `acompanhantes`
--
ALTER TABLE `acompanhantes`
  ADD CONSTRAINT `FK_reserva_locador` FOREIGN KEY (`id_reserva_locador`) REFERENCES `reserva_locador` (`id`);

--
-- Limitadores para a tabela `cota`
--
ALTER TABLE `cota`
  ADD CONSTRAINT `FK_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `unidade` (`id`),
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `notificacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `acesso_usuario` (`id`);

--
-- Limitadores para a tabela `reserva_cota`
--
ALTER TABLE `reserva_cota`
  ADD CONSTRAINT `FK_cota` FOREIGN KEY (`id_cota`) REFERENCES `cota` (`id`);

--
-- Limitadores para a tabela `reserva_locador`
--
ALTER TABLE `reserva_locador`
  ADD CONSTRAINT `FK_reserva_cota` FOREIGN KEY (`id_reserva_cota`) REFERENCES `reserva_cota` (`id`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `unidade`
--
ALTER TABLE `unidade`
  ADD CONSTRAINT `empreendimento` FOREIGN KEY (`id_empreendimento`) REFERENCES `empreendimento` (`id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_acesso_usuario` FOREIGN KEY (`id_acesso_usuario`) REFERENCES `acesso_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
