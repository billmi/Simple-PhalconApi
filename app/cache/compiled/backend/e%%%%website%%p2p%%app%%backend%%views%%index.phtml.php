<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?= $this->partial('public/header') ?>
</head>
<body>
    <div class="navbar navbar-default" id="navbar">
        <?= $this->partial('public/top_sidebar') ?>
    </div>
    <div class="main-container" id="main-container">
        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="javascript:void(0);">
                <span class="menu-text"></span>
            </a>
            <div class="sidebar" id="sidebar">
                <?= $this->partial('public/left_sidebar') ?>
            </div>
            <div class="main-content">
                <?= $this->getContent() ?>
            </div>
        </div>
    </div>
    <?= $this->partial('public/alert') ?>
    <?= $this->partial('public/footer') ?>
</body>
</html>

