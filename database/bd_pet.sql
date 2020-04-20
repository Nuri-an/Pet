-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Abr-2020 às 18:00
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bd_pet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `codAdministrador` int(40) NOT NULL AUTO_INCREMENT,
  `codIntegrante` int(40) NOT NULL,
  PRIMARY KEY (`codAdministrador`),
  KEY `codIntegrante` (`codIntegrante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`codAdministrador`, `codIntegrante`) VALUES
(1, 11),
(3, 20),
(13, 25),
(12, 23),
(11, 22),
(10, 19),
(14, 26);

-- --------------------------------------------------------

--
-- Estrutura da tabela `discentes`
--

CREATE TABLE IF NOT EXISTS `discentes` (
  `codDiscente` int(11) NOT NULL AUTO_INCREMENT,
  `codIntegrante` int(11) NOT NULL,
  PRIMARY KEY (`codDiscente`),
  KEY `codIntegrante` (`codIntegrante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `discentes`
--

INSERT INTO `discentes` (`codDiscente`, `codIntegrante`) VALUES
(1, 2),
(2, 3),
(3, 4),
(12, 17),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(10, 12),
(11, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
  `codGaleria` int(40) NOT NULL AUTO_INCREMENT,
  `tituloGaleria` varchar(100) DEFAULT NULL,
  `midiaGaleria` varchar(40) NOT NULL,
  `urlGaleria` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`codGaleria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`codGaleria`, `tituloGaleria`, `midiaGaleria`, `urlGaleria`) VALUES
(105, '14:23', 'video_1580664212.mp4', NULL),
(104, '14:20', 'video_1580664042.mp4', NULL),
(103, 'm', 'video_1580663876.mp4', NULL),
(101, '14:09', 'video_1580663355.mp4', NULL),
(102, 'e', 'video_1580663568.AVI', NULL),
(99, '14:01', 'video_1580662919.mp4', NULL),
(100, '14:03', 'video_1580663045.mp4', NULL),
(96, '13:07', 'video_1580659636.mp4', NULL),
(97, '13:08', 'video_1580659737.mp4', NULL),
(98, '13:10', 'video_1580659813.mp4', NULL),
(95, 'n', 'imagem_1580658388.mp4', NULL),
(90, 'Florianópolis - evento startups', 'imagem_1579639977.jpg', NULL),
(89, 'Workshop SP', 'imagem_1579639902.png', NULL),
(109, 'video yt', '', 'https://www.youtube.com/watch?v=dGIuBvhymQs'),
(112, 'mp4', 'video_1580835417.mp4', ''),
(113, 'infraestrutura ti', '', 'https://www.youtube.com/watch?v=-WnQ6X2oSwU'),
(114, 'teste', '', 'https://www.youtube.com/watch?v=quSLB3dz-OM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes`
--

CREATE TABLE IF NOT EXISTS `informacoes` (
  `tituloInfo` varchar(1000) NOT NULL,
  `descricaoInfo` longtext NOT NULL,
  `subTituloInfo` varchar(1000) DEFAULT NULL,
  `subDescricaoInfo` longtext,
  `codInfo` int(10) NOT NULL AUTO_INCREMENT,
  `extrasInfo` longtext NOT NULL,
  PRIMARY KEY (`codInfo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `informacoes`
--

INSERT INTO `informacoes` (`tituloInfo`, `descricaoInfo`, `subTituloInfo`, `subDescricaoInfo`, `codInfo`, `extrasInfo`) VALUES
('PET – Programa de Educação Tutorial - teste', 'O Programa de Educação Tutorial (PET) foi criado para apoiar atividades acadêmicas que integram ensino, pesquisa e extensão. Formado por grupos tutoriais de aprendizagem, o PET propicia aos alunos participantes, sob a orientação de um tutor, a realização de atividades extracurriculares que complementem a formação acadêmica do estudante e atendam às necessidades do próprio curso de graduação. O estudante e o professor tutor recebem apoio financeiro de acordo com a Política Nacional de Iniciação Científica.', 'O PET-Computação do IFSUDESTEMG: teste', 'Nossa proposta está focada no tema “Laboratório de Multimídia Interativa”. Este conceito, unido à realidade aumentada, é a base para a construção de aplicações atrativas e famosas como: “Beco das palavras”, no Museu da Língua Portuguesa (SP); jogos diversos e exercícios de fisioterapia desenvolvidos para o console Nintendo Wii; publicidade do banco Itaú em forma de campanha em 3D com tour virtual por uma das novas agências e apresentação da conveniência do 30 Horas com uma campanha em realidade aumentada que acrescenta elementos virtuais ao mundo real. Embora seja um mercado em alta, toda esta tecnologia está longe do alcance da maioria dos desenvolvedores e empresas de software do Brasil. Este projeto busca documentar “o caminho das pedras”, desenvolver aplicações e desmistificar na região o uso desta tecnologia.\r\n\r\nDe acordo com o objetivo do Projeto Pedagógico de 2010 “O Curso de Bacharelado em Ciência da Computação tem como propósito oferecer formação profissional suportada em base científica e tecnológica, em diretrizes alinhadas com as necessidades do mercado de trabalho e da pesquisa acadêmica, permitindo-lhes atuar como agentes de transformação do mundo pela intervenção e desenvolvimento de tecnologias, para promoção das instituições sociais e do homem.”, tem-se que o tema proposto vem de encontro com os ideais do curso, principalmente no que se refere a “formação suportada por base científica” e “permitindo-lhes atuar como agentes de transformação”. Multimídia Interativa é uma subdivisão da Ciência da Computação pouco explorada e com grande potencial. A sólida base oferecida pelo nosso bacharelado aos bolsistas fundamentará as pesquisas necessárias à inovação nesta área\r\n\r\nA Coordenação em Ciência da Computação dispõe de 4 laboratórios com cerca de 24 máquinas, cada uma com todos os requisitos necessários à investidura dos alunos nestes projetos. Sempre há um laboratório disponível para a equipe. Para testes de projeção há um datashow da coordenação e outros 6 da instituição. Sempre há um livre para as pesquisas. Esta coordenação apóia por completo o presente trabalho.\r\n\r\nPor fim, observa-se que o autor/coordenador deste projeto, que está no Doutorado em Computação (linha de pesquisa Computação Visual), possui a experiência necessária para a orientação dos estudos desta área, como pode ser comprovado com: 4 jogos aprovados no Festival de Jogos Independentes da SBGames/SBC 2009, 1° Lugar em Jogos para Console da SBGames 2009, coordenação do evento Global Game Jam 2010 sede CEFET-MG/Varginha e 2011 sede IFSUDESTE-MG/Rio Pomba, e jogo semifinalista do XNA Challenge Brasil 2009. Além de publicações em diversos congressos nacionais e internacionais da área, como: Webmedia/SBC 2006, SBGames/SBC 2007, 2008 e 2010, e VideoJogos 2009.', 1, '<b>O PET-Computação do IFSUDESTEMG: teste  </b><br />\r\n<br />\r\nLorem ipsum dolor sit amet consectetur adipiscing elit pharetra justo aenean vivamus lacus, vestibulum nascetur rutrum platea sagittis arcu curae hendrerit sodales nisl. Magnis facilisis penatibus quis scelerisque phasellus commodo elit nulla nascetur, varius mus praesent inceptos vitae lorem tellus nisl. Taciti eget quam ultrices tortor proin curae, vulputate magna lorem ad hendrerit, per finibus tristique penatibus luctus. Magna etiam nec volutpat maximus est litora suspendisse ornare sociosqu, vestibulum tempus vivamus malesuada efficitur lorem platea finibus. At pulvinar aliquet tempus facilisi luctus a nam, placerat porta lobortis class maecenas leo aliquam, ridiculus sociosqu potenti fusce taciti morbi. Consequat feugiat dignissim aliquet finibus curae ultricies nibh a, pellentesque rutrum hac lacinia mollis nisl molestie, platea neque pharetra donec sed purus gravida. Quisque ultrices eros sociosqu molestie finibus turpis eu malesuada pretium adipiscing etiam curabitur sed, arcu enim elit imperdiet orci gravida tempor class sagittis ridiculus tortor integer, dictumst habitant faucibus laoreet magna purus a cubilia accumsan lacinia consectetur egestas. Facilisis suspendisse ipsum quam consequat nam litora, imperdiet est porttitor massa convallis, ultrices odio sed leo enim.<br />\r\n<br />\r\n<b> Outro título aqui nada a ver com o conteúdo </b><br />\r\n<br />\r\nDictumst venenatis fusce leo magnis scelerisque nulla adipiscing, himenaeos inceptos lacus quisque phasellus habitasse vel pretium, ultrices condimentum sit eu rhoncus elit. Risus dapibus primis ad netus penatibus tellus aptent ornare molestie rhoncus lacinia, ex curabitur ipsum aliquet neque sodales eget sapien nibh egestas. Nulla congue scelerisque penatibus dui tortor ut fermentum, imperdiet quisque lacinia tristique lorem pellentesque porta justo, platea rutrum massa etiam commodo litora. Vulputate tortor taciti efficitur molestie porta praesent dignissim diam, laoreet hac class ex commodo proin habitant et, sollicitudin nunc vitae velit congue ac nam. Urna facilisis facilisi eu ultrices dictum sociosqu lacus, faucibus parturient eleifend dui integer potenti lectus ante, rhoncus morbi proin efficitur viverra fames. Dis vivamus libero taciti diam varius nibh nunc suspendisse massa, per dui finibus litora ornare molestie senectus non. Sollicitudin finibus amet natoque nostra dis nec vulputate, accumsan ligula euismod fusce primis nam, augue parturient habitasse potenti congue maecenas. Aptent vehicula ultrices suscipit tellus curabitur lobortis elementum ultricies, pharetra convallis proin ornare erat congue ex. Ac vitae scelerisque odio eros placerat per dignissim, tortor non aliquam maecenas vivamus nunc penatibus, conubia luctus dictumst amet urna potenti. Netus arcu per lacus libero litora sapien natoque, feugiat ultrices curabitur gravida scelerisque rhoncus est, velit maecenas sed non aptent tempus.<br />\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `integrantes`
--

CREATE TABLE IF NOT EXISTS `integrantes` (
  `codIntegrante` int(100) NOT NULL AUTO_INCREMENT,
  `nomeIntegrante` varchar(100) NOT NULL,
  `emailIntegrante` varchar(100) DEFAULT NULL,
  `cpfIntegrante` varchar(20) NOT NULL,
  `dataInicioIntegrante` date NOT NULL,
  `dataFimIntegrante` date DEFAULT NULL,
  `situacaoIntegrante` varchar(20) NOT NULL,
  `fotoIntegrante` varchar(100) DEFAULT NULL,
  `socialIntegrante` varchar(100) DEFAULT NULL,
  `senhaIntegrante` varchar(40) NOT NULL,
  PRIMARY KEY (`codIntegrante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `integrantes`
--

INSERT INTO `integrantes` (`codIntegrante`, `nomeIntegrante`, `emailIntegrante`, `cpfIntegrante`, `dataInicioIntegrante`, `dataFimIntegrante`, `situacaoIntegrante`, `fotoIntegrante`, `socialIntegrante`, `senhaIntegrante`) VALUES
(1, 'Alessandra Martins Coelho', 'alessandracoelho@gmail.com', '151.712.956-70', '2018-11-06', NULL, 'Tutor(a)', 'foto_1580218033.jpg', 'https://www.facebook.com/alessandra.m.coelho.7', ''),
(2, 'Davidson Lucas de Souza', 'd@email.com', '151.712.956-70', '2020-01-31', NULL, 'Voluntário', 'foto_1580322804.jpg', 'https://linkedin.com.br/davidson', ''),
(3, 'Fábio Junior Barbosa', 'f@gmail.com', '151.712.956-70', '2018-02-22', NULL, 'Bolsista', 'foto_3.jpg', '', ''),
(4, 'Fernando Lucas de Lima Martins', 'fl@gmail.com', '', '2015-05-02', NULL, 'Bolsista', 'foto_4.jpg', NULL, ''),
(6, 'Jesus Felipe Candian Silva', NULL, '111.111.111-10', '2011-07-31', NULL, 'Bolsista', 'foto_6.jpg', NULL, ''),
(7, 'Leonardo Antônio Almeida de Souza', NULL, '111.111.111-10', '2000-03-04', NULL, 'Bolsista', 'foto_7.jpg', NULL, ''),
(8, 'Luana da Mercês Oliveira', 'l@gmail.com', '111.111.111-10', '2017-12-02', NULL, 'Bolsista', 'foto_8.jpg', NULL, ''),
(9, 'Luiza Rosa de Moura', 'lr@gmail.com', '111.111.111-10', '2019-08-05', NULL, 'Bolsista', 'foto_9.jpg', NULL, ''),
(11, 'Nurian Coelho', 'nuriancoelho@hotmail.com', '151.712.956-70', '2020-01-01', NULL, 'Administrador', '', '', 'coelho123'),
(17, 'Nurian Maria Amancio Coelho', 'nuriancoelho@hotmail.com', '151.712.956-70', '2020-01-01', NULL, 'Voluntário', 'foto_1586467908.jpg', '', ''),
(19, 'Nunda Xavier', 'nunda@gmail.com', '855.432.416-15', '2020-04-15', NULL, 'Administrador', NULL, NULL, 'coelho123'),
(22, 'Adm 2', 'nuriancoelho@hotmail.com', '23395239071', '2020-04-15', NULL, 'Administrador', NULL, NULL, '123456'),
(23, 'Adm 1', 'nuriancoelho@hotmail.com', '00576067652', '2020-04-15', NULL, 'Administrador', NULL, NULL, '1234567'),
(25, 'Adm 3', 'nuriancoelho@hotmail.com', '23190850682', '2020-04-15', NULL, 'Administrador', NULL, NULL, '1234567'),
(26, 'Adm 4', 'nuriancoelho@hotmail.com', '40249574063', '2020-04-15', NULL, 'Administrador', NULL, NULL, '1234567');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `tituloNoticia` varchar(400) NOT NULL,
  `descricaoNoticia` longtext NOT NULL,
  `midiaNoticia` varchar(40) DEFAULT NULL,
  `codNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `localNoticia` varchar(40) NOT NULL,
  `dataNoticia` date NOT NULL,
  PRIMARY KEY (`codNoticia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`tituloNoticia`, `descricaoNoticia`, `midiaNoticia`, `codNoticia`, `localNoticia`, `dataNoticia`) VALUES
('Calouro do DACC tem Artigo Completo Aprovado na 17ª Edição do SBGames.', '  O estudante do curso de Ciência da Computação, Davi Leal da Costa, sob orientação do professor Alex Machado e do aluno Matheus Baffa, teve seu artigo completo aprovado na 17ª edição do Simpósio Brasileiro de Jogos e Entretenimento Digital – SBGAMES 2018.\r\n  O trabalho intitulado “Emoção e Desempenho de Jogadores de E-Sports: Um Estudo Piloto”, propõe uma análise das emoções e como estas influenciam no desempenho de jogadores do cenário competitivo de jogos de esportes eletrônicos, como League of Legends, Dota2 e Counter Strike. O estudo faz uso de um dispositivo de interface cérebro-computador (ou Brain Computer Interface – BCI) para capturar as emoções sentidas pelo jogador em um determinado período.\r\n  A SBGames 2018 é uma das maiores conferências de jogos eletrônicos da américa latina. Com o qualis B2, este ano o evento ocorrerá em Foz do Iguaçu em conjunto dos eventos SIBGRAPI’18 e SVR 2018, eventos renomados dá área de computação gráfica, processamento de imagens e realidade virtual.', 'midia_1.png', 1, 'Externa', '2018-12-17'),
('Participação na Semana da Informática no IFSul de Minas', 'Como é tradição, pelo terceiro ano, o LAMIF participou da Semana da Informática no Campus Inconfidentes do IFSULDEMINAS, a convite da Professora Doutora Luciana Faria. O evento ocorreu do dia 27 a 29 desse mês de Agosto.\r\n\r\nAs atividades conduzidas foram:\r\n\r\n1) Curso de Extensão: Desenvolvimento em Unity3D – Ofertado pelos bolsistas JULIE e PABLO\r\n2) Curso de Extensão: Introdução ao Blender  –  Ofertado pelos bolsistas  MARCELLA e VICTOR REZENDE\r\n3) Curso de Extensão: Introdução ao Android Studio  – Ofertado pelos bolsistas DIEGO e LEONARDO FAÊDA\r\n4) Curso de Extensão: Programação na Plataforma Dot Net  – Ofertado pelos bolsistas LUIZA e ARIEL\r\n5) Palestra: Realidade Virtual e Aumentada  – Ofertada pelo PROF. ALEX\r\n6) Palestra: Realidade Virtual e suas Aplicações –  Ofertada pelos bolsistas PABLO, MARCELLA e LEONARDO FAÊDA', NULL, 2, 'Externa', '2020-02-11'),
('Professor Alex Realiza Palestra na UFJF', 'Nessa ultima sexta, 4 de Maio, o Prof. Alex realizou uma palestra sobre Realidade Virtual no GetMeeting 2018.\r\nCom o título “Bem-Vindos à Realidade Paralela! Uma Breve Discussão sobre os Avanços da Realidade Virtual e Aumentada“, o discurso centrou-se nas tecnologias contemporâneas e desafios relacionados ao tema.\r\nUm breve resumo fornecido pelo autor pode ser conferido a seguir:\r\n“Entre os estudiosos não há um consenso sobre a origem da Realidade Virtual. Em meio aos escritores não há um limite das suas possibilidades futuras. Todavia entre ciência e ficção nos encontramos. Em uma era de avanços tecnológicos consideráveis relacionados à Realidade Virtual e Aumentada, como podemos nos preparar para os desafios contemporâneos desta área?”\r\n\r\nMais informações sobre o evento podem ser conferidos em:\r\nhttp://www.ufjf.br/getcomp/eventos/getmeeting/informacoes-do-evento/', NULL, 3, 'Externa', '2020-02-21'),
('DACC Participa do GetMeeting na UFJF', 'Em um evento repleto de palestras, mesas de discussões e mostras tecnológicas, alunos do Curso de Ciência da Computação participaram nessa ultima sexta, 4 de Maio, do GetMeeting 2018.\r\nCom destaque à palestra do Prof. Esteban Clua, sobre Jogos Eletrônicos e Realidade Virtual, o evento contou inclusive com a mostra de jogos eletrônicos com a co-participação de projetos do LAMIF.\r\nO VIII GETMeeting é um evento organizado pelo Grupo de Educação Tutorial do curso de Ciência da Computação (GETComp) voltado para os alunos do Departamento de Ciência da Computação e áreas afins da UFJF e é aberto para a participação de pessoas interessadas em tecnologia. O evento é constituído de minicursos a serem ministrados por alunos ou profissionais ligados à área de Ciência da Computação além da apresentação de trabalhos no Workshop de Trabalhos de Graduação, palestras e maratonas de programação.\r\n\r\nMais informações sobre o evento podem ser conferidos em:\r\nhttp://www.ufjf.br/getcomp/eventos/getmeeting/informacoes-do-evento/', NULL, 4, 'Externa', '2020-02-24'),
('Parceria para o Desenvolvimento de Produtos Tecnológicos', 'O Laboratório de Multimídia Interativa do Campus Rio Pomba (LAMIF) em parceria com professores e alunos do Mestrado em Educação Profissional e Tecnológica  celebram o início das atividades para o desenvolvimento de produtos educacionais de software.\r\nCom o objetivo de implementação de portais educacionais, aplicativos de celular e jogos eletrônicos, tem-se a meta de publicação dos primeiros protótipos para agosto deste ano.', NULL, 5, 'Interna', '0000-00-00'),
('LEO3D – Uma Tese em Defesa do Uso de um Jogo Eletrônico nas Aulas de Física', 'O que um jogo eletrônico deve ter para apoiar o ensino Física? Como avaliar a eficiência de um serius game? Esses entre outros questionamentos foram respondidos pelo pesquisador ANDRÉ LUIGI AMARAL DI SALVO. \r\nO professor Alex, deste departamento, prestigiou como membro da banca sua defesa de tese intitulada "AMBIENTE DIGITAL MULTIDIDÁTICO PARA O ENSINO DE ÓPTICA GEOMÉTRICA: LEO3D - UMA AVENTURA PELO O MUNDO DA ÓPTICA" na qual o recém Doutor dismistificou o uso de jogos eletrônicos na educação. \r\nA aplicação desenvolvida na Pós-Graduação em DESENVOLVIMENTO HUMANO E TECNOLOGIAS da UNIVERSIDADE ESTADUAL PAULISTA pode ser conferida no link:\r\nhttps://www.youtube.com/watch?v=-Xo0pg_WK9k', NULL, 6, 'Externa', '2020-02-27'),
('Participação na Semana das Profissões', 'O LAMIF teve a honra de participar representando o Departamento Acadêmico de Ciência da Computação da I Mostra de Cursos e Profissões do IF Sudeste MG – Campus Rio Pomba.\r\nO evento foi realizado nos dias 16 e 17 de agosto e teve o objetivo de apresentar as possibilidades de formação técnica e superior ofertadas gratuitamente pela unidade.', NULL, 7, 'Interna', '0000-00-00'),
('LAMIF tem dois Artigos Publicados no SVR 2018', 'Apresentamos novos resultados das pesquisas do LAMIF: dois artigos completos aceito para publicação no Symposium on Virtual and Augmented Reality.\r\nEste evento é o mais importante da Sociedade Brasileira da Computação a tratar sobre Realidade Virtual e Aumentada. Seu extrato Qualis atual é B2. Este ano ocorrerá em Foz do Iguaçu em paralelo ao SBGames e SIBGRAPI.\r\n\r\nOs trabalhos aprovados foram:\r\nUm estudo semiótico em jogos de realidade virtual e simulações (Leonardo Faêda, Alex Machado,  Pablo Sanches, Ítalo Rodrigues Gama e Wallacy Pasqualini)\r\nEfeito agudo do estímulo de realidade virtual no desempenho de nadadores: um estudo piloto (Marcella Menezes, João Freire, Alex Machado e Guilherme Tucher)', NULL, 8, 'Externa', '2018-08-18'),
('Integrantes do LAMIF realizam palestras no Campus Bom Sucesso', 'No último dia 12 de novembro, alunos integrantes do grupo PET estiveram no IFSUDESTEMG – Campus Avançado Bom Sucesso, ministrando palestras sobre os trabalhos desenvolvidos no laboratório de pesquisa. As palestras aconteceram no evento “IFPlayers”, realizado pelo instituto para os alunos.\r\n\r\nOs trabalhos e integrantes foram:\r\n“EFEITO AGUDO DE REALIDADE VIRTUAL NO ESTÍMULO DE NADADORES: UM ESTUDO PILOTO” – João Paulo Freire\r\n“A SEMIOTIC STUDY ON VIRTUAL REALITY GAMES AND SIMULATIONS” – Leonardo Moreira Faêda\r\n“EMOÇÃO E DESEMPENHO DE JOGADORES DE E-SPORTS: UM ESTUDO PILOTO” – Matheus de Freitas Oliveira Baffa\r\n“THE EMERGENCE OF ARTIFICIAL CONSCIOUSNESS AND ITS IMPORTANCE TO REACH THE TECHNOLOGICAL SINGULARITY” – Pablo de Lara Sanches\r\n\r\n', NULL, 9, 'Externa', '2019-07-16'),
('teste', '  ', '', 13, '', '2000-08-07'),
('testando', '  ', '', 18, 'Interna', '2020-04-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE IF NOT EXISTS `projetos` (
  `codProjeto` int(40) NOT NULL AUTO_INCREMENT,
  `tituloProjeto` text NOT NULL,
  `descricaoProjeto` longtext,
  `anoProjeto` int(4) NOT NULL,
  `midiaProjeto` varchar(100) DEFAULT NULL,
  `publicacaoProjeto` mediumtext,
  `parceriaProjeto` mediumtext,
  PRIMARY KEY (`codProjeto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`codProjeto`, `tituloProjeto`, `descricaoProjeto`, `anoProjeto`, `midiaProjeto`, `publicacaoProjeto`, `parceriaProjeto`) VALUES
(1, 'Simulador de Natação ', 'Entendendo e preparando atletas de forma divertida: Desenvolvimento de um jogo com a utilização da plataforma Unity para auxiliar estudantes e profissionais a elaborar estratégias de treino e técnicas para desenvolver as habilidades de seus atletas.', 2015, 'midia_1.jpg', NULL, NULL),
(5, 'Singularidade Tecnológica', '  Os seres humanos serão dominados pelas máquinas? Qual futuro da inteligência artificial? O projeto de singularidade tecnológica do grupo PET-Computação tem como objetivo estudar e desenvolver ferramentas que utilizam conceitos de singularidade tecnológica, como multi-task learning e transductive learning, a fim de desenvolver a área de estudos proposta.', 2018, 'midia_1586641645.jpg', NULL, NULL),
(2, 'IF 3D', 'desenvolvimento de um ambiente 3D com a plataforma Unity[1] que reflita todo Campus Rio Pomba, incluindo salas de aula, laboratórios, áreas de plantio e criação de animais. O desenvolvimento deste ambiente está dividido em duas partes, a primeira modela o ambiente externo (áreas abertas, prédios, quadras) e a segunda modela a parte interna dos prédios, quadras, laboratórios, dentre outros ambientes.', 2015, NULL, NULL, NULL),
(3, 'Frigote', 'Frigote é um jogo desenvolvido na Unity que têm como objetivo simular uma fazenda e suas funções, de modo que alunos da Zootecnia possam aprender sobre sua área de forma divertida. Em primeiro momento, desenvolvemos um cenário para o frango de corte, onde é possível frangos desde a fase inicial como pintinho até a fase adulta, na qual ele já pode ser vendido. O jogo também é composto de um quiz relacionado a criação do frango, para que o jogador possa fixar esses conteúdos.', 2015, '', NULL, NULL),
(6, 'Interação Real em Mundo Digital: Realidade Virtual + Kinect', '  Este projeto, desenvolvido na plataforma Unity, permite que qualquer pessoa com um dispositivo móvel que possua suporte para Realidade Virtual, Microsoft Kinect e criatividade possa desenvolver suas próprias experiências em Realidade Virtual. Os dados de rastreamento de posição do corpo capitados pelo Kinect são enviados para o jogador, e através do WiFi utilizando um servidor Unet(servidor Multiplayer da Unity Engine), todos os dados são recebidos no dispositivo móvel obtendo, assim, uma maior imersão no mundo virtual.', 2016, '', NULL, NULL),
(13, 'Interação Real em Mundo Digital: Realidade Virtual + GPS', '  Algo que não é explorado atualmente é a interação de Realidade Virtual com GPS, ou seja, é a capacidade de você poder andar em um ambiente virtual a medida em que se desloca em um ambiente real. Há inúmeras aplicações que encaixam com esse tema, as opções de desenvolvimento são vastas e ainda não são exploradas , o que faz com que cada pesquisa sobre ele seja de grande importância. Com base nisso, este projeto entra para desenvolver as ferramentas necessárias para a exploração desse tema.', 2016, '', NULL, NULL),
(15, 'Treinamento Mental com VR para ganho de rendimento na Natação', '  Você já pensou em melhorar seu desempenho em seu esporte favorito sem sair de casa? Essa é uma proposta do nosso grupo LAMIF juntamente com o Departamento Acadêmico de Educação Física. Desenvolver um jogo que utiliza realidade virtual para simular o ambiente real de treinamento, com intuído de investigar as possíveis aplicações desta ferramenta no dia a dia de treino do atleta. Com isto buscamos obter melhorias no rendimento do mesmo sem o desgaste físico dos treinamentos habituais.', 2020, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE IF NOT EXISTS `publicacoes` (
  `codPublicacao` int(40) NOT NULL AUTO_INCREMENT,
  `descricaoPublicacao` varchar(10000) NOT NULL,
  `dataPublicacao` date NOT NULL,
  `linkPublicacao` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`codPublicacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`codPublicacao`, `descricaoPublicacao`, `dataPublicacao`, `linkPublicacao`) VALUES
(1, 'MACHADO, A. F. V.; SILVA, L. R. T. S. ; SANCHES, P. . THE EMERGENCE OF ARTIFICIAL CONSCIOUSNESS AND ITS IMPORTANCE TO REACH THE TECHNOLOGICAL SINGULARITY. KÍNESIS (MARÍLIA), v. X, p. 111-127, 2018.', '2018-03-03', NULL),
(2, 'MENEZES, M. L. ; FREIRE, J. P. ; MACHADO, A. F. V. ; TUCHER, G. . Acute effect of the virtual reality stimulus in the performance of swimmers: a pilot study. In: SYMPOSIUM ON VIRTUAL AND AUGMENTED REALITY, 2018, Foz do Iguaçu. SVR, 2018.', '2018-05-01', NULL),
(3, 'FAEDA, L. M. ; GAMA, I. R. ; ROBERTI JUNIOR, W. C. ; SANCHES, P. ; MACHADO, A. F. V. ; NERIO, W. O. P. . A Semiotic Study On Virtual Reality Games and Simulations. In: SYMPOSIUM ON VIRTUAL AND AUGMENTED REALITY, 2018, Foz do Iguaçu. SVR, 2018.', '2018-09-30', NULL),
(4, 'COSTA, D. L. ; BAFFA, M. F. ; MACHADO, A. F. V. . Emoc¸ao e Desempenho de Jogadores de E-Sports: Um Estudo Piloto. In: Simpósio Brasileiro de Games e Entretenimento Digital, 2018, Foz do Iguaçu. SBGames, 2018.', '2018-08-20', NULL),
(5, 'LUCARELLI, D. ; LAVORATO, A. S. ; MACHADO, A. F. V. ; CATALDO JUNIOR, W. . Ensino de Lógica de Programação através do Jogo Defense of the Ancients 2. In: WIE, 2017, Recife. Workshop de Informática na Escola, 2017', '2017-03-06', ''),
(6, 'SANCHES, P. ; FAEDA, L. M. ; MACHADO, A. F. V. . VRCircuit: Realidade virtual aplicada ao ensino de circuitos elétricos. In: SBIE, 2017, Recife. Simpósio Brasileiro de Informática na Educação, 2017.', '2017-02-08', NULL),
(7, 'MOREIRA, G. B. S. M. ; RAMALHO, M. M. ; COSTA, V. R. ; BAFFA, M. F. ; RIBEIRO, L. G. G. ; MACHADO, A. F. V. ; BORGES, L. M. . Building Successful Games: A Complete Analysis of the Key Featuresof League of Legends. In: GAME-ON, 2017, Carlow, Ireland. European GAMEON Conference, 2017.', '2017-09-30', NULL),
(8, 'CUNHA, L. F. ; JUNQUEIRA, M. A. P. ; MACHADO, A. F. V. . Markov Chain in Fighting Electronic Games. In: European GAME-ON Conference, 2016, Lisboa. European GAME-ON Conference, 2016.', '2018-08-07', NULL),
(9, 'RIBEIRO, L. G. G. ; ROCHA, R. R. ; BAFFA, M. F. ; MACHADO, A. F. V. . ?Stop The Roller Coaster!? – A Study of Cybersickness Occurrence. In: European GAME-ON Conference, 2016, Lisboa. European GAME-ON Conference, 2016.', '2018-07-08', NULL),
(10, 'BAFFA, M. F. ; RAMALHO, M. M. ; MOREIRA, G. B. S. M. ; MACHADO, A. F. V. . Building Successful Games: An Analysis of League of Legends. In: SBGames, 2016, São Paulo. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2016.', '2018-02-01', NULL),
(11, 'MOREIRA, G. B. S. M. ; FAUSTINO, P. R. C. ; RAMALHO, M. M. ; MACHADO, A. F. V. ; BAFFA, M. F. ; CLUA, E. W. . Affective Computing: Measuring the Player Emotions in Virtual Reality Environments. In: European Simulation and Modelling Conference, 2015, Leicester. ESM, 2015.', '2018-04-03', NULL),
(12, 'BENTO, D. S. ; RODRIGUES, B. C. ; ALVES, J. C. P. ; SOUSA, B. L. ; NEVES JUNIOR, A. B. ; PAULO, L. M. ; MACHADO, A. F. V. . Metaheuristics Applied to the Autonomous Movement of Intelligent Agents. In: European Simulation and Modelling Conference, 2015, Leicester. ESM, 2015.', '2018-05-04', NULL),
(13, 'FAEDA, L. M. ; SANCHES, P. ; LOPES, M. ; MACHADO, A. F. V. . Music Sheet Challenge: Um jogo educativo para o ensino de partituras musicais. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2015, Teresina. SBGames, 2015.', '2018-08-07', NULL),
(14, 'JUNQUEIRA, M. A. P. ; CUNHA, L. F. ; RIBEIRO, J. G. ; MACHADO, A. F. V. . Uma Proposta de Jogo Assistivo Para Dispositivos Móveis em Prol da Inclusão Digital de Deficientes Visuais. In: Workshop de Informática na Escola, 2015, Maceió. WIE, 2015.', '2018-06-05', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tutores`
--

CREATE TABLE IF NOT EXISTS `tutores` (
  `codTutor` int(40) NOT NULL AUTO_INCREMENT,
  `codIntegrante` int(40) NOT NULL,
  PRIMARY KEY (`codTutor`),
  KEY `codIntegrante` (`codIntegrante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tutores`
--

INSERT INTO `tutores` (`codTutor`, `codIntegrante`) VALUES
(4, 1),
(5, 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
