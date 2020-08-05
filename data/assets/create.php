<br><br>
<div class="row">
    <div class="col s12">
        <a href="#">← 質問ひろばへ</a>
    </div>
</div>
<h4>質問する</h4>
<p>有識者〜〜〜〜〜助けてくれ〜〜〜〜〜🥺🥺🥺</p>
<br><br>
<div class="row">
    <form name="create" class="col s12" method="post" onsubmit="return check();">
        <div class="row">
            <h5>タイトル</h5>
            <div class="input-field col s12">
                <input id="title"  pattern=".*\S+.*" required type="text">
                <label for="title">わかりやすくて簡潔なタイトル...</label>
                <span class="helper-text" data-error="空白で投稿はできません" data-success="">Helper text</span>
            </div>
            <h5>内容</h5>
            <div class="input-field col s12">
                <textarea id="textarea1" required pattern=".*\S+.*" class="materialize-textarea"></textarea>
                <label for="textarea1">内容(改行OK)...</label>
                <span class="helper-text" data-error="空白で投稿はできません" data-success="">Helper text</span>
            </div>
            <button class="btn waves-effect waves-light right modal-trigger" type="submit">
                投稿<i class="material-icons right">send</i>
            </button>
        </div>
    </form>

</div>