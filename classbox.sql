-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 07:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19096352_classbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_assg`
--

CREATE TABLE `daftar_assg` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `assignment` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `test_type` int(1) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_assg`
--

INSERT INTO `daftar_assg` (`id`, `subject_id`, `assignment`, `description`, `test_type`, `status`) VALUES
(1, '1', '1', 'Redox Reaction', 3, 'active'),
(18, '2', '1', 'Quiz 1', 3, 'active'),
(21, '3', '1', 'Persamaan Lingkaran', 3, 'active'),
(22, '5', '1', '', 3, 'closed');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_jawaban`
--

CREATE TABLE `daftar_jawaban` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `assigment_id` varchar(100) NOT NULL,
  `soal_id` varchar(100) NOT NULL,
  `mc_ans` varchar(100) NOT NULL,
  `essay_ans` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_jawaban`
--

INSERT INTO `daftar_jawaban` (`id`, `student_id`, `assigment_id`, `soal_id`, `mc_ans`, `essay_ans`) VALUES
(24, '6', '1', 'essay', '', '6_1.pdf'),
(25, '6', '1', '1', 'a', ''),
(26, '6', '1', '2', 'b', ''),
(32, '6', '18', 'essay', '', '6_18.pdf'),
(33, '6', '18', '30', 'a', ''),
(40, '8', '1', 'essay', '', '8_1.pdf'),
(41, '8', '1', '1', 'a', ''),
(42, '8', '1', '2', 'a', ''),
(48, '8', '18', 'essay', '', '8_18.'),
(49, '8', '18', '30', 'b', ''),
(56, '12', '21', 'essay', '', '12_21.docx'),
(57, '12', '21', '40', 'a', ''),
(58, '12', '21', '41', 'b', ''),
(59, '13', '22', 'essay', '', '13_22.txt'),
(60, '13', '22', '44', 'a', ''),
(61, '13', '22', '45', 'b', ''),
(62, '13', '1', 'essay', '', '13_1.'),
(63, '13', '1', '1', 'a', ''),
(64, '13', '1', '', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_soal`
--

CREATE TABLE `daftar_soal` (
  `id` int(11) NOT NULL,
  `assignment_id` varchar(100) NOT NULL,
  `type_test` varchar(100) NOT NULL,
  `soal` varchar(250) NOT NULL,
  `answer_a` varchar(250) NOT NULL,
  `answer_b` varchar(250) NOT NULL,
  `answer_c` varchar(250) NOT NULL,
  `answer_d` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_soal`
--

INSERT INTO `daftar_soal` (`id`, `assignment_id`, `type_test`, `soal`, `answer_a`, `answer_b`, `answer_c`, `answer_d`) VALUES
(1, '1', '1', 'Nilai bilangan okidasi dari Cr didalam K2CrO4 adalah . . .', '4', '5', '6', '7'),
(2, '1', '1', 'Nilai bilangan okidasi dari S didalam Na2SO3 adalah . . .', '4', '5', '6', '7'),
(3, '1', '2', 'Sebutkan 150 reaksi redox!', '', '', '', ''),
(4, '1', '2', 'Jelaskan tentang reaksi redox!', '', '', '', ''),
(30, '18', '1', 'Besaran yang diukur oleh Adi adalah . . .', 'Besaran pokok, yaitu volume batu', 'Besaran pokok, yaitu tinggi batu', 'Besaran turunan, yaitu tinggi batu', 'Besaran turunan, yaitu volume batu'),
(31, '18', '2', 'Ujung sebuah tali yang panjangnya 1 meter di getarkan sehingga dalam waktu 2 sekon terdapat 2 gelombang. tentukanlah persamaan gelombang ', '', '', '', ''),
(40, '21', '1', 'Persamaan dengan format x^2 + y^2 + ax + by = 0 memiliki bentuk? ', 'Lingkaran', 'Persegi ', 'Oval ', 'Jajar genjang'),
(41, '21', '1', 'Persamaan dengan format (x-a)^2 + (y-b)^2 = r^2 memiliki pusat di titik? ', '(-a, -b) ', '(-a, b) ', '(a, -b) ', '(a, b)'),
(42, '21', '2', 'Dapatkan pusat lingkaran dengan persamaan x^2 + y^2 + 6x + 10y = 0', '', '', '', ''),
(43, '21', '2', 'Dapatkan jari-jari dari persamaan yang sama di nomor 1', '', '', '', ''),
(44, '22', '1', 'Dari tanaman berikut ini manakah yang tidak dapat berfotosintesis?', 'Rafflesia sp.', 'Oryza sativa', 'Eichhornia crassipes', 'Hibiscus rosa-sinensis'),
(45, '22', '1', 'Faktor penentu yang menjadikan suatu tanaman dapat berfotosintesis adalah?', 'habitat', 'kelembaban media', 'adanya klorofil', 'usia tanaman'),
(46, '22', '2', 'Jelaskan proses fotosintesis reaksi gelap!', '', '', '', ''),
(47, '22', '2', 'Jelaskan proses fotosintesis reaksi terang!', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_subject`
--

CREATE TABLE `daftar_subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_subject`
--

INSERT INTO `daftar_subject` (`id`, `subject_name`, `teacher_id`, `logo`) VALUES
(1, 'Chemistry', '14', 'Chem.png'),
(2, 'Physic', '17', 'Physic.png'),
(3, 'Mathematics', '19', 'Math.png'),
(4, 'ICT', '', 'ICT.png'),
(5, 'BIology', '20', 'Bio.png'),
(6, 'Sport', '', 'Sport.png');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reg_number` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `reg_number`, `password`, `gender`) VALUES
(6, 'Reynold Putra Merdeka', '5027211034', 'rey123', 'male'),
(8, 'Rifqi Akhmad Maulana', '5027211035', 'rif123', 'male'),
(9, 'Nuafal Ammar Saputra', '5027211052', 'nas123', 'male'),
(12, 'Fransiskus Benyamin Sitompul', '5021711021', 'frans123', 'male'),
(13, 'Rendy Anfi Yudha', '5027211006', 'rendy123', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_assigment`
--

CREATE TABLE `submitted_assigment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `assigment_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submitted_assigment`
--

INSERT INTO `submitted_assigment` (`id`, `student_id`, `assigment_id`, `status`, `grade`) VALUES
(2, '6', '1', 'done', '96'),
(5, '6', '18', 'done', '80'),
(8, '8', '1', 'done', '75'),
(11, '8', '18', 'done', ''),
(14, '12', '21', 'done', '80'),
(15, '13', '22', 'done', '80'),
(16, '13', '1', 'done', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reg_number` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `reg_number`, `password`, `subject_name`, `gender`) VALUES
(14, 'Hadi', '1278391273', 'hadi123', '1', 'male'),
(17, 'Prof. Dr. Suasmoro', '0812345', 'majuterus', '2', 'male'),
(19, 'Dr Drs Bandung Arry Sanjoyo M.I.Kom', '0812321452', 'its123', '3', 'male'),
(20, 'Nur Naily Ihtidaiy S.Pd', '0812539999', 'bio2022', '5', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

CREATE TABLE `test_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_type`
--

INSERT INTO `test_type` (`id`, `type`) VALUES
(1, 'Multiple choice'),
(2, 'Essay'),
(3, 'Multiple choice, Essay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_assg`
--
ALTER TABLE `daftar_assg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_jawaban`
--
ALTER TABLE `daftar_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_soal`
--
ALTER TABLE `daftar_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_subject`
--
ALTER TABLE `daftar_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_assigment`
--
ALTER TABLE `submitted_assigment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_type`
--
ALTER TABLE `test_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_assg`
--
ALTER TABLE `daftar_assg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `daftar_jawaban`
--
ALTER TABLE `daftar_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `daftar_soal`
--
ALTER TABLE `daftar_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `daftar_subject`
--
ALTER TABLE `daftar_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submitted_assigment`
--
ALTER TABLE `submitted_assigment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `test_type`
--
ALTER TABLE `test_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
