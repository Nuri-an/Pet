-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Out-2020 às 18:59
-- Versão do servidor: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_pet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `codAdministrador` int(40) NOT NULL,
  `codIntegrante` int(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`codAdministrador`, `codIntegrante`) VALUES
(17, 35);

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `codColaborador` int(11) NOT NULL,
  `codIntegrante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `capa` varchar(10) NOT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `rodape` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `capa`, `instagram`, `facebook`, `rodape`) VALUES
(1, 'capa.png', 'https://www.instagram.com/pet_computacao/?hl=pt-br', 'https://www.facebook.com/gpca.if', '<p> INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS - CAMPUS RIO POMBA </p> <p> Endereço: Av. Dr. José Sebastião da Paixão s/nº - Bairro Lindo Vale - Rio Pomba / MG - CEP: 36180-000 </p>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `discentes`
--

CREATE TABLE `discentes` (
  `codDiscente` int(11) NOT NULL,
  `codIntegrante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `discentes`
--

INSERT INTO `discentes` (`codDiscente`, `codIntegrante`) VALUES
(1, 2),
(17, 38),
(3, 4),
(18, 39),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(16, 37),
(10, 12),
(11, 13),
(19, 40),
(20, 41),
(21, 42);

-- --------------------------------------------------------

--
-- Estrutura da tabela `downloads`
--

