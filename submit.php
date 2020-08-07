<?php
require_once(__DIR__ . '/data/assets/setup.php');
if (!isset($userId)) {
    header('location: /?error=true');
    exit();
}
$params = ['title', 'content'];
foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        header('location: /?error=true');
        exit();
    }
}
if (mb_strlen($title) >= 50) {
    header('location: /?error=true');
    exit();
}
$date = new DateTime();
$id = isset($threads[0]) ? $threads[0]['id'] + 1 : 0;
$thread = [
    "id" => $id,
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

if(isset($_POST['discord'])){
    $url = $_SERVER['SERVER_NAME'].substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'],'submit'));
    var_dump($url);
    $result = feedbackDiscord($_POST['title'], $_POST['content'], $url);
    var_dump($result);
    exit();
}

header('location: ./?success=true');

function feedbackDiscord($title, $content, $url)
{
    $uri = DISCORD_WEBHOCK;
    $ch = curl_init();
    $headers = [
        "HTTP/1.0",
        'Content-type: application/json'
    ];
    $params = [
        "username" => "おしえてME",
        "content" => "新しいトピックが投稿されました",
        "embeds" => [
            [
                "title" => $title,
                "description" => "```" . $content . "```\n[回答する](".$url.")",
                "url" => $url,
                "timestamp" => new DateTime(),
                "color" => 5620992
            ]
        ]
    ];
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result =  curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}
