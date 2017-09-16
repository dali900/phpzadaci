--
-- Database: `drupal`
--

-- --------------------------------------------------------

--
-- Table structure for table `firma`
--

CREATE TABLE `firma` (
  `sfirme` int(11) NOT NULL,
  `naziv` varchar(60) NOT NULL,
  `kapital` int(11) NOT NULL,
  `sdirektora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `firma`
--

INSERT INTO `firma` (`sfirme`, `naziv`, `kapital`, `sdirektora`) VALUES
(1, 'ProCars', 1000000, 100),
(2, 'Composer', 50000, 200),
(3, 'TNT', 980000, 300);

-- --------------------------------------------------------

--
-- Table structure for table `firma_zaposleni`
--

CREATE TABLE `firma_zaposleni` (
  `sfirme` int(11) NOT NULL,
  `szaposleni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `firma_zaposleni`
--

INSERT INTO `firma_zaposleni` (`sfirme`, `szaposleni`) VALUES
(1, 100),
(2, 200),
(3, 300),
(1, 101),
(2, 201),
(3, 301);

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `szaposleni` int(11) NOT NULL,
  `ime` varchar(60) NOT NULL,
  `radno_mesto` varchar(60) NOT NULL,
  `plata` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`szaposleni`, `ime`, `radno_mesto`, `plata`) VALUES
(11, 'Petar Petrovic', 'Admin', 30100),
(12, 'Marko Markovic', 'HR', 40001),
(100, 'Filip Filipovic', 'IT Support', 39600),
(101, 'Milica Milic', 'Support', 38000),
(200, 'Jovan Jovanovic', 'Driketor', 30000),
(201, 'Stevic Jovic', 'Naucnik', 0),
(300, 'Stefan Stefanovic', 'Direktor', 1000000),
(301, 'MC Stojan', 'Konobar', 15000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`sfirme`);

--
-- Indexes for table `firma_zaposleni`
--
ALTER TABLE `firma_zaposleni`
  ADD KEY `sfirme` (`sfirme`),
  ADD KEY `szaposleni` (`szaposleni`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`szaposleni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `firma`
--
ALTER TABLE `firma`
  MODIFY `sfirme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `szaposleni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `firma_zaposleni`
--
ALTER TABLE `firma_zaposleni`
  ADD CONSTRAINT `firma_zaposleni_ibfk_1` FOREIGN KEY (`sfirme`) REFERENCES `firma` (`sfirme`),
  ADD CONSTRAINT `firma_zaposleni_ibfk_2` FOREIGN KEY (`szaposleni`) REFERENCES `zaposleni` (`szaposleni`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
