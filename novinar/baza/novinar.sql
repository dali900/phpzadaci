--
-- Database: `novinar`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(2) NOT NULL,
  `naziv` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'Vesti dana'),
(2, 'Sport'),
(3, 'Estrada'),
(4, 'Crna hronika'),
(5, 'Tehnologija');

-- --------------------------------------------------------

--
-- Table structure for table `novinar`
--

CREATE TABLE `novinar` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `adresa` varchar(60) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `novinar`
--

INSERT INTO `novinar` (`id`, `ime`, `prezime`, `adresa`, `status`) VALUES
(1, 'Marko', 'Markovic', 'Adresa Ulica 1', NULL),
(2, 'Petar', 'Petrovic', 'Adresa Ulica 2', NULL),
(3, 'Ivan ', 'Ivanovic', 'Adresa Ulica 3', NULL),
(4, 'Stefan', 'Stefanovic', 'Adresa Ulica 4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(60) DEFAULT NULL,
  `opis` text,
  `kategorija_id` int(11) DEFAULT NULL,
  `novinar_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `opis`, `kategorija_id`, `novinar_id`) VALUES
(1, 'Politika', 'Aktuelni dogadjaji u politici', 1, 1),
(2, 'Sport', 'Aktuelni dogadjaji u sportu. Arsenal', 2, 2),
(3, 'Estrada', 'Aktuelni dogadjaji na estradi', 3, 3),
(4, 'Crna hronika', 'Aktuelni dogadjaji crna hronika', 4, 4),
(5, 'Sport', 'Fudbalski klub Arsenal.', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novinar`
--
ALTER TABLE `novinar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`),
  ADD KEY `novinar_id` (`novinar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `novinar`
--
ALTER TABLE `novinar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `vesti`
--
ALTER TABLE `vesti`
  ADD CONSTRAINT `vesti_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorije` (`id`),
  ADD CONSTRAINT `vesti_ibfk_2` FOREIGN KEY (`novinar_id`) REFERENCES `novinar` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
