<?php
ini_set('memory_limit', '512M');

if($_SB->db_build($_GET['db_id'], $_GET['source_id']) == false){
    $response = false;
}else{
    $response = true;
}