--
-- Database: `skola`
--

-- --------------------------------------------------------

--
-- Table structure for table `ispiti`
--

CREATE TABLE `ispiti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) DEFAULT NULL,
  `profesor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispiti`
--

INSERT INTO `ispiti` (`id`, `naziv`, `profesor`) VALUES
(1, 'Informacione tehnologije', 'Petar Peric'),
(2, 'Matematika', 'Boris Borovic'),
(3, 'Osnovi Programiranja', 'Nenad Matic');


-- --------------------------------------------------------

--
-- Table structure for table `polozeni_ispiti`
--

CREATE TABLE `polozeni_ispiti` (
  `student_id` int(2) NOT NULL,
  `ispit_id` int(2) NOT NULL,
  `ocena` float DEFAULT NULL,
  `FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polozeni_ispiti`
--

INSERT INTO `polozeni_ispiti` (`student_id`, `ispit_id`, `ocena`, `FK`) VALUES
(1, 1, 8, 0),
(1, 2, 7, 0),
(1, 3, 9, 0),
(2, 1, 10, 0),
(2, 3, 8, 0),
(3, 1, 6, 0),
(3, 2, 8, 0),
(3, 3, 6, 0),
(4, 1, 10, 0),
(4, 2, 10, 0),
(4, 3, 10, 0),
(5, 1, 9, 0),
(5, 3, 9, 0);


-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

CREATE TABLE `studenti` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) DEFAULT NULL,
  `godup` int(4) DEFAULT NULL,
  `prosek` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studenti`
--

INSERT INTO `studenti` (`id`, `ime`, `godup`, `prosek`) VALUES
(1, 'Marko Markovic', 2014, 7),
(2, 'Janko Jankovic', 2015, 8),
(3, 'Branko Brankovic', 2015, 9),
(4, 'Milos Jankovic', 2014, 7),
(5, 'Darko Darkovic', 2015, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ispiti`
--
ALTER TABLE `ispiti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);


--
-- Indexes for table `polozeni_ispiti`
--
ALTER TABLE `polozeni_ispiti`
  ADD PRIMARY KEY (`student_id`,`ispit_id`),
  ADD KEY `ispit_id` (`ispit_id`),
  ADD KEY `FK` (`FK`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ispiti`
--
ALTER TABLE `ispiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `polozeni_ispiti`
--
ALTER TABLE `polozeni_ispiti`
  ADD CONSTRAINT `polozeni_ispiti_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `studenti` (`id`),
  ADD CONSTRAINT `polozeni_ispiti_ibfk_2` FOREIGN KEY (`ispit_id`) REFERENCES `ispiti` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
