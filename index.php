<?php
require_once(__DIR__ . '/data/assets/setup.php');
?>

<!DOCTYPE html>
<html>

<?php require_once(__DIR__ . '/data/assets/head.php'); ?>

<body>
    <?php require_once(__DIR__ . '/data/assets/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <?php
                if (!isset($_GET['id'])) {
                    require_once(__DIR__ . '/data/assets/top.php');
                } else {
                    if ($_GET['id'] === 'create') {
                        require_once(__DIR__ . '/data/assets/create.php');
                    } else {
                        require_once(__DIR__ . '/data/assets/threads.php');
                    }
                } ?>
            </div>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/select.js"></script>
    <script>
        const sleep = (sec) => {
            return new Promise(resolve => setTimeout(resolve, sec * 1000))
        }

        $(document).ready(() => {
            $('.sidenav').sidenav();
            $('select').formSelect();
            $('.tap-target').tapTarget();
            $('.modal').modal();
            $('.dropdown-trigger').dropdown();
            //openAndClose();
        });
        const openAndClose = async () => {
            M.TapTarget.getInstance($('.tap-target')).open();
            await sleep(3);
            M.TapTarget.getInstance($('.tap-target')).close();
        }

        const deleteThread = (id) => {
            $('delete-btn').attr('href', 'deleteThread?id='+id);
            M.Modal.getInstance($('#delete')).open();
        }

        const check = () => {
            const pattern = /.*\S+.*/
            if($('input#title').val().match(pattern) === null){
                M.toast({html: '空白のまま投稿することはできません。'})
                return false
            }
            if($('textarea#content').val().match(pattern) === null){
                M.toast({html: '空白のまま投稿することはできません。'})
                return false;
            }
            M.Modal.getInstance($('#warnings')).open();
        }

        const submit = () => {
            document.create_form.submit();
        }

        const openNav = () => {
            M.Sidenav.getInstance($('#slide-out')).open();
        }

        const ban = () => {
            alert("良くないコンテンツを発見しましたか？ごめんなさい、通報フォームは作っていません。。。\n管理者にDiscordなりでそっと教えてね。");
        }
    </script>
</body>

</html>