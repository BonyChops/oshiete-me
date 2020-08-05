<?php
ini_set('display_errors', "On");

$params = ['content'];
$addReply = true;
foreach($params as $param){
    if(!isset($_POST[$param])){
        $addReply = false;
    }
}
if($addReply){
    $thread = findThread($_GET['id'], $threads);
    $reply = $thread['reply'];
    $date = new DateTime();
    $reply = [
        "id" => isset($reply[0]) ? $reply[0]['id'] + 1: 0,
        "author" => $userId,
        "content" => $_POST['content'],
        "date" => $date->format(DateTime::ATOM),
        "type" => "reply"
    ];
    array_unshift($data['threads'][findThread($_GET['id'], $threads, true)]['reply'], $reply);
    saveData($data);
    header('location: ./?id='.$_GET['id']);
    exit();
}
?>

<br><br>
<div class="row">
    <div class="col s12">
        <a href="./">← 質問ひろばへ</a>
    </div>
</div>

<?php
$found = false;
foreach ($threads as $threadSearch) {
    if ($_GET['id'] == $threadSearch['id']) {
        $found = true;
        $thread = $threadSearch;
        break;
    }
}
if (!$found) {
    echo '<h4>お探しの投稿は見つかりませんでした。</h4>';
} else {
?>

    <div class="card<?php if ($thread['author'] == $userId) echo " yellow lighten-3" ?>">
        <div class="card-content">
            <span class="card-title"><?= $thread['isSolved'] ? '✅' : '🤔' ?> <?= $thread['title'] ?>
                <span class="right">
                    <a class='dropdown-trigger' href='#' data-target='dropdown_<?= $thread['id'] ?>'><i class="material-icons">more_vert</i></a>
                </span>
            </span>
            <p><?= nl2br($thread['content']) ?></p>
        </div>
    </div>
    <ul id='dropdown_<?= $thread['id'] ?>' class='dropdown-content'>
        <?php if ($thread['author'] == $userId) { ?>
            <li><a onclick="deleteThread(<?= $thread['id'] ?>)">削除</a></li>
            <li class="divider" tabindex="-1"></li>
        <?php } ?>
        <li><a onclick="ban();">報告する</a></li>
    </ul><br>
    <div class="row">
        <form action="./?id=<?= $_GET['id'] ?>" method="post">
            <div class="input-field col s12">
                <textarea name="content" id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">解答する...</label>
            </div>
            <button class="btn waves-effect waves-light right modal-trigger" type="submit">
                投稿<i class="material-icons right">send</i>
            </button>
        </form>
    </div>
    <p>ページを読み込むたびにユーザー名が変わるよ！(質問者さん以外)</p>
    <?php
    $replies = $thread['reply'];
    $loopCnt = 1;
    $cnt = 0;
    $preData = [];
    shuffle($animals);
    foreach ($replies as $reply) { ?>
        <div class="card<?php if ($reply['author'] == $userId) echo " yellow lighten-3" ?>">
            <a class="btn-floating halfway-fab waves-effect waves-light red center-align"><i class="material-icons">feedback</i></a>
            <div class="card-content">
                <span class="card-title">
                    <?php
                    //Name judgement
                    if ($reply['author'] === $thread['author']) {
                        echo "質問者";
                    } else {
                        if (isset($preData[$reply['author']])) {
                            echo $preData[$reply['author']];
                        } else {
                            $crtName = $animals[$cnt];
                            if ($loopCnt >= 2) {
                                $crtName = $crtName . $loopCnt;
                            }
                            $preData[$reply['author']] = $crtName;
                            echo $crtName;
                            $cnt++;
                            if ($cnt >= count($animals)) {
                                $loopCnt++;
                                $cnt = 0;
                            }
                        }
                    }
                    ?> さん</span>
                <p><?= nl2br($reply['content']) ?> <span class="right">
                        <a class='dropdown-trigger' href='#' data-target='dropdown_<?= $reply['id'] ?>'><i class="material-icons">more_vert</i></a>
                    </span></p>
            </div>
        </div>
        <ul id='dropdown_<?= $reply['id'] ?>' class='dropdown-content'>
            <?php if ($reply['author'] == $userId) { ?>
                <li><a onclick="deleteThread(<?= $reply['id'] ?>)">削除</a></li>
                <li class="divider" tabindex="-1"></li>
            <?php } ?>
            <li><a onclick="ban();">報告する</a></li>
        </ul><br>

    <?php } ?>
<?php } ?>