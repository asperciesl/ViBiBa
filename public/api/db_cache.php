<?php
ini_set('memory_limit','512M');
if (empty($_GET['db_id'])) {
    exit();
}
if($_SB->db_source_cache($_GET['db_id']) == true){
    $response = true;
}else{
    $response = false;
}