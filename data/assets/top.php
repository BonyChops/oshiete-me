<h4>質問ひろば</h4>

<select>
    <?php
    if(!isset($_GET['category'])){
        $i = 0;
    }else{
        switch($_GET['category']){
            case 'notSolved':
                $i = 1;
                break;
            case 'solved':
                $i = 2;
                break;
            default:
                $i = 0;
                break;
        }
    }
    $values = ['all', 'notSolved', 'solved'];
    $names = ['全て', '🤔 Needs help', '✅ Solved'];
    $_ = function($s){return $s;};
    foreach($values as $key => $value){
        echo "<option value=\"$value\"{$_($_GET['category'] == $value ? ' selected ' : '')}>{$_($names[$key])}</option>";
    }
    ?>
</select>
<label>カテゴリ</label>



<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a id="create" href="<?= $loggedIn ? '?id=create' : googleLoginURI() ?>" class="btn btn-floating btn-large cyan">
        <i class="material-icons">create</i>
    </a>
</div>
<!-- Tap Target Structure -->
<div class="tap-target" data-target="create">
    <div class="tap-target-content">
        <h5>ようこそ！</h5>
        <p>ここから新しい質問を投げられます</p>
    </div>
</div>

<?php
//var_dump($threads);
foreach ($threads as $thread) {
    if ($thread['isDeleted']) {
        continue;
    }
    if (isset($_GET['category'])) {
        if ($_GET['category'] == "notSolved" && $thread['isSolved']) {
            continue;
        }
        if ($_GET['category'] == "solved" && !$thread['isSolved']) {
            continue;
        }
    }
?>
    <div class="card<?php if ($thread['author'] == $userId) echo " yellow lighten-3" ?>">
        <a href="?id=<?= $thread['id'] ?>" class="btn-floating halfway-fab waves-effect waves-light red center-align">
            <?php
            if (count($thread['reply']) === 0) {
                echo '<i class="material-icons">comment</i>';
            } else {
                echo count($thread['reply']);
            }
            ?></a>
        <div class="card-content">
            <span class="card-title"><a href="?id=<?= $thread['id'] ?>" class="box-link"><?= $thread['isSolved'] ? '✅' : '🤔' ?> <?= $thread['title'] ?></a>
                <span class="right">
                    <a class='dropdown-trigger' href='#' data-target='dropdown_<?= $thread['id'] ?>'><i class="material-icons">more_vert</i></a>
                </span>
            </span>
            <p><?= mb_substr($thread['content'], 0, 20) ?></p>
        </div>
    </div>
    <ul id='dropdown_<?= $thread['id'] ?>' class='dropdown-content'>
        <?php if ($thread['author'] == $userId) { ?>
            <li><a onclick="deleteThread(<?= $thread['id'] ?>)">削除</a></li>
            <li class="divider" tabindex="-1"></li>
        <?php } ?>
        <li><a onclick="ban();">報告する</a></li>
    </ul>
    <br>
<?php } ?>