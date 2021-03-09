<?php
require_once(__DIR__ . '/../lib/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$_POST['data_plain'] = true;
if (!empty($_GET['search'])) {
    $data_SSP = $_SB->db_samples_fetch_complex($_POST, $_SB->cache->fetch('sample_search'));
} elseif (!empty($_GET['search_light'])) {
    $data[$_GET['field_name_internal']] = $_GET['value'];
    $_SB->db_samples_search_prepare($data, true);
    $data_SSP = $_SB->db_samples_fetch_complex($_POST, $_SB->current_fetch('sample_search', true));
} elseif (!empty($_GET['detail'])) {
    $data[$_GET['field_name_internal']] = $_GET['value'];
    $_SB->db_samples_search_prepare($data, true);
    $data_SSP = $_SB->db_samples_fetch_complex($_POST, $_SB->current_fetch('sample_search', true), null, 'detail');
} elseif (!empty($_GET['basket'])) {
    $data_SSP = $_SB->db_samples_fetch_simple($_POST, true);
} elseif (!empty($_GET['order'])) {
    $data_SSP = $_SB->db_samples_fetch_simple($_POST, true, $_GET['order_id']);
} else {
    $data_SSP = $_SB->db_samples_fetch_simple($_POST);
}

$data_SSP[-1] = $_SB->pluck($_SB->db_fields_fetch(false)['flat_ordered'], 'field_name_de');
ksort($data_SSP);
$spreadSheet = new Spreadsheet();
$workSheet = $spreadSheet->getActiveSheet();
$workSheet->fromArray($data_SSP, null, 'A1');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="vibiba.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
$writer->save('php://output');
exit;