CREATE TABLE `downloads` (
  `codDownload` int(40) NOT NULL,
  `tituloDownload` varchar(100) NOT NULL,
  `referenciaDownload` varchar(100) NOT NULL,
  `slidesDownload` varchar(100) DEFAULT NULL,
  `algoritmoDownload` varchar(100) DEFAULT NULL,
  `linkDownload` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `downloads`
--

INSERT INTO `downloads` (`codDownload`, `tituloDownload`, `referenciaDownload`, `slidesDownload`, `algoritmoDownload`, `linkDownload`) VALUES
(15, 'Fundamentos de Processamento de Imagens', 'Minicurso', '', 'algoritmo_1597687124.pdf', 'https://sistemas.riopomba.ifsudestemg.edu.br/gpca/wp-content/uploads/2019/04/Apresenta%C3%A7%C3%A3o-Fundamentos-de-PI.pdf'),
(16, 'Introdução a Análise de Imagens Médicas', 'Minicurso', '', '', 'https://sistemas.riopomba.ifsudestemg.edu.br/gpca/wp-content/uploads/2019/04/Apresenta%C3%A7%C3%A3o-An%C3%A1lise-Imagens-M%C3%A9dicas.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE `galeria` (
  `codGaleria` int(40) NOT NULL,
  `tituloGaleria` varchar(100) DEFAULT NULL,
  `midiaGaleria` varchar(40) NOT NULL,
  `urlGaleria` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`codGaleria`, `tituloGaleria`, `midiaGaleria`, `urlGaleria`) VALUES
(90, 'IF Sudeste realiza simpósio de ensino em Barbacena', 'imagem_1597672743.jpg', ''),
(115, 'LAMIF - Projetos 2016', '', 'https://youtu.be/MiL3kbH--fc'),
(89, 'Laboratório de Multimídia Interativa do Campus Rio Pomba consegue registro de software', 'imagem_1597673005.jpg', ''),
(118, 'Apresentação LAMIF', '', 'https://youtu.be/RhZuZn5Mf3E'),
(121, 'Prédio onde se localiza a sala do grupo. ', 'imagem_1597672518.png', ''),
(116, 'Prótipo IFUnity', '', 'https://youtu.be/xhZDIhX6dXM'),
(112, 'Video de paz', 'video_1580835417.mp4', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `tituloInfo` varchar(1000) NOT NULL,
  `descricaoInfo` longtext NOT NULL,
  `subTituloInfo` varchar(1000) DEFAULT NULL,
  `subDescricaoInfo` longtext,
  `codInfo` int(10) NOT NULL,
  `extrasInfo` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `informacoes`
--

INSERT INTO `informacoes` (`tituloInfo`, `descricaoInfo`, `subTituloInfo`, `subDescricaoInfo`, `codInfo`, `extrasInfo`) VALUES
('PET – Programa de Educação Tutorial', 'O Programa de Educação Tutorial (PET) foi criado para apoiar atividades acadêmicas que integram ensino, pesquisa e extensão. Formado por grupos tutoriais de aprendizagem, o PET propicia aos alunos participantes, sob a orientação de um tutor, a realização de atividades extracurriculares que complementem a formação acadêmica do estudante e atendam às necessidades do próprio curso de graduação. O estudante e o professor tutor recebem apoio financeiro de acordo com a Política Nacional de Iniciação Científica.', ' Grupo de Estudos em Computação Aplicada', 'O Grupo de Estudos em Computação Aplicada do IF Sudeste MG visa o ensino, pesquisa e extensão de soluções computacionais aplicadas a todas as áreas do conhecimento, em particular, às áreas relacionadas aos cursos do IF Sudeste MG, campus Rio Pomba. As pesquisas realizadas pelo grupo abrangem diversas áreas da computação, incluindo otimização e pesquisa operacional, computação visual, inteligência artificial, mineração de dados e educação. O grupo é composto por pesquisadores e estudantes da área de Ciência da Computação e de áreas correlatas. Os pesquisadores participam na orientação de trabalhos de curso técnico e graduação, visando a aquisição de conhecimento, a resolução de problemas e a publicação dos resultados atingidos.', 1, '<b>O PET-Computação do IFSUDESTEMG:  </b><br />\r\n<br />\r\nDe acordo com o objetivo do Projeto Pedagógico de 2010 “O Curso de Bacharelado em Ciência da Computação tem como propósito oferecer formação profissional suportada em base científica e tecnológica, em diretrizes alinhadas com as necessidades do mercado de trabalho e da pesquisa acadêmica, permitindo-lhes atuar como agentes de transformação do mundo pela intervenção e desenvolvimento de tecnologias, para promoção das instituições sociais e do homem.”, tem-se que o tema proposto vem de encontro com os ideais do curso, principalmente no que se refere a “formação suportada por base científica” e “permitindo-lhes atuar como agentes de transformação”. Multimídia Interativa é uma subdivisão da Ciência da Computação pouco explorada e com grande potencial. A sólida base oferecida pelo nosso bacharelado aos bolsistas fundamentará as pesquisas necessárias à inovação nesta área.<br />\r\n<br />\r\nA Coordenação em Ciência da Computação dispõe de 4 laboratórios com cerca de 24 máquinas, cada uma com todos os requisitos necessários à investidura dos alunos nestes projetos. Sempre há um laboratório disponível para a equipe. Para testes de projeção há um datashow da coordenação e outros 6 da instituição. Sempre há um livre para as pesquisas. Esta coordenação apóia por completo o presente trabalho.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `integrantes`
--

CREATE TABLE `integrantes` (
  `codIntegrante` int(100) NOT NULL,
  `nomeIntegrante` varchar(100) NOT NULL,
  `emailIntegrante` varchar(100) DEFAULT NULL,
  `cpfIntegrante` varchar(20) DEFAULT NULL,
  `dataInicioIntegrante` date DEFAULT '0000-00-00',
  `dataFimIntegrante` date DEFAULT NULL,
  `situacaoIntegrante` varchar(20) NOT NULL,
  `fotoIntegrante` varchar(100) DEFAULT NULL,
  `socialIntegrante` varchar(100) DEFAULT NULL,
  `senhaIntegrante` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `integrantes`
--

INSERT INTO `integrantes` (`codIntegrante`, `nomeIntegrante`, `emailIntegrante`, `cpfIntegrante`, `dataInicioIntegrante`, `dataFimIntegrante`, `situacaoIntegrante`, `fotoIntegrante`, `socialIntegrante`, `senhaIntegrante`) VALUES
(1, 'Alessandra Martins Coelho', '', '', '2018-11-06', NULL, 'Tutor(a)', 'foto_1580218033.jpg', 'https://www.facebook.com/alessandra.m.coelho.7', ''),
(2, 'Davidson Lucas de Souza', '', '', '2020-01-08', NULL, 'Bolsista', 'foto_1580322804.jpg', '', ''),
(39, 'Nurian Maria Amâncio Coelho', 'nuriancoelho@hotmail.com', '', '2020-08-11', NULL, 'Bolsista', 'foto_1597668095.jpeg', 'https://www.linkedin.com/in/nuriancoelho/', ''),
(4, 'Fernando Lucas de Lima Martins', '', '', '2019-08-22', NULL, 'Bolsista', 'foto_1597668235.jpg', '', ''),
(6, 'Jesus Felipe Candian Silva', '', '', '2019-07-13', NULL, 'Bolsista', 'foto_1597668761.jpg', '', ''),
(7, 'Leonardo Antônio Almeida de Souza', '', '', '2018-07-13', NULL, 'Bolsista', 'foto_1597668858.jpg', 'https://www.facebook.com/leonardo.antonio.lol', ''),
(8, 'Luana da Mercês Oliveira', '', '', '2019-07-13', NULL, 'Bolsista', 'foto_1597668943.jpg', '', ''),
(9, 'Luiza Rosa de Moura', '', '', '2019-07-20', NULL, 'Bolsista', 'foto_1597669090.jpg', 'https://www.facebook.com/luiza.rosa.98?ref=br_rs', ''),
(37, 'Élisson Carlos de Carvalho', '', '', '2019-07-13', NULL, 'Bolsista', '', '', ''),
(40, 'Gabriela Cardoso Montes', '', '', '2019-07-14', NULL, 'Bolsista', 'foto_1597603450.jpg', '', ''),
(41, 'Raian Campos Malta', '', '', '2019-07-13', NULL, 'Bolsista', 'foto_1597603772.jpg', '', ''),
(35, 'Nurian Maria Amâncio Coelho', 'nuriancoelho@hotmail.com', '151.712.956-70', '2020-08-15', NULL, 'Administrador', NULL, NULL, '04a2db8af1724c5f9e669f06572872e2'),
(42, 'Marcella Linhares Menezes', '', '', '2018-02-21', NULL, 'Bolsista', 'foto_1597603900.jpg', 'https://www.facebook.com/marcella.menezes.3', ''),
(38, 'Marcus Daniel de Almeida', '', '', '2020-08-11', NULL, 'Bolsista', 'foto_1597602017.jpg', '', ''),
(55, 'Teste Testando', '', NULL, '2020-09-23', NULL, 'Colaborador(a)', '', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `tituloNoticia` varchar(400) NOT NULL,
  `descricaoNoticia` longtext NOT NULL,
  `midiaNoticia` varchar(40) DEFAULT NULL,
  `codNoticia` int(11) NOT NULL,
  `dataNoticia` date NOT NULL,
  `resumoNoticia` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`tituloNoticia`, `descricaoNoticia`, `midiaNoticia`, `codNoticia`, `dataNoticia`, `resumoNoticia`) VALUES
('Calouro do DACC tem Artigo Completo Aprovado na 17ª Edição do SBGames.', ' O trabalho intitulado “Emoção e Desempenho de Jogadores de E-Sports: Um Estudo Piloto”, propõe uma análise das emoções e como estas influenciam no desempenho de jogadores do cenário competitivo de jogos de esportes eletrônicos, como League of Legends, Dota2 e Counter Strike. O estudo faz uso de um dispositivo de interface cérebro-computador (ou Brain Computer Interface – BCI) para capturar as emoções sentidas pelo jogador em um determinado período.\r\n  A SBGames 2018 é uma das maiores conferências de jogos eletrônicos da américa latina. Com o qualis B2, este ano o evento ocorrerá em Foz do Iguaçu em conjunto dos eventos SIBGRAPI’18 e SVR 2018, eventos renomados dá área de computação gráfica, processamento de imagens e realidade virtual.', 'midia_1597671477.png', 1, '2018-09-17', ' Inicialmente, um estudante do curso de Ciência da Computação, Davi Leal da Costa, sob orientação do professor Alex Machado e do aluno Matheus Baffa, teve seu artigo completo aprovado na 17ª edição do Simpósio Brasileiro de Jogos e Entretenimento Digital – SBGAMES 2018.'),
('LAMIF participa de SBGames e SVR 2018', 'Durante os dias 22, 23, 24 e 25 de novembro, os integrantes do LAMIF João Paulo Freire, Leonardo Faêda, Marcella Menezes, Matheus Baffa e Pablo Sanches, sob a supervisão de Alex F. V. Machado apresentaram trabalhos em 2 das maiores conferências da América do Sul nas áreas de Jogos e Realidade Virtual.\r\n\r\nOs trabalhos aprovados foram:\r\n\r\nUm estudo semiótico em jogos e simulações de Realidade Virtual   \r\n\r\nLeonardo Faêda, Pablo Sanches, Italo Gama e Alex F. V. Machado\r\n\r\nEfeito agudo do estímulo de realidade virtual no desempenho de nadadores: Um estudo piloto\r\n\r\nJoão Paulo Freire, Marcella Menezes e Alex F. V. Machado\r\n\r\nEmoção e desempenho de jogadores de Esports: Um estudo piloto\r\n\r\nMatheus Baffa, Davi Leal da Costa e Alex F. V. Machado', 'midia_1592336880.png', 2, '2018-11-09', 'O Laboratório de Multimídia Interativa de Rio Pomba (LAMIF) levou 5 de seus integrantes para apresentarem trabalhos aprovados na SVR (Symposium on Virtual and Augmented Reality) e na SBGames em Foz do Iguaçu.'),
('Integrantes do LAMIF realizam palestras no Campus Bom Sucesso', 'Com o título “Bem-Vindos à Realidade Paralela! Uma Breve Discussão sobre os Avanços da Realidade Virtual e Aumentada“, o discurso centrou-se nas tecnologias contemporâneas e desafios relacionados ao tema.\r\nUm breve resumo fornecido pelo autor pode ser conferido a seguir:\r\n“Entre os estudiosos não há um consenso sobre a origem da Realidade Virtual. Em meio aos escritores não há um limite das suas possibilidades futuras. Todavia entre ciência e ficção nos encontramos. Em uma era de avanços tecnológicos consideráveis relacionados à Realidade Virtual e Aumentada, como podemos nos preparar para os desafios contemporâneos desta área?”\r\n\r\nMais informações sobre o evento podem ser conferidos em:\r\nhttp://www.ufjf.br/getcomp/eventos/getmeeting/informacoes-do-evento/', 'midia_1592336756.jpg', 3, '2018-11-13', 'No último dia 12 de novembro, alunos integrantes do grupo PET estiveram no IFSUDESTEMG – Campus Avançado Bom Sucesso, ministrando palestras sobre os trabalhos desenvolvidos no laboratório de pesquisa. As palestras aconteceram no evento “IFPlayers”, realizado pelo instituto para os alunos.'),
('Publicação: Consciência Artificial e Singularidade Tecnológica', 'Com apoio do filósofo Luiz Raimundo Tadeu da Silva Silva (UnB) e do graduando em Computação Pablo de Lara Sanches (IF Sudeste – MG), esta pesquisa multidisciplinar realizou um diálogo atemporal com Turing, Descartes, Wittgenstein, Karl Marx e John Searle, demonstrando a possibilidade da existência de uma consciência artificial e que a busca pela intencionalidade, promovida por algoritmos sofisticados de aprendizagem e descoberta de máquina, é a chave para o alcance da Singularidade Tecnológica.\r\n\r\nOs autores aproveitam para agradecer a iniciativa do Edital 02/2018 – PROPESQINOV, da Pró-Reitoria de Pesquisa e Inovação deste instituto, na qual a tradução para o inglês foi executada.\r\n\r\nMais informações em:\r\n\r\nhttp://www.marilia.unesp.br/#!/revistas-eletronicas/kinesis/edicoes/2018—volume-10-25/', 'midia_1592336650.jpg', 4, '2019-01-11', 'Como fruto de sua monografia da Graduação em Filosofia, o professor Alex publicou na Revista Kínesis (Qualis B2) o trabalho intitulado “THE EMERGENCE OF ARTIFICIAL CONSCIOUSNESS AND ITS IMPORTANCE TO REACH THE TECHNOLOGIC SINGULARITY”.'),
('Parceria para o Desenvolvimento de Produtos Tecnológicos', 'O Laboratório de Multimídia Interativa do Campus Rio Pomba (LAMIF) em parceria com professores e alunos do Mestrado em Educação Profissional e Tecnológica  celebram o início das atividades para o desenvolvimento de produtos educacionais de software.\r\nCom o objetivo de implementação de portais educacionais, aplicativos de celular e jogos eletrônicos, tem-se a meta de publicação dos primeiros protótipos para agosto deste ano.', 'midia_1597671272.jpg', 5, '2018-06-29', 'O Laboratório de Multimídia Interativa do Campus Rio Pomba (LAMIF) em parceria com professores e alunos do Mestrado em Educação Profissional e Tecnológica  celebram o início das atividades para o desenvolvimento de produtos educacionais de software.'),
('Integrantes do LAMIF em parceria com alunos da Educação Física realizam avaliações na UFRJ', ' ', 'midia_1592335096.jpeg', 6, '2018-12-09', 'No último dia 5 de dezembro, alunos integrantes do grupo PET juntamente com alunos do curso de Licenciatura em Educação Física do Campus Rio Pomba estiveram na Universidade Federal do Rio de Janeiro para realizar avaliações de um projeto desenvolvido no laboratório.'),
('Participação na Semana das Profissões', 'O LAMIF teve a honra de participar representando o Departamento Acadêmico de Ciência da Computação da I Mostra de Cursos e Profissões do IF Sudeste MG – Campus Rio Pomba.\r\nO evento foi realizado nos dias 16 e 17 de agosto e teve o objetivo de apresentar as possibilidades de formação técnica e superior ofertadas gratuitamente pela unidade.', 'midia_1597670752.jpg', 7, '2018-08-20', 'O LAMIF teve a honra de participar representando o Departamento Acadêmico de Ciência da Computação da I Mostra de Cursos e Profissões do IF Sudeste MG – Campus Rio Pomba.'),
('LAMIF tem dois Artigos Publicados no SVR 2018', 'Apresentamos novos resultados das pesquisas do LAMIF: dois artigos completos aceito para publicação no Symposium on Virtual and Augmented Reality.\r\nEste evento é o mais importante da Sociedade Brasileira da Computação a tratar sobre Realidade Virtual e Aumentada. Seu extrato Qualis atual é B2. Este ano ocorrerá em Foz do Iguaçu em paralelo ao SBGames e SIBGRAPI.\r\n\r\nOs trabalhos aprovados foram:\r\nUm estudo semiótico em jogos de realidade virtual e simulações (Leonardo Faêda, Alex Machado,  Pablo Sanches, Ítalo Rodrigues Gama e Wallacy Pasqualini)\r\nEfeito agudo do estímulo de realidade virtual no desempenho de nadadores: um estudo piloto (Marcella Menezes, João Freire, Alex Machado e Guilherme Tucher)\r\n\r\nMais informações sobre o SVR podem ser conferidos em:\r\n\r\nhttp://svr.net.br/\r\n\r\nE sobre o SBGames em:\r\n\r\nhttps://www.sbgames.org/sbgames2018/home', 'midia_1592337146.jpg', 8, '2018-08-18', 'Apresentamos novos resultados das pesquisas do LAMIF: dois artigos completos aceito para publicação no Symposium on Virtual and Augmented Reality.'),
('Participação na Semana da Informática no IFSul de Minas', 'As atividades conduzidas foram:\r\n\r\n1) Curso de Extensão: Desenvolvimento em Unity3D – Ofertado pelos bolsistas JULIE e PABLO\r\n\r\n2) Curso de Extensão: Introdução ao Blender  –  Ofertado pelos bolsistas  MARCELLA e VICTOR REZENDE\r\n3) Curso de Extensão: Introdução ao Android Studio  – Ofertado pelos bolsistas DIEGO e LEONARDO FAÊDA\r\n4) Curso de Extensão: Programação na Plataforma Dot Net  – Ofertado pelos bolsistas LUIZA e ARIEL\r\n5) Palestra: Realidade Virtual e Aumentada  – Ofertada pelo PROF. ALEX\r\n6) Palestra: Realidade Virtual e suas Aplicações –  Ofertada pelos bolsistas PABLO, MARCELLA e LEONARDO FAÊDA', 'midia_1592337007.jpg', 9, '2018-09-01', 'Como é tradição, pelo terceiro ano, o LAMIF participou da Semana da Informática no Campus Inconfidentes do IFSULDEMINAS, a convite da Professora Doutora Luciana Faria. O evento ocorreu do dia 27 a 29 desse mês de Agosto.'),
('LEO3D – Uma Tese em Defesa do Uso de um Jogo Eletrônico nas Aulas de Física', 'O que um jogo eletrônico deve ter para apoiar o ensino Física? Como avaliar a eficiência de um serius game? Esses entre outros questionamentos foram respondidos pelo pesquisador ANDRÉ LUIGI AMARAL DI SALVO. \r\n\r\nO professor Alex, deste departamento, prestigiou como membro da banca sua defesa de tese intitulada &#34;AMBIENTE DIGITAL MULTIDIDÁTICO PARA O ENSINO DE ÓPTICA GEOMÉTRICA: LEO3D - UMA AVENTURA PELO O MUNDO DA ÓPTICA&#34; na qual o recém Doutor dismistificou o uso de jogos eletrônicos na educação. \r\n\r\nA aplicação desenvolvida na Pós-Graduação em DESENVOLVIMENTO HUMANO E TECNOLOGIAS da UNIVERSIDADE ESTADUAL PAULISTA pode ser conferida no link:\r\nhttps://www.youtube.com/watch?v=-Xo0pg_WK9k', 'midia_1597671036.jpg', 19, '2018-07-04', 'O que um jogo eletrônico deve ter para apoiar o ensino Física? Como avaliar a eficiência de um serius game? Esses entre outros questionamentos foram respondidos pelo pesquisador ANDRÉ LUIGI AMARAL DI SALVO.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `codProjeto` int(40) NOT NULL,
  `tituloProjeto` text NOT NULL,
  `descricaoProjeto` longtext,
  `anoProjeto` varchar(4) NOT NULL,
  `midiaProjeto` varchar(100) DEFAULT NULL,
  `publicacaoProjeto` mediumtext,
  `parceriaProjeto` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `codPublicacao` int(40) NOT NULL,
  `descricaoPublicacao` varchar(10000) NOT NULL,
  `dataPublicacao` varchar(4) NOT NULL,
  `linkPublicacao` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`codPublicacao`, `descricaoPublicacao`, `dataPublicacao`, `linkPublicacao`) VALUES
(30, 'MACHADO, A. F. V. ; P.CAZETTA, P. ; SANTOS, P. C. ; FIGUEIREDO, A. M. O. ; SANTANA, L. S. ; S. JUNIOR, N. A. ; DUTRA, S. F. E. ; CLUA, E. W. . Uma Proposta de Jogo Educacional 3D com Questões Didáticas. In: Simpósio Brasileiro de Informática na Educação (SBIE), 2011, Aracajú/SE. Simpósio Brasileiro de Informática na Educação (SBIE), 2011', '2011', ''),
(2, 'MENEZES, M. L. ; FREIRE, J. P. ; MACHADO, A. F. V. ; TUCHER, G. . Acute effect of the virtual reality stimulus in the performance of swimmers: a pilot study. In: SYMPOSIUM ON VIRTUAL AND AUGMENTED REALITY, 2018, Foz do Iguaçu. SVR, 2018.', '2018', NULL),
(3, 'FAEDA, L. M. ; GAMA, I. R. ; ROBERTI JUNIOR, W. C. ; SANCHES, P. ; MACHADO, A. F. V. ; NERIO, W. O. P. . A Semiotic Study On Virtual Reality Games and Simulations. In: SYMPOSIUM ON VIRTUAL AND AUGMENTED REALITY, 2018, Foz do Iguaçu. SVR, 2018.', '2018', NULL),
(4, 'COSTA, D. L. ; BAFFA, M. F. ; MACHADO, A. F. V. . Emoção e Desempenho de Jogadores de E-Sports: Um Estudo Piloto. In: Simpósio Brasileiro de Games e Entretenimento Digital, 2018, Foz do Iguaçu. SBGames, 2018.', '2018', ''),
(5, 'LUCARELLI, D. ; LAVORATO, A. S. ; MACHADO, A. F. V. ; CATALDO JUNIOR, W. . Ensino de Lógica de Programação através do Jogo Defense of the Ancients 2. In: WIE, 2017, Recife. Workshop de Informática na Escola, 2017', '2017', ''),
(6, 'SANCHES, P. ; FAEDA, L. M. ; MACHADO, A. F. V. . VRCircuit: Realidade virtual aplicada ao ensino de circuitos elétricos. In: SBIE, 2017, Recife. Simpósio Brasileiro de Informática na Educação, 2017.', '2017', NULL),
(7, 'MOREIRA, G. B. S. M. ; RAMALHO, M. M. ; COSTA, V. R. ; BAFFA, M. F. ; RIBEIRO, L. G. G. ; MACHADO, A. F. V. ; BORGES, L. M. . Building Successful Games: A Complete Analysis of the Key Featuresof League of Legends. In: GAME-ON, 2017, Carlow, Ireland. European GAMEON Conference, 2017.', '2017', NULL),
(8, 'CUNHA, L. F. ; JUNQUEIRA, M. A. P. ; MACHADO, A. F. V. . Markov Chain in Fighting Electronic Games. In: European GAME-ON Conference, 2016, Lisboa. European GAME-ON Conference, 2016.', '2016', ''),
(9, 'RIBEIRO, L. G. G. ; ROCHA, R. R. ; BAFFA, M. F. ; MACHADO, A. F. V. . ?Stop The Roller Coaster!? – A Study of Cybersickness Occurrence. In: European GAME-ON Conference, 2016, Lisboa. European GAME-ON Conference, 2016.', '2016', ''),
(10, 'BAFFA, M. F. ; RAMALHO, M. M. ; MOREIRA, G. B. S. M. ; MACHADO, A. F. V. . Building Successful Games: An Analysis of League of Legends. In: SBGames, 2016, São Paulo. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2016.', '2016', ''),
(11, 'MOREIRA, G. B. S. M. ; FAUSTINO, P. R. C. ; RAMALHO, M. M. ; MACHADO, A. F. V. ; BAFFA, M. F. ; CLUA, E. W. . Affective Computing: Measuring the Player Emotions in Virtual Reality Environments. In: European Simulation and Modelling Conference, 2015, Leicester. ESM, 2015.', '2015', ''),
(12, 'BENTO, D. S. ; RODRIGUES, B. C. ; ALVES, J. C. P. ; SOUSA, B. L. ; NEVES JUNIOR, A. B. ; PAULO, L. M. ; MACHADO, A. F. V. . Metaheuristics Applied to the Autonomous Movement of Intelligent Agents. In: European Simulation and Modelling Conference, 2015, Leicester. ESM, 2015.', '2015', ''),
(13, 'FAEDA, L. M. ; SANCHES, P. ; LOPES, M. ; MACHADO, A. F. V. . Music Sheet Challenge: Um jogo educativo para o ensino de partituras musicais. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2015, Teresina. SBGames, 2015.', '2015', ''),
(14, 'JUNQUEIRA, M. A. P. ; CUNHA, L. F. ; RIBEIRO, J. G. ; MACHADO, A. F. V. . Uma Proposta de Jogo Assistivo Para Dispositivos Móveis em Prol da Inclusão Digital de Deficientes Visuais. In: Workshop de Informática na Escola, 2015, Maceió. WIE, 2015.', '2015', ''),
(16, 'BAFFA, M. F. O.; LATTARI, L. G.; Convolutional Neural Networks for Static and Dynamic Breast Infrared Imaging Classification. In: CONFERENCE ON GRAPHICS, PATTERNS AND IMAGES, 31. (SIBGRAPI), 2018, Foz do Iguaçu, PR, Brazil. Proceedings… 2018.', '2018', ''),
(17, 'MACHADO, A. F. V.; SILVA, L. R. T. S. ; SANCHES, P. . THE EMERGENCE OF ARTIFICIAL CONSCIOUSNESS AND ITS IMPORTANCE TO REACH THE TECHNOLOGICAL SINGULARITY. KÍNESIS (MARÍLIA), v. X, p. 111-127, 2018.', '2018', ''),
(18, 'FAUSTINO, P. R. C. ; RAMALHO, M. M. ; MOREIRA, G. B. S. M. ; MACHADO, A. F. V. ; SILVA, L. D. . Development of a Game with KINECT for Inclusion of Visually Impaired. In: European GAME-ON Conference, 2014, Lincoln. Game-on, 2014.', '2014', ''),
(19, 'RAMALHO, M. M. ; MOREIRA, G. B. S. M. ; FAUSTINO, P. R. C. ; SILVA, L. D. ; MACHADO, A. F. V. ; CLUA, E. W. . Audio game Fuga : Desenvolvimento e avaliação de um jogo assistivo com kinect para deficientes visuais. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2014, Porto Alegre. SBGames, 2014.', '2014', ''),
(20, 'JACOB, L. B. ; KOHWALTER, T. ; CLUA, E. W. ; OLIVEIRA, D. ; MACHADO, A. F. V. . A Non-intrusive Approach for Game Design Analysis Based on Provenance Data Extracted from Game Streaming. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2014, Porto Alegre. SBGames, 2014.', '2014', ''),
(21, 'ALVARENGA, E. R. Q. ; MACHADO, A. F. V. . Why Children Should Program Computers without Computers. In: European GAME-ON Conference, 2013, Bruxelas. Game-on, 2013.', '2013', ''),
(22, 'DIAS, L. L. ; MACHADO, A. F. V. ; PINTO, T. P. C. ; ANDRADE, F. L. C. ; PADOVANI, R. R. . A New Concept for Teaching AI Using as Example Classics from Electronic Games. In: European GAME-ON Conference, 2013, Bruxelas. Game-on, 2013.', '2013', ''),
(23, 'LUNARDI, A. C. ; CORREA, R. F. ; MACHADO, A. F. V. ; CLUA, E. W. . Neural Network for Multitask Learning Applied in Electronics Games. In: European GAME-ON Conference, 2013, Bruxelas. Game-on, 2013.', '2013', ''),
(24, 'SANTOS, U. O. ; MACHADO, A. F. V. ; CLUA, E. W. . Best First Search with Genetic Algorithm for Space Optimization in Pathfinding Problems. In: European GAME-ON Conference, 2012, Málaga. GAME-ON, 2012.', '2012', ''),
(25, 'MACHADO, A. F. V. ; BATISTA, I. A. ; SANTIAGO, M. C. ; PADOVANI, R. R. ; SOARES, B. G. ; CLUA, E. W. ; CARVALHO, S. P. ; GOMES, G. . Cognitive Classification of Electronic Games. In: International Conference on Culture & Computing, 2012, Hangzhou. International Conference on Culture & Computing, 2012.', '2012', ''),
(26, 'P.CAZETTA, P. ; OLIVEIRA, M. C. S. ; MACHADO, A. F. V. ; SANTOS, P. C. ; SANTOS, U. O. ; CLUA, E. W. . Mathematics Teaching Based on a New Pedagogical Tool for M-Learning. In: SBGames, 2012, Brasília. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2012.', '2012', ''),
(27, 'SANTIAGO, M. C. ; BATISTA, I. A. ; PADOVANI, R. R. ; MACHADO, A. F. V. ; SOARES, B. G. ; CLUA, E. W. ; CARVALHO, S. P. . A Proposal of Cognitive Classification of Electronic Games. In: SBGames, 2012, Brasília. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2012.', '2012', ''),
(28, 'SANTOS, U. O. ; MACHADO, A. F. V. ; CLUA, E. W. . Pathfinding Based on Pattern Detection Using Genetic Algorithms. In: SBGames, 2012, Brasília. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2012.', '2012', ''),
(29, 'MACHADO, A. F. V. ; BATISTA, I. A. ; SANTIAGO, M. C. ; SANTOS, U. O. ; PADOVANI, R. R. ; SILVA, S. L. M. ; CLUA, E. W. . Frigote: Uma Proposta de Ferramenta para Apoiar o Ensino de Avicultura. In: Simpósio Brasileiro de Informática na Educação (SBIE), 2011, Aracajú/SE. Simpósio Brasileiro de Informática na Educação (SBIE), 2011.', '2011', ''),
(31, 'MACHADO, A. F. V. ; CLUA, E. W. ; GONCALVES, R. ; VALVERDE, I. P. ; SANTOS, U. O. ; NEVES, T. ; OCHI, L. S. . Real Time Pathfinding with Genetic Algorithm. In: SBGames, 2011, Salvador, BA. Simpósio Brasileiro de Jogos e Entretenimento Digital (SBGames), 2011.', '2011', ''),
(32, 'MACHADO, A. F. V. ; CLUA,Esteban ; SANTOS, U. O. ; BATISTA, I. A. ; SANTIAGO, M. C. ; PADOVANI, R. R. ; SILVA, S. L. M. . Um Software Educativo para o Ensino de Avicultura. In: SBGames, 2011, Salvador, BA. Simpósio Brasileiro de Jogos e Entretenimento Digital (SBGames), 2011.', '2011', ''),
(33, 'MACHADO, A. F. V. ; CLUA, E. W. ; MONTANARI, M. V. ; DUARTE, C. G. ; REIS, W. M. P. ; CARVALHO, D. . An Architecture Based on M5P Algorithm for Multiagent Systems. In: ENIA – VIII Encontro Nacional de Inteligência Artificial, 2011, Natal/RN. ENIA – VIII Encontro Nacional de Inteligência Artificial, 2011.', '2011', ''),
(34, 'MAGALHAES, V. H. P. ; RESENDE, V. C. ; NOCELI, D. ; FREIRE, J. P. ; MACHADO, A. F. V. . Dengame: Um Jogo Educativo com Realidade Aumentada para Prevenção à Proliferação do Mosquito da Dengue. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2017, Curitiba. SBGames, 2017.', '2017', ''),
(35, 'RIBEIRO, L. G. G. ; MOURA, R. ; MAGALHAES, V. H. P. ; RESENDE, V. C. ; MACHADO, A. F. V. . Affective Computing in Electronic Games: Influence of Emotional States in Player Performance. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2017, Curitiba. SBGames, 2017.', '2017', ''),
(36, 'OLIVEIRA, V. C. ; PLACIDES, B. ; BAFFA, M. F. ; MACHADO, A. F. V. . A Hybrid Approach to Build Automatic Team Composition in League of Legends. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2017, Curitiba. SBGames, 2017.', '2017', ''),
(37, 'BAFFA, M. F. ; OLIVEIRA, L. C. ; FIALHO, W. F. ; VARGAS, D. ; MACHADO, A. F. V. . Inteligência Artificial e League of Legends: Um Relato de Aplicação de Jogos Eletrônicos no Ensino de Disciplinas Específicas. In: Simpósio Brasileiro de Jogos e Entretenimento Digital, 2017, Curitiba. SBGames, 2017.', '2017', ''),
(38, 'BAFFA, M. F. ; RAMALHO, M. M. ; MOREIRA, G. B. S. M. ; MACHADO, A. F. V. . Building Successful Games: An Analysis of League of Legends. In: SBGames, 2016, São Paulo. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2016.', '2016', ''),
(39, 'OLIVEIRA, L. C. ; RIBEIRO, L. G. G. ; MACHADO, A. F. V. . Introdução à logica de programação utilizando robôs educacionais para crianças do ensino básico. In: Simpósio Brasileiro de Jogos e Entretenimento Digital – See more at: http://www.sbgames.org/sbgames2015/#/, 2015, Teresina. SBGames, 2015.', '2015', ''),
(40, 'DIAS, L. L. ; MACHADO, A. F. V. ; PAULO, L. M. ; ALVARENGA, E. R. Q. . A Proposal to Program Contents for Teaching Children from 0 to 12 Years the Basics of Programming. In: European GAME-ON Conference, 2014, Lincoln. Game-on, 2014.', '2014', ''),
(41, 'MACHADO, A. F. V.; FARIA, A. C. B. ; FREITAS, E. ; SANTOS, P. C. ; CLUA, E. W. . Gamification for Professionals in the Development Area of Electronic Games. In: SBGames, 2012, Brasília. Simpósio Brasileiro de Jogos e Entretenimento Digital, 2012.', '2012', ''),
(42, 'SANTIAGO, M. C. ; PADOVANI, R. R. ; BATISTA, I. A. ; MACHADO, A. F. V. ; CLUA, E. W. ; SOARES, B. G. ; CARVALHO, S. P. . A New Cognitive Classification of Video Games. In: European GAME-ON Conference, 2012, Málaga. GAME-ON, 2012.', '2012', ''),
(43, 'MACHADO, A. F. V.; DUARTE, C. G. ; CLUA, E. W. ; ROGERIO, H. E. ; PAULO, L. M. ; PAULA, W. C. S. ; ROGERS, T. J. . Dynamic Difficulty Balancing of Strategy Games through Player Adaptation using Top Culling. In: SBGames, 2011, Salvador, BA. Simpósio Brasileiro de Jogos e Entretenimento Digital (SBGames), 2011.', '2011', ''),
(44, 'BAFFA, M. F. O.; CHELONI, D. J. M.; LATTARI, L. G.;  COELHO, M. A. N.  Segmentação Automática de Mamas em Imagens Infravermelhas Utilizando Limiarização com Refinamento Adaptativo em Bases Multivariadas. Revista de Informática Aplicada, v. 12, n. 2, 2017.', '2017', ''),
(45, 'BAFFA, M. F. O.; CHELONI, D. J. M.; LATTARI, L. G. Segmentação automática de imagens térmicas da mama utilizando limiarização com refinamento adaptativo. In: CONGRESSO DA SOCIEDADE BRASILEIRA DE COMPUTAÇÃO, 36. (CSBC), 2016, Porto Alegre, PR, Brazil. Anais… 2016. ', '2016', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tutores`
--

CREATE TABLE `tutores` (
  `codTutor` int(40) NOT NULL,
  `codIntegrante` int(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tutores`
--

INSERT INTO `tutores` (`codTutor`, `codIntegrante`) VALUES
(4, 1),
(5, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`codAdministrador`),
  ADD KEY `codIntegrante` (`codIntegrante`);

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`codColaborador`),
  ADD KEY `codIntegrante` (`codIntegrante`);

--
-- Indexes for table `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discentes`
--
ALTER TABLE `discentes`
  ADD PRIMARY KEY (`codDiscente`),
  ADD KEY `codIntegrante` (`codIntegrante`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`codDownload`);

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`codGaleria`);

--
-- Indexes for table `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`codInfo`);

--
-- Indexes for table `integrantes`
--
ALTER TABLE `integrantes`
  ADD PRIMARY KEY (`codIntegrante`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`codNoticia`);

--
-- Indexes for table `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`codProjeto`);

--
-- Indexes for table `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`codPublicacao`);

--
-- Indexes for table `tutores`
--
ALTER TABLE `tutores`
  ADD PRIMARY KEY (`codTutor`),
  ADD KEY `codIntegrante` (`codIntegrante`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `codAdministrador` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `codColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `discentes`
--
ALTER TABLE `discentes`
  MODIFY `codDiscente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `codDownload` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `codGaleria` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `codInfo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `integrantes`
--
ALTER TABLE `integrantes`
  MODIFY `codIntegrante` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `codNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `codProjeto` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `codPublicacao` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tutores`
--
ALTER TABLE `tutores`
  MODIFY `codTutor` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
