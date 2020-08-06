<?php
require_once(__DIR__ . '/data/assets/setup.php');
if(!isset($userId)){
    header('location: /?error=true');
    exit();
}
$params = ['title', 'content'];
foreach($params as $param){
    if(!isset($_POST[$param])){
        header('location: /?error=true');
        exit();
    }
}
$date = new DateTime();
$thread = [
    "id" => isset($threads[0]) ? $threads[0]['id'] + 1: 0,
    "author" => $userId,
    "title" => $_POST['title'],
    "content" => $_POST['content'],
    "date" => $date->format(DateTime::ATOM),
    "isSolved" => false,
    "isDeleted" => false,
    "reply" => []
];
array_unshift($data['threads'], $thread);
saveData($data);
header('location: ./?success=true');