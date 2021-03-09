-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Erstellungszeit: 09. Mrz 2021 um 18:15
-- Server-Version: 8.0.23
-- PHP-Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `docker`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_cache`
--

CREATE TABLE `db_001_cache` (
  `sample_id` int NOT NULL,
  `ou_id` varchar(255) DEFAULT NULL,
  `kit_id` varchar(255) DEFAULT NULL,
  `pat_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `quant_cell_count` int DEFAULT NULL,
  `quant_her2_neg` int DEFAULT NULL,
  `quant_her2_+` int DEFAULT NULL,
  `quant_her2_++` int DEFAULT NULL,
  `quant_her2_+++` int DEFAULT NULL,
  `quant_date` varchar(255) DEFAULT NULL,
  `proc_cellcelector_done` tinyint(1) DEFAULT NULL,
  `proc_cellcelector_date` varchar(255) DEFAULT NULL,
  `proc_wga_leucocytes` varchar(255) DEFAULT NULL,
  `proc_wga_leucocytes_1` int DEFAULT NULL,
  `proc_wga_leucocytes_2` int DEFAULT NULL,
  `proc_wga_leucocytes_3` int DEFAULT NULL,
  `proc_wga_leucocytes_4` int DEFAULT NULL,
  `proc_wga_leucocytes_5` int DEFAULT NULL,
  `proc_wga_leucocytes_6` int DEFAULT NULL,
  `proc_wga_1` varchar(255) DEFAULT NULL,
  `proc_wga_1_1` int DEFAULT NULL,
  `proc_wga_1_2` int DEFAULT NULL,
  `proc_wga_1_3` int DEFAULT NULL,
  `proc_wga_1_4` int DEFAULT NULL,
  `proc_wga_1_5` int DEFAULT NULL,
  `proc_wga_1_6` int DEFAULT NULL,
  `proc_wga_2` varchar(255) DEFAULT NULL,
  `proc_wga_2_1` int DEFAULT NULL,
  `proc_wga_2_2` int DEFAULT NULL,
  `proc_wga_2_3` int DEFAULT NULL,
  `proc_wga_2_4` int DEFAULT NULL,
  `proc_wga_2_5` int DEFAULT NULL,
  `proc_wga_2_6` int DEFAULT NULL,
  `proc_wga_3` varchar(255) DEFAULT NULL,
  `proc_wga_3_1` int DEFAULT NULL,
  `proc_wga_3_2` int DEFAULT NULL,
  `proc_wga_3_3` int DEFAULT NULL,
  `proc_wga_3_4` int DEFAULT NULL,
  `proc_wga_3_5` int DEFAULT NULL,
  `proc_wga_3_6` int DEFAULT NULL,
  `proc_isolated` int DEFAULT NULL,
  `proc_wbc` int DEFAULT NULL,
  `storage_aliquots_serum` int DEFAULT NULL,
  `storage_cartridge` tinyint(1) DEFAULT NULL,
  `etc_comment` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_cache`
--

INSERT INTO `db_001_cache` (`sample_id`, `ou_id`, `kit_id`, `pat_id`, `project_id`, `quant_cell_count`, `quant_her2_neg`, `quant_her2_+`, `quant_her2_++`, `quant_her2_+++`, `quant_date`, `proc_cellcelector_done`, `proc_cellcelector_date`, `proc_wga_leucocytes`, `proc_wga_leucocytes_1`, `proc_wga_leucocytes_2`, `proc_wga_leucocytes_3`, `proc_wga_leucocytes_4`, `proc_wga_leucocytes_5`, `proc_wga_leucocytes_6`, `proc_wga_1`, `proc_wga_1_1`, `proc_wga_1_2`, `proc_wga_1_3`, `proc_wga_1_4`, `proc_wga_1_5`, `proc_wga_1_6`, `proc_wga_2`, `proc_wga_2_1`, `proc_wga_2_2`, `proc_wga_2_3`, `proc_wga_2_4`, `proc_wga_2_5`, `proc_wga_2_6`, `proc_wga_3`, `proc_wga_3_1`, `proc_wga_3_2`, `proc_wga_3_3`, `proc_wga_3_4`, `proc_wga_3_5`, `proc_wga_3_6`, `proc_isolated`, `proc_wbc`, `storage_aliquots_serum`, `storage_cartridge`, `etc_comment`) VALUES
(1, 'Lab B, Lab A', 'DS_0001', '1', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-06-06', '0/0/0/0/2/0', NULL, NULL, NULL, NULL, NULL, NULL, '6/2/1/0/0/0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL),
(2, 'Lab B, Lab A', 'DS_0002', '3', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0/0/0/0/2/0', NULL, NULL, NULL, NULL, NULL, NULL, '1/4/2/1/1/0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(3, 'Lab B, Lab A', 'DIII_5001', '7', 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0/0/0/0/2/0', NULL, NULL, NULL, NULL, NULL, NULL, '6/2/1/0/0/0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, 'Lab A', 'DS_0020', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(5, 'Lab A', 'DS_0044', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(6, 'Lab A', 'DS_0089', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(7, 'Lab A', 'DS_0101', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(8, 'Lab A', 'DS_0104', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(9, 'Lab A', 'DS_0119', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(10, 'Lab A', 'DIII_5004', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 'Lab A', 'DIII_5010', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(12, 'Lab A', 'DIII_5020', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(13, 'Lab A', 'DIII_5022', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(14, 'Lab A', 'DIII_5026', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 'Lab A', 'DIII_5031', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(16, 'Lab A', 'DIII_5033', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(17, 'Lab A', 'DS_0004', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2, NULL, NULL, NULL),
(18, 'Lab A', 'DIII_5003', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-08-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_fields`
--

