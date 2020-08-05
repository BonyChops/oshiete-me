<?php
$dataPath = __DIR__ . '/data/data.json';
$data = file_exists($dataPath) ? file_get_contents($dataPath) : [
    "threads"=> [],
    "oauthTokens"=> []
];
$threads = $data['threads'];
$oauthTokens = $data['oauthTokens'];
?>