CREATE DATABASE sp;

USE sp;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` int NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `sexo` int DEFAULT NULL,
  `sobre` varchar(160) DEFAULT NULL,
  `site` varchar(300) DEFAULT NULL,
  `esporte` int DEFAULT NULL,
  `banner` varchar(60) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `pontos` int DEFAULT NULL,

  CONSTRAINT pk_usuario PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
COMMIT;



DROP TABLE IF EXISTS `campeonatos`;
CREATE TABLE IF NOT EXISTS `campeonatos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(40) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_org` int NOT NULL,
  `premiacao` varchar(50) NOT NULL,
  `taxa_inscricao` decimal(10,2) NOT NULL,
  `nome_org` varchar(50) NOT NULL,
  `n_times` int DEFAULT NULL,
  `d_inicio` date DEFAULT NULL,
  `d_termino` date DEFAULT NULL,
  `tipo` int NOT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `esporte` int DEFAULT NULL,

  CONSTRAINT pk_usuario PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `registro_conversa` varchar(255) NOT NULL,
  `link` varchar(300) DEFAULT NULL,

  PRIMARY KEY (`id_mensagem`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_time`
--

DROP TABLE IF EXISTS `chat_time`;
CREATE TABLE IF NOT EXISTS `chat_time` (
  `id_mensagem` int NOT NULL AUTO_INCREMENT,
  `id_time` int NOT NULL,
  `id_usuario` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mensagem`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE IF NOT EXISTS `contrato` (
  `id_contrato` int NOT NULL AUTO_INCREMENT,
  `id_jogador` int NOT NULL,
  `id_contratante` int NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status_contrato` int NOT NULL DEFAULT '0',
  `tipo_contrato` int NOT NULL,
  `posicao` varchar(80) DEFAULT NULL,
  `id_time` int DEFAULT NULL,
  PRIMARY KEY (`id_contrato`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_saida`
--

DROP TABLE IF EXISTS `feedback_saida`;
CREATE TABLE IF NOT EXISTS `feedback_saida` (
  `id_opiniao` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_usuario` int NOT NULL,
  `opiniao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_opiniao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jogadores_time`
--

DROP TABLE IF EXISTS `jogadores_time`;
CREATE TABLE IF NOT EXISTS `jogadores_time` (
  `id_jogador` int NOT NULL,
  `id_contrato` int NOT NULL,
  `id_time` int NOT NULL,
  `posicao` varchar(40) NOT NULL,
  `esporte` int NOT NULL,
  `tipo_jogador` int NOT NULL,
  PRIMARY KEY (`id_jogador`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
CREATE TABLE IF NOT EXISTS `notifica` (
  `id_notifica` int NOT NULL AUTO_INCREMENT,
  `id_usu` int NOT NULL,
  `id_para` int DEFAULT NULL,
  `notifi` varchar(200) DEFAULT NULL,
  `status` int DEFAULT '0',
  `link` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_notifica`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partidas`
--

DROP TABLE IF EXISTS `partidas`;
CREATE TABLE IF NOT EXISTS `partidas` (
  `id_partida` int NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cep_part` varchar(11) DEFAULT NULL,
  `cidade_part` varchar(80) DEFAULT NULL,
  `bairro_part` varchar(80) DEFAULT NULL,
  `rua_part` varchar(80) DEFAULT NULL,
  `numero_part` varchar(5) DEFAULT NULL,
  `resultado` varchar(11) DEFAULT NULL,
  `id_time1` int NOT NULL,
  `id_time2` int NOT NULL,
  `id_analisador` int DEFAULT NULL,
  `id_campeonato` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `estado_part` char(2) DEFAULT NULL,
  `tipo` int DEFAULT NULL,
  PRIMARY KEY (`id_partida`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sugestoes`
--

DROP TABLE IF EXISTS `sugestoes`;
CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id_sugestao` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sugestao` varchar(500) NOT NULL,
  PRIMARY KEY (`id_sugestao`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

DROP TABLE IF EXISTS `times`;
CREATE TABLE IF NOT EXISTS `times` (
  `id_time` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cep_sede` varchar(10) DEFAULT NULL,
  `cidade_sede` varchar(80) DEFAULT NULL,
  `bairro_sede` varchar(80) DEFAULT NULL,
  `rua_sede` varchar(80) DEFAULT NULL,
  `numero_sede` varchar(5) DEFAULT NULL,
  `foto_time` varchar(40) DEFAULT NULL,
  `id_esportes` int DEFAULT NULL,
  `id_dono` int NOT NULL,
  `pontos` int DEFAULT NULL,
  `lema` varchar(160) DEFAULT NULL,
  `uf_sede` char(3) DEFAULT NULL,
  PRIMARY KEY (`id_time`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `times_camp`
--

DROP TABLE IF EXISTS `times_camp`;
CREATE TABLE IF NOT EXISTS `times_camp` (
  `id_camp` int NOT NULL,
  `id_time` int NOT NULL,
  `colocacao` int DEFAULT NULL,
  `pontos` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_camp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

