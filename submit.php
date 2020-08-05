<?php
require_once(__DIR__ . '/data/assets/setup.php');
$date = new DateTime();
$thread = [
    "id" => isset($threads[0]) ? $threads[0]['id'] : 0,
    "author" => $userId,
    "title" => $_POST['title'],
    "content" => $_POST['content'],
    "date" => $date->format(DateTime::ATOM),
    "isSolved" => false,
    "reply" => []
];
array_push($data['threads'], $thread);
saveData($data);
header('location: /');