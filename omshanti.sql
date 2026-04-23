-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 07:39 AM
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
-- Database: `omshanti`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_code` varchar(255) DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pickup_at` datetime DEFAULT NULL,
  `dropoff_at` datetime DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `car` varchar(255) NOT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `passengers` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pickup` varchar(255) DEFAULT NULL,
  `drop` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `return_date` date DEFAULT NULL,
  `total_days` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_gateway` varchar(40) DEFAULT NULL,
  `gateway_order_id` varchar(120) DEFAULT NULL,
  `gateway_payment_id` varchar(120) DEFAULT NULL,
  `gateway_signature` varchar(256) DEFAULT NULL,
  `refund_id` varchar(120) DEFAULT NULL,
  `refund_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `refund_status` varchar(40) DEFAULT NULL,
  `refunded_at` datetime DEFAULT NULL,
  `payment_utr` varchar(64) DEFAULT NULL,
  `payment_status` varchar(32) NOT NULL DEFAULT 'Unpaid',
  `online_payment_terms_accepted_at` datetime DEFAULT NULL,
  `receipt_number` varchar(40) DEFAULT NULL,
  `receipt_generated_at` datetime DEFAULT NULL,
  `payment_verified_at` datetime DEFAULT NULL,
  `payment_verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_code`, `car_id`, `car_unit_id`, `driver_id`, `pickup_at`, `dropoff_at`, `pickup_location`, `dropoff_location`, `status`, `car`, `price_per_day`, `passengers`, `name`, `phone`, `email`, `pickup`, `drop`, `date`, `pickup_time`, `return_date`, `total_days`, `total_amount`, `amount_paid`, `payment_method`, `payment_gateway`, `gateway_order_id`, `gateway_payment_id`, `gateway_signature`, `refund_id`, `refund_amount`, `refund_status`, `refunded_at`, `payment_utr`, `payment_status`, `online_payment_terms_accepted_at`, `receipt_number`, `receipt_generated_at`, `payment_verified_at`, `payment_verified_by`, `payment_proof`, `message`, `created_at`, `updated_at`) VALUES
(1, 'BK-20260423-RL0NE6', 1, 1, NULL, '2026-05-07 11:11:00', '2026-05-09 11:11:00', 'ahmedabad', 'su', 'Pending', 'Swift Dzire', 3000.00, 4, 'gh', '7676756566', 'vv@gmail.com', 'ahmedabad', 'su', '2026-05-07', '11:11:00', '2026-05-09', 3, 9000.00, 0.00, 'Cash', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'Cash', NULL, 'RCP-20260423-UEO0QUXV', '2026-04-23 03:22:18', NULL, NULL, NULL, NULL, '2026-04-22 21:51:50', '2026-04-22 21:52:18'),
(2, 'BK-20260423-JSMACF', 9, 20, 3, '2026-04-24 11:00:00', '2026-04-24 23:00:00', 'ahmedabad', 'goa', 'Confirmed', 'bike', 100.00, 4, 'Ayushi patel', '9327709323', 'ayushijpatel52@gmail.com', 'ahmedabad', 'goa', '2026-04-24', '11:00:00', '2026-04-24', 1, 100.00, 50.00, 'UPI', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '122022458233', 'Paid', '2026-04-23 03:41:47', 'RCP-20260423-HM3KKUZZ', '2026-04-23 03:42:03', '2026-04-23 03:41:47', NULL, NULL, 'ok', '2026-04-22 22:11:47', '2026-04-22 22:13:24'),
(3, 'BK-20260423-TCXGWT', 9, 20, NULL, '2026-04-29 09:00:00', '2026-04-30 09:00:00', 'ahmedabad', 'surat', 'Pending', 'bike', 100.00, 3, 'nddnwk', '9789675645', 'kddd@gmail.com', 'ahmedabad', 'surat', '2026-04-29', '09:00:00', '2026-04-30', 2, 200.00, 100.00, 'UPI', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '732627678902', 'Paid', '2026-04-23 03:45:59', 'RCP-20260423-7VLBBKFH', '2026-04-23 03:46:12', '2026-04-23 03:45:59', NULL, NULL, 'mkdkw', '2026-04-22 22:16:00', '2026-04-22 22:16:12'),
(4, 'BK-20260423-AVOYBN', 9, 20, NULL, '2026-05-08 09:00:00', '2026-05-10 09:00:00', 'goa', 'surat', 'Pending', 'bike', 100.00, 2, 'djhd', '8978787788', 'hs@gmail.com', 'goa', 'surat', '2026-05-08', '09:00:00', '2026-05-10', 3, 300.00, 150.00, 'UPI', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '897856765432', 'Rejected', '2026-04-23 03:57:10', 'RCP-20260423-PU99BKJL', '2026-04-23 03:57:25', NULL, NULL, NULL, 'ok', '2026-04-22 22:27:11', '2026-04-22 22:28:46'),
(5, 'BK-20260423-YO2BVS', 9, 20, NULL, '2026-05-21 11:00:00', '2026-05-22 11:00:00', 'ahmedabad', 'ahmedabad', 'Pending', 'bike', 100.00, 2, 'kavya', '7878252527', 'davekavya43@gmail.com', 'ahmedabad', 'ahmedabad', '2026-05-21', '11:00:00', '2026-05-22', 2, 200.00, 100.00, 'Online', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'Pending Payment', '2026-04-23 04:06:17', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 22:36:17', '2026-04-22 22:36:17'),
(6, 'BK-20260423-TGKKSH', 9, 20, NULL, '2026-07-01 08:08:00', '2026-07-03 08:08:00', 'ahmedabad', 'ahmedabad', 'Pending', 'bike', 100.00, 2, 'kavya', '7878252527', 'davekavya43@gmail.com', 'ahmedabad', 'ahmedabad', '2026-07-01', '08:08:00', '2026-07-03', 3, 300.00, 150.00, 'UPI', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '785643237809', 'Paid', '2026-04-23 04:08:07', NULL, NULL, '2026-04-23 04:09:56', 1, NULL, NULL, '2026-04-22 22:38:08', '2026-04-22 22:39:56'),
(7, 'BK-20260423-KS7MN1', 9, 20, 6, '2026-05-06 09:09:00', '2026-05-07 09:09:00', 'ahmedabad', 'ahmedabad', 'Confirmed', 'bike', 100.00, 3, 'trupti', '6355042132', 'ridhiparmar07@gmail.com', 'ahmedabad', 'ahmedabad', '2026-05-06', '09:09:00', '2026-05-07', 2, 200.00, 100.00, 'UPI', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '786756453456', 'Rejected', '2026-04-23 04:41:03', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 23:11:04', '2026-04-22 23:12:41'),
(8, 'BK-20260423-NIE2GO', 8, 6, NULL, '2026-04-24 09:09:00', '2026-04-25 09:09:00', 'ahmedabad', 'ahmedabad', 'Pending', 'Toyota Camry', 4500.00, 3, 'kavya dave', '7878252527', 'davekavya43@gmail.com', 'ahmedabad', 'ahmedabad', '2026-04-24', '09:09:00', '2026-04-25', 2, 9000.00, 0.00, 'Cash', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'Cash', NULL, 'RCP-20260423-XD5YID0S', '2026-04-23 04:46:46', NULL, NULL, NULL, 'ok', '2026-04-22 23:16:37', '2026-04-22 23:16:46'),
(9, 'BK-20260423-AIXCQF', 8, 6, NULL, '2026-07-23 06:00:00', '2026-07-25 06:00:00', 'ahmedabad', 'ahmedabad', 'Pending', 'Toyota Camry', 4500.00, 4, 'DHRUVI', '9723233090', 'sjpatel15180@gmail.com', 'ahmedabad', 'ahmedabad', '2026-07-23', '06:00:00', '2026-07-25', 3, 13500.00, 6750.00, 'Online', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'Pending Payment', '2026-04-23 05:04:26', NULL, NULL, NULL, NULL, NULL, 'jqdwgugu', '2026-04-22 23:34:27', '2026-04-22 23:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `seats` int(10) UNSIGNED DEFAULT NULL,
  `fuel_type` varchar(255) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `price_per_day`, `seats`, `fuel_type`, `transmission`, `featured`, `description`, `image`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Swift Dzire', 'Maruti Suzuki', 3000.00, 4, 'Petrol', 'Manual', 1, 'Compact sedan with excellent mileage and comfort. Perfect for city commuting and short trips, this car offers smooth handling, low maintenance, and fuel efficiency. It comfortably seats 4 passengers and comes with modern features like air conditioning, touchscreen infotainment, and a spacious boot for luggage. Its stylish design and reliable performance make it an ideal choice for daily drives, family outings, or business travel.', 'cars_uploads/Pmn0dma2jX6iX95D2lyjUCr6zGaA47EzkL59dWG8.jpg', NULL, '2026-04-22 21:21:17', '2026-04-22 21:21:17'),
(2, 'Honda City', 'Honda', 2000.00, 4, 'Petrol', 'Automatic', 0, 'A stylish and premium sedan designed for comfort and smooth driving.', 'honda.jpg', NULL, NULL, NULL),
(3, 'Honda Amaze', 'Honda', 1400.00, 4, 'Petrol', 'Manual', 0, 'Compact and efficient sedan, perfect for city travel and everyday commuting.', 'amaze.jpg', NULL, NULL, NULL),
(4, 'Kia Carens', 'Kia', 2500.00, 6, 'Diesel', 'Manual', 0, 'A versatile MPV designed for family trips and group travel.', 'kia.jpg', NULL, NULL, NULL),
(5, 'Innova Crysta', 'Toyota', 3000.00, 6, 'Diesel', 'Manual', 0, 'A premium MPV combining luxury, comfort, and reliability.', 'innova.jpg', NULL, NULL, NULL),
(6, 'Innova Hycross', 'Toyota', 3500.00, 6, 'Petrol', 'Automatic', 0, 'A premium hybrid MPV with modern technology and comfort.', 'hycross.avif', NULL, NULL, NULL),
(7, 'Toyota Fortuner', 'Toyota', 5000.00, 6, 'Diesel', 'Automatic', 0, 'A powerful SUV built for city and off-road adventures.', 'fortuner.jpg', NULL, NULL, NULL),
(8, 'Toyota Camry', 'Toyota', 4500.00, 4, 'Hybrid', 'Automatic', 0, 'A luxury hybrid sedan with elegance and efficiency.', 'camry.jpg', NULL, NULL, NULL),
(9, 'bike', 'toyota', 100.00, 4, 'Petrol', 'Manual', 1, 'vfgd dnhjed fnekfnhkejiefjdkmnfdkf', 'cars_uploads/mTE4yhghqzMxD9GeuAtwR8EqA1d5nI8UQRjxWOKU.jpg', NULL, '2026-04-22 22:06:13', '2026-04-22 22:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `carsses`
--

CREATE TABLE `carsses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_units`
--

CREATE TABLE `car_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `number_plate` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_units`
--

INSERT INTO `car_units` (`id`, `car_id`, `number_plate`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'active', '2026-04-22 21:22:08', '2026-04-22 21:22:08'),
(2, 1, NULL, 'active', '2026-04-22 21:22:08', '2026-04-22 21:22:08'),
(3, 1, NULL, 'active', '2026-04-22 21:22:08', '2026-04-22 21:22:08'),
(4, 1, NULL, 'active', '2026-04-22 21:22:08', '2026-04-22 21:22:08'),
(5, 8, 'GJ01 DC 2345', 'active', '2026-04-22 21:56:17', '2026-04-22 21:56:17'),
(6, 8, 'GJ01 AB 1234', 'active', '2026-04-22 21:56:28', '2026-04-22 21:56:28'),
(7, 7, 'GJ01 jC 2300', 'active', '2026-04-22 21:56:56', '2026-04-22 21:56:56'),
(8, 7, 'GJ01 jC 2000', 'active', '2026-04-22 21:57:11', '2026-04-22 21:57:11'),
(9, 7, 'GJ05 jC 2300', 'active', '2026-04-22 21:57:34', '2026-04-22 21:57:34'),
(10, 7, 'GJ05 jC 9000', 'active', '2026-04-22 21:57:49', '2026-04-22 21:57:49'),
(11, 3, 'GJ01 jC 8756', 'active', '2026-04-22 21:58:35', '2026-04-22 21:58:35'),
(12, 3, 'GJ01 kj 2089', 'active', '2026-04-22 21:58:55', '2026-04-22 21:58:55'),
(13, 3, 'GJ09 jC 2898', 'active', '2026-04-22 21:59:15', '2026-04-22 21:59:15'),
(14, 4, 'GJ01 jC 2309', 'active', '2026-04-22 21:59:47', '2026-04-22 21:59:47'),
(15, 4, 'GJ09 jC 2990', 'active', '2026-04-22 22:00:07', '2026-04-22 22:00:07'),
(16, 2, 'GJ01 jC 2006', 'active', '2026-04-22 22:00:45', '2026-04-22 22:00:45'),
(17, 2, 'GJ01 jC 2378', 'active', '2026-04-22 22:01:03', '2026-04-22 22:01:03'),
(18, 6, 'GJ16 jC 2006', 'active', '2026-04-22 22:01:32', '2026-04-22 22:01:32'),
(19, 5, 'GJ01 iC 2388', 'active', '2026-04-22 22:02:21', '2026-04-22 22:02:21'),
(20, 9, 'GJ01 iC 2389', 'active', '2026-04-22 22:08:14', '2026-04-22 22:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_items`
--

