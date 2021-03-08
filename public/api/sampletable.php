<?php
if (!empty($_GET['special_basket_checkbox'])) {
    $_POST['special_basket_checkbox'] = 1;
}
if (!empty($_GET['search'])) {
    $response = $_SB->db_samples_fetch_complex($_POST, $_SB->cache->fetch('sample_search'));
} elseif (!empty($_GET['search_light'])) {
    $data[$_GET['field_name_internal']] = $_GET['value'];
    $_SB->db_samples_search_prepare($data, true);
    $response = $_SB->db_samples_fetch_complex($_POST, $_SB->current_fetch('sample_search', true));
} elseif (!empty($_GET['detail'])) {
    $data[$_GET['field_name_internal']] = $_GET['value'];
    $_SB->db_samples_search_prepare($data, true);
    $response = $_SB->db_samples_fetch_complex($_POST, $_SB->current_fetch('sample_search', true), null, 'detail');
} elseif (!empty($_GET['basket'])) {
    $response = $_SB->db_samples_fetch_simple($_POST, true);
} elseif (!empty($_GET['order'])) {
    $response = $_SB->db_samples_fetch_simple($_POST, true, $_GET['order_id']);
} else {
    $response = $_SB->db_samples_fetch_simple($_POST);
}