CREATE TABLE `db_001_fields` (
  `field_id` int NOT NULL,
  `field_name_internal` varchar(100) NOT NULL,
  `field_name_de` varchar(300) NOT NULL,
  `field_name_en` varchar(300) NOT NULL,
  `field_parent_id` int NOT NULL,
  `field_order` int NOT NULL,
  `field_type` int NOT NULL,
  `field_option_1` int DEFAULT NULL,
  `field_option_2` varchar(255) DEFAULT NULL,
  `field_tooltip` varchar(300) DEFAULT NULL,
  `field_description` text,
  `field_displayed_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_fields`
--

INSERT INTO `db_001_fields` (`field_id`, `field_name_internal`, `field_name_de`, `field_name_en`, `field_parent_id`, `field_order`, `field_type`, `field_option_1`, `field_option_2`, `field_tooltip`, `field_description`, `field_displayed_default`) VALUES
(1, 'ou_id', 'Lab', 'Lab', 1, 1, 8, NULL, NULL, '', '', 0),
(2, 'kit_id', 'Kit ID', 'Kit ID', 1, 2, 6, NULL, NULL, '', '', 0),
(3, 'pat_id', 'Patienten ID', 'Patient ID', 1, 3, 7, NULL, NULL, '', '', 0),
(4, 'project_id', 'Projekt', 'Project', 1, 4, 7, NULL, NULL, '', '', 0),
(5, 'quant_cell_count', 'Zellzahl', 'Cell Count', 2, 1, 2, NULL, NULL, NULL, NULL, 0),
(6, 'quant_her2_neg', 'HER2- Zellen', 'HER2- Cells', 2, 2, 2, NULL, NULL, NULL, NULL, 0),
(7, 'quant_her2_+', 'HER2+ Zellen', 'HER2+ Cells', 2, 3, 2, NULL, NULL, NULL, NULL, 0),
(8, 'quant_her2_++', 'HER2++ Zellen', 'HER2++ Cells', 2, 4, 2, NULL, NULL, NULL, NULL, 0),
(9, 'quant_her2_+++', 'HER2+++ Zellen', 'HER2+++ Cells', 2, 5, 2, NULL, NULL, NULL, NULL, 0),
(10, 'proc_cellcelector_done', 'CellCelector durchgeführt', 'CellCelector performed', 3, 1, 4, NULL, NULL, NULL, NULL, 0),
(11, 'proc_cellcelector_date', 'CellCelector Datum', 'CellCelector Date', 3, 3, 3, NULL, NULL, NULL, NULL, 0),
(12, 'proc_wga_leucocytes', 'WGA Leukozyten (GII)', 'WGA Leucocytes (GII)', 3, 4, 9, 6, NULL, NULL, NULL, 0),
(13, 'proc_wga_1', 'WGA CD45-/CK+/EpCAM+ (GII)', 'WGA CD45-/CK+/EpCAM+ (GII)', 3, 5, 9, 6, NULL, NULL, NULL, 0),
(14, 'proc_wga_2', 'WGA CD45-/CK+/EpCAM- (GII)', 'WGA CD45-/CK+/EpCAM- (GII)', 3, 6, 9, 6, NULL, NULL, NULL, 0),
(15, 'proc_wga_3', 'WGA CD45+/CK+/ EpCAM- (GII)', 'WGA CD45+/CK+/ EpCAM- (GII)', 3, 7, 9, 6, NULL, NULL, NULL, 0),
(16, 'storage_aliquots_serum', 'Serum Aliquot (ml)', 'Serum Aliquot (ml)', 4, 1, 2, NULL, NULL, NULL, NULL, 0),
(17, 'storage_cartridge', 'Cartridge gelagert', 'Cartridge stored', 4, 3, 4, NULL, NULL, NULL, NULL, 0),
(18, 'proc_isolated', 'Isolierte Zellen Anzahl', 'Isolated Cells Count', 3, 8, 2, NULL, NULL, NULL, NULL, 0),
(19, 'proc_wbc', 'Isolierte WBC Anzahl', 'Isolated WBC Count', 3, 9, 2, NULL, NULL, NULL, NULL, 0),
(20, 'quant_date', 'Datum (Quant.)', 'Date (Quant)', 2, 6, 3, NULL, NULL, NULL, NULL, 0),
(21, 'etc_comment', 'Kommentar', 'Comment', 5, 1, 1, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_fields_parents`
--

CREATE TABLE `db_001_fields_parents` (
  `field_parent_id` int NOT NULL,
  `field_parent_name_de` varchar(300) NOT NULL,
  `field_parent_name_en` varchar(300) NOT NULL,
  `field_parent_description` text,
  `field_parent_order` int NOT NULL,
  `field_parent_display_default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_fields_parents`
--

INSERT INTO `db_001_fields_parents` (`field_parent_id`, `field_parent_name_de`, `field_parent_name_en`, `field_parent_description`, `field_parent_order`, `field_parent_display_default`) VALUES
(1, 'Proben Identifikation', 'Sample Identification', NULL, 1, 1),
(2, 'Quantifizierung', 'Quantification', NULL, 2, 1),
(3, 'Prozessierung', 'Processing', NULL, 3, 0),
(4, 'Lagerung', 'Storage', NULL, 4, 0),
(5, 'Weitere Informationen', 'Further Information', NULL, 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_orders`
--

CREATE TABLE `db_001_orders` (
  `order_id` int NOT NULL,
  `order_description` text NOT NULL,
  `order_priority` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `ou_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_orders_basket`
--

CREATE TABLE `db_001_orders_basket` (
  `order_id` int DEFAULT NULL,
  `kit_id` varchar(255) NOT NULL,
  `ou_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_orders_basket`
--

INSERT INTO `db_001_orders_basket` (`order_id`, `kit_id`, `ou_id`) VALUES
(NULL, 'DIII_5001', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_samples`
--

CREATE TABLE `db_001_samples` (
  `sample_id` int NOT NULL,
  `ou_id` int DEFAULT NULL,
  `kit_id` varchar(255) DEFAULT NULL,
  `pat_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `quant_cell_count` int DEFAULT NULL,
  `quant_her2_neg` int DEFAULT NULL,
  `quant_her2_+` int DEFAULT NULL,
  `quant_her2_++` int DEFAULT NULL,
  `quant_her2_+++` int DEFAULT NULL,
  `quant_date` date DEFAULT NULL,
  `proc_cellcelector_done` tinyint(1) DEFAULT NULL,
  `proc_cellcelector_date` date DEFAULT NULL,
  `proc_wga_leucocytes` varchar(255) DEFAULT NULL,
  `proc_wga_leucocytes_1` int DEFAULT NULL,
  `proc_wga_leucocytes_2` int DEFAULT NULL,
  `proc_wga_leucocytes_3` int DEFAULT NULL,
  `proc_wga_leucocytes_4` int DEFAULT NULL,
  `proc_wga_leucocytes_5` int DEFAULT NULL,
  `proc_wga_leucocytes_6` int DEFAULT NULL,
  `proc_wga_1` varchar(255) DEFAULT NULL,
  `proc_wga_1_1` int DEFAULT NULL,
  `proc_wga_1_2` int DEFAULT NULL,
  `proc_wga_1_3` int DEFAULT NULL,
  `proc_wga_1_4` int DEFAULT NULL,
  `proc_wga_1_5` int DEFAULT NULL,
  `proc_wga_1_6` int DEFAULT NULL,
  `proc_wga_2` varchar(255) DEFAULT NULL,
  `proc_wga_2_1` int DEFAULT NULL,
  `proc_wga_2_2` int DEFAULT NULL,
  `proc_wga_2_3` int DEFAULT NULL,
  `proc_wga_2_4` int DEFAULT NULL,
  `proc_wga_2_5` int DEFAULT NULL,
  `proc_wga_2_6` int DEFAULT NULL,
  `proc_wga_3` varchar(255) DEFAULT NULL,
  `proc_wga_3_1` int DEFAULT NULL,
  `proc_wga_3_2` int DEFAULT NULL,
  `proc_wga_3_3` int DEFAULT NULL,
  `proc_wga_3_4` int DEFAULT NULL,
  `proc_wga_3_5` int DEFAULT NULL,
  `proc_wga_3_6` int DEFAULT NULL,
  `proc_isolated` int DEFAULT NULL,
  `proc_wbc` int DEFAULT NULL,
  `storage_aliquots_serum` int DEFAULT NULL,
  `storage_cartridge` tinyint(1) DEFAULT NULL,
  `etc_comment` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_samples`
--

INSERT INTO `db_001_samples` (`sample_id`, `ou_id`, `kit_id`, `pat_id`, `project_id`, `quant_cell_count`, `quant_her2_neg`, `quant_her2_+`, `quant_her2_++`, `quant_her2_+++`, `quant_date`, `proc_cellcelector_done`, `proc_cellcelector_date`, `proc_wga_leucocytes`, `proc_wga_leucocytes_1`, `proc_wga_leucocytes_2`, `proc_wga_leucocytes_3`, `proc_wga_leucocytes_4`, `proc_wga_leucocytes_5`, `proc_wga_leucocytes_6`, `proc_wga_1`, `proc_wga_1_1`, `proc_wga_1_2`, `proc_wga_1_3`, `proc_wga_1_4`, `proc_wga_1_5`, `proc_wga_1_6`, `proc_wga_2`, `proc_wga_2_1`, `proc_wga_2_2`, `proc_wga_2_3`, `proc_wga_2_4`, `proc_wga_2_5`, `proc_wga_2_6`, `proc_wga_3`, `proc_wga_3_1`, `proc_wga_3_2`, `proc_wga_3_3`, `proc_wga_3_4`, `proc_wga_3_5`, `proc_wga_3_6`, `proc_isolated`, `proc_wbc`, `storage_aliquots_serum`, `storage_cartridge`, `etc_comment`) VALUES
(1, 2, 'DS_0001', '1', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0/0/0/0/2/0', NULL, NULL, NULL, NULL, 2, NULL, '6/2/1/0/0/0', 6, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'DS_0001', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-06-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL),
(3, 2, 'DS_0002', '3', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0/0/0/0/2/0', NULL, NULL, NULL, NULL, 2, NULL, '1/4/2/1/1/0', 1, 4, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'DS_0002', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 2, 'DIII_5001', '7', 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0/0/0/0/2/0', NULL, NULL, NULL, NULL, 2, NULL, '6/2/1/0/0/0', 6, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'DIII_5001', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(7, 1, 'DS_0020', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(8, 1, 'DS_0044', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(9, 1, 'DS_0089', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(10, 1, 'DS_0101', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 1, 'DS_0104', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(12, 1, 'DS_0119', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(13, 1, 'DIII_5004', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(14, 1, 'DIII_5010', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 1, 'DIII_5020', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(16, 1, 'DIII_5022', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(17, 1, 'DIII_5026', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(18, 1, 'DIII_5031', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(19, 1, 'DIII_5033', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(20, 1, 'DS_0004', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2, NULL, NULL, NULL),
(21, 1, 'DIII_5003', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-08-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_001_fields`
--

CREATE TABLE `db_001_source_001_fields` (
  `field_id` int NOT NULL,
  `source_field_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `source_field_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_001_fields`
--

INSERT INTO `db_001_source_001_fields` (`field_id`, `source_field_enabled`, `source_field_position`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 0, 5),
(6, 0, 6),
(7, 0, 7),
(8, 0, 8),
(9, 0, 9),
(10, 0, 10),
(11, 0, 11),
(12, 1, 12),
(13, 1, 13),
(14, 0, 14),
(15, 0, 15),
(16, 0, 16),
(17, 0, 17),
(18, 0, 18),
(19, 0, 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_001_interface`
--

CREATE TABLE `db_001_source_001_interface` (
  `sample_id` int NOT NULL,
  `ou_id` int DEFAULT NULL,
  `kit_id` varchar(255) DEFAULT NULL,
  `pat_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `quant_cell_count` int DEFAULT NULL,
  `quant_her2_neg` int DEFAULT NULL,
  `quant_her2_+` int DEFAULT NULL,
  `quant_her2_++` int DEFAULT NULL,
  `quant_her2_+++` int DEFAULT NULL,
  `quant_date` date DEFAULT NULL,
  `proc_cellcelector_done` tinyint(1) DEFAULT NULL,
  `proc_cellcelector_date` date DEFAULT NULL,
  `proc_wga_leucocytes_1` int DEFAULT NULL,
  `proc_wga_leucocytes_2` int DEFAULT NULL,
  `proc_wga_leucocytes_3` int DEFAULT NULL,
  `proc_wga_leucocytes_4` int DEFAULT NULL,
  `proc_wga_leucocytes_5` int DEFAULT NULL,
  `proc_wga_leucocytes_6` int DEFAULT NULL,
  `proc_wga_1_1` int DEFAULT NULL,
  `proc_wga_1_2` int DEFAULT NULL,
  `proc_wga_1_3` int DEFAULT NULL,
  `proc_wga_1_4` int DEFAULT NULL,
  `proc_wga_1_5` int DEFAULT NULL,
  `proc_wga_1_6` int DEFAULT NULL,
  `proc_wga_2_1` int DEFAULT NULL,
  `proc_wga_2_2` int DEFAULT NULL,
  `proc_wga_2_3` int DEFAULT NULL,
  `proc_wga_2_4` int DEFAULT NULL,
  `proc_wga_2_5` int DEFAULT NULL,
  `proc_wga_2_6` int DEFAULT NULL,
  `proc_wga_3_1` int DEFAULT NULL,
  `proc_wga_3_2` int DEFAULT NULL,
  `proc_wga_3_3` int DEFAULT NULL,
  `proc_wga_3_4` int DEFAULT NULL,
  `proc_wga_3_5` int DEFAULT NULL,
  `proc_wga_3_6` int DEFAULT NULL,
  `proc_isolated` int DEFAULT NULL,
  `proc_wbc` int DEFAULT NULL,
  `storage_aliquots_serum` int DEFAULT NULL,
  `storage_cartridge` tinyint(1) DEFAULT NULL,
  `etc_comment` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_001_interface`
--

INSERT INTO `db_001_source_001_interface` (`sample_id`, `ou_id`, `kit_id`, `pat_id`, `project_id`, `quant_cell_count`, `quant_her2_neg`, `quant_her2_+`, `quant_her2_++`, `quant_her2_+++`, `quant_date`, `proc_cellcelector_done`, `proc_cellcelector_date`, `proc_wga_leucocytes_1`, `proc_wga_leucocytes_2`, `proc_wga_leucocytes_3`, `proc_wga_leucocytes_4`, `proc_wga_leucocytes_5`, `proc_wga_leucocytes_6`, `proc_wga_1_1`, `proc_wga_1_2`, `proc_wga_1_3`, `proc_wga_1_4`, `proc_wga_1_5`, `proc_wga_1_6`, `proc_wga_2_1`, `proc_wga_2_2`, `proc_wga_2_3`, `proc_wga_2_4`, `proc_wga_2_5`, `proc_wga_2_6`, `proc_wga_3_1`, `proc_wga_3_2`, `proc_wga_3_3`, `proc_wga_3_4`, `proc_wga_3_5`, `proc_wga_3_6`, `proc_isolated`, `proc_wbc`, `storage_aliquots_serum`, `storage_cartridge`, `etc_comment`) VALUES
(1, 2, 'DS_0001', '1', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 6, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'DS_0002', '3', 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, 4, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'DIII_5001', '7', 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 6, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_002_fields`
--

CREATE TABLE `db_001_source_002_fields` (
  `field_id` int NOT NULL,
  `source_field_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `source_field_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_002_fields`
--

INSERT INTO `db_001_source_002_fields` (`field_id`, `source_field_enabled`, `source_field_position`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 0, 3),
(4, 1, 4),
(5, 0, 5),
(6, 0, 6),
(7, 0, 7),
(8, 0, 8),
(9, 0, 9),
(10, 1, 10),
(11, 1, 11),
(12, 0, 12),
(13, 0, 13),
(14, 0, 14),
(15, 0, 15),
(16, 0, 16),
(17, 0, 17),
(18, 1, 18),
(19, 1, 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_002_interface`
--

CREATE TABLE `db_001_source_002_interface` (
  `sample_id` int NOT NULL,
  `ou_id` int DEFAULT NULL,
  `kit_id` varchar(255) DEFAULT NULL,
  `pat_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `quant_cell_count` int DEFAULT NULL,
  `quant_her2_neg` int DEFAULT NULL,
  `quant_her2_+` int DEFAULT NULL,
  `quant_her2_++` int DEFAULT NULL,
  `quant_her2_+++` int DEFAULT NULL,
  `quant_date` date DEFAULT NULL,
  `proc_cellcelector_done` tinyint(1) DEFAULT NULL,
  `proc_cellcelector_date` date DEFAULT NULL,
  `proc_wga_leucocytes_1` int DEFAULT NULL,
  `proc_wga_leucocytes_2` int DEFAULT NULL,
  `proc_wga_leucocytes_3` int DEFAULT NULL,
  `proc_wga_leucocytes_4` int DEFAULT NULL,
  `proc_wga_leucocytes_5` int DEFAULT NULL,
  `proc_wga_leucocytes_6` int DEFAULT NULL,
  `proc_wga_1_1` int DEFAULT NULL,
  `proc_wga_1_2` int DEFAULT NULL,
  `proc_wga_1_3` int DEFAULT NULL,
  `proc_wga_1_4` int DEFAULT NULL,
  `proc_wga_1_5` int DEFAULT NULL,
  `proc_wga_1_6` int DEFAULT NULL,
  `proc_wga_2_1` int DEFAULT NULL,
  `proc_wga_2_2` int DEFAULT NULL,
  `proc_wga_2_3` int DEFAULT NULL,
  `proc_wga_2_4` int DEFAULT NULL,
  `proc_wga_2_5` int DEFAULT NULL,
  `proc_wga_2_6` int DEFAULT NULL,
  `proc_wga_3_1` int DEFAULT NULL,
  `proc_wga_3_2` int DEFAULT NULL,
  `proc_wga_3_3` int DEFAULT NULL,
  `proc_wga_3_4` int DEFAULT NULL,
  `proc_wga_3_5` int DEFAULT NULL,
  `proc_wga_3_6` int DEFAULT NULL,
  `proc_isolated` int DEFAULT NULL,
  `proc_wbc` int DEFAULT NULL,
  `storage_aliquots_serum` int DEFAULT NULL,
  `storage_cartridge` tinyint(1) DEFAULT NULL,
  `etc_comment` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_002_interface`
--

INSERT INTO `db_001_source_002_interface` (`sample_id`, `ou_id`, `kit_id`, `pat_id`, `project_id`, `quant_cell_count`, `quant_her2_neg`, `quant_her2_+`, `quant_her2_++`, `quant_her2_+++`, `quant_date`, `proc_cellcelector_done`, `proc_cellcelector_date`, `proc_wga_leucocytes_1`, `proc_wga_leucocytes_2`, `proc_wga_leucocytes_3`, `proc_wga_leucocytes_4`, `proc_wga_leucocytes_5`, `proc_wga_leucocytes_6`, `proc_wga_1_1`, `proc_wga_1_2`, `proc_wga_1_3`, `proc_wga_1_4`, `proc_wga_1_5`, `proc_wga_1_6`, `proc_wga_2_1`, `proc_wga_2_2`, `proc_wga_2_3`, `proc_wga_2_4`, `proc_wga_2_5`, `proc_wga_2_6`, `proc_wga_3_1`, `proc_wga_3_2`, `proc_wga_3_3`, `proc_wga_3_4`, `proc_wga_3_5`, `proc_wga_3_6`, `proc_isolated`, `proc_wbc`, `storage_aliquots_serum`, `storage_cartridge`, `etc_comment`) VALUES
(1, 1, 'DS_0001', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-06-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL),
(2, 1, 'DS_0004', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2, NULL, NULL, NULL),
(3, 1, 'DIII_5003', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-08-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_003_fields`
--

CREATE TABLE `db_001_source_003_fields` (
  `field_id` int NOT NULL,
  `source_field_enabled` tinyint(1) NOT NULL,
  `source_field_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_003_fields`
--

INSERT INTO `db_001_source_003_fields` (`field_id`, `source_field_enabled`, `source_field_position`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 0, 3),
(4, 1, 4),
(5, 0, 5),
(6, 0, 6),
(7, 0, 7),
(8, 0, 8),
(9, 0, 9),
(10, 0, 10),
(11, 0, 11),
(12, 0, 12),
(13, 0, 13),
(14, 0, 14),
(15, 0, 15),
(16, 1, 16),
(17, 0, 17),
(18, 0, 18),
(19, 0, 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_003_interface`
--

CREATE TABLE `db_001_source_003_interface` (
  `sample_id` int NOT NULL,
  `ou_id` int DEFAULT NULL,
  `kit_id` varchar(255) DEFAULT NULL,
  `pat_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `quant_cell_count` int DEFAULT NULL,
  `quant_her2_neg` int DEFAULT NULL,
  `quant_her2_+` int DEFAULT NULL,
  `quant_her2_++` int DEFAULT NULL,
  `quant_her2_+++` int DEFAULT NULL,
  `quant_date` date DEFAULT NULL,
  `proc_cellcelector_done` tinyint(1) DEFAULT NULL,
  `proc_cellcelector_date` date DEFAULT NULL,
  `proc_wga_leucocytes_1` int DEFAULT NULL,
  `proc_wga_leucocytes_2` int DEFAULT NULL,
  `proc_wga_leucocytes_3` int DEFAULT NULL,
  `proc_wga_leucocytes_4` int DEFAULT NULL,
  `proc_wga_leucocytes_5` int DEFAULT NULL,
  `proc_wga_leucocytes_6` int DEFAULT NULL,
  `proc_wga_1_1` int DEFAULT NULL,
  `proc_wga_1_2` int DEFAULT NULL,
  `proc_wga_1_3` int DEFAULT NULL,
  `proc_wga_1_4` int DEFAULT NULL,
  `proc_wga_1_5` int DEFAULT NULL,
  `proc_wga_1_6` int DEFAULT NULL,
  `proc_wga_2_1` int DEFAULT NULL,
  `proc_wga_2_2` int DEFAULT NULL,
  `proc_wga_2_3` int DEFAULT NULL,
  `proc_wga_2_4` int DEFAULT NULL,
  `proc_wga_2_5` int DEFAULT NULL,
  `proc_wga_2_6` int DEFAULT NULL,
  `proc_wga_3_1` int DEFAULT NULL,
  `proc_wga_3_2` int DEFAULT NULL,
  `proc_wga_3_3` int DEFAULT NULL,
  `proc_wga_3_4` int DEFAULT NULL,
  `proc_wga_3_5` int DEFAULT NULL,
  `proc_wga_3_6` int DEFAULT NULL,
  `proc_isolated` int DEFAULT NULL,
  `proc_wbc` int DEFAULT NULL,
  `storage_aliquots_serum` int DEFAULT NULL,
  `storage_cartridge` tinyint(1) DEFAULT NULL,
  `etc_comment` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_003_interface`
--

INSERT INTO `db_001_source_003_interface` (`sample_id`, `ou_id`, `kit_id`, `pat_id`, `project_id`, `quant_cell_count`, `quant_her2_neg`, `quant_her2_+`, `quant_her2_++`, `quant_her2_+++`, `quant_date`, `proc_cellcelector_done`, `proc_cellcelector_date`, `proc_wga_leucocytes_1`, `proc_wga_leucocytes_2`, `proc_wga_leucocytes_3`, `proc_wga_leucocytes_4`, `proc_wga_leucocytes_5`, `proc_wga_leucocytes_6`, `proc_wga_1_1`, `proc_wga_1_2`, `proc_wga_1_3`, `proc_wga_1_4`, `proc_wga_1_5`, `proc_wga_1_6`, `proc_wga_2_1`, `proc_wga_2_2`, `proc_wga_2_3`, `proc_wga_2_4`, `proc_wga_2_5`, `proc_wga_2_6`, `proc_wga_3_1`, `proc_wga_3_2`, `proc_wga_3_3`, `proc_wga_3_4`, `proc_wga_3_5`, `proc_wga_3_6`, `proc_isolated`, `proc_wbc`, `storage_aliquots_serum`, `storage_cartridge`, `etc_comment`) VALUES
(1, 1, 'DS_0001', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 1, 'DS_0002', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(3, 1, 'DS_0020', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(4, 1, 'DS_0044', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 1, 'DS_0089', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(6, 1, 'DS_0101', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(7, 1, 'DS_0104', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(8, 1, 'DS_0119', NULL, 'DS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(9, 1, 'DIII_5001', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(10, 1, 'DIII_5004', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 1, 'DIII_5010', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(12, 1, 'DIII_5020', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(13, 1, 'DIII_5022', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(14, 1, 'DIII_5026', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 1, 'DIII_5031', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(16, 1, 'DIII_5033', NULL, 'DIII', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_config`
--

CREATE TABLE `db_001_source_config` (
  `source_id` int NOT NULL,
  `source_name_internal` varchar(50) NOT NULL,
  `source_name_de` varchar(255) NOT NULL,
  `source_name_en` varchar(255) NOT NULL,
  `source_priority` int NOT NULL,
  `source_mode` int NOT NULL DEFAULT '1' COMMENT '1 => normal; 2 => plugin',
  `plugin_name` varchar(250) DEFAULT NULL,
  `source_last_upload` date DEFAULT NULL,
  `source_last_run` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_config`
--

INSERT INTO `db_001_source_config` (`source_id`, `source_name_internal`, `source_name_de`, `source_name_en`, `source_priority`, `source_mode`, `plugin_name`, `source_last_upload`, `source_last_run`) VALUES
(1, '001', 'Source A', 'Source A', 4, 2, 'plugin_demo_1', '2021-03-09', '2021-03-09'),
(2, '002', 'Source B', 'Source B', 2, 2, 'plugin_demo_2', '2021-03-09', '2021-03-09'),
(3, '003', 'Source C', 'Source C', 3, 2, 'plugin_demo_3', '2021-03-09', '2021-03-09');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_001_source_rights`
--

CREATE TABLE `db_001_source_rights` (
  `source_id` int NOT NULL,
  `ou_id` int NOT NULL,
  `source_access_right` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_001_source_rights`
--

INSERT INTO `db_001_source_rights` (`source_id`, `ou_id`, `source_access_right`) VALUES
(1, 1, 2),
(2, 1, 2),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_config`
--

CREATE TABLE `db_config` (
  `db_id` int NOT NULL,
  `ou_id` int NOT NULL,
  `db_name_internal` varchar(10) NOT NULL,
  `db_name_de` varchar(300) NOT NULL,
  `db_name_en` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_config`
--

INSERT INTO `db_config` (`db_id`, `ou_id`, `db_name_internal`, `db_name_de`, `db_name_en`) VALUES
(1, 1, '001', 'Test Datenbank', 'Test Database');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `db_rights`
--

CREATE TABLE `db_rights` (
  `ou_id` int NOT NULL,
  `db_id` int NOT NULL,
  `db_access_right` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `db_rights`
--

INSERT INTO `db_rights` (`ou_id`, `db_id`, `db_access_right`) VALUES
(1, 1, 2),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `main_groups`
--

CREATE TABLE `main_groups` (
  `group_id` int NOT NULL,
  `group_name_de` varchar(300) NOT NULL,
  `group_name_en` varchar(300) NOT NULL,
  `group_right_samples_read` tinyint(1) NOT NULL,
  `group_right_samples_write` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `main_groups`
--

INSERT INTO `main_groups` (`group_id`, `group_name_de`, `group_name_en`, `group_right_samples_read`, `group_right_samples_write`) VALUES
(1, 'Laborleiter', 'PI', 1, 1),
(2, 'Student', 'Student', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `main_ou`
--

CREATE TABLE `main_ou` (
  `ou_id` int NOT NULL,
  `ou_name` varchar(300) NOT NULL,
  `ou_short` varchar(150) NOT NULL,
  `ou_city` varchar(150) NOT NULL,
  `ou_adress` varchar(300) NOT NULL,
  `ou_phone` varchar(150) NOT NULL,
  `ou_fax` varchar(150) NOT NULL,
  `ou_contact` text NOT NULL,
  `ou_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `main_ou`
--

INSERT INTO `main_ou` (`ou_id`, `ou_name`, `ou_short`, `ou_city`, `ou_adress`, `ou_phone`, `ou_fax`, `ou_contact`, `ou_description`) VALUES
(1, 'Lab A', 'Lab A', 'A City', 'A Street', '0800 A', '0900 A', '', ''),
(2, 'Lab B', 'Lab B', 'B City', 'B Street', '0800 B', '0900 B', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `main_users`
--

CREATE TABLE `main_users` (
  `user_id` int NOT NULL,
  `ou_id` int NOT NULL,
  `user_firstname` varchar(300) NOT NULL,
  `user_lastname` varchar(300) NOT NULL,
  `user_alias` varchar(50) NOT NULL,
  `user_sex` varchar(1) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `user_token` varchar(100) NOT NULL,
  `user_token_generated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_mail` varchar(300) NOT NULL,
  `group_id` int NOT NULL,
  `user_language` varchar(2) DEFAULT NULL,
  `user_special` int DEFAULT NULL,
  `user_salutation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `main_users`
--

INSERT INTO `main_users` (`user_id`, `ou_id`, `user_firstname`, `user_lastname`, `user_alias`, `user_sex`, `user_password`, `user_token`, `user_token_generated`, `user_mail`, `group_id`, `user_language`, `user_special`, `user_salutation`) VALUES
(1, 1, 'User A', 'Userius', 'user_a', 'm', '$2y$10$MIFkKqhT1d0oLJVUUD1OrOBMlxLUDM6pARbnS4dLyJ88QtTXgFWb.', '0rVbgOmenIgm4RWSGlPR', '2019-08-04 13:38:08', 'user_a@example.com', 1, NULL, NULL, 'Herr Prof.'),
(2, 2, 'User B', 'Userius', 'user_b', 'w', '$2y$10$MIFkKqhT1d0oLJVUUD1OrOBMlxLUDM6pARbnS4dLyJ88QtTXgFWb.', '0rVbgOmenIgm4RWSGlPR', '2019-08-04 13:38:08', 'user_b@example.com', 1, NULL, NULL, 'Frau Prof.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d1_mapping`
--

CREATE TABLE `z_plugin_d1_mapping` (
  `mapping_id` int NOT NULL,
  `external_field_mysql` varchar(100) NOT NULL,
  `internal_field_mysql` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `z_plugin_d1_mapping`
--

INSERT INTO `z_plugin_d1_mapping` (`mapping_id`, `external_field_mysql`, `internal_field_mysql`) VALUES
(4, 'ctc_count', NULL),
(3, 'date_cellsearch', NULL),
(5, 'DEPArray_Pick_Date', NULL),
(13, 'gii_wga_1_0', 'proc_wga_1_1'),
(14, 'gii_wga_1_1', 'proc_wga_1_2'),
(15, 'gii_wga_1_2', 'proc_wga_1_3'),
(16, 'gii_wga_1_3', 'proc_wga_1_4'),
(17, 'gii_wga_1_4', 'proc_wga_1_5'),
(18, 'gii_wga_1_5', 'proc_wga_1_6'),
(6, 'gii_wga_leucocytes_0', 'proc_wga_leucocytes_1'),
(7, 'gii_wga_leucocytes_1', 'proc_wga_leucocytes_2'),
(8, 'gii_wga_leucocytes_2', 'proc_wga_leucocytes_3'),
(9, 'gii_wga_leucocytes_3', 'proc_wga_leucocytes_4'),
(10, 'gii_wga_leucocytes_4', 'proc_wga_leucocytes_5'),
(11, 'gii_wga_leucocytes_5', 'proc_wga_leucocytes_6'),
(1, 'kit_id_real', 'kit_id'),
(19, 'origin', NULL),
(2, 'pat_id', 'pat_id'),
(12, 'project', 'project_id');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d1_molecular`
--

CREATE TABLE `z_plugin_d1_molecular` (
  `lab_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Fortlaufende Nummer aus Eingangsbuch',
  `pat_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Gibt die ID an, die vom klinischen Zentrum vergeben wird, sie ist patientenspezifisch und gilt für alle abgegebenen Blutproben eines Patienten. Mit ihr kann man in der Alcedis-Datenbank nach Patienteneinträgen suchen.',
  `blood_withdrawal` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Wann war die Blutentnahme?',
  `date_cellsearch` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Wann war der CellSearch-Lauf?',
  `DEPArray_Pick_Date` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Wann war der DEPArray-Lauf bzw. das Pickdatum (für handgepickte Proben)?',
  `cell_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Mit dieser Nummer sind die Tubes beschriftet. TZ = Tumor Cells, NZ = White Blood Cells, PK = Picking control = Blank, ',
  `gii` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Genomic Integrity Index (0 = keine Bande; 1 = KRAS; 2 = 1 lange Bande +/- KRAS; 3 = 2 lange Banden +/- KRAS; 4 = 3 Banden +/- KRAS)',
  `qpcr` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'diese Zellen wurden in der qPCR untersucht (gibt es in den folgenden Spalten keine Angaben, so waren die Zellen ungeeignet für die weiterführenden Analysen/Berechnungen)',
  `interne_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `z_plugin_d1_molecular`
--

INSERT INTO `z_plugin_d1_molecular` (`lab_id`, `pat_id`, `blood_withdrawal`, `date_cellsearch`, `DEPArray_Pick_Date`, `cell_id`, `gii`, `qpcr`, `interne_id`) VALUES
('1', NULL, NULL, NULL, NULL, '001-TZ01', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ02', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ03', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ04', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ05', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-NZ01', '4', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-NZ02', '4', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ06', '0', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ07', '2', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ08', '1', NULL, NULL),
('1', NULL, NULL, NULL, NULL, '001-TZ09', '1', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ01', '3', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ02', '2', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ03', '4', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ04', '1', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ05', '1', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-NZ01', '4', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-NZ02', '4', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ06', '0', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ07', '2', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ08', '1', NULL, NULL),
('2', NULL, NULL, NULL, NULL, '002-TZ09', '1', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ01', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ02', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ03', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ04', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ05', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-NZ01', '4', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-NZ02', '4', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ06', '0', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ07', '2', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ08', '1', NULL, NULL),
('3', NULL, NULL, NULL, NULL, '003-TZ09', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d1_overview`
--

CREATE TABLE `z_plugin_d1_overview` (
  `lab_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Fortlaufende Nummer aus Eingangsbuch',
  `origin` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'In welcher Klinik wurde die Probe generiert (=wo war der CellSearch Lauf)?',
  `kit_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Einmalig vergebene Nummer des Blutentnahme-Kits, die vom klinischen Zentrum (z.B. LMU, Ulm…) vergeben wird. Sie steht immer auf dem Begleitschein unter BlutKit-Nummer (oder aufgedruckt als Stempel z.B. in dieser Form "DIIIXYZ"). Mit ihr kann man in der Alcedis-Datenbank nach Einträgen suchen. Steht hier ein Name, Datum sind das Privatpatienten von denen wir Proben haben. Alle anderen Proben, die nicht mit DIII, DIV, DV beginnen sind Proben aus anderen Studien und somit auch nicht in der DETECT-Datenbank zu finden. Vorsicht: Irrtümlicherweise werden alle Screeningproben mit einer DIII-Kit Nummer versehen, auch wenn der Patient später nicht an dieser Studie, sondern z.B. an DIVb teilnimmt! Das heißt, man kann nicht zwangsläufig von der Detect-Kit Nummer auf die Teilnahme des Patienten schließen. Dies gilt nur für Screeningproben!',
  `pat_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Gibt die ID an, die vom klinischen Zentrum vergeben wird, sie ist patientenspezifisch und gilt für alle abgegebenen Blutproben eines Patienten. Mit ihr kann man in der Alcedis-Datenbank nach Patienteneinträgen suchen. Taucht eine Zahl mehrfach auf, wird diese farblich hinterlegt.',
  `birthday` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Geburtsjahr der Patientin',
  `date_cellsearch` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Wann war der CellSearch-Lauf?',
  `veridex_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Gibt die ID der Veridex-Catridge an, in der sich die angereicherten Zellen befinden (Barcode).',
  `ctc_count` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Gibt die tatsächliche CTC-Anzahl an (laut Arztbefund in der Datenbank).',
  `DEPArray_Pick_Date` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '"Wann war der DEPArray-Lauf bzw. das Pickdatum (für handgepickte Proben)? Wenn die Probe aus dem Bearbeitungsraster fällt= nicht bearbeitet Wenn das Feld ""Gelb"" ist ist die Probe noch nicht bearbeitet worden!"',
  `cellisolation_method` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '"Diese Spalte ist wichtig für die SPSS Auswertung! Sie bezieht sich auf die Art, wie die Zellen vereinzelt wurden.  0 = Manuell am Pickmikroskop,  1 = DEPArray V1 (früher LEX), 2 = DEP Array V2 (ITEM), 3 = DEPArrayNxt"',
  `DEPArray_count` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Gibt die tatsächlich im DEPArray detektierte CTC-Zahl an. ',
  `isolated_wga` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Anzahl der isolierten Single-CTCs des Experimentes, die einer WGA unterzogen wurden. ',
  `ctc_pool` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Anzahl der isolierten CTCPools, die einer WGA unterzogen wurden. ',
  `isolated_wga_wbc` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Anzahl der isolierten Single-WBCs, die einer WGA unterzogen wurden. ',
  `wbc_pool` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Anzahl der isolierten WBCPools, die einer WGA unterzogen wurden. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `z_plugin_d1_overview`
--

INSERT INTO `z_plugin_d1_overview` (`lab_id`, `origin`, `kit_id`, `pat_id`, `birthday`, `date_cellsearch`, `veridex_id`, `ctc_count`, `DEPArray_Pick_Date`, `cellisolation_method`, `DEPArray_count`, `isolated_wga`, `ctc_pool`, `isolated_wga_wbc`, `wbc_pool`) VALUES
('1', 'LMU', 'DIII0001', '1', NULL, '2012-11-11 00:00:00', '4354583', '96', '2012-11-13 00:00:00', '1', '96', '9', '0', '2', '1'),
('2', 'LMU', 'DIII0002', '3', NULL, '2012-12-06 00:00:00', '1033548', '45', '2012-12-08 00:00:00', '1', '45', '6', '0', '2', '1'),
('3', 'LMU', 'DIII5001', '7', NULL, '2012-01-31 00:00:00', '7223207', '1', '2012-02-02 00:00:00', '0', '1', NULL, NULL, NULL, NULL),
('6', 'SB', 'n.a.', 'n.a.', NULL, '2012-08-25 00:00:00', '1321933', '100', '2012-08-27 00:00:00', '0', '100', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d2_data`
--

CREATE TABLE `z_plugin_d2_data` (
  `number` varchar(255) DEFAULT NULL,
  `Pat-ID` varchar(255) DEFAULT NULL,
  `Kit-Nr` varchar(255) DEFAULT NULL,
  `Project` varchar(255) DEFAULT NULL,
  `Date_of_Isolation` varchar(255) DEFAULT NULL,
  `User` varchar(255) DEFAULT NULL,
  `Isolated_Cell_Count` varchar(255) DEFAULT NULL,
  `how_many_time` varchar(255) DEFAULT NULL,
  `Cluster` varchar(255) DEFAULT NULL,
  `WBC` varchar(255) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `z_plugin_d2_data`
--

INSERT INTO `z_plugin_d2_data` (`number`, `Pat-ID`, `Kit-Nr`, `Project`, `Date_of_Isolation`, `User`, `Isolated_Cell_Count`, `how_many_time`, `Cluster`, `WBC`, `Comment`) VALUES
('1', '3D0001', '1256803', 'Detect3', '2014-06-06 00:00:00', 'Martin', '1', NULL, NULL, '2', NULL),
('2', '3D0004', '1256800', 'Detect3', '2014-07-06 00:00:00', 'Martin', '7', NULL, NULL, '2', NULL),
('3', '3D5003', '1289623', 'Detect3', '2014-08-20 00:00:00', 'Martin', '10', NULL, NULL, '3', NULL),
('4', 'Aug 15', '1289624', 'AUG', '2014-09-28 00:00:00', 'Sarah', '3', NULL, NULL, '4', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d2_mapping`
--

CREATE TABLE `z_plugin_d2_mapping` (
  `mapping_id` int NOT NULL,
  `external_field_mysql` varchar(100) NOT NULL,
  `internal_field_mysql` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `z_plugin_d2_mapping`
--

INSERT INTO `z_plugin_d2_mapping` (`mapping_id`, `external_field_mysql`, `internal_field_mysql`) VALUES
(1, 'Kit-Nr', 'kit_id'),
(2, 'Pat-ID', NULL),
(3, 'number', NULL),
(4, 'Date_of_Isolation', 'proc_cellcelector_date'),
(5, 'Isolated_Cell_Count', 'proc_isolated'),
(6, 'Project', 'project_id'),
(7, 'User', NULL),
(8, 'how_many_time', NULL),
(9, 'Cluster', NULL),
(10, 'WBC', 'proc_wbc'),
(11, 'Comment', NULL),
(12, 'single_cells_isolated_cellcelector', 'proc_cellcelector_done');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d3_data`
--

CREATE TABLE `z_plugin_d3_data` (
  `Kiste_Nr` text,
  `Studie` text,
  `SampleID` text,
  `PatID` text,
  `Datum` text,
  `Anzahl_Aliquots` text,
  `ungef_Vol` text,
  `entnommen_am` text,
  `verschickt_nach` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `z_plugin_d3_data`
--

INSERT INTO `z_plugin_d3_data` (`Kiste_Nr`, `Studie`, `SampleID`, `PatID`, `Datum`, `Anzahl_Aliquots`, `ungef_Vol`, `entnommen_am`, `verschickt_nach`) VALUES
('12', 'DIII', '0001', NULL, NULL, '2', '1ml, 0,5 ml', NULL, NULL),
('12', 'DIII', '0002', NULL, NULL, '1', '1,0 ml ', NULL, NULL),
('12', 'DIII', '0020', NULL, NULL, '1', '1,5 ml ', NULL, NULL),
('12', 'DIII', '0044', NULL, NULL, '2', '1 ml ', NULL, NULL),
('12', 'DIII', '0089', NULL, NULL, '3', '1,5 ml ', NULL, NULL),
('12', 'DIII', '0101', NULL, NULL, '3', '0,5 ml ', NULL, NULL),
('12', 'DIII', '0104', NULL, NULL, '2', '1,5 ml ', NULL, NULL),
('12', 'DIII', '0119', NULL, NULL, '1', '1,0 ml ', NULL, NULL),
('13', 'DIII', '5001', NULL, NULL, '2', '1ml', NULL, NULL),
('13', 'DIII', '5004', NULL, NULL, '1', '0,5ml 1,5ml', NULL, NULL),
('13', 'DIII', '5010', NULL, NULL, '1', '0,5 ml ', NULL, NULL),
('13', 'DIII', '5020', NULL, NULL, '2', '1,5 ml ', NULL, NULL),
('13', 'DIII', '5022', NULL, NULL, '3', '1,5 ml ', NULL, NULL),
('13', 'DIII', '5026', NULL, NULL, '3', '0,5 ml ', NULL, NULL),
('13', 'DIII', '5031', NULL, NULL, '2', '1,0', NULL, NULL),
('13', 'DIII', '5033', NULL, NULL, '1', '1,5 ml ', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_plugin_d3_mapping`
--

CREATE TABLE `z_plugin_d3_mapping` (
  `mapping_id` int NOT NULL,
  `external_field_mysql` varchar(100) NOT NULL,
  `internal_field_mysql` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `z_plugin_d3_mapping`
--

INSERT INTO `z_plugin_d3_mapping` (`mapping_id`, `external_field_mysql`, `internal_field_mysql`) VALUES
(1, 'SampleID', 'kit_id'),
(2, 'PatID', 'pat_id'),
(3, 'Datum', NULL),
(4, 'Anzahl_Aliquots', NULL),
(5, 'ungef_Vol', 'storage_aliquots_serum'),
(6, 'Studie', 'project_id'),
(7, 'verschickt_nach', NULL),
(8, 'Kiste_Nr', NULL),
(9, 'entnommen_am', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `db_001_cache`
--
ALTER TABLE `db_001_cache`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `ou_id` (`ou_id`);

--
-- Indizes für die Tabelle `db_001_fields`
--
ALTER TABLE `db_001_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `field_name_internal` (`field_name_internal`),
  ADD UNIQUE KEY `field_parent_id` (`field_parent_id`,`field_order`);

--
-- Indizes für die Tabelle `db_001_fields_parents`
--
ALTER TABLE `db_001_fields_parents`
  ADD PRIMARY KEY (`field_parent_id`),
  ADD UNIQUE KEY `field_parent_order` (`field_parent_order`);

--
-- Indizes für die Tabelle `db_001_orders`
--
ALTER TABLE `db_001_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `db_001_orders_basket`
--
ALTER TABLE `db_001_orders_basket`
  ADD UNIQUE KEY `kit_id` (`kit_id`,`ou_id`);

--
-- Indizes für die Tabelle `db_001_samples`
--
ALTER TABLE `db_001_samples`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `ou_id` (`ou_id`);

--
-- Indizes für die Tabelle `db_001_source_001_fields`
--
ALTER TABLE `db_001_source_001_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indizes für die Tabelle `db_001_source_001_interface`
--
ALTER TABLE `db_001_source_001_interface`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `ou_id` (`ou_id`);

--
-- Indizes für die Tabelle `db_001_source_002_fields`
--
ALTER TABLE `db_001_source_002_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indizes für die Tabelle `db_001_source_002_interface`
--
ALTER TABLE `db_001_source_002_interface`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `ou_id` (`ou_id`);

--
-- Indizes für die Tabelle `db_001_source_003_fields`
--
ALTER TABLE `db_001_source_003_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indizes für die Tabelle `db_001_source_003_interface`
--
ALTER TABLE `db_001_source_003_interface`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `ou_id` (`ou_id`);

--
-- Indizes für die Tabelle `db_001_source_config`
--
ALTER TABLE `db_001_source_config`
  ADD PRIMARY KEY (`source_id`);

--
-- Indizes für die Tabelle `db_001_source_rights`
--
ALTER TABLE `db_001_source_rights`
  ADD UNIQUE KEY `source_id` (`source_id`,`ou_id`);

--
-- Indizes für die Tabelle `db_config`
--
ALTER TABLE `db_config`
  ADD PRIMARY KEY (`db_id`);

--
-- Indizes für die Tabelle `db_rights`
--
ALTER TABLE `db_rights`
  ADD PRIMARY KEY (`ou_id`,`db_id`);

--
-- Indizes für die Tabelle `main_groups`
--
ALTER TABLE `main_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indizes für die Tabelle `main_ou`
--
ALTER TABLE `main_ou`
  ADD PRIMARY KEY (`ou_id`);

--
-- Indizes für die Tabelle `main_users`
--
ALTER TABLE `main_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `z_plugin_d1_mapping`
--
ALTER TABLE `z_plugin_d1_mapping`
  ADD PRIMARY KEY (`mapping_id`),
  ADD UNIQUE KEY `external_field_mysql` (`external_field_mysql`,`internal_field_mysql`);

--
-- Indizes für die Tabelle `z_plugin_d2_mapping`
--
ALTER TABLE `z_plugin_d2_mapping`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indizes für die Tabelle `z_plugin_d3_mapping`
--
ALTER TABLE `z_plugin_d3_mapping`
  ADD PRIMARY KEY (`mapping_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `db_001_cache`
--
ALTER TABLE `db_001_cache`
  MODIFY `sample_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `db_001_fields`
--
ALTER TABLE `db_001_fields`
  MODIFY `field_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `db_001_orders`
--
ALTER TABLE `db_001_orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `db_001_samples`
--
ALTER TABLE `db_001_samples`
  MODIFY `sample_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `db_001_source_001_interface`
--
ALTER TABLE `db_001_source_001_interface`
  MODIFY `sample_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `db_001_source_002_interface`
--
ALTER TABLE `db_001_source_002_interface`
  MODIFY `sample_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `db_001_source_003_interface`
--
ALTER TABLE `db_001_source_003_interface`
  MODIFY `sample_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `db_config`
--
ALTER TABLE `db_config`
  MODIFY `db_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `main_groups`
--
ALTER TABLE `main_groups`
  MODIFY `group_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `main_ou`
--
ALTER TABLE `main_ou`
  MODIFY `ou_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `main_users`
--
ALTER TABLE `main_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `z_plugin_d1_mapping`
--
ALTER TABLE `z_plugin_d1_mapping`
  MODIFY `mapping_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
