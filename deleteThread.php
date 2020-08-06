<?php
require_once(__DIR__ . '/data/assets/setup.php');
if(!isset($userId)){
    header('location: /?error=true');
    exit();
}

if(!isset($_GET['id'])){
    header('location: /?error=true');
    exit();
}
$thread = findThread($_GET['id'], $threads);
$threadIndex = findThread($_GET['id'], $threads, true);
if($userId != $thread['author']){
    header('location: /?error=true');
    exit();
}
unset($data['threads'][$threadIndex]);
$data['threads'] = array_values($data['threads']);
var_dump($data);
exit();
saveData($data);
header('location: ./?success=true');