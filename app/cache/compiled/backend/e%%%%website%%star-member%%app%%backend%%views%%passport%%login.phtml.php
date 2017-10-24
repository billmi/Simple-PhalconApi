<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?= $this->url->getStatic('bootstrap/css/bootstrap.min.css?_v=') . $assetsVersion ?>" rel="stylesheet" />
    <link href="<?= $this->url->getStatic('assets/css/style.css?_v=') . $assetsVersion ?>" rel="stylesheet" />
</head>
<body>
    <style type="text/css">
        body{
            background:#f1f1f1;
        }
    </style>
    <div class="login-box-wrap">
        <div class="login-box">
            <h3 class="login-logo">PhalconCMS博客系统</h3>
            <form action="<?= $this->url->get('passport/login') ?>" method="post" name="login-form" id="login-form">
                <div class="login-input">
                    <input type="text" name="username" id="username" class="form-control" placeholder="用户名"
                           aria-describedby="basic-addon1" maxlength="20" autocomplete="off">
                </div>
                <div class="login-input">
                    <input type="password" name="password" id="password" class="form-control" placeholder="密码"
                           aria-describedby="sizing-addon1" maxlength="32" autocomplete="off">
                </div>
                <button type="button" class="btn btn-success" id="login-btn">登录</button>
            </form>
        </div>
    </div>

    <script src="<?= $this->url->getStatic('ace/js/jquery-2.0.3.min.js?_v=') . $assetsVersion ?>"></script>
    <script src="<?= $this->url->getStatic('bootstrap/js/bootstrap.min.js?_v=') . $assetsVersion ?>"></script>
    <script src="<?= $this->url->getStatic('assets/js/public.js?_v=') . $assetsVersion ?>"></script>
    <script>
        $('#login-btn').on('click', function(){
            var username = $.trim($('#username').val());
            var usernamePattern = /^[\w-]{4,20}$/i;
            if(!usernamePattern.test(username)){
                tips_message('用户名由4-20个英文字符、数字、中下划线组成');
                return false;
            }

            var password = $.trim($('#password').val());
            if(password.length < 6 || password.length > 32){
                tips_message('密码由6-32个字符组成');
                return false;
            }

            $('#login-form').submit();
        });
    </script>

    <?= $this->partial('public/alert') ?>
</body>
</html>