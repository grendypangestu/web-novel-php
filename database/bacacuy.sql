-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacacuy-v7`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(10) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `tahun_buku` int(4) NOT NULL,
  `penulis_buku` varchar(100) NOT NULL,
  `cover_buku` text NOT NULL,
  `rating_buku` float NOT NULL,
  `tanggal_diposting` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `sipnosis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `nama_buku`, `tahun_buku`, `penulis_buku`, `cover_buku`, `rating_buku`, `tanggal_diposting`, `id_user`, `sipnosis`) VALUES
(39, 'Endless Path : Infinite Cosmos', 2014, 'Einlion', '65f1d39c9a1e2.jpg', 7.8, 1710347164, 1, 'Vahn was an atypical youth. Due to a rare mutation, his blood had the potential to target and attack ailments within the human body. Touted as a universal cure, people had elevated his status above the norm and given him the classification &quot;Panacea&quot;. In the media, he was hailed as a great hero who would usher in a new era or human wellness. However, behind the scenes things weren&#039;t so bright. Being a unique individual, Vahn spent his entire youth locked up in a lab with various scientists and research teams using his body and blood to perform endless amounts of experiments. The only solace in his suffering was the various anime and manga made available to him between experiments. He often imagined himself as the protagonist in a world of his own, finally in control of his own destiny. For years he nurtured this desire, until at the age of 14 he died when an organization had tried to kidnap him from the lab...\r\n\r\n&quot;Finally, I don&#039;t have to suffer anymore...&quot;\r\n\r\nThis was Vahn&#039;s last thought as he faded into the endless black abyss...\r\n\r\n&quot;You poor soul.&quot;'),
(40, 'He who Sacrificed the Gifts of The Gods ', 2004, 'Lance_Godspell', '65f1d3ff9e1f5.jpg', 6.6, 1710347263, 1, 'Lough Freed, a boy who served the kingdom in the RMMT (Republican Military of Magical Talent) at a young age, is a veteran at war, but he was cast aside after being the sole reason for victory, since he had no artefacts, and was thrown down into poverty. He lives his life with a held back rage until he enters his usual workplace and finds something interesting...'),
(41, 'Level Up Legacy', 2020, 'MellowGuy', '65f1d454e0994.jpg', 8.1, 1710347348, 1, '[You Leveled Up!]\r\n\r\n[You have learned a new rune.]\r\n\r\nArthur Silvera stared at the hologram before him, not knowing what was going on. He had awakened this never-seen ability, and it was terrifyingly bugged.\r\n\r\nThe golden rune in front of him floated without a care in the world. As his Legacy described, it was a rune to absorb stats from enemies that he kills. This, by itself, was an absurd ability. However, it was one of many. The Legacy he has awakened turned him from a dirt-digger to.... a creator.\r\n\r\nIn a world where modern technology fused with magic, guilds, dungeons, and mechas are now everything that the world cares about. Monsters lurk in the deepest parts of the world, connecting them to unknown realms. Superpowers vie for supremacy, creating an endless wheel that crushes anyone who falters. And in one of this world&#039;s ordinary cities, an ordinary young man becomes the most extraordinary.'),
(42, 'My Adopted Family', 2023, '_Er', '65f1d4cd9bb59.jpg', 6.4, 1710347469, 1, 'Ryker&#039;s life changed when he was adopted by a famous family. His new mother was a beloved celebrity, his older sister was a renowned tennis player, and his younger sister was an idol to many.\r\n\r\nRyker, with these three beautiful women, had a great life and some sexual thoughts toward his family.\r\n\r\nHowever, he suppressed these thoughts, but one day, his older sister told him she would help him with masturbation, and another day, his mother said she would be his love partner to help him understand the relationship.'),
(43, 'Stargate THE Fifth Race ', 2022, 'Russell_John_Birch', '65f1d50ece6f3.jpg', 5.9, 1710347534, 1, 'This story takes place in the universe of stargate Sg1,Stargate universe, And Atlantis ,continuing the story of the Tau’ri and their rise as the fifth Race'),
(44, 'The Innkeeper', 2020, 'Lifesketcher', '65f1d5830193e.jpg', 8.5, 1710347651, 1, 'In the depths of a newborn universe, a cultivator takes advantage of the abundant energy to refine himself a treasure. But after 14 billion years of refining and quite a few more to go, he decides to entertain himself by releasing countless systems and watching how the creatures of this fledgling universe handle them.\r\n\r\nOn Earth, a young man, lost and confused about what to do with his life, sits in a park and looks up at the night sky. A shooting star, a wish and a bang. When the boy finally wakes up he hears a sound, &quot;assimilation complete. Launching System. Welcome to the Midnight Inn. Host Designation: The Innkeeper.&quot;'),
(45, 'Travels of the Daughter of God ', 2021, 'ArtoriaPendragon_', '65f1d5cc52be4.jpg', 8, 1710347724, 1, 'After her death in her previous life, a woman was given the chance at reincarnation. Follow the adventures of the daughter of God. Lucifer Morningstar herself!\r\n____________________________\r\nStarts in Twilight - Eventually will go to other universes.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku_genre`
--

CREATE TABLE `tb_buku_genre` (
  `id_buku` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_buku_genre`
--

INSERT INTO `tb_buku_genre` (`id_buku`, `id_genre`) VALUES
(39, 21),
(39, 23),
(39, 32),
(39, 52),
(39, 53),
(40, 21),
(40, 23),
(40, 39),
(41, 21),
(41, 23),
(41, 27),
(41, 28),
(41, 32),
(42, 22),
(42, 30),
(42, 53),
(42, 55),
(43, 21),
(43, 23),
(43, 28),
(44, 21),
(44, 23),
(44, 27),
(44, 28),
(45, 21),
(45, 22),
(45, 31);

-- --------------------------------------------------------

--
-- Table structure for table `tb_genre`
--

CREATE TABLE `tb_genre` (
  `id_genre` int(10) NOT NULL,
  `nama_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_genre`
--

INSERT INTO `tb_genre` (`id_genre`, `nama_genre`) VALUES
(21, 'Action'),
(22, 'Adult'),
(23, 'Adventure'),
(24, 'Bully'),
(25, 'Cooking'),
(26, 'Crime'),
(27, 'Dark Fantasy'),
(28, 'Demon'),
(29, 'Doujinshi'),
(30, 'Drama'),
(31, 'Ecchi'),
(32, 'Fantasy'),
(33, 'Games'),
(34, 'Gore'),
(35, 'Historical'),
(36, 'Horror'),
(37, 'Isekai'),
(38, 'Leveling'),
(39, 'Magic'),
(40, 'Martial Art'),
(41, 'Mature'),
(42, 'Medical'),
(43, 'Military'),
(44, 'Modern'),
(45, 'Oneshot'),
(46, 'Overpowered'),
(47, 'Parody'),
(48, 'Philosophical'),
(49, 'Post Apocalyptic'),
(50, 'Psychological'),
(51, 'Regression'),
(52, 'Reincarnation'),
(53, 'Romance'),
(54, 'Sci-Fi'),
(55, 'Slice Of Life'),
(56, 'Sports'),
(57, 'Super Power'),
(58, 'SuperHero'),
(59, 'Vampire'),
(60, 'Villainess'),
(61, 'Violence'),
(62, 'Zombies');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(10) NOT NULL,
  `nama_komentar` varchar(50) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` int(11) NOT NULL,
  `id_buku` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `nama_komentar`, `isi_komentar`, `tanggal_komentar`, `id_buku`) VALUES
(124, 'kjmnsdjsdnjm', 'sdkmdsjmsdmdsmdsm', 2147483647, 37),
(125, 'xxs', 'skddksks\r\n', 2147483647, 43),
(126, 'gjgjj', 'gthjjhghhj', 2147483647, 39),
(127, 'jm,mnnjmq', 'ghfjghgjghkjgkh', 2147483647, 39),
(128, 'lkskld', 'lkdskldsdsksdkl', 2147483647, 42);

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id_riwayat` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_riwayat`
--

INSERT INTO `tb_riwayat` (`id_riwayat`, `id_user`, `tindakan`, `tanggal`) VALUES
(1, 5, 'Berhasil mengubah profile', 1706125831),
(2, 5, 'Berhasil mengubah password', 1706125853),
(3, 5, 'Berhasil menambahkan genre buku Fantasi', 1706127149),
(4, 5, 'Berhasil menambahkan genre buku Heroic', 1706127160),
(5, 5, 'Berhasil menambahkan buku StateDiagram', 1706127193),
(6, 5, 'Berhasil menambahkan buku zxkSJSJ', 1706481589),
(7, 5, 'Berhasil menambahkan buku jsjs', 1706482692),
(8, 5, 'Berhasil menghapus genre buku 1', 1706482786),
(9, 5, 'Berhasil menghapus genre buku 4', 1706482790),
(10, 5, 'Berhasil menambahkan buku jasdkja', 1706482813),
(11, 5, 'Berhasil menghapus buku Jasdkja', 1706582861),
(12, 5, 'Berhasil menghapus buku Jasdkja', 1706582863),
(13, 5, 'Berhasil menghapus buku Jsjs', 1706582865),
(14, 5, 'Berhasil menghapus buku Jsjs', 1706582867),
(15, 5, 'Berhasil menghapus buku ZxkSJSJ', 1706582869),
(16, 5, 'Berhasil menghapus buku ZxkSJSJ', 1706582871),
(17, 5, 'Berhasil menambahkan buku zXczs', 1706593633),
(18, 5, 'Berhasil menambahkan genre buku Romance', 1706599490),
(19, 5, 'Berhasil menambahkan genre buku Horror', 1706599496),
(20, 5, 'Berhasil menambahkan genre buku Dramatic', 1706599501),
(21, 5, 'Berhasil menambahkan genre buku Creepy', 1706599508),
(22, 5, 'Berhasil menambahkan genre buku Action', 1706599514),
(23, 5, 'Berhasil menambahkan genre buku Comedy', 1706599519),
(24, 5, 'Berhasil menambahkan buku sd', 1706599716),
(25, 5, 'Berhasil menambahkan buku dsadsa', 1706756403),
(26, 5, 'Berhasil menambahkan buku asd', 1706756794),
(27, 5, 'Berhasil menambahkan buku asd', 1706756834),
(28, 5, 'Berhasil menambahkan buku asd', 1706756856),
(29, 5, 'Berhasil menambahkan buku WQsa', 1706759287),
(30, 5, 'Berhasil menambahkan buku sadDSA', 1706759883),
(31, 5, 'Berhasil menambahkan buku asd', 1706761001),
(32, 5, 'Berhasil menambahkan buku DS', 1706761066),
(33, 5, 'Berhasil menambahkan buku asdsadas12d', 1706763303),
(34, 5, 'Berhasil menambahkan buku Polisi', 1708310371),
(35, 5, 'Berhasil menghapus buku DS', 1708310909),
(36, 5, 'Berhasil menghapus buku SadDSA', 1708310917),
(37, 5, 'Berhasil menghapus buku Asdsadas12d', 1708311465),
(38, 5, 'Berhasil menghapus buku Asd', 1708311469),
(39, 5, 'Berhasil menambahkan buku StateDiagram', 1708311536),
(40, 5, 'Berhasil menambahkan buku SEMINAR', 1708312610),
(41, 5, 'Berhasil menambahkan buku Sembako', 1708312662),
(42, 5, 'Berhasil mengubah buku StateDiagram', 1708312681),
(43, 5, 'Berhasil mengubah buku StateDiagram', 1708312701),
(44, 5, 'Berhasil mengubah buku Sembako', 1708313031),
(45, 5, 'Berhasil menambahkan buku A320M', 1708320959),
(46, 1, 'Berhasil menambahkan buku a520m', 1708321003),
(47, 2, 'Berhasil menambahkan buku DINAS', 1708321069),
(48, 1, 'Berhasil menghapus buku A520m', 1708486226),
(49, 1, 'Berhasil menghapus buku DINAS', 1708486234),
(50, 1, 'Berhasil menambahkan buku ababa', 1708486292),
(51, 1, 'Berhasil menambahkan buku kotakota', 1708486349),
(52, 1, 'Berhasil menambahkan buku asdads', 1710176932),
(53, 1, 'Berhasil menambahkan buku sfdsfd', 1710176951),
(54, 1, 'Berhasil menambahkan buku 321', 1710176969),
(55, 1, 'Berhasil menambahkan buku dassda', 1710176984),
(56, 1, 'Berhasil menambahkan buku I Stayed At Home For A Century, When I Emerged I Was Invincible ', 1710179916),
(57, 1, 'Berhasil menghapus buku 321', 1710345400),
(58, 1, 'Berhasil menghapus buku Ababa', 1710345402),
(59, 1, 'Berhasil menghapus buku Asdads', 1710345406),
(60, 1, 'Berhasil menghapus buku Dassda', 1710345409),
(61, 1, 'Berhasil menghapus buku I Stayed At Home For A Century, When I Emerged I Was Invincible ', 1710345412),
(62, 1, 'Berhasil menghapus buku Kotakota', 1710345416),
(63, 1, 'Berhasil menghapus buku Sfdsfd', 1710345419),
(64, 1, 'Berhasil menambahkan buku Endless Path : Infinite Cosmos', 1710345858),
(65, 1, 'Berhasil menambahkan genre buku Adventure', 1710345916),
(66, 1, 'Berhasil menambahkan genre buku Comedy', 1710345931),
(67, 1, 'Berhasil menghapus genre buku Comedy', 1710345939),
(68, 1, 'Berhasil menambahkan genre buku Anthology', 1710345980),
(69, 1, 'Berhasil menambahkan genre buku Cooking', 1710345994),
(70, 1, 'Berhasil menambahkan genre buku Dark Fantasy', 1710346020),
(71, 1, 'Berhasil menghapus buku Endless Path : Infinite Cosmos', 1710346039),
(72, 1, 'Berhasil menambahkan genre buku Delinquent', 1710346069),
(73, 1, 'Berhasil menambahkan genre buku Demon', 1710346081),
(74, 1, 'Berhasil menambahkan genre buku Doujinshi', 1710346087),
(75, 1, 'Berhasil mengubah genre buku Fantasy', 1710346207),
(76, 1, 'Berhasil menghapus genre buku ', 1710346261),
(77, 1, 'Berhasil menghapus genre buku Heroic', 1710346264),
(78, 1, 'Berhasil menambahkan genre buku Action', 1710346286),
(79, 1, 'Berhasil menambahkan genre buku Adult', 1710346296),
(80, 1, 'Berhasil menambahkan genre buku Adventure', 1710346305),
(81, 1, 'Berhasil menambahkan genre buku Bully', 1710346353),
(82, 1, 'Berhasil menambahkan genre buku Cooking', 1710346365),
(83, 1, 'Berhasil menambahkan genre buku Crime', 1710346458),
(84, 1, 'Berhasil mengubah profile', 1710346499),
(85, 1, 'Berhasil menambahkan genre buku Dark Fantasy', 1710346521),
(86, 1, 'Berhasil menambahkan genre buku Demon', 1710346532),
(87, 1, 'Berhasil menambahkan genre buku Doujinshi', 1710346608),
(88, 1, 'Berhasil menambahkan genre buku Drama', 1710346620),
(89, 1, 'Berhasil menambahkan genre buku Ecchi', 1710346631),
(90, 1, 'Berhasil menambahkan genre buku Fantasy', 1710346649),
(91, 1, 'Berhasil menambahkan genre buku Games', 1710346662),
(92, 1, 'Berhasil menambahkan genre buku Gore', 1710346674),
(93, 1, 'Berhasil menambahkan genre buku Historical', 1710346693),
(94, 1, 'Berhasil menambahkan genre buku Horror', 1710346700),
(95, 1, 'Berhasil menambahkan genre buku Isekai', 1710346713),
(96, 1, 'Berhasil menambahkan genre buku Leveling', 1710346728),
(97, 1, 'Berhasil menambahkan genre buku Magic', 1710346738),
(98, 1, 'Berhasil menambahkan genre buku Martial Art', 1710346761),
(99, 1, 'Berhasil menambahkan genre buku Mature', 1710346774),
(100, 1, 'Berhasil menambahkan genre buku Medical', 1710346785),
(101, 1, 'Berhasil menambahkan genre buku Military', 1710346791),
(102, 1, 'Berhasil menambahkan genre buku Modern', 1710346802),
(103, 1, 'Berhasil menambahkan genre buku Oneshot', 1710346816),
(104, 1, 'Berhasil menambahkan genre buku Overpowered', 1710346827),
(105, 1, 'Berhasil menambahkan genre buku Parody', 1710346834),
(106, 1, 'Berhasil menambahkan genre buku Philosophical', 1710346862),
(107, 1, 'Berhasil menambahkan genre buku Post Apocalyptic', 1710346894),
(108, 1, 'Berhasil menambahkan genre buku Psychological', 1710346909),
(109, 1, 'Berhasil menambahkan genre buku Regression', 1710346926),
(110, 1, 'Berhasil menambahkan genre buku Reincarnation', 1710346933),
(111, 1, 'Berhasil menambahkan genre buku Romance', 1710346942),
(112, 1, 'Berhasil menambahkan genre buku Sci-Fi', 1710346959),
(113, 1, 'Berhasil menambahkan genre buku Slice Of Life', 1710346976),
(114, 1, 'Berhasil menambahkan genre buku Sports', 1710346986),
(115, 1, 'Berhasil menambahkan genre buku Super Power', 1710346997),
(116, 1, 'Berhasil menambahkan genre buku SuperHero', 1710347004),
(117, 1, 'Berhasil menambahkan genre buku Vampire', 1710347018),
(118, 1, 'Berhasil menambahkan genre buku Villainess', 1710347038),
(119, 1, 'Berhasil menambahkan genre buku Violence', 1710347051),
(120, 1, 'Berhasil menambahkan genre buku Zombies', 1710347064),
(121, 1, 'Berhasil menambahkan buku Endless Path : Infinite Cosmos', 1710347164),
(122, 1, 'Berhasil menambahkan buku He who Sacrificed the Gifts of The Gods ', 1710347263),
(123, 1, 'Berhasil menambahkan buku Level Up Legacy', 1710347348),
(124, 1, 'Berhasil menambahkan buku My Adopted Family', 1710347469),
(125, 1, 'Berhasil menambahkan buku Stargate THE Fifth Race ', 1710347534),
(126, 1, 'Berhasil menambahkan buku The Innkeeper', 1710347651),
(127, 1, 'Berhasil menambahkan buku Travels of the Daughter of God ', 1710347724);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `photo_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `photo_profile`) VALUES
(1, 'grendy', '$2y$10$z4j6/2od0a8HkikMd3CO2u/eNBLA.t.1qhKkugEaJ.f2BwJs1NSP.', 'Grendy Aditya Pangestu', '65f1d10355ea3.jpg'),
(2, 'adrian', '$2y$10$5L6ldSnsUFBGYt8GAH.mG.RPvXBsXXBp7DjSwM20qlJEmxxuIXf5.', 'Adrian Trinata', 'jadwal kelas.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_buku_genre`
--
ALTER TABLE `tb_buku_genre`
  ADD PRIMARY KEY (`id_buku`,`id_genre`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Indexes for table `tb_genre`
--
ALTER TABLE `tb_genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `relasi_komentar` (`id_buku`) USING BTREE;

--
-- Indexes for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_genre`
--
ALTER TABLE `tb_genre`
  MODIFY `id_genre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id_riwayat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_buku_genre`
--
ALTER TABLE `tb_buku_genre`
  ADD CONSTRAINT `tb_buku_genre_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`),
  ADD CONSTRAINT `tb_buku_genre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `tb_genre` (`id_genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
