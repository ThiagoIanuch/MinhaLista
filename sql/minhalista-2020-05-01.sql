-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Maio-2020 às 06:05
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minhalista`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime`
--

DROP TABLE IF EXISTS `anime`;
CREATE TABLE IF NOT EXISTS `anime` (
  `animeID` int(11) NOT NULL AUTO_INCREMENT,
  `animeTitle` tinytext NOT NULL,
  `animeSinopse` text,
  `animeAvatar` longblob NOT NULL,
  `animeBanner` longblob,
  `animeType` tinytext NOT NULL,
  `animeEpisodes` int(4) DEFAULT NULL,
  `animeStatus` tinytext NOT NULL,
  `animeStart` date DEFAULT NULL,
  `animeEnd` date DEFAULT NULL,
  `animeSource` tinytext,
  `animeGenres` tinytext,
  PRIMARY KEY (`animeID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anime`
--

INSERT INTO `anime` (`animeID`, `animeTitle`, `animeSinopse`, `animeAvatar`, `animeBanner`, `animeType`, `animeEpisodes`, `animeStatus`, `animeStart`, `animeEnd`, `animeSource`, `animeGenres`) VALUES
(1, 'Steins;Gate', 'O cientista louco auto-proclamado Rintarou Okabe aluga um quarto em um antigo prédio deteriorado em Akihabara, onde ele se entrega a si mesmo em seu hobby de inventar potenciais \"futuros dispositivos\" com outros membros do laboratório: Mayuri Shiina, sua amigo de infância com cabeça de vento, e Hashida Itaru, um hacker pervertidao apelidado de \"Daru.\" Os três passam o tempo mexendo em uma máquina apelidada de \"Telefone Micro-ondas\", que executa a função estranha de transformar bananas em pilhas de gel verde.<br><br>\r\n\r\nEmbora milagroso por si só, o fenômeno não fornece nada de concreto na busca de Okabe por um avanço científico; isto é, até os membros do laboratório serem estimulados a agir por uma série de acontecimentos misteriosos antes de se depararem com um sucesso inesperado - o Telefone Micro-ondas pode enviar e-mails para o passado, alterando o fluxo da história.<br><br>\r\n\r\nAdaptado do romance visual aclamado pela crítica por 5pb. e Nitroplus, Steins; Gate leva Okabe pelas profundezas da teoria científica e da praticidade. Forçado através dos fios divergentes do passado e do presente, Okabe deve arcar com os encargos que acompanham a chave do domínio do tempo.', 0x312e6a7067, 0x312e6a7067, 'TV', 24, 'Finalizado', '2011-04-06', '2011-09-14', 'Novel', 'Ficção Científica, Thriller'),
(2, 'Bakemonogatari', 'Koyomi Araragi, uma estudante do terceiro ano do ensino médio, consegue sobreviver a um ataque de vampiro com a ajuda de Meme Oshino, um homem estranho que mora em um prédio abandonado. Apesar de ser salvo do vampirismo e agora um humano novamente, vários efeitos colaterais, como habilidades de cura sobre-humanas e visão aprimorada, ainda permanecem. Independentemente disso, Araragi tenta viver a vida de um aluno normal, com a ajuda de seu amigo e da presidente da turma, Tsubasa Hanekawa.<br><br>\r\n\r\nQuando a colega Hitagi Senjougahara cai da escada e é pego por Araragi, o garoto percebe que a garota não é natural. Apesar dos protestos de Senjougahara, Araragi insiste em ajudá-la, decidindo contar com a ajuda de Oshino, o mesmo homem que um dia o ajudou com sua própria situação.<br><br>\r\n\r\nAtravés de vários contos envolvendo demônios e deuses, Bakemonogatari segue Araragi enquanto ele tenta ajudar aqueles que sofrem de doenças sobrenaturais.', 0x322e6a7067, 0x322e6a7067, 'TV', 15, 'Finalizado', '2009-07-03', '2010-06-25', 'Novel', 'Mistério, Romance, Sobrenatural, Vampiro'),
(3, 'Re:Zero kara Hajimeru Isekai Seikatsu', 'Quando Subaru Natsuki sai da loja de conveniência, a última coisa que ele espera é ser arrancada de sua vida cotidiana e cair em um mundo de fantasia. As coisas não parecem boas para o adolescente confuso; no entanto, pouco depois de sua chegada, ele é atacado por alguns bandidos. Armado com apenas uma sacola de compras e um telefone celular agora inútil, ele é rapidamente espancado. Felizmente, uma beleza misteriosa chamada Satella, em perseguição a quem roubou suas insígnias, acontece com Subaru e o salva. Para agradecer à garota honesta e bondosa, Subaru se oferece para ajudar em sua busca, e mais tarde naquela noite, ele até encontra o paradeiro daquilo que ela procura. Mas, sem que eles soubessem, uma força muito mais sombria persegue o par das sombras, e apenas alguns minutos após localizar as insígnias, Subaru e Satella são brutalmente assassinados.<br><br>\r\n\r\nNo entanto, Subaru desperta imediatamente para uma cena familiar - confrontada pelo mesmo grupo de bandidos, encontrando Satella mais uma vez - o enigma se aprofunda à medida que a história se repete inexplicavelmente.', 0x332e6a7067, 0x332e6a7067, 'TV', 25, 'Finalizado', '2016-04-04', '2016-09-19', 'Novel', 'Drama, Fantasia, Psicológico, Thriller '),
(4, 'Code Geass: Hangyaku no Lelouch', 'No ano de 2010, o Sacro Império da Britannia está se estabelecendo como uma nação militar dominante, começando com a conquista do Japão. Renomeado para a Área 11 após sua rápida derrota, o Japão viu uma resistência significativa contra esses tiranos na tentativa de recuperar a independência.<br><br>\r\n\r\nLelouch Lamperouge, um estudante britânico, infelizmente se vê pego em um fogo cruzado entre as forças armadas rebeldes britânicas e da Área 11. Ele é capaz de escapar, no entanto, graças ao aparecimento oportuno de uma garota misteriosa chamada CC, que concede a ele Geass, o \"Poder dos Reis\". Percebendo o vasto potencial de seu recém-encontrado \"poder de obediência absoluta\", Lelouch embarca em uma perigosa jornada como vigilante mascarado conhecido como Zero, liderando um ataque impiedoso contra a Britannia para se vingar de uma vez por todas.', 0x342e6a7067, 0x342e6a7067, 'TV', 25, 'Finalizado', '2006-10-06', '2007-07-29', NULL, 'Ação, Militar, Ficção Científica, Super Poder, Drama, Mecha, Escolar'),
(5, 'Death Note', 'Um shinigami, como um deus da morte, pode matar qualquer pessoa - desde que veja o rosto da vítima e escreva o nome da vítima em um caderno chamado Death Note. Um dia, Ryuk, entediado com o estilo de vida shinigami e interessado em ver como um humano usaria um Death Note, joga um no reino humano.<br><br>\r\n\r\nO estudante do ensino médio e o prodígio Light Yagami se deparam com o Death Note e - desde que deplora o estado do mundo - testam o caderno mortal escrevendo o nome de um criminoso. Quando o criminoso morre imediatamente após seu experimento com o Death Note, Light fica muito surpreso e rapidamente reconhece o quão devastador o poder que caiu em suas mãos poderia ser.<br><br>\r\n\r\nCom essa capacidade divina, Light decide extinguir todos os criminosos, a fim de construir um novo mundo onde o crime não existe e as pessoas o adorem como um deus. A polícia, no entanto, descobre rapidamente que um serial killer está mirando criminosos e, consequentemente, tenta prender o culpado. Para fazer isso, os investigadores japoneses contam com a assistência do melhor detetive do mundo: um homem jovem e excêntrico conhecido apenas pelo nome de L.', 0x352e6a7067, 0x352e6a7067, 'TV', 37, 'Finalizado', '2006-10-04', '2007-06-27', NULL, 'Mistério, Polícial, Psicológico, Sobrenatural, Thriller, Shounen'),
(6, 'Yahari Ore no Seishun Love Comedy wa Machigatteiru', 'Hachiman Hikigaya é um estudante apático do ensino médio, com tendências narcísicas e semi-niilistas. Ele acredita firmemente que a juventude alegre não passa de uma farsa, e todo mundo que diz o contrário está mentindo para si mesmo.<br><br>\r\n\r\nEm uma nova punição por escrever um ensaio que zomba das relações sociais modernas, o professor de Hachiman o obriga a ingressar no Volunteer Service Club, um clube que tem como objetivo estender uma mão amiga a qualquer aluno que procura apoio para alcançar seus objetivos. Com o único outro membro do clube sendo a linda rainha do gelo Yukino Yukinoshita, Hachiman se encontra na linha de frente dos problemas de outras pessoas - um lugar que ele nunca sonhou que seria. Como Hachiman e Yukino usam sua inteligência para resolver os problemas de muitos estudantes, a visão podre de Hachiman sobre a sociedade provará ser um obstáculo ou uma ferramenta que ele pode usar a seu favor?\r\n', 0x362e6a7067, 0x362e6a7067, 'TV', 13, 'Finalizado', '2013-04-05', '2013-06-28', 'Novel', 'Fátia de Vida, Comédia, Drama, Romance, Escolar'),
(7, 'Shingeki no Kyojin', 'Séculos atrás, a humanidade foi massacrada até a quase extinção por monstruosas criaturas humanóides chamadas titãs, forçando os humanos a se esconderem com medo por trás de enormes paredes concêntricas. O que torna esses gigantes realmente aterrorizantes é que seu gosto pela carne humana não nasce da fome, mas do que parece ser por prazer. Para garantir sua sobrevivência, os remanescentes da humanidade começaram a viver dentro de barreiras defensivas, resultando em cem anos sem um único encontro de titãs. No entanto, essa calma frágil é logo destruída quando um titã colossal consegue romper a parede externa supostamente inexpugnável, reacendendo a luta pela sobrevivência contra as abominações devoradoras de homens.<br><br>\r\n\r\nDepois de testemunhar uma terrível perda pessoal nas mãos das criaturas invasoras, Eren Yeager dedica sua vida à sua erradicação, alistando-se no Survey Corps, uma unidade militar de elite que combate os humanóides impiedosos fora da proteção das muralhas. Baseado no mangá premiado de Hajime Isayama, Shingeki no Kyojin segue Eren, junto com sua irmã adotiva Mikasa Ackerman e seu amigo de infância Armin Arlert, enquanto eles se juntam à brutal guerra contra os titãs e correm para descobrir uma maneira de derrotá-los antes do último paredes são violadas.\r\n', 0x372e6a7067, 0x372e6a7067, 'TV', 25, 'Finalizado', '2013-04-07', '2013-09-29', 'Manga', 'Ação, Militar, Mistério, Super Poder, Drama, Fantasia, Shounen'),
(8, 'Hunter x Hunter (2011)', 'Hunter x Hunter é ambientado em um mundo onde os Hunters existem para executar todo tipo de tarefas perigosas, como capturar criminosos e procurar corajosamente tesouros perdidos em territórios desconhecidos. Gon Freecss, de 12 anos, está determinado a se tornar o melhor caçador possível na esperança de encontrar seu pai, que era um caçador e havia muito tempo abandonara seu filho. No entanto, Gon logo percebe que o caminho para alcançar seus objetivos é muito mais desafiador do que ele jamais poderia imaginar.<br><br>\r\n\r\nNo caminho para se tornar um caçador oficial, Gon faz amizade com o animado médico em treinamento Leorio, a vingativa Kurapika e o rebelde ex-assassino Killua. Para atingir seus próprios objetivos e desejos, juntos os quatro fazem o Exame Hunter, conhecido por sua baixa taxa de sucesso e alta probabilidade de morte. Ao longo de sua jornada, Gon e seus amigos embarcam em uma aventura que os coloca em muitas dificuldades e lutas. Eles conhecerão uma infinidade de monstros, criaturas e personagens - enquanto aprendem o que realmente significa ser um Caçador.', 0x382e6a7067, 0x382e6a7067, 'TV', 148, 'Finalizado', '2011-10-02', '2014-09-24', 'Manga', 'Ação, Aventura, Fantasia, Shounen, Super poder'),
(9, 'Fullmetal Alchemist: Brotherhood', '\"Para que algo seja obtido, algo de igual valor deve ser perdido.\"<br><br>\r\n\r\nA alquimia está vinculada a essa Lei da Troca Equivalente - algo que os jovens irmãos Edward e Alphonse Elric só percebem após tentar a transmutação humana: o único ato proibido de alquimia. Eles pagam um preço terrível por sua transgressão - Edward perde a perna esquerda, Alphonse, seu corpo físico. É apenas pelo sacrifício desesperado do braço direito de Edward que ele é capaz de fixar a alma de Alphonse em uma armadura. Devastada e sozinha, é a esperança de que ambos retornem aos seus corpos originais que dá a Edward a inspiração para obter membros de metal chamados \"automail\" e se tornar um alquimista de estado, o Fullmetal Alchemist.<br><br>\r\n\r\nTrês anos depois, os irmãos buscam a Pedra Filosofal, uma relíquia mítica que permite ao alquimista superar a Lei da Troca Equivalente. Mesmo com os aliados militares Coronel Roy Mustang, Tenente Riza Hawkeye e Tenente Coronel Maes Hughes ao seu lado, os irmãos se vêem envolvidos em uma conspiração nacional que os leva não apenas à verdadeira natureza da indescritível Pedra Filosofal, mas também à obscuridade de seu país. história também. Entre encontrar um assassino em série e correr contra o tempo, Edward e Alphonse devem se perguntar se o que estão fazendo os tornará humanos novamente ... ou tirarão sua humanidade.', 0x392e6a7067, 0x392e6a7067, 'TV', 64, 'Finalizado', '2009-04-05', '2010-07-04', 'Manga', 'Ação, Militar, Aventura, Comédia, Drama, Magia, Fantasia, Shounen'),
(10, 'Youkoso Jitsuryoku Shijou Shugi no Kyoushitsu e', 'Na superfície, a Escola Secundária Koudo Ikusei é uma utopia. Os alunos desfrutam de uma quantidade incomparável de liberdade e é altamente classificada no Japão. No entanto, a realidade é menos do que ideal. Quatro classes, de A a D, são classificadas em ordem de mérito, e somente as classes superiores recebem tratamento favorável.<br><br>\r\n\r\nKiyotaka Ayanokouji é um aluno da classe D, onde a escola despeja o pior. Lá, ele conhece a indecorosa Suzune Horikita, que acredita que ela foi colocada na Classe D por engano e deseja subir até a Classe A, e o aparentemente ídolo da classe Kikyou Kushida, cujo objetivo é fazer o máximo de amigos possível.<br><br>\r\n\r\nEmbora a associação de classe seja permanente, a classificação de classe não é; os alunos das classes mais baixas podem subir na classificação se obtiverem melhores resultados do que os das melhores. Além disso, na Classe D, não há restrições sobre quais métodos podem ser usados ​​para avançar. Nesta escola cruel, eles podem prevalecer contra as probabilidades e chegar ao topo?', 0x31302e6a7067, 0x31302e6a7067, 'TV', 12, 'Finalizado', '2017-07-12', '2017-09-27', 'Novel', 'Fátia de Vida, Psicológico, Drama, Escolar	'),
(11, 'Toradora!', NULL, 0x31312e6a7067, NULL, 'TV', NULL, 'Finalizado', NULL, NULL, NULL, NULL),
(12, 'Naruto', NULL, 0x31322e6a7067, NULL, 'TV', NULL, 'Finalizado', NULL, NULL, NULL, NULL),
(13, 'Neon Genesis Evangelion', NULL, 0x31332e6a7067, NULL, 'TV', NULL, 'Finalizado', NULL, NULL, NULL, NULL),
(14, 'Kono Subarashii Sekai ni Shukufuku wo!', NULL, 0x31342e6a7067, NULL, 'TV', NULL, 'Finalizado', NULL, NULL, NULL, NULL),
(15, 'One Piece', NULL, 0x31352e6a7067, NULL, 'TV', NULL, 'Finalizado', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime_characters`
--

DROP TABLE IF EXISTS `anime_characters`;
CREATE TABLE IF NOT EXISTS `anime_characters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `characterID` int(11) NOT NULL,
  `characterRole` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `characterID` (`characterID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anime_characters`
--

INSERT INTO `anime_characters` (`ID`, `animeID`, `characterID`, `characterRole`) VALUES
(1, 1, 1, 'Principal'),
(2, 1, 2, 'Principal'),
(3, 1, 3, 'Principal'),
(4, 1, 4, 'Principal'),
(5, 1, 5, 'Secundário'),
(6, 1, 6, 'Secundário'),
(7, 2, 7, 'Principal'),
(8, 2, 8, 'Principal'),
(9, 2, 9, 'Principal'),
(10, 2, 10, 'Principal'),
(11, 2, 11, 'Principal'),
(12, 2, 12, 'Principal'),
(13, 3, 13, 'Principal'),
(14, 3, 14, 'Principal'),
(15, 3, 15, 'Secundário'),
(16, 3, 16, 'Secundário'),
(17, 3, 17, 'Secundário'),
(18, 3, 18, 'Secundário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime_favorites`
--

DROP TABLE IF EXISTS `anime_favorites`;
CREATE TABLE IF NOT EXISTS `anime_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anime_favorites`
--

INSERT INTO `anime_favorites` (`ID`, `animeID`, `userID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime_users`
--

DROP TABLE IF EXISTS `anime_users`;
CREATE TABLE IF NOT EXISTS `anime_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userStatus` int(1) NOT NULL DEFAULT '1',
  `userScore` int(2) DEFAULT NULL,
  `userEpisodes` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anime_users`
--

INSERT INTO `anime_users` (`ID`, `animeID`, `userID`, `userStatus`, `userScore`, `userEpisodes`) VALUES
(1, 1, 1, 2, 10, 24),
(7, 5, 1, 1, NULL, 0),
(3, 4, 1, 1, 8, 0),
(4, 5, 2, 1, 9, 0),
(5, 6, 1, 1, NULL, 0),
(6, 12, 1, 1, 5, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `characters`
--

DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `characterID` int(11) NOT NULL AUTO_INCREMENT,
  `characterName` tinytext NOT NULL,
  `characterAvatar` longblob NOT NULL,
  `characterInfo` text,
  PRIMARY KEY (`characterID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `characters`
--

INSERT INTO `characters` (`characterID`, `characterName`, `characterAvatar`, `characterInfo`) VALUES
(1, 'Rintarou Okabe', 0x312e6a7067, 'Idade: 18<br>\r\nData de nascimento: 14 de dezembro<br>\r\nAltura: 177 cm<br>\r\nPeso: 60 kg<br><br>\r\n\r\nOkabe Rintarou é o principal protagonista de Steins; Gate. Ele é um estudante do primeiro ano da Universidade Tokyo Denki e se autodenomina um louco louco cientista Ele age como um vilão, mas é bastante imaturo, pois frequentemente mostra traços da síndrome de Chunibyou (中二病), apesar de ser um homem adulto. Depois de se matricular na universidade, foi a Akihabara para abrir um laboratório chamado \"Future Gadget\" Research Establishment \", onde ele inventa aparelhos que são bastante inúteis. Ele também fala sozinho no celular, suas palavras não fazem muito sentido. Supostamente, ele tem muito poucos amigos que conseguem entender do que está falando.\r\n<br><br>\r\nOkabe freqüentemente se refere a si mesmo como \"Hououin Kyouma\" (鳳凰院凶真). No entanto, Mayuri e Daru apenas o chamam de \"Okarin\" (オカリン), abreviado após seu nome.<br><Br>\r\n\r\nA frase que ele usa para encerrar conversas, particularmente consigo mesmo, é \"El Psy Kongroo\" (エル・プサイ・コングルゥ)'),
(2, 'Kurisu Makise', 0x322e6a7067, NULL),
(3, 'Mayuri Shiina', 0x332e6a7067, NULL),
(4, 'Itaru Hashida', 0x342e6a7067, NULL),
(5, 'Suzuha Amane', 0x352e6a7067, NULL),
(6, 'Rumiho Akiha', 0x362e6a7067, NULL),
(7, 'Koyomi Araragi', 0x372e6a7067, NULL),
(8, 'Hitagi Senjougahara', 0x382e6a7067, NULL),
(9, 'Tsubasa Hanekawa', 0x392e6a7067, NULL),
(10, 'Mayoi Hachikuji', 0x31302e6a7067, NULL),
(11, 'Suruga Kanbaru', 0x31312e6a7067, NULL),
(12, 'Nadeko Sengoku', 0x31322e6a7067, NULL),
(13, 'Subaru Natsuki', 0x3133, NULL),
(14, 'Emilia', 0x3134, NULL),
(15, 'Rem', 0x3135, NULL),
(16, 'Ram', 0x3136, NULL),
(17, 'Beatrice', 0x3137, NULL),
(18, 'Pack', 0x3138, NULL),
(19, 'Eikichi Onizuka', 0x31392e6a7067, 'Aniversário: 3 de agosto de 1975<br><br>\r\n\r\nOnizuka Eikichi, uma motoqueira de 22 anos, hormonal, de cabelos loiros e virgem, se formou em uma universidade de nível inferior por trapaça e, como tal, não consegue um emprego decente. Sua principal maneira de passar o tempo é espiando as saias das meninas em um shopping local. Ele é muito atlético, pois pode fazer supino de 150 kg (331 libras), tem uma segunda faixa preta de karatê e até alega fazer 500 flexões, 1000 flexões e 2000 agachamentos diariamente. Através dos eventos explicados no mangá Great Teacher Onizuka, Onizuka decide se tornar um professor, embora mais tarde esteja implícito que ele tem um QI de cerca de 50 (embora não necessariamente verdadeiro).<br><br>\r\n\r\nSua formação inicial de professores é na Escola Pública Pública de Musashino, onde ele conhece Nanako Mizuki. Sua experiência de domar as turmas turbulentas de sua turma designada endurece suas convicções de que o ensino é o caminho a percorrer e, quando ele descobre os problemas de Mizuki, ele também decide se abster de experiências sexuais com seus alunos, optando por resolver seus problemas pessoais para eles, em vez de. Infelizmente, ele quase errou ao esquecer de fazer o exame do serviço público de professores públicos. Como resultado, nenhuma escola pública o levará, mas ele ainda é elegível para várias escolas particulares. Ele consegue um emprego na Academia Holy Forest, com crosta superior, apesar das objeções do vice-diretor Uchiyamada Hiroshi, a quem ele continua a agravar seu mandato. Claro, Uma das condições de ter um emprego na Floresta Sagrada é que ele deve dormir na escola - na sala de armazenamento no último andar, com acesso ao telhado - e é aqui que Onizuka inicia oficialmente sua carreira como professor, quando para Yoshikawa Noboru de cometer suicídio. Onizuka é encarregado da classe 3-4, uma classe tão ruim que já levou vários professores à loucura. Ele não apenas sobrevive às táticas brutais de bullying da turma, mas também faz amizade com seus alunos, e a espinha dorsal da história do Grande Professor Onizuka consiste em suas experiências únicas em transformar seus alunos e aprender lições. Onizuka é encarregado da classe 3-4, uma classe tão ruim que já levou vários professores à loucura. Ele não apenas sobrevive às táticas brutais de bullying da turma, mas também faz amizade com seus alunos, e a espinha dorsal da história do Grande Professor Onizuka consiste em suas experiências únicas em transformar seus alunos e aprender lições. Onizuka é encarregado da classe 3-4, uma classe tão ruim que já levou vários professores à loucura. Ele não apenas sobrevive às táticas brutais de bullying da turma, mas também faz amizade com seus alunos, e a espinha dorsal da história do Grande Professor Onizuka consiste em suas experiências únicas em transformar seus alunos e aprender lições.<br><br>\r\n\r\nMais tarde está implícito novamente, durante os Exames Nacionais, que Onizuka pode realmente ser algum tipo de gênio. Os resultados de seus exames foram trocados: uma para a nota máxima e outra para a nota mínima. No entanto, quando perguntam a Yoshito Kikuchi se ele está curioso sobre os verdadeiros resultados de Onizuka, ele verifica as respostas e o resultado o surpreende. Ele checa com Onizuka, que afirma que ele definitivamente obteve resultados perfeitos com seu próprio esforço (o que seria incrível, já que ele fez um exame de 5 horas em 1 hora, sangrando e com 4 balas no estômago). Onizuka tem uma incrível resistência física. Em mais de uma ocasião, ele caiu de alturas que matariam instantaneamente a maioria das pessoas e afirma ter um tipo de fator de cura, pois ele se recuperou de um braço quebrado em menos de um dia e até sofreu vários ferimentos a bala, em um curto espaço de tempo. período de tempo.<br><br>\r\n\r\nSuas habilidades de luta também não devem ser tomadas de ânimo leve, pois Onizuka é capaz de afastar vários oponentes, mesmo que eles estejam bem armados, e quase nunca recebe nenhum dano físico. Apesar de suas impressionantes habilidades de luta, Onizuka é frequentemente criticado por seus alunos e outros, sempre que se comporta mal. Pode-se especular que, no fundo, Onizuka sabe quando está agindo imaturo e permite que outros o mantenham na linha. Um exemplo disso é quando ele força seus alunos a cavar a terra em busca de tesouros enterrados durante a viagem a Okinawa. Kanzaki Urumi chuta Onizuka para um buraco, e mais tarde o obriga a usar roupas de S&M e o faz rastejar de quatro, com Urumi andando de costas.<br><br>\r\n\r\nSeu modo de transporte pessoal é um Kawasaki 750 Road Star Z2. A moto em si também é destaque na série prequel do GTO.'),
(20, 'Azusa Fuyutsyki', 0x32302e6a7067, 'Uma bela professora de 22 anos que é a heroína da série. Ao contrário de Onizuka, ela levou uma vida relativamente normal, se formando na Universidade de Waseda. Sua maneira quieta e idéias moderadas são enganosas, pois ela prova ser muito dura sozinha, às vezes assustando até Onizuka. Para prepará-lo para o teste que determinaria sua carreira de professor, ela prepara uma montanha de geleia com olhos de atum Maguro como frutas e impõe horários incrivelmente difíceis que matariam alguém ou os enlouqueceriam. Seu campo de ensino é o Kokugo ou o idioma japonês (inglês no Live Action). Ela, não surpreendentemente, se apaixona por Onizuka, mas como ambos relutam em admitir seus sentimentos e mostrá-los abertamente, eles afirmam que são apenas \'amigos\'. Isto\' não é realmente um assunto importante para mais ninguém, exceto Suguru Teshigawara, que acha mais irritante que uma mulher com suas qualificações se apaixone por outra com um fundo tão bruto quanto Onizuka. Ela tem dificuldade com as alunas de sua turma devido a todos os garotos da turma terem paixões por ela, mas as traz rapidamente rapidamente após o conselho de Onizuka. Ela tem uma irmã mais nova chamada Makoto.<br><br>\r\n\r\nO Azusa Fuyutsuki retratado no drama de ação ao vivo difere muito das versões de anime e mangá. Nessa versão, Fuyutsuki se tornou professora porque sentiu que era forçada e inveja a vida de sua irmã, que se tornou uma aeromoça que frequentemente namora celebridades masculinas (e também recebe alguns presentes extravagantes). Ela acaba decidindo permanecer como professora. graças a alguns convincentes de Onizuka, embora os dois sejam continuamente retratados como em desacordo com o amor fortemente implícito. A versão live-action de Fuyutsuki também detesta os homens em geral, achando-os muito possessivos com as mulheres, embora Onizuka também a convença de que ela também é culpada do mesmo pecado. Curiosamente, ela também está presente em muitas das \'lições\' que Onizuka ensina pessoalmente a seus alunos.'),
(21, 'Hiroshi Uchiyamada', 0x32312e6a7067, 'O pai de Yoshiko e vice-diretor da Holy Forest Academy. Ele é um homem muito rigoroso que segue cegamente as regras da escola e as coloca em cima de qualquer outra coisa. Além disso, ele não tem muita paciência.<br><br>\r\n\r\nHiroshi fica facilmente irritado com o comportamento de Onizuka basicamente sempre. Ele mostra que não tem respeito pelos delinqüentes da escola ou mesmo se revolta com os caras durante a série. Ele acredita que Onizuka é a raiz do mal de todos os seus infortúnios. Ele era visivelmente contra a contratação de Onizuka, mas teve que aceitar a decisão positiva do diretor Sakurai. Uchiyamada está sempre gritando com o comportamento de Onizuka e discute muito com ele.'),
(22, 'Urumi Kanzaki', 0x32322e6a7067, 'A antítese do estereótipo \"loira burra\", Urumi Kanzaki é um prodígio com QI acima de 200. Ela também é uma heterocromática, com olhos de cores diferentes: um marrom e um azul. No entanto, ela é psicologicamente perturbada, tendo seu quinhão de ódio em relação aos professores. Seu gênio é exibido repetidamente por ações abstratas como a detonação de bombas-relógio (ou seja, fogos de artifício em caixas descartáveis) e fazer uma cobra inofensiva parecer uma cobra usando recortes de papel. Seu intelecto também é mostrado através de ações, como gritar palavrões em francês e ser capaz de falar mandarim fluentemente. Na viagem a Okinawa, Toshito Kikuchi observou que sabe falar cinco idiomas, mas ironicamente, ela não entende o que dizem os colegas de quarto de Gundam otaku.'),
(23, 'Miyabi Aizawa', 0x32332e6a7067, 'No anime, Aizawa começou a não confiar mais nos professores quando um de seus colegas de classe se envolveu em um escândalo devido a um caso de seu ex-instrutor. A partir disso, ela e seus companheiros começaram sua busca de expulsar qualquer professor que fosse designado para sua classe. Eles tiveram sucesso em fazer com que esses professores se demitissem, mas Onizuka ...'),
(24, 'Yoshito Kikuchi', 0x32342e6a7067, 'Yoshito Kikuchi é um dos alunos de Eikichi Onizuka. Esse prodígio do computador (que obteve a maior pontuação sem certas \"ajudas\" no país, em um teste padronizado) serve como presidente de classe e também é conhecido por fazer fotos pornográficas compostas, durante a chegada de Onizuka à Academia da Floresta Sagrada. Ele tenta chantageá-lo com resignação com várias fotos postadas em toda a escola para que todos vejam. Onizuka pega Kikuchi e, em vez de puni-lo, o contrata para fazer fotos compostas de Azusa Fuyutsuki e outras professoras, para sua surpresa.<br><br>\r\n\r\nKikuchi finalmente faz amizade com Onizuka e, mais tarde, ajuda Noboru Yoshikawa a impedir que a mãe de Anko Uehara, presidente da Associação de Pais e Mestres local, seja demitida. Kikuchi é um artista marcial amador, com experiência anterior em judô e outras técnicas aprendidas com Mayu Wakui (na ação ao vivo, ele afirma que apenas o conhece e não demonstra essa afirmação). Após os exames, é revelado que ele foi quem trocou os papéis de teste de Onizuka por uma pontuação perfeita. Quando questionado sobre os resultados reais de Onizuka, Kikuchi calcula ele mesmo e fica completamente surpreso com a pontuação (não se sabe se Onizuka realmente obteve a pontuação perfeita ou com a inteligência) e pergunta diretamente a ele, para qual professor. responde que ele definitivamente recebeu uma pontuação perfeita.<br><br>\r\n\r\nNo mangá, um possível relacionamento é sugerido entre ele e Ai Tokiwa, após alguma intervenção e um abraço forçado de Onizuka. Na live-action, Kikuchi tem um relacionamento de longa distância com Tomoko Nomura.'),
(25, 'Kiyotaka Ayanokouji', 0x32352e6a7067, 'Aniversário: 20 de outubro<br>\r\nAltura: 176 cm<br>\r\nSigno do zodíaco: Libra Local<br>\r\nfavorito: Nenhum<br>\r\nNão gosta: Atuar de acordo com o livro<br>\r\nLugar usual: seu quarto<br><br>\r\n\r\nUm estudante discreto que é muito pobre em se comunicar com outras pessoas, mesmo que ele queira, assim ele tende a se isolar. Suas emoções são difíceis de ler. Ele recebeu notas \"perfeitamente intermediárias\" em seu exame de admissão, já que acadêmico e atlético, ele é mediano.\r\n'),
(26, 'Suzune Horikita', 0x32362e6a7067, 'Aniversário: 15 de fevereiro<br>\r\nAltura: 156 cm<br>\r\nSigno do zodíaco: Aquário<br>\r\nBWH: 79/54/79<br>\r\nGosta: Seriedade e diligência<br>\r\nNão gosta: Doçura<br>\r\nLocal habitual: seu quarto<br><br>\r\n\r\nUma linda garota que se senta ao lado de Ayanokouji. Ela é o oposto de Ayanokouji quando se trata de amizade; ela desconsidera e pensa em fazer amigos desnecessários, portanto, ela não se comunica muito com seus colegas de classe. Ela não está convencida de que foi colocada na classe D, portanto ela pretende ser promovida para a classe A.'),
(27, 'Kikyou Kushida', 0x32372e6a7067, 'Aniversário: 23 de janeiro<br>\r\nAltura: 155 cm<br>\r\nSigno do zodíaco: Aquário<br>\r\nBWH: 82/55/83<br>\r\nGostos: Ser capaz de conviver com outras pessoas, mesmo com estranhos<br>\r\nNão gosta: Sempre que as pessoas não se dão bem<br>\r\nLocal de costume: Escola, café, Zelkey shopping, dormitório<br><br>\r\n\r\nEla possui uma enorme popularidade entre homens e mulheres como ídolo da classe D. Ela pretende ser amiga de todos, não apenas da classe D. Ela quer se dar bem com sua colega de classe, Horikita.'),
(28, 'Kei Karuizawa', 0x32382e6a7067, 'Aniversário: 8 de março<br>\r\nAltura: 154 cm<br>\r\nSigno do zodíaco: Peixes<br>\r\nBWH: 76/54/77<br>\r\nGosta de: Ser a figura central da classe<br>\r\nNão gosta: Atuar de acordo com o livro<br>\r\nLugar usual: café, Zelkey ​​shopping, karaokê<br><br>\r\n\r\nEla é uma garota com um má atitude que está localizada no topo da hierarquia da classe D. Ela luta com Kushida pelos 2 melhores lugares da classe.'),
(29, 'Honami Ichinose', 0x32392e6a7067, 'Ela é aluna da classe B e é referida como a figura central da classe B por Horikita Suzune.'),
(30, 'Arisu Sakayanagi', 0x33302e6a7067, 'Idade: 16<br>\r\nAniversário: 12 de março<br>\r\nAltura: 150 cm<br>\r\nMedidas: B70 / W54 / H77<br><br>\r\n\r\nEla parece ter uma atitude de \"seguir o fluxo\", pois aceita a maioria das situações sem protesto, embora manifeste seu desagrado por situações chatas depois que Katsuragi notou a pontuação da turma. Ao contrário de Kouhei Katsuragi, que tem uma postura conservadora, Arisu possui uma atitude inovadora. Juntos, os dois lideram efetivamente a classe A ao longo dos anos escolares.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `characters_favorites`
--

DROP TABLE IF EXISTS `characters_favorites`;
CREATE TABLE IF NOT EXISTS `characters_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `characterID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `characterID` (`characterID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `characters_favorites`
--

INSERT INTO `characters_favorites` (`ID`, `characterID`, `userID`) VALUES
(1, 25, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `friends_requests`
--

DROP TABLE IF EXISTS `friends_requests`;
CREATE TABLE IF NOT EXISTS `friends_requests` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userFriendSent` int(11) NOT NULL,
  `userFriendReceived` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userFriendSent` (`userFriendSent`),
  KEY `userFriendReceived` (`userFriendReceived`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `friends_users`
--

DROP TABLE IF EXISTS `friends_users`;
CREATE TABLE IF NOT EXISTS `friends_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userFriendIDOne` int(11) NOT NULL,
  `userFriendIDTwo` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userFriendIDOne` (`userFriendIDOne`),
  KEY `userFriendIDTwo` (`userFriendIDTwo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `friends_users`
--

INSERT INTO `friends_users` (`ID`, `userFriendIDOne`, `userFriendIDTwo`) VALUES
(4, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga`
--

DROP TABLE IF EXISTS `manga`;
CREATE TABLE IF NOT EXISTS `manga` (
  `mangaID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaTitle` tinytext NOT NULL,
  `mangaSinopse` text,
  `mangaAvatar` longblob NOT NULL,
  `mangaBanner` longblob,
  `mangaType` tinytext NOT NULL,
  `mangaChapters` int(4) DEFAULT NULL,
  `mangaVolumes` int(4) DEFAULT NULL,
  `mangaStatus` tinytext NOT NULL,
  `mangaStart` date DEFAULT NULL,
  `mangaEnd` date DEFAULT NULL,
  `mangaGenres` tinytext,
  PRIMARY KEY (`mangaID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manga`
--

INSERT INTO `manga` (`mangaID`, `mangaTitle`, `mangaSinopse`, `mangaAvatar`, `mangaBanner`, `mangaType`, `mangaChapters`, `mangaVolumes`, `mangaStatus`, `mangaStart`, `mangaEnd`, `mangaGenres`) VALUES
(1, 'GTO', 'Eikichi Onizuka, 22 anos: pervertido, ex-membro de gangue ... e professor?<br><br>\r\n\r\nO grande professor Onizuka segue as incríveis, embora muitas vezes ridículas, travessuras do professor titular, enquanto ele tenta enganar e conquistar a astuta classe 3-4 que está determinada a removê-lo da escola. No entanto, outros obstáculos se apresentam por toda parte - incluindo o vice-diretor frustrado e careca Hiroshi Uchiyamada; velhos inimigos de seus dias de motociclista; e seus próprios métodos de ensino idiotas. Mas Eikichi luta contra tudo isso enquanto tenta ajudar seus alunos, o professor de romance Azusa Fuyutsuki, e ganhar seu título auto-proclamado.', 0x312e6a7067, 0x312e6a7067, 'Manga', 208, 25, 'Finalizado', '1996-12-11', '2002-01-30', 'Ação, Comédia, Drama, Ecchi, Escolar, Shounen'),
(2, 'Youkoso Jitsuryoku Shijou Shugi no Kyoushitsu e', 'Koudo Ikusei Senior High School, uma escola de prestígio líder com instalações de última geração, onde quase 100% dos estudantes freqüentam a universidade ou encontram emprego. Os estudantes têm a liberdade de usar qualquer penteado e trazer quaisquer objetos pessoais que desejarem. Koudo Ikusei é uma escola paradisíaca, mas a verdade é que apenas os alunos mais superiores recebem tratamento favorável.<br><br>\r\n\r\nO protagonista Kiyotaka Ayanokouji é um aluno da classe D, que é onde a escola despeja seus alunos \"inferiores\" para ridicularizá-los. Por um certo motivo, Kiyotaka foi descuidado em seu exame de admissão e foi colocado na classe D. Depois de conhecer Suzune Horikita e Kikyou Kushida, outros dois alunos de sua turma, a situação de Kiyotaka começa a mudar.', 0x322e6a7067, 0x322e6a7067, 'Novel', NULL, NULL, 'Em publicação', '2015-05-25', NULL, 'Comédia, Romance, Escolar'),
(3, 'Onanie Master Kurosawa', 'Kakeru Kurosawa, de quatorze anos, é um estudante antissocial do ensino médio que menospreza seus colegas de classe - mas por baixo de seu complexo de superioridade está um jovem adolescente sem esperança que usa a masturbação como passatempo. Usando pensamentos eróticos de suas colegas de classe como estímulo, ele se tranca diariamente no banheiro de uma garota raramente usada na escola para fazer sua ação suja.<br><br>\r\n\r\nUm dia, durante as aulas, Kurosawa testemunha as meninas populares intimidando a tímida Aya Kitahara. Embora não seja alguém que se irrite com esses assuntos, ele decide retribuir com suas próprias mãos. Em um movimento ousado, ele rouba os uniformes dos agressores e distribui sua \"justiça branca\" sobre eles.<br><br>\r\n\r\nEmbora satisfeito com suas façanhas, os problemas de Kurosawa estão apenas começando. Enquanto segue sua rotina diária, ele é subitamente confrontado por Kitahara, que o identifica como o culpado por trás do incidente uniforme, e chantageia-o para aterrorizar as outras garotas da classe da mesma maneira que ele lidou com os agressores dela. Deixando poucas opções, Kurosawa concorda e, assim, começa uma história de maioridade que lida com consequências, bullying e a capacidade das pessoas de mudar.', 0x332e6a7067, 0x332e6a7067, 'Manga', 31, 4, 'Finalizado', '2007-09-00', '2008-03-00', 'Drama, Psicológico, Escolar'),
(4, 'Akame ga Kill!', 'O cruel Ministro Honest explora a ignorância de um novo jovem imperador e desonestamente governa o país das sombras com moral distorcida e sem consideração pela vida humana. Como resultado disso, uma epidemia de crime e corrupção se espalhou por toda a capital do país, e um estado da sociedade ocorre onde os privilegiados têm domínio absoluto sobre os menos.<br><br>\r\n\r\nNo entanto, existe uma organização para combater esse abuso de poder: Night Raid, uma divisão secreta do Exército Revolucionário opositor. É composto por uma pequena equipe de assassinos cruéis que assassinam todos aqueles que participam ou fazem vista grossa para as ultrajantes irregularidades do Império.<br><br>\r\n\r\nTatsumi é um jovem ingênuo e empunhado de espadas em uma jornada para salvar sua aldeia empobrecida. Logo, ele testemunha os horrores sangrentos e a crueldade da capital em primeira mão. Superado com ódio, Tatsumi é influenciado pela causa profunda de Night Raid e decide se juntar a eles, embarcando em uma missão dolorosa e perigosa para se vingar do Ministro Honesto. Tatsumi ganha muitas experiências inestimáveis ​​ao desvendar a ética de ideologias conflitantes, vida e morte, enquanto trabalha para a restauração de um mundo humano.', 0x342e6a7067, 0x342e6a7067, 'Manga', 80, 15, 'Finalizado', '2010-04-22', '2016-12-22', 'Ação, Drama, Fantasia, Terror, Shounen'),
(5, 'Berserk', 'Guts, um ex-mercenário agora conhecido como \"Espadachim Negro\", está em vingança. Depois de uma infância tumultuada, ele finalmente encontra alguém em quem respeita e acredita que pode confiar, apenas para que tudo desmorone quando essa pessoa tira tudo o que é importante para Guts com o objetivo de satisfazer seus próprios desejos. Agora marcado para a morte, Guts torna-se condenado a um destino em que ele é incansavelmente perseguido por seres demoníacos.<br><br>\r\n\r\nPartindo de uma terrível missão repleta de infortúnios, Guts, armado com uma espada maciça e uma força monstruosa, não permitirá que nada o pare, nem mesmo a própria morte, até que ele finalmente consiga assumir a cabeça de quem o despojou - e sua ente querido - de sua humanidade.', 0x352e6a7067, 0x352e6a7067, 'Manga', NULL, NULL, 'Em publicação', '1989-08-25', NULL, 'Ação, Aventura, Demônios, Drama, Fantasia, Terror, Sobrenatural, Militar, Psicológico, Seinen'),
(6, 'Yahari Ore no Seishun Love Comedy wa Machigatteiru.', 'Hachiman Hikigaya, um estudante da Soubu High School, é um solitário cínico devido a suas experiências traumáticas passadas em sua vida social. Isso o levou a desenvolver um conjunto de \"olhos de peixe morto\" e uma personalidade distorcida semelhante à de um criminoso mesquinho. Acreditando que o conceito de juventude é uma mentira inventada por jovens que enfrentam seus fracassos em negação, ele faz um ensaio que critica essa exata mentalidade dos jovens. Irritado com a submissão, seu professor de sala de aula, Shizuka Hiratsuka, o obriga a ingressar no Voluntariado a Serviços - um clube que ajuda os alunos a resolver seus problemas na vida, esperando que ajudar outras pessoas mude sua personalidade.<br><br>\r\n\r\nNo entanto, Yukino Yukinoshita, a garota mais bonita da escola, é surpreendentemente a única integrante do clube e solitária, embora mais fria e inteligente que Hikigaya. O clube logo se expande quando Yui Yuigahama se junta a eles depois de terem sido ajudados com sua situação, e eles começam a aceitar mais pedidos.<br><br>\r\n\r\nCom seu status quo como recluso, Hikigaya tenta resolver problemas à sua maneira, mas seus métodos podem se provar uma faca de dois gumes.', 0x362e6a7067, 0x36, 'Novel', NULL, NULL, 'Em publicação', '2011-03-23', NULL, 'Comédia, Romance, Escolar'),
(7, 'Komi-san wa, Comyushou desu.', 'É o primeiro dia de Shouko Komi na prestigiada Itan Private High School, e ela já alcançou o status de Madonna da escola. Com longos cabelos negros e uma aparência alta e graciosa, ela capta a atenção de quem a encontra. Porém, há apenas um problema - apesar de sua popularidade, Shouko é péssima em se comunicar com os outros.<br><br>\r\n\r\nHitohito Tadano é seu garoto médio do ensino médio. Com seu lema de vida de \"leia a situação e certifique-se de ficar longe de problemas\", ele rapidamente descobre que sentar ao lado de Shouko fez dele o inimigo de todos em sua classe! Um dia, nocauteado por acidente, Hitohito depois acorda com o som do \"miado\" de Shouko. Ele mente que não ouviu nada, fazendo Shouko fugir. Mas antes que ela possa escapar, Hitohito supõe que Shouko não é capaz de conversar com outras pessoas facilmente - na verdade, ela nunca foi capaz de fazer uma única amiga. Hitohito resolve ajudar Shouko com seu objetivo de fazer cem amigos para que ela possa superar seu distúrbio de comunicação.', 0x372e6a7067, 0x372e6a7067, 'Manga', NULL, NULL, 'Em publicação', '2016-05-18', NULL, 'Comédia, Escolar, Shounen'),
(8, 'Oyasumi Punpun', 'Punpun Onodera é um garoto normal de 11 anos e vive no Japão. Desesperadamente idealista e romântico, Punpun começa a ver sua vida dar uma volta sutil - ainda que surpreendente - ao adulto quando conhece a nova garota de sua classe, Aiko Tanaka. É então que o garoto quieto aprende o quão inconstante é a manutenção de um relacionamento e as superadas dificuldades de transição de uma infância ingênua para uma idade adulta complicada. Quando seu pai agride sua mãe uma noite, Punpun percebe outra coisa: aqueles a quem ele admirava não eram tão impressionantes quanto ele pensava.<br><br>\r\n\r\nÀ medida que seus problemas aumentam, o comportamento outrora tímido de Punpun se transforma em reclusão voluntária. Em vez de curá-lo de seus problemas e emoções conflitantes, isso apenas os intensifica, enviando-o pelo caminho sombrio da maturidade nesta saga sombria de amadurecimento.', 0x382e6a7067, 0x382e6a7067, 'Manga', 147, 13, 'Finalizado', '2007-03-15', '2013-11-02', 'Drama, Fátia de Vida, Psicológico, Seinen'),
(9, 'Shinmai Maou no Testament', '\"Ei, você disse que queria uma irmãzinha, certo?\" O aluno do primeiro ano do ensino médio, Toujou Basara, foi subitamente questionado por seu pai e entrou em pânico. Além disso, o pai excêntrico disse que ele se casaria novamente. Ele então partiu para o exterior depois de trazer a Basara duas lindas irmãs adotivas. Mas as verdadeiras formas de Mio e Maria são, na verdade, o novato Demon Lord e um súcubo !? Basara foi quase celebrado um contrato de mestre e servo com Mio, mas um contrato \"revertido\" foi formado por engano, e Basara agora é o mestre !? Além disso, Basara está sendo atingida pela situação ecchi uma após a outra devido ao contrato, mas a vida de Mio está sendo perseguida por outras tribos de demônios e tribos de heróis !! O drama de ação de desejo do contratante mais poderoso começa!', 0x392e6a7067, 0x392e6a7067, 'Novel', 58, 12, 'Finalizado', '2012-09-29', '2018-04-01', 'Ação, Ecchi, Fantasia, Romance, Harém, Sobrenatural'),
(10, 'Shonan Junai Gumi!', 'Ekichi Onizuka e Ryuji Danma são membros da infame gangue de motoqueiros Oni Baku. Quando não estão andando por aí, eles podem ser encontrados na escola, tentando pegar mulheres jovens. Esta é a história do jovem Onizuka, que mais tarde se tornaria o maior professor do Japão.', 0x31302e6a7067, 0x31302e6a7067, 'Manga', 267, 31, 'Finalizado', '1990-09-26', '1996-09-18', 'Ação, Comédia, Drama, Romance, Escolar, Shounen');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga_characters`
--

DROP TABLE IF EXISTS `manga_characters`;
CREATE TABLE IF NOT EXISTS `manga_characters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `characterID` int(11) NOT NULL,
  `characterRole` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `mangaID` (`mangaID`),
  KEY `characterID` (`characterID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manga_characters`
--

INSERT INTO `manga_characters` (`ID`, `mangaID`, `characterID`, `characterRole`) VALUES
(1, 1, 19, 'Principal'),
(2, 1, 20, 'Principal'),
(3, 1, 21, 'Principal'),
(4, 1, 22, 'Principal'),
(5, 1, 23, 'Principal'),
(6, 1, 24, 'Principal'),
(7, 2, 25, 'Principal'),
(8, 2, 26, 'Principal'),
(9, 2, 27, 'Principal'),
(10, 2, 28, 'Secundário'),
(11, 2, 29, 'Secundário'),
(12, 2, 30, 'Secundário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga_favorites`
--

DROP TABLE IF EXISTS `manga_favorites`;
CREATE TABLE IF NOT EXISTS `manga_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `mangaID` (`mangaID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manga_favorites`
--

INSERT INTO `manga_favorites` (`ID`, `mangaID`, `userID`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga_users`
--

DROP TABLE IF EXISTS `manga_users`;
CREATE TABLE IF NOT EXISTS `manga_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userStatus` int(1) NOT NULL DEFAULT '1',
  `userScore` int(2) DEFAULT NULL,
  `userChapters` int(4) NOT NULL DEFAULT '0',
  `userVolumes` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `manga` (`mangaID`),
  KEY `users` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manga_users`
--

INSERT INTO `manga_users` (`ID`, `mangaID`, `userID`, `userStatus`, `userScore`, `userChapters`, `userVolumes`) VALUES
(1, 1, 1, 2, 10, 208, 25),
(2, 2, 1, 1, 10, 75, 8),
(3, 6, 1, 1, NULL, 0, 0),
(6, 4, 1, 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` tinytext NOT NULL,
  `userEmail` tinytext NOT NULL,
  `userPassword` longtext NOT NULL,
  `userPermissions` int(1) DEFAULT '0',
  `userAvatar` longblob,
  `userBanner` longblob,
  `userBannerList` longblob,
  `userAbout` tinytext,
  `userGender` int(1) NOT NULL DEFAULT '0',
  `userBirthday` date DEFAULT NULL,
  `userLocalization` tinytext,
  `userDate` date NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPassword`, `userPermissions`, `userAvatar`, `userBanner`, `userBannerList`, `userAbout`, `userGender`, `userBirthday`, `userLocalization`, `userDate`) VALUES
(1, 'ThiagoIanuch', 'thiagoianuch@hotmail.com', '$2y$10$2p7NAzb.oaq4UaCiI./6c.AeKOev2AzM.3a4rlnW004XDqimJw0yC', 1, 0x6167356e384f4b5f343630732e6a7067, 0x73756e726973652d616e696d652d6769726c2d73696c686f75657474652d7363656e6572792d75686470617065722e636f6d2d68642d342e3632382e6a7067, NULL, NULL, 1, '2002-09-15', 'Brasil', '2020-02-28'),
(2, 'ThiagoIM', 'thiago.ianuch@hotmail.com', '$2y$10$Rs8Moy/W7M6mIeii7v1P8.RY9FD9d/hnmZ4o0J.mh0nAgyZnreAz.', 0, 0x3238313531352e6a7067, 0x68617473756e652d6d696b752d616e696d652d766f63616c6f69642d6769726c2d77616c6c70617065722e6a7067, 0x77616c6c7061706572322e706e67, NULL, 0, NULL, NULL, '2020-02-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_comments`
--

DROP TABLE IF EXISTS `users_comments`;
CREATE TABLE IF NOT EXISTS `users_comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userIDProfile` int(11) NOT NULL,
  `userComment` text NOT NULL,
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_comments`
--

INSERT INTO `users_comments` (`commentID`, `userID`, `userIDProfile`, `userComment`, `commentDate`) VALUES
(3, 1, 2, 'iii', '2020-04-01 15:12:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
