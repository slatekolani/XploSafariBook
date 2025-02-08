-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2025 at 03:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safariExplore`
--

-- --------------------------------------------------------

--
-- Table structure for table `appreciation_activities`
--

CREATE TABLE `appreciation_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appreciation_activity_detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanzania_region_culture_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appreciation_activities`
--

INSERT INTO `appreciation_activities` (`id`, `appreciation_activity_detail`, `tanzania_region_culture_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Visit the Maasai Bomas', 1, '91428390-b1b9-42a6-8b9e-1a438f14fd93', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `attraction_visit_advices`
--

CREATE TABLE `attraction_visit_advices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attraction_visit_advices`
--

INSERT INTO `attraction_visit_advices` (`id`, `advice_number`, `advice_title`, `advice_description`, `touristic_attraction_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'Book in advance', 'Arusha National Park can get busy', 1, '45482c8b-2d52-4f76-bd35-454d77092db8', NULL, '2025-02-05 08:48:47', '2025-02-05 08:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `attraction_visit_reasons`
--

CREATE TABLE `attraction_visit_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attraction_visit_reasons`
--

INSERT INTO `attraction_visit_reasons` (`id`, `reason_number`, `reason_title`, `reason_description`, `touristic_attraction_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'Diverse Scenery', 'The scenery is astonishing', 1, '36f5fec4-3351-408b-a530-e0dbf0fb9c6d', NULL, '2025-02-05 08:48:48', '2025-02-05 08:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'updated', 'App\\Models\\Auth\\User', 1, '{\"confirmed\":0}', '{\"confirmed\":\"1\"}', 'http://127.0.0.1:8000/account/sms_confirm/49aa011c-e2d8-48f3-a7ac-83bec54b8b06?token=101010', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:34:21', '2025-02-05 07:34:21'),
(2, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\Nations\\nations', 1, '[]', '{\"nation_name\":\"Tanzania\",\"nation_description\":\"African Safari Gem\",\"nation_history\":\"Tanzania, in East Africa, is known for its stunning landscapes, rich wildlife, and diverse cultures. Home to Mount Kilimanjaro, Serengeti National Park, and Zanzibar\\u2019s beaches, it boasts a vibrant history, including Swahili heritage. With over 120 ethnic groups, it thrives on tourism, agriculture, and natural resources like gold and gas.\",\"population\":\"62000000\",\"google_map\":\"<iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d8121257.375617882!2d29.676842984401436!3d-6.334705595766067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x184b51314869a111%3A0x885a17314bc1c430!2sTanzania!5e0!3m2!1sen!2stz!4v1738740986039!5m2!1sen!2stz\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"><\\/iframe>\",\"nation_flag\":\"1738741074.png\",\"tourist_map\":\"1738741074.jpg\",\"uuid\":\"f43d1256-2caf-451b-a6fe-f1c4567a07f8\",\"id\":1}', 'http://127.0.0.1:8000/nation/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:54'),
(3, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\Nations\\economicActivity\\nationEconomicActivity', 1, '[]', '{\"economic_activity_title\":\"Tourism\",\"economic_activity_description\":\"Home to Tourism\",\"nation_id\":1,\"uuid\":\"7baac3e4-87d5-4927-9573-dc914018f849\",\"id\":1}', 'http://127.0.0.1:8000/nation/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:54'),
(4, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\Nations\\Precaution\\nationPrecautions', 1, '[]', '{\"precaution_title\":\"Robbery\",\"precaution_description\":\"Robbers are everywhere\",\"nation_id\":1,\"uuid\":\"0b429f85-7635-48f2-9be3-001007288baa\",\"id\":1}', 'http://127.0.0.1:8000/nation/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:54'),
(5, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\Nations\\nations', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/nation/activateNation?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:37:56', '2025-02-05 07:37:56'),
(6, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\tanzaniaRegions', 1, '[]', '{\"region_name\":\"Arusha\",\"economic_activity\":\"1\",\"region_size\":\"It poses 595,000 people.\",\"population\":\"It poses 595,000 people.\",\"climatic_condition\":\"Humid\",\"transport_nature\":\"Helicopter\",\"region_description\":\"Touristic City\",\"region_map\":\"<iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d127449.72605776529!2d36.59463846521615!3d-3.3979688588866783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371c88f2387383%3A0xbc1907f7ec497152!2sArusha!5e0!3m2!1sen!2stz!4v1738741191714!5m2!1sen!2stz\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"><\\/iframe>\",\"region_history\":\"Established in ...\",\"nation_id\":\"1\",\"region_icon_image\":\"\\/regionDominantImage\\/1738741224_67a315e8a9567.png,\\/regionDominantImage\\/1738741224_67a315e8a9719.jpeg,\\/regionDominantImage\\/1738741224_67a315e8a9825.jpeg\",\"uuid\":\"187ac514-0edb-47fd-a5df-c504cf4a93ed\",\"id\":1}', 'http://127.0.0.1:8000/tanzaniaRegion/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:40:24', '2025-02-05 07:40:24'),
(7, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\Precautions\\tanzaniaRegionPrecautions', 1, '[]', '{\"precaution_title\":\"Robbery\",\"precaution_description\":\"Be careful with robbers\",\"tanzania_region_id\":1,\"uuid\":\"e0f655f1-1708-4bf2-9f5e-9642cca7bf03\",\"id\":1}', 'http://127.0.0.1:8000/tanzaniaRegion/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:40:24', '2025-02-05 07:40:24'),
(8, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\tanzaniaRegions\\tanzaniaRegions', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tanzaniaRegion/activateTanzaniaRegion?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:40:26', '2025-02-05 07:40:26'),
(9, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\regionCulture\\tanzaniaRegionCulture', 1, '[]', '{\"culture_name\":\"Maasai\",\"basic_information\":\"Maasai\",\"traditional_language\":\"Maa\",\"traditional_dance\":\"Maa\",\"traditional_dance_description\":\"Jump Jump alot\",\"traditional_food\":\"Losholo\",\"traditional_food_description\":\"Mixture of milk and maize\",\"culture_history\":\"Established in ...\",\"cultural_video\":\"https:\\/\\/youtu.be\\/kELqAOwnsLE\",\"conclusion\":\"Maasai is a great culture.\",\"tanzania_region_id\":\"1\",\"culture_image\":\"\\/cultureImage\\/1738741566_67a3173e6d717.jpeg,\\/cultureImage\\/1738741566_67a3173e6d829.jpeg,\\/cultureImage\\/1738741566_67a3173e6d903.jpeg\",\"uuid\":\"afbe3838-6788-46b4-8b8f-d8b16a9cb79c\",\"id\":1}', 'http://127.0.0.1:8000/regionCulture/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06'),
(10, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\regionCulture\\cultureCharacteristics\\tanzaniaRegionCultureCharacteristic', 1, '[]', '{\"characteristic_title\":\"Maasai Shukas\",\"characteristic_description\":\"Wear red shukas\",\"tanzania_region_culture_id\":1,\"uuid\":\"0f4de2a4-5f72-4655-9c7b-bd09ed741069\",\"id\":1}', 'http://127.0.0.1:8000/regionCulture/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06'),
(11, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\regionCulture\\appreciationActivities\\CultureAppreciationActivityModel', 1, '[]', '{\"appreciation_activity_detail\":\"Visit the Maasai Bomas\",\"tanzania_region_culture_id\":1,\"uuid\":\"91428390-b1b9-42a6-8b9e-1a438f14fd93\",\"id\":1}', 'http://127.0.0.1:8000/regionCulture/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06'),
(12, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaRegions\\regionCulture\\cultureChallenges\\CultureChallengesModel', 1, '[]', '{\"culture_challenges_detailed\":\"Globalization\",\"tanzania_region_culture_id\":1,\"uuid\":\"440c4e3f-0812-413b-9f29-1bd99d5be524\",\"id\":1}', 'http://127.0.0.1:8000/regionCulture/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06'),
(13, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\tanzaniaRegions\\regionCulture\\tanzaniaRegionCulture', 1, '{\"cultural_video\":\"https:\\/\\/youtu.be\\/kELqAOwnsLE\"}', '{\"cultural_video\":null}', 'http://127.0.0.1:8000/regionCulture/update/afbe3838-6788-46b4-8b8f-d8b16a9cb79c', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 07:46:57', '2025-02-05 07:46:57'),
(14, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\touristicActivities\\touristicActivities', 1, '[]', '{\"activity_name\":\"Hiking\",\"activity_description\":\"This activity involves\",\"best_activity_period\":\"Starting from September to October\",\"basic_information\":\"Involves you to get into ..\",\"activity_image\":\"1738744260.jpeg\",\"uuid\":\"9822d356-748a-4705-a375-ca522f97a995\",\"id\":1}', 'http://127.0.0.1:8000/touristicActivity/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:31:00', '2025-02-05 08:31:00'),
(15, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\touristicActivities\\touristicActivityConductTips\\touristicActivityConductTips', 1, '[]', '{\"tip_name\":\"Wear protective gear boots\",\"tip_description\":\"Due to the rough nature of most areas in hike areas in Tanzania\",\"touristic_activities_id\":1,\"uuid\":\"d5492a61-4fd7-466f-945c-58ad314f5823\",\"id\":1}', 'http://127.0.0.1:8000/touristicActivity/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:31:00', '2025-02-05 08:31:00'),
(16, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\TouristicAttractions\\category\\touristicAttractionCategory', 1, '[]', '{\"attraction_category\":\"National Park\",\"attraction_category_description\":\"Home to Wildlife\",\"attraction_category_basic_information\":\"Most animals like ..\",\"attraction_category_iconic_image\":\"1738744391.jpeg\",\"uuid\":\"a08e4250-c700-40d1-bc7a-b4a0274289c4\",\"id\":1}', 'http://127.0.0.1:8000/touristicAttractionCategory/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:33:11', '2025-02-05 08:33:11'),
(17, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\TouristicAttractions\\touristicAttractions', 1, '[]', '{\"attraction_name\":\"Arusha national Park\",\"attraction_description\":\"Park of the North\",\"attraction_region\":\"1\",\"attraction_category\":\"1\",\"establishment_year\":\"0\",\"seasonal_variation\":\"Seasonal variation\",\"flora_fauna\":\"Flora & Fauna\",\"attraction_visit_month\":\"September to October\",\"basic_information\":\"Just basic information\",\"governing_body\":\"TANAPA\",\"website_link\":\"https:\\/\\/www.tanzaniaparks.go.tz\",\"entry_fee_adult_foreigner\":\"4000\",\"entry_fee_child_foreigner\":\"5000\",\"entry_fee_child_local\":\"3000\",\"entry_fee_adult_local\":\"2000\",\"personal_experience\":\"It was so fine the first time we travelled with my team.\",\"attraction_map\":null,\"attraction_image\":\"\\/touristAttraction\\/1738745327_67a325eff064f.jpeg,\\/touristAttraction\\/1738745327_67a325eff0786.jpeg\",\"uuid\":\"e86efdbd-3e20-4c64-bd22-d81d503b8249\",\"id\":1}', 'http://127.0.0.1:8000/touristicAttraction/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:48:47', '2025-02-05 08:48:47'),
(18, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\TouristicAttractions\\touristicAttractionVisitAdvices', 1, '[]', '{\"advice_number\":\"1\",\"advice_title\":\"Book in advance\",\"advice_description\":\"Arusha National Park can get busy\",\"touristic_attraction_id\":1,\"uuid\":\"45482c8b-2d52-4f76-bd35-454d77092db8\",\"id\":1}', 'http://127.0.0.1:8000/touristicAttraction/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:48:47', '2025-02-05 08:48:47'),
(19, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\TouristicAttractions\\attractionVisitReasons', 1, '[]', '{\"reason_number\":\"1\",\"reason_title\":\"Diverse Scenery\",\"reason_description\":\"The scenery is astonishing\",\"touristic_attraction_id\":1,\"uuid\":\"36f5fec4-3351-408b-a530-e0dbf0fb9c6d\",\"id\":1}', 'http://127.0.0.1:8000/touristicAttraction/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:48:48', '2025-02-05 08:48:48'),
(20, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\TouristicAttractions\\touristicAttractions', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/touristicAttraction/activateAttraction?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:48:51', '2025-02-05 08:48:51'),
(21, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\specialNeed\\specialNeed', 1, '[]', '{\"special_need_name\":\"Handicapped\",\"special_need_icon\":\"fas fa-wheelchair\",\"uuid\":\"760d2952-ec99-4a7a-81f5-25b1d30ff3d1\",\"id\":1}', 'http://127.0.0.1:8000/specialNeed/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:53:34', '2025-02-05 08:53:34'),
(22, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\specialNeed\\specialNeed', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/specialNeed/activateSpecialNeed?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:53:36', '2025-02-05 08:53:36'),
(23, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\specialNeed\\specialNeed', 2, '[]', '{\"special_need_name\":\"Blind\",\"special_need_icon\":\"fas fa-blind\",\"uuid\":\"321d6163-0f48-48d3-ba06-b8d908cff3f0\",\"id\":2}', 'http://127.0.0.1:8000/specialNeed/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:53:49', '2025-02-05 08:53:49'),
(24, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\specialNeed\\specialNeed', 2, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/specialNeed/activateSpecialNeed?id=2&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:53:50', '2025-02-05 08:53:50'),
(25, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\Transport\\transport', 1, '[]', '{\"transport_icon\":\"fas fa-car\",\"transport_name\":\"Cruiser\",\"uuid\":\"1463c26c-40bf-409e-a9dd-61062041bbc5\",\"id\":1}', 'http://127.0.0.1:8000/transport/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:54:11', '2025-02-05 08:54:11'),
(26, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\Transport\\transport', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/transport/activateTransport?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:54:13', '2025-02-05 08:54:13'),
(27, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\Transport\\transport', 2, '[]', '{\"transport_icon\":\"fas fa-plane\",\"transport_name\":\"helicopter\",\"uuid\":\"c1b68e98-2f77-470d-8902-cf3b10b2a70a\",\"id\":2}', 'http://127.0.0.1:8000/transport/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:54:25', '2025-02-05 08:54:25'),
(28, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\Transport\\transport', 2, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/transport/activateTransport?id=2&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:54:27', '2025-02-05 08:54:27'),
(29, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\TourTypes\\tourTypes', 1, '[]', '{\"rating\":\"10\",\"tour_type_name\":\"10 star: Supreme Excellence\",\"tour_type_description\":\"Most of services are available for free\",\"uuid\":\"44f6d127-9ba7-4184-b8c0-d4833e89b73c\",\"id\":1}', 'http://127.0.0.1:8000/tourType/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:55:12', '2025-02-05 08:55:12'),
(30, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\TourTypes\\tourTypes', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tourType/activateTourType?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:55:14', '2025-02-05 08:55:14'),
(31, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tanzaniaAndWorldEvents\\tanzaniaAndWorldEvents', 1, '[]', '{\"event_name\":\"Christmas\",\"event_description\":\"This event is due to the birth of Jesus Christ\",\"event_date\":\"2025-12-25\",\"event_image\":\"1738745773.jpeg\",\"uuid\":\"7dcc69a5-1c54-4e34-8997-8799b45b4d19\",\"id\":1}', 'http://127.0.0.1:8000/event/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:56:13', '2025-02-05 08:56:13'),
(32, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\tanzaniaAndWorldEvents\\tanzaniaAndWorldEvents', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/event/activateEvent?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:56:17', '2025-02-05 08:56:17'),
(33, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tourPackageType\\tourPackageType', 1, '[]', '{\"tour_package_type_name\":\"Couple tour\",\"tour_package_type_description\":\"This is a special package for couples\",\"tour_package_type_image\":\"1738745943.jpeg\",\"uuid\":\"3ad40204-2d9f-4d6c-90ea-02c198a2a29c\",\"id\":1}', 'http://127.0.0.1:8000/tourPackageType/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:59:03', '2025-02-05 08:59:03'),
(34, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\tourPackageType\\tourPackageType', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tourPackageType/activateTourPackageType?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:59:05', '2025-02-05 08:59:05'),
(35, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\tourInsuranceTypes\\tourInsuranceTypes', 1, '[]', '{\"tour_insurance_name\":\"Trip Cancellation\",\"tour_insurance_description\":\"Trip Cancellation is when you want to cancel off the trip\",\"uuid\":\"de5bd432-b610-499c-a1a2-a84d69ab24ce\",\"id\":1}', 'http://127.0.0.1:8000/tourInsuranceType/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:59:41', '2025-02-05 08:59:41'),
(36, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\tourInsuranceTypes\\tourInsuranceTypes', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tourInsuranceType/activateTourInsurance?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 08:59:44', '2025-02-05 08:59:44'),
(37, 'App\\Models\\Auth\\User', 1, 'created', 'App\\Models\\customerSatisfactionCategory\\customerSatisfactionCategory', 1, '[]', '{\"customer_satisfaction_name\":\"Trip Guarantee\",\"customer_satisfaction_description\":\"Guarantee is high\",\"uuid\":\"36747404-0ee0-4e40-b7c5-684ca688bca3\",\"id\":1}', 'http://127.0.0.1:8000/customerSatisfactionCategory/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 09:00:45', '2025-02-05 09:00:45'),
(38, NULL, NULL, 'updated', 'App\\Models\\Auth\\User', 2, '{\"confirmed\":0}', '{\"confirmed\":\"1\"}', 'http://127.0.0.1:8000/account/sms_confirm/49406dcd-2d3c-4b66-b40f-efa9edf282ea?token=202020', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-05 09:37:39', '2025-02-05 09:37:39'),
(39, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\Auth\\User', 2, '{\"password\":\"$2y$10$GuwcuXl4rv2CoW5hjQ8pHuias\\/SMfrgbxY8Ji8J8bkqFL8RPTaeMW\"}', '{\"password\":\"$2y$10$A7kC10vF.XYw.JqQOSDF\\/OrG2DHceXoMU1yePB0wJOIOLuvhVIWcq\"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 05:56:04', '2025-02-06 05:56:04'),
(40, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\tourOperator', 1, '[]', '{\"company_name\":\"Leopard Tours\",\"email_address\":\"leopard@gmail.com\",\"phone_number\":\"0768885599\",\"established_date\":\"2020-01-20\",\"total_employees\":\"20\",\"website_url\":\"https:\\/\\/www.eetechnologiestz.com\",\"instagram_url\":\"https:\\/\\/www.eetechnologiestz.com\",\"whatsapp_url\":\"https:\\/\\/www.eetechnologiestz.com\",\"gps_url\":\"https:\\/\\/www.eetechnologiestz.com\",\"company_nation\":\"1\",\"about_company\":\"Quality Service for all\",\"support_time_range\":\"24 hours after request made\",\"region\":\"1\",\"safariClass\":\"localTours\",\"agreeCustomBooking\":\"Yes\",\"postal_code\":\"6221\",\"tin_number\":\"778668885\",\"physical_location\":\"NSSF Kaloleni Plaza, Ground Floor\",\"users_id\":2,\"company_logo\":\"1738825312.png\",\"company_team_image\":\"1738825312.jpeg\",\"verification_certificate\":\"1738825312.pdf\",\"terms_and_conditions\":\"1738825312.pdf\",\"tato_membership_certificate\":\"1738825312.pdf\",\"uuid\":\"b746f2f0-49c2-4414-b751-3dd508bbd265\",\"id\":1}', 'http://127.0.0.1:8000/tourOperator/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:01:52', '2025-02-06 07:01:52'),
(41, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\Auth\\User', 1, '{\"password\":\"$2y$10$2y8nsQLZWxh3H0tUe4MvzOoii2BDgFMx9Hs6ppOueOBRifPgdHl82\"}', '{\"password\":\"$2y$10$NqXDC.rrWkfGMkr\\/U91vn.ASy3xz4TSbzfWmVqNe9j3IvdgYNv11.\"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:02:18', '2025-02-06 07:02:18'),
(42, 'App\\Models\\Auth\\User', 1, 'updated', 'App\\Models\\TourOperator\\tourOperator', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tourOperatorCompaniesManagement/ActivateOrDeactivateCompany?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:02:22', '2025-02-06 07:02:22'),
(43, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\Auth\\User', 2, '{\"password\":\"$2y$10$A7kC10vF.XYw.JqQOSDF\\/OrG2DHceXoMU1yePB0wJOIOLuvhVIWcq\"}', '{\"password\":\"$2y$10$ChSccP63wdKOg.QoI0ryh.dAngLp4FNAg.rU1utj95302\\/RhTqkGu\"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:02:39', '2025-02-06 07:02:39'),
(44, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 1, '[]', '{\"safari_name\":\"1\",\"safari_description\":\"A day trip to Arusha National Park\",\"trip_kind\":\"dayAdventure\",\"travel_age_range\":\"From 5 to 30\",\"number_of_views_expecting\":\"300\",\"payment_start_percent\":\"10\",\"cancellation_percent\":\"30\",\"cancellation_due_date\":\"2025-02-25\",\"cancellation_policy\":\"This is to be issued on the final condition that no one will be issued without registration\",\"trip_price_adult_tanzanian\":\"5000\",\"trip_price_child_tanzanian\":\"4000\",\"trip_price_adult_foreigner\":\"3000\",\"trip_price_child_foreigner\":\"2000\",\"safari_start_date\":\"2025-03-01\",\"safari_end_date\":\"2025-03-01\",\"payment_deadline\":\"2025-02-15\",\"package_range\":\"1\",\"maximum_travellers\":\"30\",\"phone_number\":\"0768584833\",\"email_address\":\"mambo@leopardtours.co.tz\",\"discount_offered\":\"5\",\"number_of_people_for_discount\":\"20\",\"payment_start_percent_deadline\":\"2025-02-10\",\"targeted_event\":\"1\",\"tour_package_type_name\":\"1\",\"emergency_handling\":\"We do have a sat phone in case of emergency\",\"free_of_charge_age\":\"5\",\"package_reference_number\":\"REF - 67A460E8EF453\",\"local_tour_type\":\"1\",\"tour_operator_id\":\"1\",\"safari_poster\":\"1738825961.jpeg\",\"transport_used_images\":\"\\/transportImages\\/1738825961_67a460e900330.jpg,\\/transportImages\\/1738825961_67a460e900438.jpg\",\"uuid\":\"47645798-2f9c-4643-acf0-30de48fa6997\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(45, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageActivities\\localTourPackageActivities', 1, '[]', '{\"activity_name\":\"Indoor Games\",\"activity_description\":\"Playing Expedition of Tanzania\",\"local_tour_package_id\":1,\"tour_operator_id\":1,\"uuid\":\"911a4248-6b82-49ce-b941-6360202cafdf\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(46, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackagePriceInclusive\\localTourPackagePriceInclusives', 1, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":1,\"tour_operator_id\":1,\"uuid\":\"9791aa3f-ba2f-456f-9cce-2fc788f9f0e4\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(47, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourpackagePriceExclusive\\localTourPackagePriceExclusive', 1, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":1,\"tour_operator_id\":1,\"uuid\":\"5f90dca8-ca57-4be0-968f-ff4032ca5bdc\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(48, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageCollectionStops\\localTourPackageCollectionStops', 1, '[]', '{\"collection_stop_name\":\"Shoppers\",\"collection_stop_price\":\"1000\",\"pick_up_time\":\"12:30\",\"local_tour_package_id\":1,\"tour_operator_id\":1,\"uuid\":\"c5b64a56-4c55-4dab-8d15-6e9eecc163ca\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(49, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackageRequirement\\localTourPackageRequirements', 1, '[]', '{\"requirement_name\":\"Heavy Coats\",\"requirement_description\":\"It is Cold so much\",\"local_tour_package_id\":1,\"tour_operator_id\":1,\"uuid\":\"d3bfd76e-b182-4866-9afe-e480c521c5a2\",\"id\":1}', 'http://127.0.0.1:8000/localTourPackages/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(50, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/localTourPackages/ActivateOrDeactivateLocalTourPackage?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:47', '2025-02-06 07:12:47'),
(51, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 2, '[]', '{\"safari_name\":\"1\",\"trip_kind\":\"dayAdventure\",\"safari_description\":\"A day trip to Arusha National Park\",\"safari_poster\":\"1738825961.jpeg\",\"maximum_travellers\":\"30.00\",\"trip_price_adult_tanzanian\":\"5000.00\",\"trip_price_child_tanzanian\":\"4000.00\",\"trip_price_adult_foreigner\":\"3000.00\",\"trip_price_child_foreigner\":\"2000.00\",\"safari_start_date\":\"2025-03-01\",\"safari_end_date\":\"2025-03-01\",\"travel_age_range\":\"From 5 to 30\",\"number_of_views_expecting\":\"300\",\"payment_start_percent\":\"10\",\"cancellation_due_date\":\"2025-02-25\",\"cancellation_policy\":\"This is to be issued on the final condition that no one will be issued without registration\",\"payment_deadline\":\"2025-02-15\",\"package_range\":\"1\",\"phone_number\":\"0768584833\",\"email_address\":\"mambo@leopardtours.co.tz\",\"discount_offered\":\"5\",\"emergency_handling\":\"We do have a sat phone in case of emergency\",\"targeted_event\":\"1\",\"tour_package_type_name\":\"1\",\"local_tour_type\":\"1\",\"transport_used_images\":\"\\/transportImages\\/1738825961_67a460e900330.jpg,\\/transportImages\\/1738825961_67a460e900438.jpg\",\"tour_operator_id\":1,\"status\":\"1\",\"uuid\":\"b76746c3-ac98-43bb-9876-e95f94aed4c3\",\"package_reference_number\":\"REF - 67A460F4A4871\",\"free_of_charge_age\":\"5\",\"cancellation_percent\":\"30\",\"number_of_people_for_discount\":\"20\",\"payment_start_percent_deadline\":\"2025-02-10\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(52, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageActivities\\localTourPackageActivities', 2, '[]', '{\"activity_name\":\"Indoor Games\",\"activity_description\":\"Playing Expedition of Tanzania\",\"local_tour_package_id\":2,\"tour_operator_id\":1,\"uuid\":\"14ce600c-4472-4bc3-b843-c12c19c841f2\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(53, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageCollectionStops\\localTourPackageCollectionStops', 2, '[]', '{\"collection_stop_name\":\"Shoppers\",\"collection_stop_price\":\"1000\",\"pick_up_time\":\"12:30:00\",\"local_tour_package_id\":2,\"tour_operator_id\":1,\"uuid\":\"8a4217e5-a23e-423c-a300-89242935ab7e\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(54, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackagePriceInclusive\\localTourPackagePriceInclusives', 2, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":2,\"tour_operator_id\":1,\"uuid\":\"737b270f-7493-4481-aa1f-51c7b04a537e\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(55, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourpackagePriceExclusive\\localTourPackagePriceExclusive', 2, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":2,\"tour_operator_id\":1,\"uuid\":\"9c690d73-d0f6-42fb-9159-d1bc229cb671\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(56, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackageRequirement\\localTourPackageRequirements', 2, '[]', '{\"requirement_name\":\"Heavy Coats\",\"requirement_description\":\"It is Cold so much\",\"local_tour_package_id\":2,\"tour_operator_id\":1,\"status\":\"0\",\"uuid\":\"f066ee1a-54e5-4b7e-a39f-977dc7c6e809\",\"id\":2}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/47645798-2f9c-4643-acf0-30de48fa6997', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(57, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 2, '{\"trip_kind\":\"dayAdventure\",\"safari_description\":\"A day trip to Arusha National Park\",\"safari_poster\":\"1738825961.jpeg\"}', '{\"trip_kind\":\"weekendGateway\",\"safari_description\":\"A Weekend trip to Arusha National Park\",\"safari_poster\":\"1738826025.jpeg\"}', 'http://127.0.0.1:8000/localTourPackages/update/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:13:45', '2025-02-06 07:13:45'),
(58, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 3, '[]', '{\"safari_name\":\"1\",\"trip_kind\":\"weekendGateway\",\"safari_description\":\"A Weekend trip to Arusha National Park\",\"safari_poster\":\"1738826025.jpeg\",\"maximum_travellers\":\"30.00\",\"trip_price_adult_tanzanian\":\"5000.00\",\"trip_price_child_tanzanian\":\"4000.00\",\"trip_price_adult_foreigner\":\"3000.00\",\"trip_price_child_foreigner\":\"2000.00\",\"safari_start_date\":\"2025-03-01\",\"safari_end_date\":\"2025-03-01\",\"travel_age_range\":\"From 5 to 30\",\"number_of_views_expecting\":\"300\",\"payment_start_percent\":\"10\",\"cancellation_due_date\":\"2025-02-25\",\"cancellation_policy\":\"This is to be issued on the final condition that no one will be issued without registration\",\"payment_deadline\":\"2025-02-15\",\"package_range\":\"1\",\"phone_number\":\"0768584833\",\"email_address\":\"mambo@leopardtours.co.tz\",\"discount_offered\":\"5\",\"emergency_handling\":\"We do have a sat phone in case of emergency\",\"targeted_event\":\"1\",\"tour_package_type_name\":\"1\",\"local_tour_type\":\"1\",\"transport_used_images\":\"\\/transportImages\\/1738825961_67a460e900330.jpg,\\/transportImages\\/1738825961_67a460e900438.jpg\",\"tour_operator_id\":1,\"status\":\"1\",\"uuid\":\"37c5c656-db85-43e6-8fac-60c04ca1ce63\",\"package_reference_number\":\"REF - 67A4613CC4B54\",\"free_of_charge_age\":\"5\",\"cancellation_percent\":\"30\",\"number_of_people_for_discount\":\"20\",\"payment_start_percent_deadline\":\"2025-02-10\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(59, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageActivities\\localTourPackageActivities', 3, '[]', '{\"activity_name\":\"Indoor Games\",\"activity_description\":\"Playing Expedition of Tanzania\",\"local_tour_package_id\":3,\"tour_operator_id\":1,\"uuid\":\"c59b1ad8-a2b1-4a73-baf3-ee251a11f56f\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(60, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackageCollectionStops\\localTourPackageCollectionStops', 3, '[]', '{\"collection_stop_name\":\"Shoppers\",\"collection_stop_price\":\"1000\",\"pick_up_time\":\"12:30:00\",\"local_tour_package_id\":3,\"tour_operator_id\":1,\"uuid\":\"8658bb77-52e0-42ff-9d69-6d04879e2465\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(61, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourPackagePriceInclusive\\localTourPackagePriceInclusives', 3, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":3,\"tour_operator_id\":1,\"uuid\":\"93ad0bf5-fd1a-44b5-913c-aee56d724b9e\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(62, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\LocalTourpackagePriceExclusive\\localTourPackagePriceExclusive', 3, '[]', '{\"item\":\"Photoshooting\",\"local_tour_package_id\":3,\"tour_operator_id\":1,\"uuid\":\"858d1cf2-cb27-408a-ae48-fe6deb941817\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(63, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackageRequirement\\localTourPackageRequirements', 3, '[]', '{\"requirement_name\":\"Heavy Coats\",\"requirement_description\":\"It is Cold so much\",\"local_tour_package_id\":3,\"tour_operator_id\":1,\"status\":\"0\",\"uuid\":\"5e50933f-6d15-44f5-afa8-adb64f9aa22c\",\"id\":3}', 'http://127.0.0.1:8000/localTourPackages/replicateTourPackage/b76746c3-ac98-43bb-9876-e95f94aed4c3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04'),
(64, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\TourOperator\\TourPackages\\LocalTourPackages\\localTourPackages', 3, '{\"trip_kind\":\"weekendGateway\",\"safari_description\":\"A Weekend trip to Arusha National Park\",\"safari_poster\":\"1738826025.jpeg\",\"package_range\":\"1\"}', '{\"trip_kind\":\"weekLongAdventure\",\"safari_description\":\"A Week long trip to Arusha National Park\",\"safari_poster\":\"1738826088.jpg\",\"package_range\":\"2\"}', 'http://127.0.0.1:8000/localTourPackages/update/37c5c656-db85-43e6-8fac-60c04ca1ce63', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:14:48', '2025-02-06 07:14:48'),
(65, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\reservations\\tourOperatorReservation', 1, '[]', '{\"reservation_name\":\"Lake Duluti\",\"reservation_capacity\":\"More than 40 people can sleep\",\"reservation_url\":\"https:\\/\\/www.tanzaniatourism.com\\/destination\\/lake-duluti\",\"region_found\":\"1\",\"resident_child_price_reservation\":\"50000\",\"resident_adult_price_reservation\":\"60000\",\"foreigner_adult_price_reservation\":\"100000\",\"foreigner_child_price_reservation\":\"90000\",\"tour_operator_id\":\"1\",\"reservation_images\":\"\\/reservationImages\\/1738826278_67a46226c7966.jpeg,\\/reservationImages\\/1738826278_67a46226c7aa8.jpeg\",\"uuid\":\"b8d5ef6b-55ac-4acd-b243-283895412952\",\"id\":1}', 'http://127.0.0.1:8000/tourOperatorReservation/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:17:58', '2025-02-06 07:17:58'),
(66, 'App\\Models\\Auth\\User', 2, 'created', 'App\\Models\\TourOperator\\reservations\\reservationFacilities\\tourOperatorReservationFacility', 1, '[]', '{\"facility_name\":\"Wi-Fi\",\"facility_description\":\"Free Wi-Fi all over the perimeter\",\"tour_operator_reservation_id\":1,\"tour_operator_id\":1,\"uuid\":\"2bf0a306-2226-4ec1-8027-7c84bc7d6832\",\"id\":1}', 'http://127.0.0.1:8000/tourOperatorReservation/store', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:17:58', '2025-02-06 07:17:58'),
(67, 'App\\Models\\Auth\\User', 2, 'updated', 'App\\Models\\TourOperator\\reservations\\tourOperatorReservation', 1, '{\"status\":\"0\"}', '{\"status\":1}', 'http://127.0.0.1:8000/tourOperatorReservation/activateTourCompanyReservation?id=1&status=0', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0 (Edition std-1)', NULL, '2025-02-06 07:18:03', '2025-02-06 07:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `category_activities`
--

CREATE TABLE `category_activities` (
  `touristic_attraction_category_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_activities_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_activities`
--

INSERT INTO `category_activities` (`touristic_attraction_category_id`, `touristic_activities_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_touristic_activities`
--

CREATE TABLE `company_touristic_activities` (
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_activities_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_touristic_activities`
--

INSERT INTO `company_touristic_activities` (`tour_operator_id`, `touristic_activities_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:01:52', '2025-02-06 07:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `culture_challenges`
--

CREATE TABLE `culture_challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `culture_challenges_detailed` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanzania_region_culture_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `culture_challenges`
--

INSERT INTO `culture_challenges` (`id`, `culture_challenges_detailed`, `tanzania_region_culture_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Globalization', 1, '440c4e3f-0812-413b-9f29-1bd99d5be524', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `culture_characteristics`
--

CREATE TABLE `culture_characteristics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `characteristic_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `characteristic_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanzania_region_culture_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `culture_characteristics`
--

INSERT INTO `culture_characteristics` (`id`, `characteristic_title`, `characteristic_description`, `tanzania_region_culture_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Maasai Shukas', 'Wear red shukas', 1, '0f4de2a4-5f72-4655-9c7b-bd09ed741069', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_satisfaction_category`
--

CREATE TABLE `customer_satisfaction_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_satisfaction_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_satisfaction_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_satisfaction_category`
--

INSERT INTO `customer_satisfaction_category` (`id`, `customer_satisfaction_name`, `customer_satisfaction_description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Trip Guarantee', 'Guarantee is high', '36747404-0ee0-4e40-b7c5-684ca688bca3', NULL, '2025-02-05 09:00:45', '2025-02-05 09:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `custom_booking_attraction`
--

CREATE TABLE `custom_booking_attraction` (
  `custom_tour_booking_id` bigint(20) UNSIGNED NOT NULL,
  `tourist_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_tour_booking`
--

CREATE TABLE `custom_tour_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tourist_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_need_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_adult_foreigners` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_children_foreigners` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_children_residents` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_adult_residents` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_needed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `due_payment_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_tour_booking_reservations`
--

CREATE TABLE `custom_tour_booking_reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `touristic_attraction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_reservation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_tour_booking_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_tour_booking_tour_prices`
--

CREATE TABLE `custom_tour_booking_tour_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attraction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resident_adult_price` decimal(15,2) DEFAULT NULL,
  `resident_child_price` decimal(15,2) DEFAULT NULL,
  `foreigner_child_price` decimal(15,2) DEFAULT NULL,
  `foreigner_adult_price` decimal(15,2) DEFAULT NULL,
  `custom_tour_booking_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_package_price_exclusives`
--

CREATE TABLE `local_package_price_exclusives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_package_price_exclusives`
--

INSERT INTO `local_package_price_exclusives` (`id`, `item`, `local_tour_package_id`, `tour_operator_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Photoshooting', 1, 1, '5f90dca8-ca57-4be0-968f-ff4032ca5bdc', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 'Photoshooting', 2, 1, '9c690d73-d0f6-42fb-9159-d1bc229cb671', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(3, 'Photoshooting', 3, 1, '858d1cf2-cb27-408a-ae48-fe6deb941817', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `local_package_reservation`
--

CREATE TABLE `local_package_reservation` (
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_reservation_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_package_reservation`
--

INSERT INTO `local_package_reservation` (`local_tour_package_id`, `tour_operator_reservation_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:18:24', '2025-02-06 07:18:24'),
(2, 1, NULL, '2025-02-06 07:18:42', '2025-02-06 07:18:42'),
(3, 1, NULL, '2025-02-06 07:18:57', '2025-02-06 07:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `local_package_special_need`
--

CREATE TABLE `local_package_special_need` (
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `special_need_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_package_special_need`
--

INSERT INTO `local_package_special_need` (`local_tour_package_id`, `special_need_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(1, 2, NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 1, NULL, '2025-02-06 07:13:45', '2025-02-06 07:13:45'),
(3, 1, NULL, '2025-02-06 07:14:48', '2025-02-06 07:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `local_package_transport`
--

CREATE TABLE `local_package_transport` (
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `transport_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_package_transport`
--

INSERT INTO `local_package_transport` (`local_tour_package_id`, `transport_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(1, 2, NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 2, NULL, '2025-02-06 07:13:45', '2025-02-06 07:13:45'),
(3, 1, NULL, '2025-02-06 07:14:48', '2025-02-06 07:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `local_tourist_review`
--

CREATE TABLE `local_tourist_review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_company` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_attraction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `local_tour_booking_id` bigint(20) UNSIGNED NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_review_company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_review_attraction` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_cancelledbookings`
--

CREATE TABLE `local_tour_cancelledbookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cancellation_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_reason` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_reason_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_cancellation_policy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_booking_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_goals_package_segmentations`
--

CREATE TABLE `local_tour_goals_package_segmentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_tours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_travellers` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `goal_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_goals_projected_revenues`
--

CREATE TABLE `local_tour_goals_projected_revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revenue_breakdown` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `local_tours_goals_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package`
--

CREATE TABLE `local_tour_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `safari_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_kind` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_poster` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_travellers` decimal(8,2) NOT NULL,
  `trip_price_adult_tanzanian` decimal(15,2) NOT NULL,
  `trip_price_child_tanzanian` decimal(15,2) NOT NULL,
  `trip_price_adult_foreigner` decimal(15,2) NOT NULL,
  `trip_price_child_foreigner` decimal(15,2) NOT NULL,
  `safari_start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_age_range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_views_expecting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_start_percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_due_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_policy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_deadline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_offered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_handling` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `targeted_event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_used_images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_of_charge_age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancellation_percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_people_for_discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_start_percent_deadline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package`
--

INSERT INTO `local_tour_package` (`id`, `safari_name`, `trip_kind`, `safari_description`, `safari_poster`, `maximum_travellers`, `trip_price_adult_tanzanian`, `trip_price_child_tanzanian`, `trip_price_adult_foreigner`, `trip_price_child_foreigner`, `safari_start_date`, `safari_end_date`, `travel_age_range`, `number_of_views_expecting`, `payment_start_percent`, `cancellation_due_date`, `cancellation_policy`, `payment_deadline`, `package_range`, `phone_number`, `email_address`, `discount_offered`, `emergency_handling`, `targeted_event`, `tour_package_type_name`, `local_tour_type`, `transport_used_images`, `tour_operator_id`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`, `package_reference_number`, `free_of_charge_age`, `cancellation_percent`, `number_of_people_for_discount`, `payment_start_percent_deadline`) VALUES
(1, '1', 'dayAdventure', 'A day trip to Arusha National Park', '1738825961.jpeg', '30.00', '5000.00', '4000.00', '3000.00', '2000.00', '2025-03-01', '2025-03-01', 'From 5 to 30', '300', '10', '2025-02-25', 'This is to be issued on the final condition that no one will be issued without registration', '2025-02-15', '1', '0768584833', 'mambo@leopardtours.co.tz', '5', 'We do have a sat phone in case of emergency', '1', '1', '1', '/transportImages/1738825961_67a460e900330.jpg,/transportImages/1738825961_67a460e900438.jpg', 1, '1', '47645798-2f9c-4643-acf0-30de48fa6997', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:47', 'REF - 67A460E8EF453', '5', '30', '20', '2025-02-10'),
(2, '1', 'weekendGateway', 'A Weekend trip to Arusha National Park', '1738826025.jpeg', '30.00', '5000.00', '4000.00', '3000.00', '2000.00', '2025-03-01', '2025-03-01', 'From 5 to 30', '300', '10', '2025-02-25', 'This is to be issued on the final condition that no one will be issued without registration', '2025-02-15', '1', '0768584833', 'mambo@leopardtours.co.tz', '5', 'We do have a sat phone in case of emergency', '1', '1', '1', '/transportImages/1738825961_67a460e900330.jpg,/transportImages/1738825961_67a460e900438.jpg', 1, '1', 'b76746c3-ac98-43bb-9876-e95f94aed4c3', NULL, '2025-02-06 07:12:52', '2025-02-06 07:13:45', 'REF - 67A460F4A4871', '5', '30', '20', '2025-02-10'),
(3, '1', 'weekLongAdventure', 'A Week long trip to Arusha National Park', '1738826088.jpg', '30.00', '5000.00', '4000.00', '3000.00', '2000.00', '2025-03-01', '2025-03-01', 'From 5 to 30', '300', '10', '2025-02-25', 'This is to be issued on the final condition that no one will be issued without registration', '2025-02-15', '2', '0768584833', 'mambo@leopardtours.co.tz', '5', 'We do have a sat phone in case of emergency', '1', '1', '1', '/transportImages/1738825961_67a460e900330.jpg,/transportImages/1738825961_67a460e900438.jpg', 1, '1', '37c5c656-db85-43e6-8fac-60c04ca1ce63', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:48', 'REF - 67A4613CC4B54', '5', '30', '20', '2025-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_activities`
--

CREATE TABLE `local_tour_package_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package_activities`
--

INSERT INTO `local_tour_package_activities` (`id`, `activity_name`, `activity_description`, `local_tour_package_id`, `tour_operator_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Indoor Games', 'Playing Expedition of Tanzania', 1, 1, '911a4248-6b82-49ce-b941-6360202cafdf', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 'Indoor Games', 'Playing Expedition of Tanzania', 2, 1, '14ce600c-4472-4bc3-b843-c12c19c841f2', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(3, 'Indoor Games', 'Playing Expedition of Tanzania', 3, 1, 'c59b1ad8-a2b1-4a73-baf3-ee251a11f56f', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_booking`
--

CREATE TABLE `local_tour_package_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tourist_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_number_foreigner_child` decimal(3,2) NOT NULL,
  `total_number_local_child` decimal(3,2) NOT NULL,
  `total_number_foreigner_adult` decimal(3,2) NOT NULL,
  `total_number_local_adult` decimal(3,2) NOT NULL,
  `collection_station` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_attention` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_free_of_charge_children` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_terms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_agreement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_collection_stop`
--

CREATE TABLE `local_tour_package_collection_stop` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_stop_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection_stop_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pick_up_time` time NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package_collection_stop`
--

INSERT INTO `local_tour_package_collection_stop` (`id`, `collection_stop_name`, `collection_stop_price`, `pick_up_time`, `local_tour_package_id`, `tour_operator_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Shoppers', '1000', '12:30:00', 1, 1, 'c5b64a56-4c55-4dab-8d15-6e9eecc163ca', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 'Shoppers', '1000', '12:30:00', 2, 1, '8a4217e5-a23e-423c-a300-89242935ab7e', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(3, 'Shoppers', '1000', '12:30:00', 3, 1, '8658bb77-52e0-42ff-9d69-6d04879e2465', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_price_inclusive`
--

CREATE TABLE `local_tour_package_price_inclusive` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package_price_inclusive`
--

INSERT INTO `local_tour_package_price_inclusive` (`id`, `item`, `local_tour_package_id`, `tour_operator_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Photoshooting', 1, 1, '9791aa3f-ba2f-456f-9cce-2fc788f9f0e4', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 'Photoshooting', 2, 1, '737b270f-7493-4481-aa1f-51c7b04a537e', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(3, 'Photoshooting', 3, 1, '93ad0bf5-fd1a-44b5-913c-aee56d724b9e', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_requirement`
--

CREATE TABLE `local_tour_package_requirement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requirement_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package_requirement`
--

INSERT INTO `local_tour_package_requirement` (`id`, `requirement_name`, `requirement_description`, `local_tour_package_id`, `tour_operator_id`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Heavy Coats', 'It is Cold so much', 1, 1, '0', 'd3bfd76e-b182-4866-9afe-e480c521c5a2', NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 'Heavy Coats', 'It is Cold so much', 2, 1, '0', 'f066ee1a-54e5-4b7e-a39f-977dc7c6e809', NULL, '2025-02-06 07:12:52', '2025-02-06 07:12:52'),
(3, 'Heavy Coats', 'It is Cold so much', 3, 1, '0', '5e50933f-6d15-44f5-afa8-adb64f9aa22c', NULL, '2025-02-06 07:14:04', '2025-02-06 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `local_tour_package_total_views`
--

CREATE TABLE `local_tour_package_total_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_tour_package_total_views`
--

INSERT INTO `local_tour_package_total_views` (`id`, `ip_address`, `local_tour_package_id`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 2, '2025-02-06 07:38:15', '2025-02-06 07:38:15'),
(2, '127.0.0.1', 1, '2025-02-06 07:38:26', '2025-02-06 07:38:26'),
(3, '127.0.0.1', 3, '2025-02-06 07:38:44', '2025-02-06 07:38:44'),
(4, '127.0.0.1', 3, '2025-02-06 10:15:51', '2025-02-06 10:15:51'),
(5, '127.0.0.1', 2, '2025-02-06 10:20:40', '2025-02-06 10:20:40'),
(6, '127.0.0.1', 1, '2025-02-06 10:20:54', '2025-02-06 10:20:54'),
(7, '127.0.0.1', 1, '2025-02-06 10:21:03', '2025-02-06 10:21:03'),
(8, '127.0.0.1', 1, '2025-02-06 10:21:17', '2025-02-06 10:21:17'),
(9, '127.0.0.1', 1, '2025-02-06 10:21:17', '2025-02-06 10:21:17'),
(10, '127.0.0.1', 1, '2025-02-06 10:21:53', '2025-02-06 10:21:53'),
(11, '127.0.0.1', 1, '2025-02-06 10:23:43', '2025-02-06 10:23:43'),
(12, '127.0.0.1', 1, '2025-02-06 10:24:18', '2025-02-06 10:24:18'),
(13, '127.0.0.1', 1, '2025-02-06 10:26:23', '2025-02-06 10:26:23'),
(14, '127.0.0.1', 1, '2025-02-06 15:02:05', '2025-02-06 15:02:05'),
(15, '127.0.0.1', 1, '2025-02-06 15:02:12', '2025-02-06 15:02:12'),
(16, '127.0.0.1', 1, '2025-02-06 15:02:13', '2025-02-06 15:02:13'),
(17, '127.0.0.1', 1, '2025-02-06 15:02:13', '2025-02-06 15:02:13'),
(18, '127.0.0.1', 3, '2025-02-06 15:02:43', '2025-02-06 15:02:43'),
(19, '127.0.0.1', 1, '2025-02-06 15:04:10', '2025-02-06 15:04:10'),
(20, '127.0.0.1', 1, '2025-02-06 15:04:23', '2025-02-06 15:04:23'),
(21, '127.0.0.1', 3, '2025-02-06 15:06:12', '2025-02-06 15:06:12'),
(22, '127.0.0.1', 3, '2025-02-06 15:06:21', '2025-02-06 15:06:21'),
(23, '127.0.0.1', 1, '2025-02-06 15:06:58', '2025-02-06 15:06:58'),
(24, '127.0.0.1', 1, '2025-02-06 15:07:10', '2025-02-06 15:07:10'),
(25, '127.0.0.1', 3, '2025-02-06 15:31:00', '2025-02-06 15:31:00'),
(26, '127.0.0.1', 3, '2025-02-06 15:35:49', '2025-02-06 15:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `love_likes`
--

CREATE TABLE `love_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `likeable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type_id` enum('LIKE','DISLIKE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LIKE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `love_like_counters`
--

CREATE TABLE `love_like_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `likeable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` enum('LIKE','DISLIKE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LIKE',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_09_02_153301_create_love_likes_table', 1),
(2, '2016_09_02_163301_create_love_like_counters_table', 1),
(3, '2018_10_04_075744_create_audits_table', 1),
(4, '2018_10_04_075744_create_failed_jobs_table', 1),
(5, '2018_10_04_075744_create_jobs_table', 1),
(6, '2019_10_29_194712_create_users_table', 1),
(7, '2021_01_27_193611_create_roles_table', 1),
(8, '2023_01_16_194754_create_role_user_table', 1),
(9, '2023_01_18_083636_create_tour_operators_table', 1),
(10, '2023_02_02_113826_create_touristic_attractions_table', 1),
(11, '2023_02_02_141940_create_nations_table', 1),
(12, '2023_02_05_193328_create_special_needs_table', 1),
(13, '2023_02_06_084255_create_transports_table', 1),
(14, '2023_02_06_104318_create_tour_types_table', 1),
(15, '2023_06_22_223953_create_tour_packages_table', 1),
(16, '2023_06_29_201424_create_tour_package_features_table', 1),
(17, '2023_07_01_122924_create_tour_package_activities_table', 1),
(18, '2023_07_01_144600_create_tour_package_accommodations_table', 1),
(19, '2023_07_02_074200_create_tour_package_special_need_table', 1),
(20, '2023_07_02_075549_create_tour_package_transport_table', 1),
(21, '2023_07_02_080124_create_tour_package_tour_type_table', 1),
(22, '2023_07_03_103512_create_tour_package_trips_table', 1),
(23, '2023_07_05_160550_create_tour_package_bookings_table', 1),
(24, '2023_07_08_113021_create_tour_operator_touristic_attractions_table', 1),
(25, '2023_07_15_114020_create_custom_tour_bookings_table', 1),
(26, '2023_07_15_155845_create_custom_tour_booking_tourist_attractions_table', 1),
(27, '2023_07_19_112257_create_tourist_reviews_table', 1),
(28, '2023_10_15_170906_create_touristic_attraction_visit_advices_table', 1),
(29, '2023_10_16_163235_create_attraction_visit_reasons_table', 1),
(30, '2023_10_21_145213_create_tourist_attraction_faqs_table', 1),
(31, '2023_10_24_145553_create_platform_faqs_table', 1),
(32, '2023_11_03_101616_create_local_tour_packages_table', 1),
(33, '2023_11_03_113048_create_local_tour_package_special_needs_table', 1),
(34, '2023_11_03_115736_create_local_tour_package_transports_table', 1),
(35, '2023_11_03_122448_create_local_tour_package_activities_table', 1),
(36, '2023_11_03_125625_create_local_tour_package_price_inclusives_table', 1),
(37, '2023_11_03_135555_create_local_tour_package_price_exclusives_table', 1),
(38, '2023_12_17_181651_create_tanzania_and_world_events_table', 1),
(39, '2023_12_18_090943_create_local_tour_package_collection_stops_table', 1),
(40, '2023_12_19_093412_create_tour_package_types_table', 1),
(41, '2023_12_21_162731_create_local_tour_package_bookings_table', 1),
(42, '2023_12_22_112228_create_local_tour_package_requirements_table', 1),
(43, '2023_12_23_085402_create_local_tourist_reviews_table', 1),
(44, '2023_12_23_144343_create_tanzania_regions_table', 1),
(45, '2023_12_23_155339_create_tour_insurance_types_table', 1),
(46, '2023_12_24_095656_create_tour_operator_tanzania_regions', 1),
(47, '2023_12_24_101207_create_tour_operator_tour_insurance_types', 1),
(48, '2023_12_30_201637_create_tanzania_region_precautions_table', 1),
(49, '2024_01_02_144919_create_tanzania_region_cultures_table', 1),
(50, '2024_01_04_161908_create_nation_economic_activities_table', 1),
(51, '2024_01_04_165946_create_nation_precautions_table', 1),
(52, '2024_01_04_174753_create_tanzania_region_nations_economic_activities_table', 1),
(53, '2024_01_04_205209_create_tanzania_region_culture_characteristics_table', 1),
(54, '2024_01_08_194515_create_touristic_attraction_honey_points_table', 1),
(55, '2024_01_09_125041_create_customer_satisfaction_categories_table', 1),
(56, '2024_01_09_143009_create_tanzania_region_f_a_q_s_table', 1),
(57, '2024_01_09_192658_create_tanzania_f_a_q_s_table', 1),
(58, '2024_01_09_195501_create_tanzania_visit_advice_table', 1),
(59, '2024_01_09_213314_create_local_tour_package_customer_satisfaction_table', 1),
(60, '2024_01_09_215825_create_touristic_attraction_rules_table', 1),
(61, '2024_01_10_103028_create_tour_operator_reservations_table', 1),
(62, '2024_01_10_171429_create_tour_operator_reservation_touristic_attraction_table', 1),
(63, '2024_01_10_172314_create_tour_operator_reservation_facilities_table', 1),
(64, '2024_01_10_194424_create_local_tour_package_tour_operator_reservation_table', 1),
(65, '2024_01_11_112007_create_touristic_games_table', 1),
(66, '2024_01_11_115415_create_touristic_game_components_table', 1),
(67, '2024_01_11_130726_create_tour_operator_reservation_touristic_game_table', 1),
(68, '2024_01_27_173020_create_touristic_attraction_categories_table', 1),
(69, '2024_02_14_155726_create_custom_tour_booking_reservations_table', 1),
(70, '2024_02_15_101831_add_reference_number_to_custom_tour_booking_table', 1),
(71, '2024_02_15_153634_add_tour_prices_to_custom_tour_booking_table', 1),
(72, '2024_02_16_125731_add_tour_prices_to_tour_operator_reservation', 1),
(73, '2024_02_16_125902_remove_price_range_per_day_column_from_tour_operator_reservation', 1),
(74, '2024_02_16_141941_add_discount_to_custom_tour_booking', 1),
(75, '2024_02_20_191254_remove_tour_prices_from_custom_tour_booking_table', 1),
(76, '2024_02_21_122343_create_custom_tour_booking_tour_prices_table', 1),
(77, '2024_02_26_091430_add_reference_number_to_local_tour_package_table', 1),
(78, '2024_02_26_092154_add_reference_number_to_local_tour_package_booking_table', 1),
(79, '2024_02_26_105253_add_discount_to_local_tour_package_booking_table', 1),
(80, '2024_02_28_200831_add_free_of_charge_age_to_local_tour_package_table', 1),
(81, '2024_02_28_202041_add_free_of_charge_age_children_to_local_tour_package_booking_table', 1),
(82, '2024_02_29_103305_add_address_to_tour_operator_table', 1),
(83, '2024_02_29_184150_add_due_payment_time_to_custom_tour_booking_table', 1),
(84, '2024_03_10_174049_create_local_tour_package_total_views_table', 1),
(85, '2024_06_29_130026_add_email_verified_at_to_users_table', 1),
(86, '2024_06_30_135259_create_password_resets_table', 1),
(87, '2024_07_01_111255_add_status_to_users_table', 1),
(88, '2024_11_04_114730_create_tour_company_local_tours_goals_table', 1),
(89, '2024_11_05_094617_create_local_tour_goals_projected_revenues_table', 1),
(90, '2024_11_05_151804_create_local_tour_goals_package_segmentations_table', 1),
(91, '2024_11_11_161236_add_accept_terms_to_local_tour_package_booking', 1),
(92, '2024_11_12_141807_add_company_information_to_tour_operator_table', 1),
(93, '2024_11_12_160806_add_reservation_id_to_local_tour_package_booking', 1),
(94, '2024_11_12_183410_add_payment_agreement_to_local_tour_package_booking', 1),
(95, '2024_11_12_183620_add_cancellation_percent_to_local_tour_package', 1),
(96, '2024_11_14_084132_add_discount_condition_to_local_tour_package', 1),
(97, '2024_11_18_113516_add_review_fields_to_local_tourist_review', 1),
(98, '2024_11_18_155916_add_payment_mode_to_local_tour_package_booking', 1),
(99, '2024_11_19_191319_add_quality_rating_to_tour_types', 1),
(100, '2024_11_20_075845_add_event_image_to_tanzania_and_world_event', 1),
(101, '2024_11_20_082649_add_package_type_image_to_tour_package_types', 1),
(102, '2024_12_16_175229_add_user_uuid_to_local_tour_package_booking', 1),
(103, '2025_01_07_122118_create_local_tour_package_cancelledbookings_table', 1),
(104, '2025_01_20_124137_create_culture_appreciation_activities_table', 1),
(105, '2025_01_20_145006_create_culture_challenges_table', 1),
(106, '2025_01_26_205118_create_touristic_activities_table', 1),
(107, '2025_01_29_213455_create_touristic_activity_conduct_tips_table', 1),
(108, '2025_01_30_222022_create_company_touristic_activities_table', 1),
(109, '2025_02_02_114347_add_details_to_touristic_attraction_category', 1),
(110, '2025_02_02_124527_create_touristic_attraction_category_activities', 1),
(111, '2025_02_05_095611_create_touristic_attraction_activities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nation`
--

CREATE TABLE `nation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_history` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_map` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_map` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nation`
--

INSERT INTO `nation` (`id`, `nation_name`, `nation_flag`, `nation_description`, `nation_history`, `population`, `tourist_map`, `google_map`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tanzania', '1738741074.png', 'African Safari Gem', 'Tanzania, in East Africa, is known for its stunning landscapes, rich wildlife, and diverse cultures. Home to Mount Kilimanjaro, Serengeti National Park, and Zanzibar’s beaches, it boasts a vibrant history, including Swahili heritage. With over 120 ethnic groups, it thrives on tourism, agriculture, and natural resources like gold and gas.', '62000000', '1738741074.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8121257.375617882!2d29.676842984401436!3d-6.334705595766067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x184b51314869a111%3A0x885a17314bc1c430!2sTanzania!5e0!3m2!1sen!2stz!4v1738740986039!5m2!1sen!2stz\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '1', 'f43d1256-2caf-451b-a6fe-f1c4567a07f8', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `nation_economic_activities`
--

CREATE TABLE `nation_economic_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `economic_activity_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `economic_activity_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nation_economic_activities`
--

INSERT INTO `nation_economic_activities` (`id`, `economic_activity_title`, `economic_activity_description`, `nation_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tourism', 'Home to Tourism', 1, '7baac3e4-87d5-4927-9573-dc914018f849', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `nation_precautions`
--

CREATE TABLE `nation_precautions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `precaution_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precaution_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nation_precautions`
--

INSERT INTO `nation_precautions` (`id`, `precaution_title`, `precaution_description`, `nation_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Robbery', 'Robbers are everywhere', 1, '0b429f85-7635-48f2-9be3-001007288baa', NULL, '2025-02-05 07:37:54', '2025-02-05 07:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `operator_insurance_type`
--

CREATE TABLE `operator_insurance_type` (
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `tour_insurance_type_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operator_insurance_type`
--

INSERT INTO `operator_insurance_type` (`tour_operator_id`, `tour_insurance_type_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:01:52', '2025-02-06 07:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `operator_tanzania_region`
--

CREATE TABLE `operator_tanzania_region` (
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `tanzania_region_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operator_tanzania_region`
--

INSERT INTO `operator_tanzania_region` (`tour_operator_id`, `tanzania_region_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:01:52', '2025-02-06 07:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `operator_touristic_attraction`
--

CREATE TABLE `operator_touristic_attraction` (
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operator_touristic_attraction`
--

INSERT INTO `operator_touristic_attraction` (`tour_operator_id`, `touristic_attraction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:01:52', '2025-02-06 07:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `package_customer_satisfaction`
--

CREATE TABLE `package_customer_satisfaction` (
  `local_tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `customer_satisfaction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_customer_satisfaction`
--

INSERT INTO `package_customer_satisfaction` (`local_tour_package_id`, `customer_satisfaction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-02-06 07:12:41', '2025-02-06 07:12:41'),
(2, 1, NULL, '2025-02-06 07:13:45', '2025-02-06 07:13:45'),
(3, 1, NULL, '2025-02-06 07:14:48', '2025-02-06 07:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platform_faq`
--

CREATE TABLE `platform_faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region_economic_activity`
--

CREATE TABLE `region_economic_activity` (
  `tanzania_region_id` bigint(20) UNSIGNED NOT NULL,
  `nation_economic_activity_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `region_economic_activity`
--

INSERT INTO `region_economic_activity` (`tanzania_region_id`, `nation_economic_activity_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_attractions`
--

CREATE TABLE `reservation_attractions` (
  `tour_operator_reservation_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_attractions`
--

INSERT INTO `reservation_attractions` (`tour_operator_reservation_id`, `touristic_attraction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_facilities`
--

CREATE TABLE `reservation_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facility_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_reservation_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_facilities`
--

INSERT INTO `reservation_facilities` (`id`, `facility_name`, `facility_description`, `tour_operator_reservation_id`, `tour_operator_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Wi-Fi', 'Free Wi-Fi all over the perimeter', 1, 1, '2bf0a306-2226-4ec1-8027-7c84bc7d6832', NULL, '2025-02-06 07:17:58', '2025-02-06 07:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_touristic_game`
--

CREATE TABLE `reservation_touristic_game` (
  `tour_operator_reservation_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_game_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(6) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isactive` smallint(6) NOT NULL DEFAULT 1 COMMENT 'specify whether the role is for active i.e. 1 is active, 0 no active',
  `isadmin` smallint(6) NOT NULL DEFAULT 0 COMMENT 'specify whether the role is for administration i.e. 1 is administrative, 0 not',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `isactive`, `isadmin`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'Administrator', 1, 1, NULL, '2025-02-05 07:30:22', '2025-02-05 07:30:22'),
(2, 'Tour Operator', 'Tour Operator', 1, 0, NULL, '2025-02-05 07:30:22', '2025-02-05 07:30:22'),
(3, 'Tourist', 'Tourist', 1, 0, NULL, '2025-02-05 07:30:22', '2025-02-05 07:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `special_needs`
--

CREATE TABLE `special_needs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `special_need_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_need_icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_needs`
--

INSERT INTO `special_needs` (`id`, `special_need_name`, `special_need_icon`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Handicapped', 'fas fa-wheelchair', '1', '760d2952-ec99-4a7a-81f5-25b1d30ff3d1', NULL, '2025-02-05 08:53:34', '2025-02-05 08:53:36'),
(2, 'Blind', 'fas fa-blind', '1', '321d6163-0f48-48d3-ba06-b8d908cff3f0', NULL, '2025-02-05 08:53:49', '2025-02-05 08:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_and_world_event`
--

CREATE TABLE `tanzania_and_world_event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanzania_and_world_event`
--

INSERT INTO `tanzania_and_world_event` (`id`, `event_name`, `event_description`, `event_date`, `uuid`, `status`, `deleted_at`, `created_at`, `updated_at`, `event_image`) VALUES
(1, 'Christmas', 'This event is due to the birth of Jesus Christ', '2025-12-25', '7dcc69a5-1c54-4e34-8997-8799b45b4d19', '1', NULL, '2025-02-05 08:56:13', '2025-02-05 08:56:17', '1738745773.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_faq`
--

CREATE TABLE `tanzania_faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_region`
--

CREATE TABLE `tanzania_region` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_icon_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `economic_activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_size` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `climatic_condition` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_nature` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_history` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_map` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanzania_region`
--

INSERT INTO `tanzania_region` (`id`, `region_name`, `region_icon_image`, `economic_activity`, `region_size`, `population`, `climatic_condition`, `transport_nature`, `region_description`, `region_history`, `region_map`, `nation_id`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Arusha', '/regionDominantImage/1738741224_67a315e8a9567.png,/regionDominantImage/1738741224_67a315e8a9719.jpeg,/regionDominantImage/1738741224_67a315e8a9825.jpeg', '1', 'It poses 595,000 people.', 'It poses 595,000 people.', 'Humid', 'Helicopter', 'Touristic City', 'Established in ...', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127449.72605776529!2d36.59463846521615!3d-3.3979688588866783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371c88f2387383%3A0xbc1907f7ec497152!2sArusha!5e0!3m2!1sen!2stz!4v1738741191714!5m2!1sen!2stz\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, '1', '187ac514-0edb-47fd-a5df-c504cf4a93ed', NULL, '2025-02-05 07:40:24', '2025-02-05 07:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_region_culture`
--

CREATE TABLE `tanzania_region_culture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `culture_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `culture_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traditional_language` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `traditional_dance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traditional_dance_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `traditional_food` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traditional_food_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `culture_history` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cultural_video` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanzania_region_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanzania_region_culture`
--

INSERT INTO `tanzania_region_culture` (`id`, `culture_name`, `basic_information`, `culture_image`, `traditional_language`, `traditional_dance`, `traditional_dance_description`, `traditional_food`, `traditional_food_description`, `culture_history`, `conclusion`, `cultural_video`, `tanzania_region_id`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Maasai', 'Maasai', '/cultureImage/1738741566_67a3173e6d717.jpeg,/cultureImage/1738741566_67a3173e6d829.jpeg,/cultureImage/1738741566_67a3173e6d903.jpeg', 'Maa', 'Maa', 'Jump Jump alot', 'Losholo', 'Mixture of milk and maize', 'Established in ...', 'Maasai is a great culture.', NULL, 1, 'afbe3838-6788-46b4-8b8f-d8b16a9cb79c', NULL, '2025-02-05 07:46:06', '2025-02-05 07:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_region_faq`
--

CREATE TABLE `tanzania_region_faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanzania_region_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_region_precaution`
--

CREATE TABLE `tanzania_region_precaution` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `precaution_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precaution_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanzania_region_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanzania_region_precaution`
--

INSERT INTO `tanzania_region_precaution` (`id`, `precaution_title`, `precaution_description`, `tanzania_region_id`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Robbery', 'Be careful with robbers', 1, '0', 'e0f655f1-1708-4bf2-9f5e-9642cca7bf03', NULL, '2025-02-05 07:40:24', '2025-02-05 07:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `tanzania_visit_advice`
--

CREATE TABLE `tanzania_visit_advice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advice_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touristic_activities`
--

CREATE TABLE `touristic_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `best_activity_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `touristic_activities`
--

INSERT INTO `touristic_activities` (`id`, `activity_name`, `activity_description`, `activity_image`, `best_activity_period`, `basic_information`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Hiking', 'This activity involves', '1738744260.jpeg', 'Starting from September to October', 'Involves you to get into ..', '9822d356-748a-4705-a375-ca522f97a995', '2025-02-05 08:31:00', '2025-02-05 08:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `touristic_activity_conduct_tips`
--

CREATE TABLE `touristic_activity_conduct_tips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tip_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_activities_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `touristic_activity_conduct_tips`
--

INSERT INTO `touristic_activity_conduct_tips` (`id`, `tip_name`, `tip_description`, `uuid`, `touristic_activities_id`, `created_at`, `updated_at`) VALUES
(1, 'Wear protective gear boots', 'Due to the rough nature of most areas in hike areas in Tanzania', 'd5492a61-4fd7-466f-945c-58ad314f5823', 1, '2025-02-05 08:31:00', '2025-02-05 08:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `touristic_attraction`
--

CREATE TABLE `touristic_attraction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attraction_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seasonal_variation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `flora_fauna` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `governing_body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_visit_month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_map` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attraction_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_fee_adult_foreigner` decimal(12,2) NOT NULL,
  `entry_fee_child_foreigner` decimal(12,2) NOT NULL,
  `entry_fee_child_local` decimal(12,2) NOT NULL,
  `entry_fee_adult_local` decimal(12,2) NOT NULL,
  `personal_experience` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `touristic_attraction`
--

INSERT INTO `touristic_attraction` (`id`, `attraction_name`, `attraction_description`, `attraction_category`, `establishment_year`, `seasonal_variation`, `flora_fauna`, `attraction_region`, `governing_body`, `website_link`, `attraction_visit_month`, `basic_information`, `attraction_map`, `attraction_image`, `entry_fee_adult_foreigner`, `entry_fee_child_foreigner`, `entry_fee_child_local`, `entry_fee_adult_local`, `personal_experience`, `uuid`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Arusha national Park', 'Park of the North', '1', '0', 'Seasonal variation', 'Flora & Fauna', '1', 'TANAPA', 'https://www.tanzaniaparks.go.tz', 'September to October', 'Just basic information', NULL, '/touristAttraction/1738745327_67a325eff064f.jpeg,/touristAttraction/1738745327_67a325eff0786.jpeg', '4000.00', '5000.00', '3000.00', '2000.00', 'It was so fine the first time we travelled with my team.', 'e86efdbd-3e20-4c64-bd22-d81d503b8249', '1', NULL, '2025-02-05 08:48:47', '2025-02-05 08:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `touristic_attraction_activities`
--

CREATE TABLE `touristic_attraction_activities` (
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `touristic_activities_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `touristic_attraction_activities`
--

INSERT INTO `touristic_attraction_activities` (`touristic_attraction_id`, `touristic_activities_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `touristic_attraction_category`
--

CREATE TABLE `touristic_attraction_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attraction_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_category_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attraction_category_iconic_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attraction_category_basic_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `touristic_attraction_category`
--

INSERT INTO `touristic_attraction_category` (`id`, `attraction_category`, `attraction_category_description`, `uuid`, `deleted_at`, `created_at`, `updated_at`, `attraction_category_iconic_image`, `attraction_category_basic_information`) VALUES
(1, 'National Park', 'Home to Wildlife', 'a08e4250-c700-40d1-bc7a-b4a0274289c4', NULL, '2025-02-05 08:33:11', '2025-02-05 08:33:11', '1738744391.jpeg', 'Most animals like ..');

-- --------------------------------------------------------

--
-- Table structure for table `touristic_attraction_honey_point`
--

CREATE TABLE `touristic_attraction_honey_point` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `honey_point_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `honey_point_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `honey_point_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touristic_attraction_rules`
--

CREATE TABLE `touristic_attraction_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rule_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touristic_game`
--

CREATE TABLE `touristic_game` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_theme` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_players` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tutorial_directory_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_of_play` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `development_inspiration` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touristic_game_components`
--

CREATE TABLE `touristic_game_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_component` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `component_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_game_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourist_attraction_faq`
--

CREATE TABLE `tourist_attraction_faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `touristic_attraction_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourist_reviews`
--

CREATE TABLE `tourist_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tourist_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tour_package_booking_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_company_local_tours_goals`
--

CREATE TABLE `tour_company_local_tours_goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goal_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_tours_to_be_made` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_travellers` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_mail_subscribers` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_tour_reviewers` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projected_revenue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_insurance_type`
--

CREATE TABLE `tour_insurance_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_insurance_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_insurance_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_insurance_type`
--

INSERT INTO `tour_insurance_type` (`id`, `tour_insurance_name`, `tour_insurance_description`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Trip Cancellation', 'Trip Cancellation is when you want to cancel off the trip', '1', 'de5bd432-b610-499c-a1a2-a84d69ab24ce', NULL, '2025-02-05 08:59:41', '2025-02-05 08:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `tour_operator`
--

CREATE TABLE `tour_operator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `established_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_employees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_time_range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safariClass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreeCustomBooking` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_nation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_team_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_certificate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tato_membership_certificate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_and_conditions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_operator`
--

INSERT INTO `tour_operator` (`id`, `company_name`, `email_address`, `phone_number`, `established_date`, `total_employees`, `support_time_range`, `website_url`, `instagram_url`, `whatsapp_url`, `gps_url`, `safariClass`, `agreeCustomBooking`, `company_nation`, `company_logo`, `company_team_image`, `about_company`, `verification_certificate`, `tato_membership_certificate`, `terms_and_conditions`, `status`, `uuid`, `users_id`, `deleted_at`, `created_at`, `updated_at`, `region`, `postal_code`, `tin_number`, `physical_location`) VALUES
(1, 'Leopard Tours', 'leopard@gmail.com', '0768885599', '2020-01-20', '20', '24 hours after request made', 'https://www.eetechnologiestz.com', 'https://www.eetechnologiestz.com', 'https://www.eetechnologiestz.com', 'https://www.eetechnologiestz.com', 'localTours', 'Yes', '1', '1738825312.png', '1738825312.jpeg', 'Quality Service for all', '1738825312.pdf', '1738825312.pdf', '1738825312.pdf', '1', 'b746f2f0-49c2-4414-b751-3dd508bbd265', 2, NULL, '2025-02-06 07:01:52', '2025-02-06 07:02:22', '1', '6221', '778668885', 'NSSF Kaloleni Plaza, Ground Floor');

-- --------------------------------------------------------

--
-- Table structure for table `tour_operator_reservation`
--

CREATE TABLE `tour_operator_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_capacity` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_found` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `resident_child_price_reservation` decimal(15,2) DEFAULT NULL,
  `resident_adult_price_reservation` decimal(15,2) DEFAULT NULL,
  `foreigner_adult_price_reservation` decimal(15,2) DEFAULT NULL,
  `foreigner_child_price_reservation` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_operator_reservation`
--

INSERT INTO `tour_operator_reservation` (`id`, `reservation_name`, `reservation_capacity`, `reservation_url`, `reservation_images`, `region_found`, `tour_operator_id`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`, `resident_child_price_reservation`, `resident_adult_price_reservation`, `foreigner_adult_price_reservation`, `foreigner_child_price_reservation`) VALUES
(1, 'Lake Duluti', 'More than 40 people can sleep', 'https://www.tanzaniatourism.com/destination/lake-duluti', '/reservationImages/1738826278_67a46226c7966.jpeg,/reservationImages/1738826278_67a46226c7aa8.jpeg', '1', 1, '1', 'b8d5ef6b-55ac-4acd-b243-283895412952', NULL, '2025-02-06 07:17:58', '2025-02-06 07:18:03', '50000.00', '60000.00', '100000.00', '90000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tour_package`
--

CREATE TABLE `tour_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_safari_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_package_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_poster` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_price_adult_tanzanian` decimal(15,2) NOT NULL,
  `trip_price_child_tanzanian` decimal(15,2) NOT NULL,
  `trip_price_adult_foreigner` decimal(15,2) NOT NULL,
  `trip_price_child_foreigner` decimal(15,2) NOT NULL,
  `safari_start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_accommodations`
--

CREATE TABLE `tour_package_accommodations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_activities`
--

CREATE TABLE `tour_package_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_bookings`
--

CREATE TABLE `tour_package_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tourist_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourist_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_adult_travellers` int(11) NOT NULL,
  `total_children_travellers` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_features`
--

CREATE TABLE `tour_package_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_special_need`
--

CREATE TABLE `tour_package_special_need` (
  `tour_package_id` int(11) NOT NULL,
  `special_need_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_tour_type`
--

CREATE TABLE `tour_package_tour_type` (
  `tour_package_id` int(11) NOT NULL,
  `tour_type_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_transport`
--

CREATE TABLE `tour_package_transport` (
  `tour_package_id` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_trips`
--

CREATE TABLE `tour_package_trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_trip_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safari_trip_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_operator_id` bigint(20) UNSIGNED NOT NULL,
  `tour_package_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_types`
--

CREATE TABLE `tour_package_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_package_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_package_type_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_package_type_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_package_types`
--

INSERT INTO `tour_package_types` (`id`, `tour_package_type_name`, `tour_package_type_description`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`, `tour_package_type_image`) VALUES
(1, 'Couple tour', 'This is a special package for couples', '1', '3ad40204-2d9f-4d6c-90ea-02c198a2a29c', NULL, '2025-02-05 08:59:03', '2025-02-05 08:59:05', '1738745943.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tour_types`
--

CREATE TABLE `tour_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_type_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_types`
--

INSERT INTO `tour_types` (`id`, `tour_type_name`, `uuid`, `status`, `deleted_at`, `created_at`, `updated_at`, `rating`, `tour_type_description`) VALUES
(1, '10 star: Supreme Excellence', '44f6d127-9ba7-4184-b8c0-d4833e89b73c', '1', NULL, '2025-02-05 08:55:12', '2025-02-05 08:55:14', '10', 'Most of services are available for free');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transport_icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `transport_icon`, `transport_name`, `uuid`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-car', 'Cruiser', '1463c26c-40bf-409e-a9dd-61062041bbc5', '1', NULL, '2025-02-05 08:54:11', '2025-02-05 08:54:13'),
(2, 'fas fa-plane', 'helicopter', 'c1b68e98-2f77-470d-8902-cf3b10b2a70a', '1', NULL, '2025-02-05 08:54:25', '2025-02-05 08:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmation_code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `isactive` smallint(6) NOT NULL DEFAULT 1,
  `available` smallint(6) NOT NULL DEFAULT 1 COMMENT 'set whether user is available to be seen by other portal users or not 1. Yes, 0. No ( If set 0, other users will not find this user through searching )',
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `role`, `remember_token`, `last_login`, `confirmed`, `confirmation_code`, `confirmed_at`, `isactive`, `available`, `uuid`, `deleted_at`, `created_at`, `updated_at`, `email_verified_at`, `status`) VALUES
(1, 'Edgar Bonaventure', 'edgarfwalo99@gmail.com', '0743154530', '$2y$10$NqXDC.rrWkfGMkr/U91vn.ASy3xz4TSbzfWmVqNe9j3IvdgYNv11.', '1', NULL, NULL, 1, '101010', NULL, 1, 1, '49aa011c-e2d8-48f3-a7ac-83bec54b8b06', NULL, '2025-02-05 07:30:22', '2025-02-06 07:02:18', NULL, '1'),
(2, 'Gaudence Bonaventure', 'gaudence@gmail.com', '0657485848', '$2y$10$ChSccP63wdKOg.QoI0ryh.dAngLp4FNAg.rU1utj95302/RhTqkGu', '2', NULL, NULL, 1, '202020', NULL, 1, 1, '49406dcd-2d3c-4b66-b40f-efa9edf282ea', NULL, '2025-02-05 07:30:22', '2025-02-06 07:02:39', NULL, '1'),
(3, 'Deogratius Bonaventure', 'deogratius@gmail.com', '0758493929', '$2y$10$pG4Q/FUUvmukKL1PlJwksOEAzR/MWWLBg3BEuScJfDdflN21uOs.K', '3', NULL, NULL, 0, '303030', NULL, 1, 1, '94f55c17-eedb-466b-a0f3-da53e47ee053', NULL, '2025-02-05 07:30:22', '2025-02-05 07:30:22', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appreciation_activities`
--
ALTER TABLE `appreciation_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appreciation_activities_tanzania_region_culture_id_foreign` (`tanzania_region_culture_id`);

--
-- Indexes for table `attraction_visit_advices`
--
ALTER TABLE `attraction_visit_advices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attraction_visit_advices_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `attraction_visit_reasons`
--
ALTER TABLE `attraction_visit_reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attraction_visit_reasons_uuid_unique` (`uuid`),
  ADD KEY `attraction_visit_reasons_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `category_activities`
--
ALTER TABLE `category_activities`
  ADD KEY `category_activities_touristic_attraction_category_id_foreign` (`touristic_attraction_category_id`),
  ADD KEY `category_activities_touristic_activities_id_foreign` (`touristic_activities_id`);

--
-- Indexes for table `company_touristic_activities`
--
ALTER TABLE `company_touristic_activities`
  ADD KEY `company_touristic_activities_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `company_touristic_activities_touristic_activities_id_foreign` (`touristic_activities_id`);

--
-- Indexes for table `culture_challenges`
--
ALTER TABLE `culture_challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `culture_challenges_tanzania_region_culture_id_foreign` (`tanzania_region_culture_id`);

--
-- Indexes for table `culture_characteristics`
--
ALTER TABLE `culture_characteristics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `culture_characteristics_tanzania_region_culture_id_foreign` (`tanzania_region_culture_id`);

--
-- Indexes for table `customer_satisfaction_category`
--
ALTER TABLE `customer_satisfaction_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_booking_attraction`
--
ALTER TABLE `custom_booking_attraction`
  ADD KEY `custom_booking_attraction_custom_tour_booking_id_foreign` (`custom_tour_booking_id`),
  ADD KEY `custom_booking_attraction_tourist_attraction_id_foreign` (`tourist_attraction_id`);

--
-- Indexes for table `custom_tour_booking`
--
ALTER TABLE `custom_tour_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_tour_booking_reference_number_unique` (`reference_number`),
  ADD KEY `custom_tour_booking_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `custom_tour_booking_reservations`
--
ALTER TABLE `custom_tour_booking_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_tour_booking_reservations_custom_tour_booking_id_foreign` (`custom_tour_booking_id`);

--
-- Indexes for table `custom_tour_booking_tour_prices`
--
ALTER TABLE `custom_tour_booking_tour_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_tour_booking_tour_prices_custom_tour_booking_id_foreign` (`custom_tour_booking_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `local_package_price_exclusives`
--
ALTER TABLE `local_package_price_exclusives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_package_price_exclusives_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_package_price_exclusives_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_package_reservation`
--
ALTER TABLE `local_package_reservation`
  ADD KEY `local_package_reservation_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_package_reservation_tour_operator_reservation_id_foreign` (`tour_operator_reservation_id`);

--
-- Indexes for table `local_package_special_need`
--
ALTER TABLE `local_package_special_need`
  ADD KEY `local_package_special_need_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_package_special_need_special_need_id_foreign` (`special_need_id`);

--
-- Indexes for table `local_package_transport`
--
ALTER TABLE `local_package_transport`
  ADD KEY `local_package_transport_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_package_transport_transport_id_foreign` (`transport_id`);

--
-- Indexes for table `local_tourist_review`
--
ALTER TABLE `local_tourist_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tourist_review_local_tour_booking_id_foreign` (`local_tour_booking_id`),
  ADD KEY `local_tourist_review_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_tourist_review_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_cancelledbookings`
--
ALTER TABLE `local_tour_cancelledbookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_cancelledbookings_local_tour_booking_id_foreign` (`local_tour_booking_id`);

--
-- Indexes for table `local_tour_goals_package_segmentations`
--
ALTER TABLE `local_tour_goals_package_segmentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_goals_package_segmentations_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `local_tour_goals_package_segmentations_goal_id_foreign` (`goal_id`);

--
-- Indexes for table `local_tour_goals_projected_revenues`
--
ALTER TABLE `local_tour_goals_projected_revenues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_goals_projected_revenues_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `local_tour_goals_projected_revenues_local_tours_goals_id_foreign` (`local_tours_goals_id`);

--
-- Indexes for table `local_tour_package`
--
ALTER TABLE `local_tour_package`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `local_tour_package_package_reference_number_unique` (`package_reference_number`),
  ADD KEY `local_tour_package_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_package_activities`
--
ALTER TABLE `local_tour_package_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_package_activities_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_tour_package_activities_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_package_booking`
--
ALTER TABLE `local_tour_package_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `local_tour_package_booking_reference_number_unique` (`reference_number`),
  ADD KEY `local_tour_package_booking_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `local_tour_package_booking_local_tour_package_id_foreign` (`local_tour_package_id`);

--
-- Indexes for table `local_tour_package_collection_stop`
--
ALTER TABLE `local_tour_package_collection_stop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_package_collection_stop_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_tour_package_collection_stop_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_package_price_inclusive`
--
ALTER TABLE `local_tour_package_price_inclusive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_package_price_inclusive_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_tour_package_price_inclusive_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_package_requirement`
--
ALTER TABLE `local_tour_package_requirement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_package_requirement_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `local_tour_package_requirement_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `local_tour_package_total_views`
--
ALTER TABLE `local_tour_package_total_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_tour_package_total_views_local_tour_package_id_foreign` (`local_tour_package_id`);

--
-- Indexes for table `love_likes`
--
ALTER TABLE `love_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `like_user_unique` (`likeable_type`,`likeable_id`,`user_id`),
  ADD KEY `love_likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`),
  ADD KEY `love_likes_user_id_index` (`user_id`);

--
-- Indexes for table `love_like_counters`
--
ALTER TABLE `love_like_counters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `like_counter_unique` (`likeable_id`,`likeable_type`,`type_id`),
  ADD KEY `love_like_counters_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nation_uuid_unique` (`uuid`);

--
-- Indexes for table `nation_economic_activities`
--
ALTER TABLE `nation_economic_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nation_economic_activities_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `nation_precautions`
--
ALTER TABLE `nation_precautions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nation_precautions_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `operator_insurance_type`
--
ALTER TABLE `operator_insurance_type`
  ADD KEY `operator_insurance_type_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `operator_insurance_type_tour_insurance_type_id_foreign` (`tour_insurance_type_id`);

--
-- Indexes for table `operator_tanzania_region`
--
ALTER TABLE `operator_tanzania_region`
  ADD KEY `operator_tanzania_region_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `operator_tanzania_region_tanzania_region_id_foreign` (`tanzania_region_id`);

--
-- Indexes for table `operator_touristic_attraction`
--
ALTER TABLE `operator_touristic_attraction`
  ADD KEY `operator_touristic_attraction_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `operator_touristic_attraction_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `package_customer_satisfaction`
--
ALTER TABLE `package_customer_satisfaction`
  ADD KEY `package_customer_satisfaction_local_tour_package_id_foreign` (`local_tour_package_id`),
  ADD KEY `package_customer_satisfaction_customer_satisfaction_id_foreign` (`customer_satisfaction_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `platform_faq`
--
ALTER TABLE `platform_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region_economic_activity`
--
ALTER TABLE `region_economic_activity`
  ADD KEY `region_economic_activity_tanzania_region_id_foreign` (`tanzania_region_id`),
  ADD KEY `region_economic_activity_nation_economic_activity_id_foreign` (`nation_economic_activity_id`);

--
-- Indexes for table `reservation_attractions`
--
ALTER TABLE `reservation_attractions`
  ADD KEY `reservation_attractions_tour_operator_reservation_id_foreign` (`tour_operator_reservation_id`),
  ADD KEY `reservation_attractions_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `reservation_facilities`
--
ALTER TABLE `reservation_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_facilities_tour_operator_reservation_id_foreign` (`tour_operator_reservation_id`),
  ADD KEY `reservation_facilities_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `reservation_touristic_game`
--
ALTER TABLE `reservation_touristic_game`
  ADD KEY `reservation_touristic_game_tour_operator_reservation_id_foreign` (`tour_operator_reservation_id`),
  ADD KEY `reservation_touristic_game_touristic_game_id_foreign` (`touristic_game_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_needs`
--
ALTER TABLE `special_needs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `special_needs_uuid_unique` (`uuid`),
  ADD KEY `special_needs_special_need_name_index` (`special_need_name`);

--
-- Indexes for table `tanzania_and_world_event`
--
ALTER TABLE `tanzania_and_world_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanzania_faq`
--
ALTER TABLE `tanzania_faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_faq_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `tanzania_region`
--
ALTER TABLE `tanzania_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_region_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `tanzania_region_culture`
--
ALTER TABLE `tanzania_region_culture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_region_culture_tanzania_region_id_foreign` (`tanzania_region_id`);

--
-- Indexes for table `tanzania_region_faq`
--
ALTER TABLE `tanzania_region_faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_region_faq_tanzania_region_id_foreign` (`tanzania_region_id`);

--
-- Indexes for table `tanzania_region_precaution`
--
ALTER TABLE `tanzania_region_precaution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_region_precaution_tanzania_region_id_foreign` (`tanzania_region_id`);

--
-- Indexes for table `tanzania_visit_advice`
--
ALTER TABLE `tanzania_visit_advice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanzania_visit_advice_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `touristic_activities`
--
ALTER TABLE `touristic_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `touristic_activity_conduct_tips`
--
ALTER TABLE `touristic_activity_conduct_tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `touristic_activity_conduct_tips_touristic_activities_id_foreign` (`touristic_activities_id`);

--
-- Indexes for table `touristic_attraction`
--
ALTER TABLE `touristic_attraction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `touristic_attraction_uuid_unique` (`uuid`),
  ADD KEY `touristic_attraction_attraction_name_index` (`attraction_name`);

--
-- Indexes for table `touristic_attraction_activities`
--
ALTER TABLE `touristic_attraction_activities`
  ADD KEY `touristic_attraction_activities_touristic_attraction_id_foreign` (`touristic_attraction_id`),
  ADD KEY `touristic_attraction_activities_touristic_activities_id_foreign` (`touristic_activities_id`);

--
-- Indexes for table `touristic_attraction_category`
--
ALTER TABLE `touristic_attraction_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `touristic_attraction_honey_point`
--
ALTER TABLE `touristic_attraction_honey_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `touristic_attraction_honey_point_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `touristic_attraction_rules`
--
ALTER TABLE `touristic_attraction_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `touristic_attraction_rules_nation_id_foreign` (`nation_id`);

--
-- Indexes for table `touristic_game`
--
ALTER TABLE `touristic_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `touristic_game_components`
--
ALTER TABLE `touristic_game_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `touristic_game_components_touristic_game_id_foreign` (`touristic_game_id`);

--
-- Indexes for table `tourist_attraction_faq`
--
ALTER TABLE `tourist_attraction_faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourist_attraction_faq_touristic_attraction_id_foreign` (`touristic_attraction_id`);

--
-- Indexes for table `tourist_reviews`
--
ALTER TABLE `tourist_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourist_reviews_tourist_name_index` (`tourist_name`),
  ADD KEY `tourist_reviews_review_title_index` (`review_title`(768)),
  ADD KEY `tourist_reviews_tour_package_booking_id_foreign` (`tour_package_booking_id`),
  ADD KEY `tourist_reviews_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_company_local_tours_goals`
--
ALTER TABLE `tour_company_local_tours_goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_company_local_tours_goals_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_insurance_type`
--
ALTER TABLE `tour_insurance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_operator`
--
ALTER TABLE `tour_operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_operator_company_name_unique` (`company_name`),
  ADD UNIQUE KEY `tour_operator_uuid_unique` (`uuid`),
  ADD KEY `tour_operator_users_id_foreign` (`users_id`);

--
-- Indexes for table `tour_operator_reservation`
--
ALTER TABLE `tour_operator_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_operator_reservation_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_package`
--
ALTER TABLE `tour_package`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_package_uuid_unique` (`uuid`),
  ADD KEY `tour_package_main_safari_name_index` (`main_safari_name`),
  ADD KEY `tour_package_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `tour_package_users_id_foreign` (`users_id`);

--
-- Indexes for table `tour_package_accommodations`
--
ALTER TABLE `tour_package_accommodations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_package_accommodations_uuid_unique` (`uuid`),
  ADD KEY `tour_package_accommodations_tour_package_id_foreign` (`tour_package_id`),
  ADD KEY `tour_package_accommodations_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_package_activities`
--
ALTER TABLE `tour_package_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_package_activities_tour_package_id_foreign` (`tour_package_id`),
  ADD KEY `tour_package_activities_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_package_bookings`
--
ALTER TABLE `tour_package_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_package_bookings_tourist_name_index` (`tourist_name`),
  ADD KEY `tour_package_bookings_tourist_country_index` (`tourist_country`),
  ADD KEY `tour_package_bookings_tourist_phone_number_index` (`tourist_phone_number`),
  ADD KEY `tour_package_bookings_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `tour_package_bookings_tour_package_id_foreign` (`tour_package_id`);

--
-- Indexes for table `tour_package_features`
--
ALTER TABLE `tour_package_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_package_features_tour_package_id_foreign` (`tour_package_id`),
  ADD KEY `tour_package_features_tour_operator_id_foreign` (`tour_operator_id`);

--
-- Indexes for table `tour_package_trips`
--
ALTER TABLE `tour_package_trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_package_trips_tour_operator_id_foreign` (`tour_operator_id`),
  ADD KEY `tour_package_trips_tour_package_id_foreign` (`tour_package_id`);

--
-- Indexes for table `tour_package_types`
--
ALTER TABLE `tour_package_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_types`
--
ALTER TABLE `tour_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_types_uuid_unique` (`uuid`),
  ADD KEY `tour_types_tour_type_name_index` (`tour_type_name`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transports_uuid_unique` (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appreciation_activities`
--
ALTER TABLE `appreciation_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attraction_visit_advices`
--
ALTER TABLE `attraction_visit_advices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attraction_visit_reasons`
--
ALTER TABLE `attraction_visit_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `culture_challenges`
--
ALTER TABLE `culture_challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `culture_characteristics`
--
ALTER TABLE `culture_characteristics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_satisfaction_category`
--
ALTER TABLE `customer_satisfaction_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custom_tour_booking`
--
ALTER TABLE `custom_tour_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_tour_booking_reservations`
--
ALTER TABLE `custom_tour_booking_reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_tour_booking_tour_prices`
--
ALTER TABLE `custom_tour_booking_tour_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `local_package_price_exclusives`
--
ALTER TABLE `local_package_price_exclusives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tourist_review`
--
ALTER TABLE `local_tourist_review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_tour_cancelledbookings`
--
ALTER TABLE `local_tour_cancelledbookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_tour_goals_package_segmentations`
--
ALTER TABLE `local_tour_goals_package_segmentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_tour_goals_projected_revenues`
--
ALTER TABLE `local_tour_goals_projected_revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_tour_package`
--
ALTER TABLE `local_tour_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tour_package_activities`
--
ALTER TABLE `local_tour_package_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tour_package_booking`
--
ALTER TABLE `local_tour_package_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_tour_package_collection_stop`
--
ALTER TABLE `local_tour_package_collection_stop`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tour_package_price_inclusive`
--
ALTER TABLE `local_tour_package_price_inclusive`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tour_package_requirement`
--
ALTER TABLE `local_tour_package_requirement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_tour_package_total_views`
--
ALTER TABLE `local_tour_package_total_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `love_likes`
--
ALTER TABLE `love_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `love_like_counters`
--
ALTER TABLE `love_like_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `nation`
--
ALTER TABLE `nation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nation_economic_activities`
--
ALTER TABLE `nation_economic_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nation_precautions`
--
ALTER TABLE `nation_precautions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `platform_faq`
--
ALTER TABLE `platform_faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_facilities`
--
ALTER TABLE `reservation_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `special_needs`
--
ALTER TABLE `special_needs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tanzania_and_world_event`
--
ALTER TABLE `tanzania_and_world_event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanzania_faq`
--
ALTER TABLE `tanzania_faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanzania_region`
--
ALTER TABLE `tanzania_region`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanzania_region_culture`
--
ALTER TABLE `tanzania_region_culture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanzania_region_faq`
--
ALTER TABLE `tanzania_region_faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanzania_region_precaution`
--
ALTER TABLE `tanzania_region_precaution`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanzania_visit_advice`
--
ALTER TABLE `tanzania_visit_advice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `touristic_activities`
--
ALTER TABLE `touristic_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `touristic_activity_conduct_tips`
--
ALTER TABLE `touristic_activity_conduct_tips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `touristic_attraction`
--
ALTER TABLE `touristic_attraction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `touristic_attraction_category`
--
ALTER TABLE `touristic_attraction_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `touristic_attraction_honey_point`
--
ALTER TABLE `touristic_attraction_honey_point`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `touristic_attraction_rules`
--
ALTER TABLE `touristic_attraction_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `touristic_game`
--
ALTER TABLE `touristic_game`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `touristic_game_components`
--
ALTER TABLE `touristic_game_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourist_attraction_faq`
--
ALTER TABLE `tourist_attraction_faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourist_reviews`
--
ALTER TABLE `tourist_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_company_local_tours_goals`
--
ALTER TABLE `tour_company_local_tours_goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_insurance_type`
--
ALTER TABLE `tour_insurance_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_operator`
--
ALTER TABLE `tour_operator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_operator_reservation`
--
ALTER TABLE `tour_operator_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_package`
--
ALTER TABLE `tour_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_accommodations`
--
ALTER TABLE `tour_package_accommodations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_activities`
--
ALTER TABLE `tour_package_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_bookings`
--
ALTER TABLE `tour_package_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_features`
--
ALTER TABLE `tour_package_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_trips`
--
ALTER TABLE `tour_package_trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_package_types`
--
ALTER TABLE `tour_package_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_types`
--
ALTER TABLE `tour_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appreciation_activities`
--
ALTER TABLE `appreciation_activities`
  ADD CONSTRAINT `appreciation_activities_tanzania_region_culture_id_foreign` FOREIGN KEY (`tanzania_region_culture_id`) REFERENCES `tanzania_region_culture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attraction_visit_advices`
--
ALTER TABLE `attraction_visit_advices`
  ADD CONSTRAINT `attraction_visit_advices_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attraction_visit_reasons`
--
ALTER TABLE `attraction_visit_reasons`
  ADD CONSTRAINT `attraction_visit_reasons_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_activities`
--
ALTER TABLE `category_activities`
  ADD CONSTRAINT `category_activities_touristic_activities_id_foreign` FOREIGN KEY (`touristic_activities_id`) REFERENCES `touristic_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_activities_touristic_attraction_category_id_foreign` FOREIGN KEY (`touristic_attraction_category_id`) REFERENCES `touristic_attraction_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_touristic_activities`
--
ALTER TABLE `company_touristic_activities`
  ADD CONSTRAINT `company_touristic_activities_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_touristic_activities_touristic_activities_id_foreign` FOREIGN KEY (`touristic_activities_id`) REFERENCES `touristic_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `culture_challenges`
--
ALTER TABLE `culture_challenges`
  ADD CONSTRAINT `culture_challenges_tanzania_region_culture_id_foreign` FOREIGN KEY (`tanzania_region_culture_id`) REFERENCES `tanzania_region_culture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `culture_characteristics`
--
ALTER TABLE `culture_characteristics`
  ADD CONSTRAINT `culture_characteristics_tanzania_region_culture_id_foreign` FOREIGN KEY (`tanzania_region_culture_id`) REFERENCES `tanzania_region_culture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_booking_attraction`
--
ALTER TABLE `custom_booking_attraction`
  ADD CONSTRAINT `custom_booking_attraction_custom_tour_booking_id_foreign` FOREIGN KEY (`custom_tour_booking_id`) REFERENCES `custom_tour_booking` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `custom_booking_attraction_tourist_attraction_id_foreign` FOREIGN KEY (`tourist_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `custom_tour_booking`
--
ALTER TABLE `custom_tour_booking`
  ADD CONSTRAINT `custom_tour_booking_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_tour_booking_reservations`
--
ALTER TABLE `custom_tour_booking_reservations`
  ADD CONSTRAINT `custom_tour_booking_reservations_custom_tour_booking_id_foreign` FOREIGN KEY (`custom_tour_booking_id`) REFERENCES `custom_tour_booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_tour_booking_tour_prices`
--
ALTER TABLE `custom_tour_booking_tour_prices`
  ADD CONSTRAINT `custom_tour_booking_tour_prices_custom_tour_booking_id_foreign` FOREIGN KEY (`custom_tour_booking_id`) REFERENCES `custom_tour_booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_package_price_exclusives`
--
ALTER TABLE `local_package_price_exclusives`
  ADD CONSTRAINT `local_package_price_exclusives_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_package_price_exclusives_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_package_reservation`
--
ALTER TABLE `local_package_reservation`
  ADD CONSTRAINT `local_package_reservation_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `local_package_reservation_tour_operator_reservation_id_foreign` FOREIGN KEY (`tour_operator_reservation_id`) REFERENCES `tour_operator_reservation` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `local_package_special_need`
--
ALTER TABLE `local_package_special_need`
  ADD CONSTRAINT `local_package_special_need_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `local_package_special_need_special_need_id_foreign` FOREIGN KEY (`special_need_id`) REFERENCES `special_needs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `local_package_transport`
--
ALTER TABLE `local_package_transport`
  ADD CONSTRAINT `local_package_transport_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `local_package_transport_transport_id_foreign` FOREIGN KEY (`transport_id`) REFERENCES `transports` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `local_tourist_review`
--
ALTER TABLE `local_tourist_review`
  ADD CONSTRAINT `local_tourist_review_local_tour_booking_id_foreign` FOREIGN KEY (`local_tour_booking_id`) REFERENCES `local_tour_package_booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tourist_review_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tourist_review_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_cancelledbookings`
--
ALTER TABLE `local_tour_cancelledbookings`
  ADD CONSTRAINT `local_tour_cancelledbookings_local_tour_booking_id_foreign` FOREIGN KEY (`local_tour_booking_id`) REFERENCES `local_tour_package_booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_goals_package_segmentations`
--
ALTER TABLE `local_tour_goals_package_segmentations`
  ADD CONSTRAINT `local_tour_goals_package_segmentations_goal_id_foreign` FOREIGN KEY (`goal_id`) REFERENCES `tour_company_local_tours_goals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_goals_package_segmentations_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_goals_projected_revenues`
--
ALTER TABLE `local_tour_goals_projected_revenues`
  ADD CONSTRAINT `local_tour_goals_projected_revenues_local_tours_goals_id_foreign` FOREIGN KEY (`local_tours_goals_id`) REFERENCES `tour_company_local_tours_goals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_goals_projected_revenues_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package`
--
ALTER TABLE `local_tour_package`
  ADD CONSTRAINT `local_tour_package_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_activities`
--
ALTER TABLE `local_tour_package_activities`
  ADD CONSTRAINT `local_tour_package_activities_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_package_activities_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_booking`
--
ALTER TABLE `local_tour_package_booking`
  ADD CONSTRAINT `local_tour_package_booking_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_package_booking_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_collection_stop`
--
ALTER TABLE `local_tour_package_collection_stop`
  ADD CONSTRAINT `local_tour_package_collection_stop_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_package_collection_stop_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_price_inclusive`
--
ALTER TABLE `local_tour_package_price_inclusive`
  ADD CONSTRAINT `local_tour_package_price_inclusive_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_package_price_inclusive_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_requirement`
--
ALTER TABLE `local_tour_package_requirement`
  ADD CONSTRAINT `local_tour_package_requirement_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `local_tour_package_requirement_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_tour_package_total_views`
--
ALTER TABLE `local_tour_package_total_views`
  ADD CONSTRAINT `local_tour_package_total_views_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nation_economic_activities`
--
ALTER TABLE `nation_economic_activities`
  ADD CONSTRAINT `nation_economic_activities_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nation_precautions`
--
ALTER TABLE `nation_precautions`
  ADD CONSTRAINT `nation_precautions_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operator_insurance_type`
--
ALTER TABLE `operator_insurance_type`
  ADD CONSTRAINT `operator_insurance_type_tour_insurance_type_id_foreign` FOREIGN KEY (`tour_insurance_type_id`) REFERENCES `tour_insurance_type` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `operator_insurance_type_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `operator_tanzania_region`
--
ALTER TABLE `operator_tanzania_region`
  ADD CONSTRAINT `operator_tanzania_region_tanzania_region_id_foreign` FOREIGN KEY (`tanzania_region_id`) REFERENCES `tanzania_region` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `operator_tanzania_region_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `operator_touristic_attraction`
--
ALTER TABLE `operator_touristic_attraction`
  ADD CONSTRAINT `operator_touristic_attraction_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `operator_touristic_attraction_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `package_customer_satisfaction`
--
ALTER TABLE `package_customer_satisfaction`
  ADD CONSTRAINT `package_customer_satisfaction_customer_satisfaction_id_foreign` FOREIGN KEY (`customer_satisfaction_id`) REFERENCES `customer_satisfaction_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `package_customer_satisfaction_local_tour_package_id_foreign` FOREIGN KEY (`local_tour_package_id`) REFERENCES `local_tour_package` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `region_economic_activity`
--
ALTER TABLE `region_economic_activity`
  ADD CONSTRAINT `region_economic_activity_nation_economic_activity_id_foreign` FOREIGN KEY (`nation_economic_activity_id`) REFERENCES `nation_economic_activities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `region_economic_activity_tanzania_region_id_foreign` FOREIGN KEY (`tanzania_region_id`) REFERENCES `tanzania_region` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation_attractions`
--
ALTER TABLE `reservation_attractions`
  ADD CONSTRAINT `reservation_attractions_tour_operator_reservation_id_foreign` FOREIGN KEY (`tour_operator_reservation_id`) REFERENCES `tour_operator_reservation` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_attractions_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation_facilities`
--
ALTER TABLE `reservation_facilities`
  ADD CONSTRAINT `reservation_facilities_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_facilities_tour_operator_reservation_id_foreign` FOREIGN KEY (`tour_operator_reservation_id`) REFERENCES `tour_operator_reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_touristic_game`
--
ALTER TABLE `reservation_touristic_game`
  ADD CONSTRAINT `reservation_touristic_game_tour_operator_reservation_id_foreign` FOREIGN KEY (`tour_operator_reservation_id`) REFERENCES `tour_operator_reservation` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_touristic_game_touristic_game_id_foreign` FOREIGN KEY (`touristic_game_id`) REFERENCES `touristic_game` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_faq`
--
ALTER TABLE `tanzania_faq`
  ADD CONSTRAINT `tanzania_faq_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_region`
--
ALTER TABLE `tanzania_region`
  ADD CONSTRAINT `tanzania_region_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_region_culture`
--
ALTER TABLE `tanzania_region_culture`
  ADD CONSTRAINT `tanzania_region_culture_tanzania_region_id_foreign` FOREIGN KEY (`tanzania_region_id`) REFERENCES `tanzania_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_region_faq`
--
ALTER TABLE `tanzania_region_faq`
  ADD CONSTRAINT `tanzania_region_faq_tanzania_region_id_foreign` FOREIGN KEY (`tanzania_region_id`) REFERENCES `tanzania_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_region_precaution`
--
ALTER TABLE `tanzania_region_precaution`
  ADD CONSTRAINT `tanzania_region_precaution_tanzania_region_id_foreign` FOREIGN KEY (`tanzania_region_id`) REFERENCES `tanzania_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanzania_visit_advice`
--
ALTER TABLE `tanzania_visit_advice`
  ADD CONSTRAINT `tanzania_visit_advice_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `touristic_activity_conduct_tips`
--
ALTER TABLE `touristic_activity_conduct_tips`
  ADD CONSTRAINT `touristic_activity_conduct_tips_touristic_activities_id_foreign` FOREIGN KEY (`touristic_activities_id`) REFERENCES `touristic_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `touristic_attraction_activities`
--
ALTER TABLE `touristic_attraction_activities`
  ADD CONSTRAINT `touristic_attraction_activities_touristic_activities_id_foreign` FOREIGN KEY (`touristic_activities_id`) REFERENCES `touristic_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `touristic_attraction_activities_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `touristic_attraction_honey_point`
--
ALTER TABLE `touristic_attraction_honey_point`
  ADD CONSTRAINT `touristic_attraction_honey_point_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `touristic_attraction_rules`
--
ALTER TABLE `touristic_attraction_rules`
  ADD CONSTRAINT `touristic_attraction_rules_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `touristic_game_components`
--
ALTER TABLE `touristic_game_components`
  ADD CONSTRAINT `touristic_game_components_touristic_game_id_foreign` FOREIGN KEY (`touristic_game_id`) REFERENCES `touristic_game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tourist_attraction_faq`
--
ALTER TABLE `tourist_attraction_faq`
  ADD CONSTRAINT `tourist_attraction_faq_touristic_attraction_id_foreign` FOREIGN KEY (`touristic_attraction_id`) REFERENCES `touristic_attraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tourist_reviews`
--
ALTER TABLE `tourist_reviews`
  ADD CONSTRAINT `tourist_reviews_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tourist_reviews_tour_package_booking_id_foreign` FOREIGN KEY (`tour_package_booking_id`) REFERENCES `tour_package_bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_company_local_tours_goals`
--
ALTER TABLE `tour_company_local_tours_goals`
  ADD CONSTRAINT `tour_company_local_tours_goals_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_operator`
--
ALTER TABLE `tour_operator`
  ADD CONSTRAINT `tour_operator_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_operator_reservation`
--
ALTER TABLE `tour_operator_reservation`
  ADD CONSTRAINT `tour_operator_reservation_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package`
--
ALTER TABLE `tour_package`
  ADD CONSTRAINT `tour_package_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package_accommodations`
--
ALTER TABLE `tour_package_accommodations`
  ADD CONSTRAINT `tour_package_accommodations_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_accommodations_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package_activities`
--
ALTER TABLE `tour_package_activities`
  ADD CONSTRAINT `tour_package_activities_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_activities_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package_bookings`
--
ALTER TABLE `tour_package_bookings`
  ADD CONSTRAINT `tour_package_bookings_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_bookings_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package_features`
--
ALTER TABLE `tour_package_features`
  ADD CONSTRAINT `tour_package_features_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_features_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package_trips`
--
ALTER TABLE `tour_package_trips`
  ADD CONSTRAINT `tour_package_trips_tour_operator_id_foreign` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_package_trips_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
