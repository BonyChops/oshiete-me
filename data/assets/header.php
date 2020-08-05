<nav class="pink lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">おしえてME for 3J</a>
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background pink">
                    </div>
                    <p><img class="circle" src="https://github.com/bonychops.png"></p>
                    <p><span class="white-text name">John Doe</span></p>
                    <p><span class="white-text email">jdandturk@gmail.com</span></p>
                </div>
            </li>
            <li><a href="<?= $loggedIn ? './logout' : googleLoginURI() ?>"><?= $loggedIn ?  'ログアウト' : 'ログイン' ?></a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="javascript: openNav();"><i class="material-icons">menu</i></a></li>
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>

<!-- Modal Structure -->
<div id="warnings" class="modal">
    <div class="modal-content">
        <h4>投稿する前にお読みください</h4>
        <p>有意義な議論の場にするため、最低限以下のことをお守りください。管理人が以下を守れないと判断した場合、勝手に消しちゃうこともあります。</p>
        <p>
            <ol>
                <li>投稿する質問は勉強関連に限定しません。ただし、クラスの大多数にとって利益のないトピックはしないこと(勉強/課題関連は基本OKと思ってください)。</li>
                <li>人を煽ったりけなしたりしないこと。それをされて嫌な気持ちになるのは、この学校でずいぶん学びましたよね？</li>
                <li>質問やコメントを投稿した人を特定しようとしないこと。問題があるものは黙って通報。</li>
                <li>その他不適切なコンテンツを投稿しないこと。目安は親の前で朗読できるかどうか。</li>
            </ol>
        </p>
        <p>といっても、これ以外を守っていただければどんな話題でもOKです。有意義な質問の場づくりにご協力ください🥺
        </p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">同意しない</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">同意して投稿する</a>
    </div>
</div>