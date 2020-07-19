-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2018 at 04:29 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jennelyn_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_username`, `phone_number`, `admin_password`, `first_name`, `last_name`) VALUES
(1, 'jennelyn@gmail.com', '09099054766', 'jennelyn', 'Jennelyn', 'Jennelyn');

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `id` int(11) NOT NULL,
  `book_title` varchar(200) DEFAULT NULL,
  `book_author` varchar(200) DEFAULT NULL,
  `book_description` text,
  `book_subject` varchar(200) DEFAULT NULL,
  `book_isbn` varchar(200) DEFAULT NULL,
  `book_price` int(25) DEFAULT NULL,
  `book_stocks` int(25) DEFAULT NULL,
  `book_cover` text,
  `book_publisher` text NOT NULL,
  `book_copyright` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`id`, `book_title`, `book_author`, `book_description`, `book_subject`, `book_isbn`, `book_price`, `book_stocks`, `book_cover`, `book_publisher`, `book_copyright`, `time_added`) VALUES
(1, 'Mastering Handwriting', 'Natividad D. De Guzman', 'This book is a series of work texts in handwriting designated for pupils of kinder through grade 6. The series is rich with practice exercises and gives special attention not only to the middle and later stages of the program', 'TLE', '987-971-0537-72-3', 280, 990, '5ba70e10e91649.48006633.jpeg', 'CJS Publishing', 'CJS Publishing and Authors Revised Edition 2012', '2018-09-23 09:18:55'),
(2, 'The 21st Century MAPEH in Action', 'Ferdilyn C. Lacia', 'Uses high-level learning activities for work that requires the six facets of understanding so students learn to go beyond the content. Tackle real problems and issues that have importance to people beyond the classroom. Utilizes activities and assessments which improves students communication and team work skills.', 'MAPEH', '-', 300, 999, '5ba70f58a77949.54547453.jpeg', 'REX book store', '2010 by REX publishing', '2018-09-24 08:46:11'),
(3, 'Computer Education', 'Arshad Mehmood Shah', 'The Computer Education is a comprehensive monograph written by Arshad Mehmood Shah that covers many kinds of programming algorithm and their analysis.', 'Computer', '-', 150, 969, '5ba71189c4a4d5.98125312.png', 'Lineage', '2010 by Arshad Mehmood Shah', '2018-09-23 14:27:40'),
(4, 'Padagony of School Subject English', 'Dr. Rajkumar Goyal', 'Language literature and aesthehtic-language literature and aesthetic-development and analysis of syllabus and textual material. Teaching learning materials and aids assessment its role and importance.', 'English', '978-8193335772', 200, 1000, '5ba712db1e55b1.06956392.jpeg', 'R.LALL', '2017 by Rajkumar Goyal', '2018-09-23 04:13:15'),
(5, 'Advanced Engineering Mathematics', 'Erwin Kreyszig', 'The tenth edition of this best selling text includes examples in more detail and more applied exercises; both changes are aimed at making the material more relevant and accessible to readers. Kreyzsig introduces engineers and computer scientists to advanced math topics as they relate to practical problems. It goes into the following topics and great depth differential equations, partial differential equations, fourier analysis, vector analysis, and linear algebra/differential equations.', 'Mathematics', '978-8126554232', 660, 999, '5ba71450efc236.47796582.jpeg', 'Wiley; 10 edition (2015)', '2015 by Erwin Kreyzsig', '2018-09-24 08:45:31'),
(6, 'Science and Technology', 'Sheelwant Singh, Kriti Rastogi, Sarika', 'Sheelwant Signh, the author of more than twenty books from several publishing houses including McGraw Hill Education, is an Assistant Editor at Pratyogita Drishti - a leading magazine for competitive examinations in Rajasthan. He has taught at various institutions for Civil Service Examination preparation. He is presently running an institute called BRAINZ IAS in lucknow in the capacity of Founding director.', 'Science', '978-9387572911', 205, 1000, '5ba716019a7314.06774693.png', 'McGraw Hill Education', '2018, May 28 First Edition', '2018-09-23 04:26:41'),
(7, 'A Pocketful of Virtues', 'Nomce Dizon-Canlas', 'Pocketful of virtues produced the first mass-market, pocket-sized paperback books in America in early 1939 and revolutionized the publishing industry. The German Albatross Books had pioneered the idea of a line of color-coded paperback editions in 1931 under Kurt Enoch; Penguin Books in Britain had refined the idea in 1935 and had 1 million books in print by the following year.', 'Values Education', '971-7781-10-2', 150, 999, '5ba7182ff330b7.23828840.jpeg', 'Cainta Rizal; Glad Tidings Pub.', '-', '2018-09-23 14:10:46'),
(8, 'El Filibusterismo', 'Dr. Jose Rizal', 'Jose Rizal was one of the leading champions of Filipino nationalism and independence. His masterpiece, \"Noli Me Tangere\", is widely considered to be the foundational novel of the Philippines. In this riveting continuation, which picks up the story thirteen years later, Rizal departs from the Noli\'s themes of innocent love and martyrdom to present a gripping tale of obsession and revenge. Clearly demonstrating Rizal\'s growth as a writer, and influenced by his exposure to international events, \"El Filibusterismo\" is a thrilling and suspenseful account of Filipino resistance to colonial rule that still resonates today.', 'Filipino', '13-9780143106395', 380, 950, '5ba7197d3bfef3.65498440.png', 'Penguin Books Ltd', '-', '2018-09-23 15:25:09'),
(9, 'Noli Me Tangere', 'Dr. Jose Rizal', 'In more than a century since its appearance, Jose Rizal\'s Noli Me Tangere has become widely known as the great novel of the Philippines. A passionate love story set against the ugly political backdrop of repression, torture, and murder, \"The Noli,\" as it is called in the Philippines, was the first major artistic manifestation of Asian resistance to European colonialism, and Rizal became a guiding conscience-and martyr-for the revolution that would subsequently rise up in the Spanish province.', 'Filipino', '13-9780143039693', 250, 1000, '5ba719f2a73873.71061649.jpeg', 'Penguin Books Ltd', '-', '2018-09-23 04:43:30'),
(10, 'Ibong Adarna', 'Virgilio S. Alamario', 'Ibong Adarna is a 16th-century Filipino epic poem about an eponymous magical bird. The title\'s longer form during the Spanish Era was \"korido at Buhay na Pinagdaanan nÍ g Tatlong Principeng Magcacapatid na anac nÍ g Haring Fernando at nÍ g Reina Valeriana sa Cahariang Berbania\".', 'Filipino', '971-508-125-8', 130, 990, '5ba71a720572a0.13735698.jpeg', '1980', '-', '2018-09-24 08:45:19'),
(11, 'Bagwis', 'Efren R. Abueg', 'Sa pag-aaral ng panitikang pandalubhasaan, ang unang malaking nagiging balakid ay ang negatibo o salungat na damdamin ng mga mag-aaral â€” bagamat hindi naman lahat, sapagkat marami-rami na ring kabataan ngayon ang mayroon nang pagpapahalaga at hangaring maunawaan pang lalo ang panitikang sarili.', 'Filipino', '789-872-0447-73-2', 620, 1000, '5ba71af640c409.70347625.jpeg', 'The Library', '-', '2018-09-23 04:47:50'),
(12, 'Technology and Livelihood Education', 'DepEd', 'Technology and Livelihood Education (TLE) is one of the learning areas of the Secondary Education Curriculum used in Philippine secondary schools. As a subject in high school, its component areas are: Home Economics, Agri-Fishery Arts, Industrial Arts, and Information and Communication Technology.', 'TLE', '656-971-0537-72-2', 570, 1000, '5ba71bdb857379.94511580.jpeg', '2014 August 25', '-', '2018-09-23 09:53:37'),
(13, 'Kasaysayan ng Daigdig', 'Serafin D.. Quiason', 'Sinulat ng tatlong kinikilalang historyador ng bansa (Quiason, Churchill, Mangahas), ang Kasaysayan ng Daigdig ay batay sa patnubay ng DepEd at akmang-akma sa panahong ito ng globalisasyon. Bukod sa naipakikita ang mahahalagang pangyayari, kabihasnan, at kultura ng mga kontinente nang mga nagdaang panahon, tinatalakay rin dito ang mga bansang malaya nang nakikipagkalakalan at nakikilahok sa iba\'\'t ibang merkado at talakayang pandaigdig.', 'History', '648-562-0646-56-3', 1499, 990, '5ba71c847511f0.67682213.jpeg', 'CJS Publishing', '-', '2018-09-24 08:45:20'),
(14, 'Filipino Yaman ng Lahing Kayumanggi', 'Elvira E. Seguera', 'Pangunahing layunin sa paghahanda ng serye ng Filipino yaman ng lahinng kayumanggi ang gamiting patnubay sa pagaaral ng pinagsanib na wika at pagbasa ng mga magaaral sa antas ng elementary.', 'Filipino', '486-689-8934-23-5', 330, 1000, '5ba7525ddc4e98.39748351.jpeg', 'St. Bernadette Publishing House Corporation', '-', '2018-09-23 08:44:13'),
(15, 'Florante at Laura', 'Virgilio S. Alamario', 'Description: Florante at Laura by Francisco Balagtas is considered as one of the masterpieces of Philippine literature. Balagtas wrote the epic during his imprisonment. He dedicated it to his sweetheart MarÃ­a Asuncion Rivera, whom he nicknamed \"M. A. R.\" and is referenced to as \"Selya\" in the dedication \"Kay Selya\".', 'Filipino', '9789715081797', 490, 999, '5ba752b6b39991.51828113.jpg', 'Anvil General Reference', '-', '2018-09-24 08:45:32'),
(16, 'Basic Economics', 'Thomas Sowell', 'Basic Economics is a citizen\'s guide to economics-for those who want to understand how the economy works but have no interest in jargon or equations. Sowell reveals the general principles behind any kind of economy-capitalist, socialist, feudal, and so on. ', 'Economics', '890-445-0678-34-3', 600, 1000, '5ba75311cd94e4.79042793.jpeg', '2004', '-', '2018-09-23 08:47:13'),
(17, 'Living Life Undaunted', 'Cristine Caine', 'You donâ€™t have to be a superhero to change the world. You just have to listen for God calling your name.\r\n\r\nDrawing from her bestselling book Undaunted as well as several of her other inspirational writings, author and advocate Christine Caine presents 365 thought-provoking devotionals that will inspire you to overcome your life circumstances, create change, and bring the hope of Christ to a dark and troubled world.\r\nEach daily reading offers the wisdom, encouragement, and companionship you need to begin your own mission of adventure. Even if, like Christine, you began your story unnamed, unwanted, and unqualified, you can be fueled by an unstoppable faith and filled with Christâ€™s relentless love and courage.', 'Values Education', '978-0310341413', 430, 1000, '5ba753c9c31ef8.79068630.jpg', 'Zondervan 2014 April 1', '-', '2018-09-23 08:50:17'),
(18, 'Good Manners and Right Conduct', 'Gertrude E. McVenn', 'The sentiment in favor of a more systematic training in morals in our schools has been growing for some time. We teachers can no longer disregard this fact. An intelligent response must be made to the demand which this sentiment has presented. The plan for definite, continuous training along this line is a matter of the highest importance, inasmuch as the results to be secured are vital in the development of society as well as of the individual. In planning such a system the following essentials should be borne in mind :T he teacher must be in the highest possible degree what he wishes his pupils to become. If you wish to teach your class to be helpful, a spirit of eager service must characterize your own actions.', 'Values Education', 'B0092FJ3AM', 200, 1000, '5ba754384062e9.08020903.jpeg', 'Forgotten Books 2012 August 5', '-', '2018-09-23 08:52:08'),
(19, 'Araling Panlipunan', 'Lea Niloban', 'Ang Araling Panlipunan sa Siglo 21 ay seryeng binuo upang maipamalas ang pag-unawa sa mga konsepto at isyung pangkasaysayan, pangheograpiya, pang-ekonomiya, pangkultura, pampamahalaan, pansibiko, at panlipunan. \r\nSa pamamagitan ng mga aralin, nais naming mahubog ka na maging isang tunay na Pilipino na makatao, makabansa, maka-Diyos, makakalikasan, mapanuri, mapagmuni, mapanagutan, at produktibo. Hangarin din namin na magkaroon ka ng pambansa at pandaigdigang pananaw at pagpapahalaga sa mga usaping panlipunan at pangkasaysayan.', 'Economics', '978-971-569-762-0', 270, 968, '5ba754d51ee840.74433692.jpeg', 'Bookmark', '-', '2018-09-24 12:38:22'),
(20, 'Home Economics and Livelihood Education 6', 'Nara B. Villamar', 'Home Economics and Livelihood Education (HELE) series was prepared for elementary students to provide them with knowledge, skills, and attitudes for growth and development. This has been written in view of developing in them and understanding of their being artistic, their hygiene, and emotional and economic problems found in home, in the school, and in the community.', 'TLE', '0712300331', 330, 852, '5ba75555c2f791.16535862.jpg', 'Rex Bookstore, Inc.', '-', '2018-09-24 12:38:22'),
(21, 'What is Mathematics?', 'Richard Courant, Herbert Robbins', 'What Is Mathematics? is a mathematics book written by Richard Courant and Herbert Robbins, published in England by Oxford University Press. It is an introduction to mathematics, intended both for the mathematics student and for the general public.', 'Mathematics', '16608993', 140, 1000, '5ba9b3a1b790f5.34026972.jpg', 'Oxford University Press', '1941 Oxford University Press', '2018-09-25 04:03:45'),
(22, 'Calculus: Early Transcendentals', 'James Stewart', 'Appropriate for the traditional 2 or 3-term college calculus course, this textbook presents the fundamentals of calculus.', 'Mathematics', '-', 230, 1000, '5ba9b415e061d2.62687198.jpg', '7E Library', '1983', '2018-09-25 04:05:41'),
(23, 'Godel, Escher, Bach', 'Dougkas Hofstadter', 'GÃ¶del, Escher, Bach: An Eternal Golden Braid, also known as GEB, is a 1979 book by Douglas Hofstadter. By exploring common themes in the lives and works of logician Kurt GÃ¶del, artist M. C. Escher, and composer Johann Sebastian Bach, the book expounds concepts fundamental to mathematics, symmetry, and intelligence.', 'Mathematics', '978-0-465-02656-2', 290, 1000, '5ba9b471653436.64132237.jpg', 'Basic Books', '1979', '2018-09-25 04:07:13'),
(24, 'How Not to Be Wrong', 'Jordan Ellenberg', 'The Power of Mathematical Thinking, written by Jordan Ellenberg, is a New York Times Best Selling book that connects various economic and societal philosophies with basic mathematics and statistical principles.', 'Mathematics', '978-1594205224', 560, 1000, '5ba9b4f9bbd602.67652126.jpg', 'A Perigee Book/Penguin Group', '29 May 2014', '2018-09-25 04:09:29'),
(25, 'Flatland', 'Edwin Abbott Abbott', 'Flatland: A Romance of Many Dimensions is a satirical novella by the English schoolmaster Edwin Abbott Abbott, first published in 1884 by Seeley & Co. of London.', 'Mathematics', 'QA699', 270, 1000, '5ba9b54fc955f3.92341766.jpg', '-', '1884', '2018-09-25 04:10:55'),
(26, 'ThE Principles of Mathematics', 'Bertrand Russell', 'The Principles of Mathematics is a book written by Bertrand Russell in 1903. In it he presented his famous paradox and argued his thesis that mathematics and logic are identical. The book presents a view of the foundations of mathematics and has become a classic reference.', 'Mathematics', '-', 450, 1000, '5ba9b5ae9a1674.54652603.jpg', 'Cambridge University Press', '1903', '2018-09-25 04:12:30'),
(27, 'Men of Mathematics', 'Eric Temple Bell', 'Men of Mathematics: The Lives and Achievements of the Great Mathematicians from Zeno to PoincarÃ© is a book on the history of mathematics published in 1937 by Scottish-born American mathematician and science fiction writer E. T. Bell.', 'Mathematics', '-', 700, 1000, '5ba9b61ec89977.03532924.jpg', 'E.t Bell', '1937', '2018-09-25 04:14:22'),
(28, 'Euclid\'s Elements', 'Euclid', 'The Elements is a mathematical treatise consisting of 13 books attributed to the ancient Greek mathematician Euclid in Alexandria, Ptolemaic Egypt c. 300 BC. It is a collection of definitions, postulates, propositions, and mathematical proofs of the propositions. ', 'Mathematics', '-', 690, 1000, '5ba9b66f973619.10921669.png', 'U.S. Library', 'C 300 BC', '2018-09-25 04:15:43'),
(29, 'Fermat\'s Enigma', 'Simon Lehna Singh', 'Fermat\'s Last Theorem is a popular science book by Simon Singh. It tells the story of the search for a proof of Fermat\'s last theorem, first conjectured by Pierre de Fermat in 1637, and explores how many mathematicians such as Ã‰variste Galois had tried and failed to provide a proof for the theorem. ', 'Science', '978-1857025217', 890, 1000, '5ba9b6e8c14374.71582101.jpg', '-', '1997', '2018-09-25 04:17:44'),
(30, 'The Mathematical Experience', 'Reuben Hersh, Phillip J. Davis', 'The Mathematical Experience is a book by Philip J. Davis and Reuben Hersh that discusses the practice of modern mathematics from a historical and philosophical perspective. The book discusses the psychology of mathematicians. It gives examples of famous proofs and outstanding problems, such as the Riemann hypothesis. Wikipedia', 'Mathematics', '127-456-8953-6', 910, 1000, '5ba9b762c67b40.30225403.jpg', 'National Book Award for Science', '1985', '2018-09-25 04:19:46'),
(31, 'How to Lie with Statistics', 'Darell Huff', 'How to Lie with Statistics is a book written by Darrell Huff in 1954 presenting an introduction to statistics for the general reader. Not a statistician, Huff was a journalist who wrote many \"how to\" articles as a freelancer.  ', 'Mathematics', '122-345-6578-7', 590, 1000, '5ba9b82e9c2bb3.63318034.jpg', 'W. W. Norton & Company', '1954', '2018-09-25 04:23:10'),
(32, 'Innumeracy', 'John Allen Paulos', 'Innumeracy: Mathematical Illiteracy and its Consequences is a 1988 book by mathematician John Allen Paulos about \"innumeracy,\" a term he embraced to describe the mathematical equivalent of illiteracy: incompetence with numbers rather than words.  ', 'Mathematics', '0-8090-7447-8', 370, 1000, '5ba9b89da4e120.01756243.jpg', '-', '1988', '2018-09-25 04:25:01'),
(33, 'Handbook of Mathematics', ' I. N. BronshteÄ­n, Konstantin AdolfoviÄ SemenÄ‘ajev', 'Bronshtein and Semendyayev is the informal name of a comprehensive handbook of fundamental working knowledge of mathematics and table of formulas originally compiled by the Russian mathematician Ilya Nikolaevich Bronshtein and engineer Konstantin Adolfovic Semendyayev.', 'Mathematics', '-', 320, 1000, '5ba9b903cf8c54.43679527.jpg', 'I. N. Bronshtein', '1945', '2018-09-25 04:26:43'),
(34, ' I. N. BronshteÄ­n, Konstantin', 'Steven Strogatz', 'Math is everywhere, often where we least expect it. Award-winning professor Steven Strogatz acts as our guide as he takes us on a tour of numbers that - unbeknownst to the most of us - form a fascinating and integral part of our everyday lives.', 'Mathematics', '989-355-2145-9', 500, 1000, '5bad7f18bde116.40960530.jpg', 'I. N. Bronshtein', '2012', '2018-09-28 01:08:40'),
(35, 'A Mind For Numbers: How to Excel at Math and Science ', 'Barbara Oakley', 'The companion book to COURSERAÂ®\'s wildly popular massive open online course \"Learning How to Learn\"Whether you are a student struggling to fulfill a math or science requirement, or you are embarking .', 'Mathematics', '9780399165245', 699, 100, '5ba9ba00e0d565.14051949.jpg', '-', '31 July 2014', '2018-09-25 04:30:56'),
(36, 'Alex\'s Adventure in Numberland', 'Alex Bellos', 'Exploding the myth that maths is best left to the geeks, Alex Bellos covers subjects from adding to algebra, from set theory to statistics and from logarithms to logical paradoxes. In doing so, he explains how mathematical ideas underpin just about everything in our lives.Google Books', 'English', '121-456-7891-6', 500, 1000, '5bad77711da0a0.49266497.jpg', '-', '2010', '2018-09-28 08:57:20'),
(40, 'Cracking the Sat II: English Subject Tests Princeton Review Series Princeton Review: Cracking the SAT Literature Subject Test', 'Liz Buffa, John Katzman', 'I purchased this book for my stepson as he prepared for his SAT Literature test. He already had a couple of other review books (Barron\'s for example). He said the Princeton Review was the best one. I bought other Princeton SAT review books as well. He made a perfect score on the math and science sections, and missed a perfect score on the Literature exam by two points. ', 'English', '0679778586', 500, 1000, '5bad7cdae1cc96.37117495.jpg', '-', '1997', '2018-09-28 00:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `bookid` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`bookid`, `ip_add`, `quantity`) VALUES
(34, '::1', 10),
(11, '::1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(70) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`) VALUES
(1, 'Arjay Diangzon', 'arjaydiangzon@gmail.com', '09099054766', 'Valley Golf'),
(2, 'Arjay Pinca', 'arjaypinca@gmail.com', '09090909090', 'Valley Golf'),
(3, 'Jean Justado', 'jeanjustado12@gmail.com', '09262455215', 'Cardona Rizal'),
(4, 'Marie Justado', 'marie@gmail.com', '', 'Cardona Rizal'),
(5, 'Jean Justado', 'jeanjustado12@gmail.com', '09099054766', 'Cardona Rizal'),
(7, 'Liza Diangzon', 'liza@gmail.com', '09086543052', 'Valley Golf'),
(9, 'Nilo Calisbo', 'nilo@gmail.com', '', 'Pasig City'),
(10, 'James Cajigal', 'james@gmail.com', '', 'Pasig City'),
(11, 'Nilo Calisbo', 'nilo@gmail.com', '', 'Pasig City'),
(12, 'Nilo Calisbo Jr.', 'nilo@gmail.com', '', 'Pasig City'),
(13, 'Jean Marie Justado', 'jeanjustado@gmail.com', '09565206205', 'Cainta, Rizal'),
(14, 'Jean Marie Diangzon', 'jeandiangzon@gmail.com', '', 'Parkplace, Cainta Rizal'),
(15, 'James II', 'jamescajigal@gmail.com', '', 'Pasig City');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `book_stocks` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `bookid`, `book_stocks`, `status`, `date_`) VALUES
(1, 1, 0, 'read', '2018-09-23 03:52:49'),
(2, 2, 0, 'read', '2018-09-23 03:58:17'),
(3, 2, 0, '', '2018-09-23 04:07:37'),
(4, 3, 0, 'read', '2018-09-23 04:07:38'),
(5, 4, 0, 'read', '2018-09-23 04:13:15'),
(6, 5, 0, 'read', '2018-09-23 04:19:29'),
(7, 6, 0, 'read', '2018-09-23 04:26:42'),
(8, 7, 0, 'read', '2018-09-23 04:36:01'),
(9, 8, 0, 'read', '2018-09-23 04:41:33'),
(10, 9, 0, 'read', '2018-09-23 04:43:32'),
(11, 10, 0, 'read', '2018-09-23 04:45:39'),
(12, 11, 0, 'read', '2018-09-23 04:47:51'),
(13, 12, 0, 'read', '2018-09-23 04:51:40'),
(14, 13, 0, 'read', '2018-09-23 04:54:29'),
(15, 14, 0, 'read', '2018-09-23 08:44:14'),
(16, 15, 0, 'read', '2018-09-23 08:45:43'),
(17, 16, 0, 'read', '2018-09-23 08:47:14'),
(18, 17, 0, 'read', '2018-09-23 08:50:18'),
(19, 18, 0, 'read', '2018-09-23 08:52:10'),
(20, 19, 0, 'read', '2018-09-23 08:54:45'),
(21, 20, 0, 'read', '2018-09-23 08:56:54'),
(22, 21, 0, 'read', '2018-09-25 04:03:46'),
(23, 2, 0, '', '2018-09-25 04:05:41'),
(24, 3, 0, '', '2018-09-25 04:05:42'),
(25, 22, 0, 'read', '2018-09-25 04:05:42'),
(26, 23, 0, 'read', '2018-09-25 04:07:14'),
(27, 24, 0, 'read', '2018-09-25 04:09:29'),
(28, 25, 0, 'read', '2018-09-25 04:10:56'),
(29, 2, 0, '', '2018-09-25 04:12:30'),
(30, 3, 0, '', '2018-09-25 04:12:30'),
(31, 22, 0, '', '2018-09-25 04:12:30'),
(32, 26, 0, 'read', '2018-09-25 04:12:31'),
(33, 2, 0, '', '2018-09-25 04:14:22'),
(34, 3, 0, '', '2018-09-25 04:14:22'),
(35, 22, 0, '', '2018-09-25 04:14:22'),
(36, 26, 0, '', '2018-09-25 04:14:23'),
(37, 27, 0, 'read', '2018-09-25 04:14:23'),
(38, 2, 0, '', '2018-09-25 04:15:43'),
(39, 3, 0, '', '2018-09-25 04:15:43'),
(40, 22, 0, '', '2018-09-25 04:15:43'),
(41, 26, 0, '', '2018-09-25 04:15:44'),
(42, 27, 0, '', '2018-09-25 04:15:44'),
(43, 28, 0, 'read', '2018-09-25 04:15:44'),
(44, 29, 0, 'read', '2018-09-25 04:17:44'),
(45, 30, 0, 'read', '2018-09-25 04:19:46'),
(46, 31, 0, 'read', '2018-09-25 04:21:49'),
(47, 32, 0, 'read', '2018-09-25 04:25:01'),
(48, 2, 0, '', '2018-09-25 04:26:43'),
(49, 3, 0, '', '2018-09-25 04:26:43'),
(50, 22, 0, '', '2018-09-25 04:26:44'),
(51, 26, 0, '', '2018-09-25 04:26:44'),
(52, 27, 0, '', '2018-09-25 04:26:44'),
(53, 28, 0, '', '2018-09-25 04:26:44'),
(54, 33, 0, 'read', '2018-09-25 04:26:44'),
(55, 34, 0, 'read', '2018-09-25 04:29:11'),
(56, 35, 0, 'read', '2018-09-25 04:30:57'),
(57, 36, 0, 'read', '2018-09-28 00:36:03'),
(58, 37, 0, 'read', '2018-09-28 00:41:51'),
(59, 37, 0, 'read', '2018-09-28 08:54:35'),
(60, 38, 0, 'read', '2018-09-28 00:45:19'),
(61, 39, 0, 'read', '2018-09-28 00:51:32'),
(62, 40, 0, 'read', '2018-09-28 00:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`name`) VALUES
('Computer'),
('Economics'),
('English'),
('Filipino'),
('History'),
('MAPEH'),
('Mathematics'),
('Science'),
('TLE'),
('Values Education');

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

CREATE TABLE `temp_cart` (
  `id` int(11) NOT NULL,
  `ip_add` text NOT NULL,
  `customer_name` text NOT NULL,
  `bookid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `status` text NOT NULL,
  `date_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_cart`
--

INSERT INTO `temp_cart` (`id`, `ip_add`, `customer_name`, `bookid`, `quantity`, `price`, `cost`, `status`, `date_`) VALUES
(1, '::1', 'Arjay Diangzon', 20, 10, 330, 3300, 'read', '2018-09-23 15:24:55'),
(3, '::1', 'Arjay Pinca', 20, 20, 330, 6600, 'read', '2018-09-23 15:25:01'),
(7, '::1', 'Jean Justado', 8, 50, 380, 19000, 'read', '2018-09-23 15:25:09'),
(12, '::1', 'Marie Justado', 20, 20, 330, 6600, 'read', '2018-09-23 15:25:15'),
(14, '::1', 'Liza Diangzon', 10, 10, 130, 1300, 'read', '2018-09-24 08:45:19'),
(15, '::1', 'Liza Diangzon', 13, 10, 1499, 14990, 'read', '2018-09-24 08:45:19'),
(17, '::1', 'Nilo Calisbo', 5, 1, 660, 660, 'read', '2018-09-24 08:45:31'),
(18, '::1', 'Nilo Calisbo', 19, 1, 270, 270, 'read', '2018-09-24 08:45:31'),
(19, '::1', 'Nilo Calisbo', 15, 1, 490, 490, 'read', '2018-09-24 08:45:31'),
(20, '::1', 'James Cajigal', 2, 1, 300, 300, 'read', '2018-09-24 08:46:11'),
(21, '::1', 'Nilo Calisbo Jr.', 18, 1, 200, 200, 'unread', '2018-09-24 08:59:21'),
(22, '::1', 'Jean Marie Justado', 7, 5, 150, 750, 'unread', '2018-09-24 12:32:14'),
(23, '::1', 'Jean Marie Justado', 3, 9, 150, 1350, 'unread', '2018-09-24 12:32:15'),
(24, '::1', 'Jean Marie Diangzon', 19, 31, 270, 8370, 'read', '2018-09-24 12:38:22'),
(25, '::1', 'Jean Marie Diangzon', 20, 98, 330, 32340, 'read', '2018-09-24 12:38:22'),
(26, '::1', 'James II', 34, 10, 500, 5000, 'unread', '2018-09-28 09:20:33'),
(27, '::1', 'James II', 11, 10, 620, 6200, 'unread', '2018-09-28 09:20:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `temp_cart`
--
ALTER TABLE `temp_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
