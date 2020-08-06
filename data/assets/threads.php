<?php
ini_set('display_errors', "On");


$thread = findThread($_GET['id'], $threads);

if ($thread === false || $thread['isDeleted']) {
    echo '<h4>お探しの投稿は見つかりませんでした。</h4>';
} else {

    $params = ['content'];
    $paramsSolvedToggle = ['solvedToggle'];
    $paramsDeleteComment = ['id', 'commentId'];

    $addReply = true;
    $solvedToggle = true;
    $deleteComment = true;
    foreach ($params as $param) {
        if (!isset($_POST[$param])) {
            $addReply = false;
        }
    }
    foreach ($paramsSolvedToggle as $param) {
        if (!isset($_POST[$param])) {
            $solvedToggle = false;
        }
    }

    foreach ($paramsDeleteComment as $param) {
        if (!isset($_GET[$param])) {
            $deleteComment = false;
        }
    }

    if ($addReply) {
        $reply = $thread['reply'];
        $date = new DateTime();
        $reply = [
            "id" => isset($reply[0]) ? $reply[0]['id'] + 1 : 0,
            "author" => $userId,
            "content" => $_POST['content'],
            "date" => $date->format(DateTime::ATOM),
            "type" => "reply"
        ];
        array_push($data['threads'][findThread($_GET['id'], $threads, true)]['reply'], $reply);
        saveData($data);
        header('location: ./?id=' . $_GET['id']);
        exit();
    }
    if ($userId == $thread['author']) {
        if ($solvedToggle) {
            $reply = $thread['reply'];
            $date = new DateTime();
            $reply = [
                "id" => isset($reply[0]) ? $reply[0]['id'] + 1 : 0,
                "author" => $userId,
                "content" => $thread['isSolved'] ? 'notSolved' : 'solved',
                "date" => $date->format(DateTime::ATOM),
                "type" => "status"
            ];
            array_push($data['threads'][findThread($_GET['id'], $threads, true)]['reply'], $reply);
            $data['threads'][findThread($_GET['id'], $threads, true)]['isSolved'] = !$thread['isSolved'];
            saveData($data);
            header('location: ./?id=' . $_GET['id']);
            exit();
        }
    }
    if($deleteComment){
        $reply = findThread($_GET['commentId'], $thread['reply']);
        if($reply['author'] == $userId){
            $data['threads'][findThread($_GET['id'], $threads, true)]['reply'][findThread($_GET['commentId'], $thread['reply'], true)]['type'] = 'deleted';
            saveData($data);
        }
    }
?>

    <br><br>
    <div class="row">
        <div class="col s12">
            <a href="./">← 質問ひろばへ</a>
        </div>
    </div>

    <?php

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
    <form method="post" action="./?id=<?= $thread['id'] ?>">
        <?php if ($userId == $thread['author']) { ?>
            <button class="btn waves-effect waves-light right <?= $thread['isSolved'] ? 'red' : ''?>" type="submit" name="solvedToggle">
                <?= $thread['isSolved'] ? '🤔 また迷宮いりした...' : '✅ 解決した！' ?>
            </button>
        <?php } ?>
    </form>
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
    foreach ($replies as $reply) {
        if ($reply['type'] == "reply") {
    ?>
            <div class="card<?php if ($reply['author'] == $userId) echo " yellow lighten-3" ?>">
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
                            <a class='dropdown-trigger' href='#' data-target='dropdown_reply_<?= $reply['id'] ?>'><i class="material-icons">more_vert</i></a>
                        </span></p>
                </div>
            </div>
            <ul id='dropdown_reply_<?= $reply['id'] ?>' class='dropdown-content'>
                <?php if ($reply['author'] == $userId) { ?>
                    <li><a onclick="deleteComment(<?= $reply['id'] ?>)">削除</a></li>
                    <li class="divider" tabindex="-1"></li>
                <?php } ?>
                <li><a onclick="ban();">報告する</a></li>
            </ul><br>

        <?php } else if ($reply['type'] == "status") { ?>
            <div class="card<?php if ($reply['author'] == $userId) echo " yellow lighten-3" ?>">
                <div class="card-content">
                    <p><?= $reply['content'] == "solved" ? '✅ 質問者さんがこのスレッドを"Solved"にマークしました。<br>解決して良かったです👏👏👏' : '🤔 おっと、質問者さんがまたこのスレッドを"Needs help"にマークしたみたいです。' ?></p>
                </div>
            </div><br>
        <?php } else if ($reply['type'] == "deleted") { ?>
            <div class="card<?php if ($reply['author'] == $userId) echo " yellow lighten-3" ?>">
                <div class="card-content">
                    <p class="grey-text"><i>このコメントは削除されました</i></p>
                </div>
            </div><br>
        <?php } ?>
    <?php } ?>
<?php } ?>