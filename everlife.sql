-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 11:35 AM
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
-- Database: `everlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `pin` bigint(12) NOT NULL,
  `dep_id` bigint(12) NOT NULL,
  `dep_name` varchar(40) NOT NULL,
  `dep_birth_date` date NOT NULL,
  `dep_citizenship` char(2) NOT NULL,
  `dep_perm_disability` char(1) NOT NULL,
  `relationship` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`pin`, `dep_id`, `dep_name`, `dep_birth_date`, `dep_citizenship`, `dep_perm_disability`, `relationship`) VALUES
(884985859064, 1, 'James P. Peres', '2018-06-25', 'F', 'N', 'Son'),
(433039350322, 2, 'Maraiah P. Dela Cruz', '2010-07-16', 'F', 'N', 'Daughter'),
(433039350322, 3, 'Mary Grace P. Reyes', '2016-02-09', 'F', 'N', 'Daughter'),
(513449091525, 4, 'Justine Gab C. Garcia', '2001-11-19', 'F', 'Y', 'Son'),
(513449091525, 5, 'Cynthia C. Garcia', '2002-09-11', 'F', 'N', 'Daughter'),
(686550560692, 6, 'Ellene R. Zabala', '1988-03-25', 'F', 'N', 'Sister'),
(686550560692, 7, 'Pilar R. Zabala', '1955-04-01', 'F', 'Y', 'Mother'),
(686550560692, 8, 'Jake Shawn R. Medoza', '2011-12-11', 'F', 'N', 'Son'),
(644461500461, 9, 'Carmela F. Abrigo', '1975-10-14', 'F', 'N', 'Daughter'),
(644461500461, 10, 'Diego C. Fernandez', '1979-05-23', 'F', 'N', 'Son'),
(936146341851, 11, 'Christine Joy C. Alvarez', '2004-12-25', 'F', 'Y', 'Daughter'),
(133599202290, 12, 'Vince Mark R. De Guzman', '1988-09-10', 'F', 'Y', 'Brother'),
(860865273438, 13, 'Patrick W. Villianueva', '1950-06-28', 'F', 'N', 'Father'),
(860865273438, 14, 'Lilia G. Villianueva', '1953-11-22', 'F', 'N', 'Mother'),
(391638473746, 15, 'Railey Joy F. Robinson', '1962-02-12', 'DC', 'N', 'Mother'),
(391638473746, 16, 'Liam V. Robinson', '1957-12-13', 'FN', 'N', 'Father'),
(996912071539, 17, 'Christian C. Silva', '2010-08-09', 'F', 'Y', 'Brother'),
(996912071539, 18, 'Elijah C. Silva', '2003-09-27', 'F', 'Y', 'Sister'),
(102483264762, 19, 'Luis M. Montemayor', '2008-03-07', 'F', 'N', 'Son'),
(895652780396, 20, 'Angela H. Torres', '2004-10-21', 'F', 'Y', 'Daughter');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `pin` bigint(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `mother_mdn_name` varchar(40) NOT NULL,
  `spouse` varchar(40) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(150) NOT NULL,
  `sex` char(1) NOT NULL,
  `civil_status` char(2) NOT NULL,
  `citizenship` char(2) NOT NULL,
  `philsys_id_no` bigint(12) DEFAULT NULL,
  `tin` bigint(12) DEFAULT NULL,
  `perm_adrs` varchar(150) NOT NULL,
  `mailing_adrs` varchar(150) NOT NULL,
  `home_phone_no` bigint(15) DEFAULT NULL,
  `mobile_no` bigint(15) NOT NULL,
  `business_directline` bigint(15) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `contributor` char(3) NOT NULL,
  `contributor_type` varchar(30) DEFAULT NULL,
  `pra_srrv_no` bigint(20) DEFAULT NULL,
  `acr_icard_no` bigint(20) DEFAULT NULL,
  `pwd_id_no` bigint(20) DEFAULT NULL,
  `profession` varchar(30) DEFAULT NULL,
  `monthly_income` decimal(15,2) NOT NULL,
  `income_proof` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`pin`, `name`, `mother_mdn_name`, `spouse`, `birth_date`, `birth_place`, `sex`, `civil_status`, `citizenship`, `philsys_id_no`, `tin`, `perm_adrs`, `mailing_adrs`, `home_phone_no`, `mobile_no`, `business_directline`, `email`, `contributor`, `contributor_type`, `pra_srrv_no`, `acr_icard_no`, `pwd_id_no`, `profession`, `monthly_income`, `income_proof`) VALUES
(102483264762, 'Antonio G. Montemayor', 'Lorna B. Gomez', 'Carla M. Montemayor', '1986-08-31', 'Cardinal Santos Medical Center, Wilson Street, Greenhills West, San Juan City, Metro Manila, PH', 'M', 'M', 'F', 792335879203, 298693461148, '56 McKinley Parkway, Bonifacio Global City, Taguig City, 1634, Metro Manila, PH', '56 McKinley Parkway, Bonifacio Global City, Taguig City, 1634, Metro Manila, PH', 29386945, 9682651617, 0, 'dr.antoniomon@gmail.com', 'PP', 'N/A', 0, 0, 0, 'Doctor', 150000.00, 'Billing Statements'),
(133599202290, 'Andrew R. De Guzman', 'Rosalina H. Ramos', 'N/A', '1985-03-17', 'Northern Mindanao Medical Center, Capitol Compound, Cagayan de Oro City, Misamis Oriental, PH', 'M', 'S', 'F', 0, 424566828501, '89 Capistrano Street, Divisoria, Cagayan de Oro City, 9000, Misamis Oriental, PH', 'Unit 45B, Maligaya Street, Divisoria, Cagayan de Oro City, 9000, Misamis Oriental, PH', 0, 9568145172, 0, 'dg.andrew@gmail.com', 'FD', 'N/A', 0, 0, 0, 'Tricycle Service Driver', 18000.00, 'Payslips'),
(391638473746, 'Alicia Jane R. Smith', 'Railey Joy. Flores', 'Charles U. Smith', '1992-08-20', 'Caloocan City Medical Center, A. Mabini Street, Caloocan City, Metro Manila, PH', 'F', 'M', 'DC', 592840337618, 138591603561, '78 Ortigas Avenue, Ortigas Center, Pasig City, 1605, Metro Manila, PH', '345 A. Mabini Street, Sangandaan, Caloocan City, 1400, Metro Manila, PH', 29714519, 9587451456, 0, 'smith.aliciaj@gmail.com', 'EP', 'N/A', 0, 0, 0, 'N/A', 75000.00, 'Certificate of Employment'),
(433039350322, 'John Michael S. Dela Cruz', 'Josefina G. Santos', 'Marina P. Dela Cruz', '1989-01-04', 'Parongs Lying Clinic, Lower Bicutan, Taguig, Metro Manila, PH', 'M', 'M', 'F', 792850381958, 840285730145, 'Blk 2 Lot 4, Commonwealth Avenue, Diliman, Quezon City, 1101, Metro Manila, PH', 'Blk 2 Lot 4, Commonwealth Avenue, Diliman, Quezon City, 1101, Metro Manila, PH', 26397681, 9628401756, 0, 'johnmichael.dc@gmail.com', 'PP', 'N/A', 0, 0, 0, 'Lawyer', 90000.00, 'Certificate of Employment'),
(463565916428, 'Lucas Jade M. Rosario', 'Carmen T. Mabalot', 'N/A', '1991-08-20', 'Zamboanga City Medical Center, Dr. Evangelista Street, Zamboanga City, Zamboanga del Sur, PH', 'M', 'S', 'F', 414768543262, 219840340125, 'Blk 9 Lot 7, 12 Pasonanca Road, Zamboanga City, 7000, Zamboanga del Sur, PH', 'Blk 9 Lot 7, 12 Pasonanca Road, Zamboanga City, 7000, Zamboanga del Sur, PH', 27824626, 9086241563, 0, 'lucasj.rosario@gmail.com', 'MW', 'Sea-Based', 0, 0, 0, 'N/A', 25000.00, 'Payslips'),
(513449091525, 'Pedro C. Garcia', 'Elena F. Conchada', 'Isabella C. Garcia', '1980-05-12', 'Davao Doctors Hospital, Quirino Avenue, Davao City, Davao del Sur, PH', 'M', 'M', 'F', 0, 0, '789 Ecoland Drive, Matina, Davao City, 8000, Davao del Sur, PH', '789 Ecoland Drive, Matina, Davao City, 8000, Davao del Sur, PH', 0, 9127582854, 0, 'pedro123@gmail.com', 'PWD', 'N/A', 0, 0, 674825722508, 'Social Worker', 15000.00, 'Paystub'),
(527255771661, 'Rafael N. Santiago', 'Myra K. Nolasco', 'N/A', '1996-05-21', 'St. Lukes Medical Center, Bonifacio Global City, Taguig City, Metro Manila, PH', 'M', 'S', 'F', 0, 623849672961, '56 McKinley Parkway, Bonifacio Global City, Taguig City, 1634, Metro Manila, PH', '56 McKinley Parkway, Bonifacio Global City, Taguig City, 1634, Metro Manila, PH', 27356783, 9364213462, 26489041, 'rafael.santiago@gmail.com', 'SI', 'Sole Proprietor', 0, 0, 0, 'Coffee Shop Owner', 60000.00, 'Financial Statements'),
(644461500461, 'Miguelito M. Fernandez', 'Samira A. Molina', 'N/A', '1952-12-05', 'Iloilo Mission Hospital, Jaro, Iloilo City, Iloilo, PH', 'M', 'W', 'F', 862962329643, 692093286241, '56 Gen. Luna Street, City Proper, Iloilo City, 5000, Iloilo, PH', '56 Gen. Luna Street, City Proper, Iloilo City, 5000, Iloilo, PH', 29840015, 9568266215, 0, 'miguelito.fernandez@gmail.com', 'SC', 'N/A', 0, 0, 0, 'Retired', 0.00, 'Pension Statements'),
(686550560692, 'Isabelle Z. Medoza', 'Pilar S. Rivera', 'Andres R. Medoza', '1985-10-17', 'Riverside Medical Center, B.S. Aquino Drive, Bacolod City, Negros Occidental, PH', 'F', 'M', 'F', 346817310478, 0, 'Unit 7, 45 Session Road, Baguio City, 2600, Benguet, PH', 'Unit 7, 45 Session Road, Baguio City, 2600, Benguet, PH', 0, 9761841033, 0, 'isabelle.andress@gmail.com', 'K', 'N/A', 0, 0, 0, 'Household Helper', 20000.00, 'Paystub'),
(718550670798, 'Victoria G. Barnes', 'Alishia A. Gibson', 'N/A', '1992-06-23', 'Denver Health Medical Center, 4041 Blake Street Denver, CO 80205 USA', 'F', 'S', 'FN', 0, 0, 'Unit 10, 5th Floor, Cebu IT Park, Lahug, Cebu City, 6000, Cebu, PH', 'Unit 10, 5th Floor, Cebu IT Park, Lahug, Cebu City, 6000, Cebu, PH', 0, 9872461834, 0, 'barnes.victoria@gmail.com', 'FN', 'N/A', 82472905, 48296702, 0, 'Content Creator', 55000.00, 'Billing Statements'),
(860865273438, 'Marcus G. Villianueva', 'Lilia K. Gonzales', 'Jazmine L. Villianueva', '1973-05-30', 'St. Elizabeth Hospital, Santiago Boulevard, General Santos City, South Cotabato, PH', 'M', 'M', 'F', 869146295174, 978416458105, '67 Santiago Boulevard, Lagao, General Santos City, 9500, South Cotabato, PH', '67 Santiago Boulevard, Lagao, General Santos City, 9500, South Cotabato, PH', 27965187, 9692681462, 0, 'villianueva.m@gmail.com', 'EG', 'N/A', 0, 0, 0, 'N/A', 120000.00, 'Certificate of Employment'),
(884985859064, 'Ana Mae P. Reyes', 'Maria D. Perez', 'Miguel A. Reyes', '1990-02-14', 'St. Lukes Medical Center, E. Rodriguez Sr. Avenue, Quezon City, Metro Manila, PH', 'F', 'M', 'F', 672816402849, 192749265035, 'Unit 5A, 123 Rizal Avenue, Santa Cruz, Manila, 1003, Metro Manila, PH', 'Unit 5A, 123 Rizal Avenue, Santa Cruz, Manila, 1003, Metro Manila, PH', 24836924, 9528649241, 29592643, 'anamae.preyes123@gmail.com', 'SI', 'Individual', 0, 0, 0, 'Virtual Assistant', 35000.00, 'Payslips'),
(895652780396, 'Ana H. Torres', 'Grace A. Hernandez', 'Gabriel K. Torres', '1994-04-24', 'VRP Medical Center, EDSA, Highway Hills, Mandaluyong City, Metro Manila, PH', 'F', 'M', 'F', 814591636136, 938766137457, '67 J.P. Rizal Street, San Roque, Marikina City, 1801, Metro Manila, PH', '23 Commerce Avenue, Alabang, Muntinlupa City, 1781, Metro Manila, PH', 23984673, 9746512961, 0, 'ana.torres@gmail.com', 'PP', 'N/A', 0, 0, 0, 'Teacher', 30000.00, 'Payslips'),
(936146341851, 'Sofia C. Alvarez', 'Magdalena D. Carlos', 'Jiro N. Alvarez', '1979-01-28', 'Baguio General Hospital and Medical Center, Gov. Pack Road, Baguio City, Benguet, PH', 'F', 'M', 'F', 0, 0, '45 Session Road, Baguio City, 2600, Benguet, PH', '45 Session Road, Baguio City, 2600, Benguet, PH', 0, 9439860104, 0, 'sofia.alvarez@gmail.com', 'PM', 'N/A', 0, 0, 0, 'Domestic Helper', 17000.00, 'Paystub'),
(996912071539, 'Kevin C. Silva', 'Eunice L. Castillo', 'N/A', '1995-11-30', 'Makati Medical Center, Amorsolo Street, Legazpi Village, Makati City, Metro Manila, PH', 'M', 'S', 'F', 7984926178, 9871287465, '23 Ayala Avenue, Legazpi Village, Makati City, 1229, Metro Manila, PH', '23 Ayala Avenue, Legazpi Village, Makati City, 1229, Metro Manila, PH', 0, 9578155602, 0, 'kevinsilva@gmail.com', 'MW', 'Land-Based', 0, 0, 0, 'Carpenter', 45000.00, 'Certificate of Employment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `FOREIGN KEY` (`pin`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`pin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `dep_id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
