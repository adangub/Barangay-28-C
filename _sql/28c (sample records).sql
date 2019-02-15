-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2016 at 02:38 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `28c`
--
CREATE DATABASE IF NOT EXISTS `28c` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `28c`;

--
-- Dumping data for table `announcements`
--

INSERT INTO `household` (`id`, `address`, `purokNo`, `totalHouseholdIncome`, `household_head_id`) VALUES
(1, 'D. Suazo St.', 0, 45000, NULL),
(2, 'Chavez St.', 0, 30000, NULL),
(3, 'Monteverde St.', 0, 0, NULL),
(4, 'Aklan St.', 0, 0, NULL),
(5, 'Sta. Ana', 0, 21000, NULL),
(6, 'Leon M. Guerrero St.', 0, 90000, NULL),
(7, 'Villa Abrille St.', 0, 205000, NULL),
(8, 'Pizza Hut St.', 0, 1, NULL),
(9, 'Narra St.', 0, 189500, NULL),
(10, 'Santa Ana Avenue', 0, 178000, NULL),
(11, 'C Lizada St.', 0, 10000, NULL);


INSERT INTO `resident` (`id`, `family_name`, `middle_name`, `first_name`, `gender`, `precinctNo`, `birth_date`, `birth_place`, `civilstatus`, `height`, `weight`, `dependent`, `personal_income`, `fathers_id`, `mothers_id`, `guardians_id`, `username`, `password`, `regdate`, `email`, `contact_number`, `household_id`, `image`, `eligibility`) VALUES
(1, 'Biggs', 'Shearer', 'Tommy', 'Male', 'First', '2001-03-16', 'Davao City', 'Single', '5''4', 46, 1, 0, 0, 0, 0, 'tommybiggs', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-09 02:40:21', 'tommybiggs@gmail.com', '09369565269', 1, NULL, 1),
(2, 'Comstock', 'Easley', 'Willie', 'Male', 'Second', '1973-02-17', 'Davao City', 'Married', '5''9', 68, 0, 30000, 0, 0, 0, 'williecomstock', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-23 02:44:51', 'williecomstock@gmail.com', '09204146187', 2, NULL, 1),
(3, 'Mortensen', 'Linton', 'Fred', 'Male', 'Third', '2000-08-14', 'Manila', 'Single', '5''6', 59, 1, 0, 0, 0, 0, 'mortfred', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-11-03 02:46:27', 'mortfred@addu.edu.ph', '09369565269', 3, NULL, 0),
(4, 'Deluca', 'Solano', 'Michael', 'Male', 'Third', '1999-07-18', 'Digos City', 'Single', '5''6', 47, 1, 0, 0, 0, 0, 'michael123', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2014-08-13 02:47:46', 'delmichael@addu.edu.ph', '09369565269', 4, NULL, 1),
(5, 'Biggs', 'Shearer', 'Ellaine', 'Female', 'Second', '1983-05-05', 'Davao City', 'Married', '5''7', 55, 0, 30000, 0, 0, 0, 'biggsel', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-01 02:49:29', 'biggsel@gmail.com', '09204146187', 1, NULL, 1),
(6, 'Biggs', 'Shearer', 'Amanda', 'Female', 'Second', '1992-04-01', 'Davao City', 'Married', '5''4', 57, 0, 15000, 0, 0, 0, 'amanda', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 02:53:15', 'amandabiggss@yahoo.com', '09286124781', 1, NULL, 1),
(7, 'Mortensen', 'Fleming', 'Eileen', 'Female', 'Third', '1999-06-17', 'Taguig', 'Single', '5''0', 44, 1, 0, 0, 0, 0, 'eileen22', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 02:55:09', 'eileen@gmail.com', '09286124781', 3, NULL, 1),
(8, 'Kimberly', 'Farrow', 'Hagan', 'Female', 'Second', '1988-02-05', 'Davao City', 'Married', '5''7', 49, 0, 21000, 0, 0, 0, 'hagan88', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-24 19:13:12', 'hagan88@yahoo.com', '09369565269', 5, NULL, 1),
(9, 'Ruby', 'Ritter', 'England', 'Female', 'Second', '1975-10-28', 'United Kingdom', 'Single', '5''7', 57, 0, 90000, 0, 0, 0, 'rubyland', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 03:16:19', 'ruby@gmail.com', '09369565269', 6, NULL, 1),
(10, 'Duterte', 'Roa', 'Rodrigo', 'Male', 'Third', '1966-05-02', 'Camiguin', 'Divorced', '5''7', 55, 0, 150000, 0, 0, 0, 'rodyduterte', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 03:18:15', 'rduterte@gmail.com', '09369565269', 7, '-264265065.jpg', 0),
(11, 'Duterte', 'Roa', 'Sarah', 'Female', 'Third', '1988-02-06', 'Davao City', 'Single', '5''4', 57, 0, 55000, 0, 0, 0, 'inday', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 03:21:56', 'sarah_duterte@gmail.com', '09369565269', 7, NULL, 1),
(12, 'Pamienta', 'Greene', 'Anita', 'Female', 'Third', '2004-12-08', 'Davao City', 'Single', '5''1', 47, 1, 0, 0, 0, 0, 'anitapm', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 03:29:23', 'anitapam@gmail.com', '09286124782', 1, NULL, 0),
(13, 'Roxas', 'Epal', 'Mar', 'Female', 'Second', '2010-11-01', 'Manila', 'Divorced', '4''5', 120, 0, 1, 0, 0, 0, 'epal', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-25 04:36:52', 'epal@epal.com', '911', 8, '-427042306.jpg', 0),
(14, 'Monica', 'Elizabeth', 'EdmÃ©e', 'Female', 'Second', '1981-07-07', 'England', 'Married', '5''5', 57, 0, 189500, 0, 0, 0, 'monicaedmee', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-26 09:57:17', 'elizabethedmee@gmail.com', '09369565269', 9, NULL, 1),
(15, 'Kjellberg', 'Arvid Ulf', 'Felix', 'Male', 'First', '1989-10-24', 'Brighton, England, United Kingdom', 'Single', '5''11', 65, 0, 1000000, 0, 0, 0, 'pewdiepie', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-26 09:59:38', 'pewdiepie@gmail.com', '09204146187', 10, '-541450311.jpg', 0),
(16, 'Méliès', 'Jean', 'Georges', 'Male', 'Third', '1935-12-08', 'Paris, France', 'Divorced', '5''5', 57, 0, 10000, 0, 0, 0, 'melies', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', '2015-12-26 10:02:47', 'georgesmelies@filmcritics.com', '09182386481', 11, '-488241931.jpg', 0),
(17, 'Mejia', 'B.', 'Neil Marc', 'Male', 'Second', '1997-03-26', 'Kidapawan City', 'Single', '5''9', 65, 0, 0, 0, 0, 0, 'nmbmejia', 'd16c2eb1ef14a0513f3cfef55e78d38a3d11401c0d498329c222ab9c3a78fe1d31969cbc7b9a0eb23ba2e788803506ae854044941df5fbb2b6f9e54f641d91db', '2016-03-03 00:45:47', 'nmbmejia@addu.edu.ph', '09369565269', 1, '-647667289.jpg', 0),
(18, 'Barquin', 'D.', 'Cedric', 'Male', 'Second', '1996-05-06', 'Davao City', 'Single', '5''9', 59, 1, 0, 0, 0, 0, 'cfdbarquin', '82a0ca393828b5c24416bc53cc9dd0dc66f33f160ba6a639eebce4cabe11ec1e09495a5edf1f476346877c6ceeea3ff1ffa5633f0f7550766984ff7526cf3e48', '2016-01-06 04:17:56', 'masha@facebook.com', '09999999999', 7, NULL, 0),
(19, 'Angub', 'Doyog', 'Adrian ', 'Male', 'Third', '1996-12-06', 'New Bohol', 'Single', '5''7', 59, 1, 0, 0, 0, 0, 'adangub', 'c4bfebdb91c4ca456fb22395dcde121b8bed4c8ab14678501ce1757f5041b9f429b5448a8179d5ba8b5f42480146e9bef6b36e3a2da2ba74d7aca8ce02552db7', '2016-01-06 04:22:35', 'adrian.angub@facebook.com', '09999999999', 2, '-120711210.jpg', 0);


INSERT INTO `employee` (`id`, `position`, `resident_id`) VALUES
(1, 'SK Chairman', 17),
(2, 'Barangay Captain', 18),
(3, 'Barangay Secretary', 19),
(4, Null, 15);


INSERT INTO `request_type` (`id`, `request_name`) VALUES
(1, 'Residency Request'),
(2, 'Barangay Clearance Request'),
(3, 'Police Clearance Request'),
(4, 'NBI Clearance Request'),
(5, 'Blotter Complaint'),
(6, 'Cedula Request'),
(7, 'Profile Edit Request'),
(8, 'Blotter Request');


INSERT INTO `transactions` (`id`, `amount`, `date`, `resident_id`, `employee_id`, `request_type_id`) VALUES
(1, 20, '2016-01-02 17:30:15', 17, 3, 1),
(2, 20, '2016-01-02 17:30:15', 18, 1, 1),
(3, 20, '2016-01-02 17:30:15', 19, 2, 1),
(4, 0, '2016-02-17 02:03:49', 17, 2, 7),
(5, NULL, '2016-02-17 02:04:18', 17, 3, 4),
(6, 20, '2016-02-17 02:05:30', 17, 2, 2),
(7, NULL, '2016-02-17 02:05:54', 17, 3, 3),
(8, 20, '2016-02-22 13:49:21', 4, 2, 1),
(9, 20, '2016-02-22 13:49:41', 5, 1, 1),
(10, 20, '2016-02-22 13:49:55', 10, 3, 1),
(11, 20, '2016-02-22 13:50:52', 16, 2, 1),
(12, 20, '2016-02-22 13:51:02', 15, 2, 1),
(13, 20, '2016-02-22 13:51:12', 13, 2, 1),
(14, 20, '2016-02-22 13:53:44', 15, 1, 3),
(15, NULL, '2016-02-22 13:53:53', 16, 1, 4),
(16, 20, '2016-02-22 13:54:01', 10, 1, 2);










INSERT INTO `announcements` (`id`, `date`, `content`, `priority`, `employee_id`) VALUES
(1, '2015-09-30 18:11:00', 'The PH jumps 30 notches in the Ease of Doing Business report. The administration''s anti-corruption drive suffers a ratings drop. Winners proclaimed in 73% of barangays.', 0, 1),
(2, '2015-12-31 16:40:00', 'Happy New Year from the Barangay 28C and its Web Developers!', 0, 1),
(3, '2015-12-21 04:21:00', 'Katherine Joy Argyle and Benjamin David Green are happy to announce their engagement. A March wedding is planned.', 0, 1),
(4, '2015-05-03 10:12:00', 'Barangay 28-C is one of the Top Ten Barangays.', 0, 1),
(5, '2014-03-26 07:34:00', 'Plaque of appreciation was awarded to the barangay council of barangay 28-C with the leadership of Hon. Margie P. Corral for their invaluable contribution and support as project partner in the successful implementation of the ''Capacity Enhancement for Child Protection Project'' from March 2010 until February 2013.\n', 0, 1),
(6, '2015-01-29 23:43:00', 'Barangay 28-C, Poblacion, Davao City in partnership with the University of Southeastern Philippines-Institute of Computing, entered into an agreement to design and develop the Barangay 28-C, Poblacion website. The goal of the project is to promote the barangay through the use of information technology.', 0, 1),
(7, '2016-02-18 05:30:00', 'Goodluck sa Mock Defense!.', 1, 1);

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`id`, `complaint`, `date`, `status`, `complainant_id`, `complaint_type_id`, `lupong_id`, `lupong2_id`, `valid`) VALUES
(1, 'Two people were issued a trespass warning in the upper deck of the barangay. They apparently removed their pants and underwear and sat on the roof and rubbed their buttocks on the edge of the roof creating mass-wide panick.', '2016-02-06 16:44:22', 'Hearing #3', 1, 26, 1, 2, 1),
(2, 'The victims were standing near a vehicle at this location when the suspects drove up in a vehicle and fired shots in their direction.  The  victim was struck and immediately transported to a local area hospital and treated for non-life threatening injuries.  The identified suspects fled the scene and were located 6 hours later.  The investigation is on going.', '2016-02-06 16:49:52', 'Hearing #2', 2, 15, NULL, NULL, 1),
(3, 'Someone broke into Mar''s house and switched hardware in his computer with identical hardware that doesn''t work. ', '2016-02-06 17:01:33', 'Hearing #2', 3, 8, NULL, NULL, 1),
(4, '(10:00PM): Record: A Phone Call Received by SP01 PAT COLINAR radio operator of 911, who received a call from a concerned citizen who identified himself as Mar Roxas informing that there was a rape incident transpired at Chavez St, Davao City.', '2016-02-22 21:59:22', 'Hearing #1', 4, 44, NULL, NULL, 1),
(5, 'At about 04:20PM of February 22, 2016, a Phone Call received by this station informing that an alleged Shooting Incident Transpired along Narra Drive of Barangay 28C, this Municipality. Elements of this Station together with the duty investigator immediately proceeded at said place. Initial investigation conducted disclosed that on or about 04:00 pm of this date while the victim driving one (1) DNS Shuttle Service Coaster Bus, bearing plate number PYY-857, drive by shot the victim 6 times.', '2016-02-22 22:05:09', 'Forwarded', 5, 35, NULL, NULL, 1),
(6, 'The victim was standing near a vehicle at this location when the unknown suspects drove up in a vehicle and fired shots in their direction.  The victim was struck and immediately transported to a local area hospital and treated for non-life threatening injuries.  The identified suspects were quickly captured. ', '2016-02-22 22:07:45', 'Forwarded', 6, 14, NULL, NULL, 1),
(7, 'An unknown suspect entered a business armed with a handgun and demanded cash.  The suspect fled the scene with an undisclosed amount of cash.  No injuries were reported.', '2016-02-22 22:09:12', 'Hearing #3', 7, 20, 2, 1, 1);

--
-- Dumping data for table `complainant`
--

INSERT INTO `complainant` (`id`, `complainant_name`, `complainant_address`, `contactNo`, `resident_id`) VALUES
(1, NULL, NULL, NULL, 18),
(2, 'ChloÃ« Grace Moretz', 'Atlanta', NULL, NULL),
(3, NULL, NULL, NULL, 13),
(4, NULL, NULL, NULL, 13),
(5, NULL, NULL, NULL, 14),
(6, NULL, NULL, NULL, 9),
(7, NULL, NULL, NULL, 10);

--
-- Dumping data for table `complaint_type`
--

INSERT INTO `complaint_type` (`id`, `complaint_name`) VALUES
(1, 'Arson'),
(2, 'Aggravated Assault / Battery'),
(3, 'Attempt'),
(4, 'Bribery'),
(5, 'Child Abandonment'),
(6, 'Child Abuse'),
(7, 'Child Pornography'),
(8, 'Computer Crime'),
(9, 'Conspiracy'),
(10, 'Credit / Debit Card Fraud'),
(11, 'Criminal Contempt of Court'),
(12, 'Cyber Bullying'),
(13, 'Disorderly Conduct'),
(14, 'Disturbing the Peace'),
(15, 'Domestic Violence'),
(16, 'Drug Manufacturing and Cultivation'),
(17, 'Drug Trafficking / Distribution'),
(18, 'DUI / DWI'),
(19, 'Embezzlement'),
(20, 'Extortion'),
(21, 'Forgery'),
(22, 'Fraud'),
(23, 'Harassment'),
(24, 'Hate Crimes'),
(25, 'Homicide'),
(26, 'Indecent Exposure'),
(27, 'Identity Theft'),
(28, 'Insurance Fraud'),
(29, 'Kidnapping'),
(30, 'Manslaughter: Involuntary'),
(31, 'Manslaughter: Voluntary'),
(32, 'Medical Marijuana'),
(33, 'MIP: A Minor in Possession'),
(34, 'Money Laundering'),
(35, 'Murder: First-degree'),
(36, 'Murder: Second-degree'),
(37, 'Open Container Law'),
(38, 'Perjury'),
(39, 'Probation Violation'),
(40, 'Prostitution'),
(41, 'Public Intoxication'),
(42, 'Pyramid Schemes'),
(43, 'Racketeering / RICO'),
(44, 'Rape'),
(45, 'Robbery'),
(46, 'Securities Fraud'),
(47, 'Sexual Assault'),
(48, 'Shoplifting'),
(49, 'Solicitation'),
(50, 'Stalking'),
(51, 'Statutory Rape'),
(52, 'Tax Evasion / Fraud'),
(53, 'Telemarketing Fraud'),
(54, 'Vandalism'),
(55, 'White Collar Crimes'),
(56, 'Wire Fraud');

--
-- Dumping data for table `editprofile`
--

INSERT INTO `editprofile` (`id`, `precinctNo`, `civilstatus`, `height`, `weight`, `personal_income`, `contact_number`, `email`, `password`, `dependent`, `position`, `new_household_id`, `resident_id`) VALUES
(1, 'First', 'Married', '4''5', 65, 5000000, '09204146187', 'pewdiepie@gmail.com', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', 0, '', 10, 15);

--
-- Dumping data for table `employee`
--



--
-- Dumping data for table `employee_program_assignment`
--

INSERT INTO `employee_program_assignment` (`programs_id`, `employee_id`) VALUES
(4, 1),
(17, 2),
(19, 3),
(20, 1),
(21, 2),
(22, 3),
(1, 1),
(3, 2),
(13, 3),
(14, 1),
(15, 2),
(18, 3),
(23, 1),
(2, 2),
(5, 3),
(9, 1),
(16, 2),
(24, 3);

--
-- Dumping data for table `hearing_schedule`
--

INSERT INTO `hearing_schedule` (`id`, `schedule_date`, `start_time`, `end_time`, `blotter_id`) VALUES
(1, '2016-02-14', '08:00:00', '09:00:00', 1),
(2, '2016-02-24', '09:00:00', '24:00:00', 1),
(3, '2016-03-02', '16:00:00', '19:00:00', 1),
(5, '2016-03-11', '16:30:00', '18:30:00', 2),
(6, '2016-02-24', '16:00:00', '17:00:00', 4),
(7, '2016-02-25', '14:30:00', '15:30:00', 7),
(8, '2016-03-02', '16:00:00', '17:00:00', 7),
(9, '2016-02-29', '15:00:00', '16:00:00', 3),
(10, '2016-03-25', '16:00:00', '17:00:00', 3),
(11, '2016-03-19', '16:00:00', '17:00:00', 2),
(12, '2016-03-17', '15:00:00', '17:00:00', 7);

--
-- Dumping data for table `household`
--



--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `title`, `date`, `place`, `status`, `timeFrom`, `timeTo`, `budget`) VALUES
(1, 'Concreting of Brgy. Road', '2016-02-24', 'D. Suazo St.', 'Approved', '11:00:00', '16:00:00', 20000),
(2, 'Vaccination of Animals', '2016-02-29', 'Barangay 28C Gymnasium', 'Pending Approval', '09:00:00', '16:00:00', 20000),
(3, 'Barangay Fiesta', '2016-02-27', 'Barangay', 'Approved', '10:00:00', '16:00:00', 30000),
(4, 'Construction of Drainage Canals', '2016-03-08', 'Chavez St.', 'Pending Approval', '08:00:00', '16:00:00', 10000),
(5, 'People Power Anniversary', '2016-02-25', 'Nationwide', 'Holiday', '00:00:00', '00:00:00', 0),
(9, 'International Womens Day', '2016-03-08', 'Nationwide', 'Approved', '00:00:00', '00:00:00', 0),
(13, 'Araw ng Dabaw', '2016-03-16', 'Davao City', 'Approved', '00:00:00', '23:00:00', 0),
(14, 'World Water Day', '2016-03-22', 'Nationwide', 'Approved', '00:00:00', '23:30:00', 0),
(15, 'Holy Thursday', '2016-03-24', 'Nationwide', 'Approved', '00:00:00', '23:30:00', 0),
(16, 'Good Friday', '2016-03-25', 'Nationwide', 'Approved', '00:00:00', '23:30:00', 0),
(17, 'Black Saturday', '2016-03-26', 'Nationwide', 'Approved', '00:00:00', '23:30:00', 0),
(18, 'Semestral Break', '2016-03-27', 'ADDU', 'Approved', '00:00:00', '23:30:00', 0),
(19, 'New Year', '2016-01-01', 'Worldwide', 'Approved', '00:00:00', '23:30:00', 20000),
(20, 'Christmas', '2015-12-25', 'Worldwide', 'Approved', '00:00:00', '23:30:00', 20000),
(21, 'Repainting of Day Care Center', '2016-03-25', 'Daycare', 'Approved', '09:00:00', '15:00:00', 18000),
(22, 'Contruction of Barangay Memorial Chapel', '2016-03-25', 'Somewhere', 'Approved', '09:00:00', '16:00:00', 68000),
(23, 'Conversion of idle lands into useful and productive lots', '2016-03-25', 'All', 'Approved', '09:00:00', '16:30:00', 30000),
(24, 'SAD Defense', '2016-03-18', 'F607', 'Approved', '13:15:00', '14:30:00', 0);

--
-- Dumping data for table `program_expense`
--

INSERT INTO `program_expense` (`id`, `expense_name`, `amount`, `date`, `program_id`) VALUES
(4, 'Concrete', 5000, '2016-02-14 00:00:00', 1),
(5, 'General Construction Supplies', 2350, '2016-02-10 00:00:00', 1),
(6, 'Foods', 13936, '2016-02-13 00:00:00', 3),
(7, 'Labor', 4500, '2016-02-12 00:00:00', 1);


INSERT INTO `participants` (`resident_id`, `program_id`) VALUES
(17, 24),
(18, 24),
(19, 24);

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `verified`, `optional_comment`, `date`, `transactions_id`, `resident_id`, `request_type_id`) VALUES
(1, '0', NULL, '2015-12-09 18:40:21', NULL, 1, 1),
(2, '0', NULL, '2015-12-23 18:44:51', NULL, 2, 1),
(3, '0', NULL, '2015-11-03 18:46:27', NULL, 3, 1),
(4, '1', 'Valid', '2014-08-13 18:47:46', 8, 4, 1),
(5, '1', 'Valid', '2015-12-01 18:49:29', 9, 5, 1),
(6, '0', NULL, '2015-12-25 18:53:15', NULL, 6, 1),
(7, '0', NULL, '2015-12-25 18:55:09', NULL, 7, 1),
(8, '0', NULL, '2015-12-25 11:13:12', NULL, 8, 1),
(9, '0', NULL, '2015-12-25 19:16:19', NULL, 9, 1),
(10, '1', 'Valid', '2015-12-25 19:18:15', 10, 10, 1),
(11, '0', NULL, '2015-12-25 19:21:56', NULL, 11, 1),
(12, '0', NULL, '2015-12-25 19:29:23', NULL, 12, 1),
(13, '1', 'Valid', '2015-12-25 19:41:49', 13, 13, 1),
(14, '0', NULL, '2015-12-27 01:57:17', NULL, 14, 1),
(15, '1', 'Valid', '2015-12-27 01:59:38', 12, 15, 1),
(16, '1', 'Valid', '2015-12-27 02:02:26', 11, 16, 1),
(17, '1', 'Residing since 6 months', '2016-01-01 06:00:00', 1, 17, 1),
(18, '1', 'Residing since 7 months', '2016-01-01 06:00:00', 2, 18, 1),
(19, '1', 'Residing since 8 months', '2016-01-01 06:00:00', 3, 19, 1),
(20, '1', NULL, '2016-02-17 18:02:32', 6, 17, 2),
(21, '2', 'No show', '2016-02-17 18:02:38', 7, 17, 3),
(22, '2', 'Invalid', '2016-02-17 18:02:42', 5, 17, 4),
(23, '1', NULL, '2016-02-17 18:03:11', 4, 17, 7),
(24, '1', NULL, '2016-02-22 21:52:21', 16, 10, 2),
(25, '2', 'Invalid', '2016-02-22 21:52:42', 15, 16, 4),
(26, '1', NULL, '2016-02-22 21:53:00', 14, 15, 3),
(27, '0', NULL, '2016-02-22 21:55:07', NULL, 15, 7),
(28, '0', NULL, '2016-02-22 21:55:28', NULL, 10, 3);

--
-- Dumping data for table `request_type`
--



--
-- Dumping data for table `resident`
--


--
-- Dumping data for table `respondents`
--

INSERT INTO `respondents` (`id`, `resident_id`, `blotter_id`) VALUES
(1, 19, 1),
(2, 13, 1),
(3, 18, 2),
(4, 19, 2),
(5, 17, 2),
(6, 10, 2),
(7, 13, 2),
(8, 16, 2),
(9, 18, 3),
(10, 15, 4),
(11, 3, 5),
(12, 13, 6),
(13, 12, 6),
(14, 13, 7);

--
-- Dumping data for table `transactions`
--


SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
