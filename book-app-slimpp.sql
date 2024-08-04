-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2024 at 10:01 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book-app-slimpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Book_id',
  `name` varchar(50) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `book_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author_name`, `book_info`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 'A novel about the serious issues of rape and racial inequality.'),
(2, '1984', 'George Orwell', 'A dystopian novel set in a totalitarian society ruled by Big Brother.'),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 'A story about the young and mysterious millionaire Jay Gatsby and his quixotic passion for the beautiful Daisy Buchanan.'),
(4, 'Pride and Prejudice', 'Jane Austen', 'A romantic novel that charts the emotional development of the protagonist Elizabeth Bennet.'),
(5, 'The Catcher in the Rye', 'J.D. Salinger', 'A novel about teenage rebellion and angst.'),
(6, 'The Hobbit', 'J.R.R. Tolkien', 'A fantasy novel and prelude to The Lord of the Rings.'),
(7, 'Fahrenheit 451', 'Ray Bradbury', 'A novel about a future American society where books are outlawed and \"firemen\" burn any that are found.'),
(8, 'Moby-Dick', 'Herman Melville', 'A story of Captain Ahab’s obsessive quest to kill the white whale, Moby Dick.'),
(9, 'War and Peace', 'Leo Tolstoy', 'A historical novel that chronicles the French invasion of Russia and its impact on Tsarist society.'),
(10, 'Crime and Punishment', 'Fyodor Dostoevsky', 'A novel about the mental anguish and moral dilemmas of an impoverished ex-student.'),
(11, 'The Adventures of Huckleberry Finn', 'Mark Twain', 'A novel about a young boy’s adventures on the Mississippi River.'),
(12, 'Brave New World', 'Aldous Huxley', 'A dystopian novel set in a futuristic World State.'),
(13, 'The Lord of the Rings', 'J.R.R. Tolkien', 'An epic fantasy novel.'),
(14, 'Jane Eyre', 'Charlotte Brontë', 'A novel about the experiences of its eponymous heroine, including her growth to adulthood and her love for Mr. Rochester.'),
(15, 'Wuthering Heights', 'Emily Brontë', 'A tale of passion and revenge on the Yorkshire moors.'),
(16, 'Animal Farm', 'George Orwell', 'A satirical allegory of Soviet totalitarianism.'),
(17, 'Great Expectations', 'Charles Dickens', 'A story of the orphan Pip’s growth and personal development.'),
(18, 'The Odyssey', 'Homer', 'An epic poem about the adventures of Odysseus.'),
(19, 'Catch-22', 'Joseph Heller', 'A satirical novel set during World War II.'),
(20, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'A novel about faith, doubt, and reason, set in 19th century Russia.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