CREATE TABLE `content_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `mobile`, `license_number`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ramesh Kumar', '9876543210', 'DL01AB1234', 1, NULL, NULL),
(2, 'Suresh Yadav', '9865432109', 'DL02CD2345', 1, NULL, NULL),
(3, 'Amit Sharma', '9854321098', 'DL03EF3456', 1, NULL, NULL),
(4, 'Vikram Singh', '9843210987', 'DL04GH4567', 1, NULL, NULL),
(5, 'Rahul Verma', '9832109876', 'DL05IJ5678', 1, NULL, NULL),
(6, 'Deepak Patel', '9821098765', 'DL06KL6789', 1, NULL, NULL),
(7, 'Manoj Joshi', '9810987654', 'DL07MN7890', 1, NULL, NULL),
(8, 'Pawan Mehta', '9809876543', 'DL08OP8901', 1, NULL, NULL),
(9, 'Anil Chauhan', '9798765432', 'DL09QR9012', 1, NULL, NULL),
(10, 'Sunil Gupta', '9787654321', 'DL10ST0123', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_13_071942_create_contacts_table', 1),
(5, '2026_03_14_051939_create_cars_table', 1),
(6, '2026_03_14_064234_create_reviews_table', 1),
(7, '2026_03_16_134340_create_bookings_table', 1),
(8, '2026_03_16_153845_add_images_to_cars_table', 1),
(9, '2026_03_19_151338_create_car_table', 1),
(10, '2026_03_21_172231_create_carsses_table', 1),
(11, '2026_03_22_181839_create_otps_table', 1),
(12, '2026_04_22_000001_add_details_to_cars_table', 1),
(13, '2026_04_22_000002_create_car_units_table', 1),
(14, '2026_04_22_000003_create_drivers_table', 1),
(15, '2026_04_22_000004_add_rental_fields_to_bookings_table', 1),
(16, '2026_04_22_000005_create_content_items_table', 1),
(17, '2026_04_22_000006_add_payment_fields_to_bookings_table', 1),
(18, '2026_04_22_000007_add_receipt_fields_to_bookings_table', 1),
(19, '2026_04_23_000001_add_gateway_and_refund_fields_to_bookings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FPIBfv28uzUQumB9gn3LDkUMhwVQi1oeRE1FVb1D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmVjY2ltdnlKakNrWHZYRU1ZdndybFZmbjV0a3lzeEFndmJZY0U2aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nP2Nhcj1iaWtlJmNhcl9pZD05JnByaWNlPTEwMC4wMCZzZWF0cz00IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6ImFkbWluIjtpOjE7fQ==', 1776920739),
('Kc6DBJHbDvbQC39jhdPNPrRClSERBmlZUs1Tp85p', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUhiTmgyc0F0eURua1FTQ25FUDZidWs4SkJNTnI2OEoyeWZhSWZFMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nL3N0YXR1cz9jb2RlPUJLLTIwMjYwNDIzLVJMME5FNiZwaG9uZT03Njc2NzU2NTY2IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776914561);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$Z6x78e2SprNJfvHAwq2OvOlnm8GGq33KnbUIqip.hxw.6GaVB8ZF.', NULL, '2026-04-22 21:17:03', '2026-04-22 21:17:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_receipt_number_unique` (`receipt_number`),
  ADD KEY `bookings_car_unit_id_foreign` (`car_unit_id`),
  ADD KEY `bookings_car_id_pickup_at_dropoff_at_index` (`car_id`,`pickup_at`,`dropoff_at`),
  ADD KEY `bookings_driver_id_pickup_at_dropoff_at_index` (`driver_id`,`pickup_at`,`dropoff_at`),
  ADD KEY `bookings_status_index` (`status`),
  ADD KEY `bookings_payment_verified_by_foreign` (`payment_verified_by`),
  ADD KEY `bookings_payment_status_index` (`payment_status`),
  ADD KEY `bookings_payment_utr_index` (`payment_utr`),
  ADD KEY `bookings_payment_gateway_index` (`payment_gateway`),
  ADD KEY `bookings_gateway_order_id_index` (`gateway_order_id`),
  ADD KEY `bookings_gateway_payment_id_index` (`gateway_payment_id`),
  ADD KEY `bookings_refund_id_index` (`refund_id`),
  ADD KEY `bookings_refund_status_index` (`refund_status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carsses`
--
ALTER TABLE `carsses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_units`
--
ALTER TABLE `car_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_units_car_id_number_plate_unique` (`car_id`,`number_plate`),
  ADD KEY `car_units_car_id_status_index` (`car_id`,`status`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_items`
--
ALTER TABLE `content_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_items_type_is_published_sort_order_index` (`type`,`is_published`,`sort_order`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drivers_is_active_index` (`is_active`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carsses`
--
ALTER TABLE `carsses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_units`
--
ALTER TABLE `car_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_items`
--
ALTER TABLE `content_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_car_unit_id_foreign` FOREIGN KEY (`car_unit_id`) REFERENCES `car_units` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_payment_verified_by_foreign` FOREIGN KEY (`payment_verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `car_units`
--
ALTER TABLE `car_units`
  ADD CONSTRAINT `car_units_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
