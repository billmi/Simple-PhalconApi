<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="<?= $this->url->get('dashboard/index') ?>">控制面板</a>
        </li>
    </ul>
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            <a href="<?= $this->url->get('dashboard/index') ?>">控制面板</a>
            <small>
                <i class="icon-double-angle-right"></i>
                查看
            </small>
        </h1>
    </div>
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="icon-remove"></i>
        </button>
        <i class="icon-ok green"></i>
        欢迎使用
        <strong class="green">
            PhalconCMS博客系统
            <small>(v<?= $appVersion ?>)</small>
        </strong>
        ,轻量级高性能易用的博客系统.
    </div>
    <div class="col-sm-6 infobox-container">
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $articlesCount ?></span>
                <div class="infobox-content">
                    <a href="<?= $this->url->get('articles/index') ?>">
                        文章总数
                    </a>
                </div>
            </div>
        </div>
        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="icon-folder-open"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $categorysCount ?></span>
                <div class="infobox-content">
                    <a href="<?= $this->url->get('categorys/index') ?>">
                        分类总数
                    </a>
                </div>
            </div>
        </div>
        <div class="infobox infobox-pink">
            <div class="infobox-icon">
                <i class="icon-pencil"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $tagsCount ?></span>
                <div class="infobox-content">
                    <a href="<?= $this->url->get('tags/index') ?>">
                        标签总数
                    </a>
                </div>
            </div>
        </div>
        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number">1</span>
                <div class="infobox-content">用户总数</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5>
                    <i class="icon-home"></i>
                    系统信息
                </h5>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>团队成员</td>
                                <td> <a href="http://www.marser.cn" target="_blank">Marser</a></td>
                            </tr>
                            <tr>
                                <td>项目代码</td>
                                <td>
                                    <a href="http://git.oschina.net/KevinJay/PhalconCMS" target="_blank">http://git.oschina.net/KevinJay/PhalconCMS</a>
                                </td>
                            </tr>
                            <tr>
                                <td>域名/IP地址</td>
                                <td><?= $systemInfo['serverName'] ?>(<?= $systemInfo['serverIp'] ?>)</td>
                            </tr>
                            <tr>
                                <td>服务器操作系统</td>
                                <td><?= $systemInfo['osName'] ?> 内核版本：<?= $systemInfo['osVersion'] ?></td>
                            </tr>
                            <tr>
                                <td>HTTP服务器</td>
                                <td><?= $systemInfo['serverSoftware'] ?></td>
                            </tr>
                            <tr>
                                <td>服务器语言</td>
                                <td><?= $systemInfo['serverLanguage'] ?></td>
                            </tr>
                            <tr>
                                <td>服务器端口</td>
                                <td><?= $systemInfo['serverPort'] ?></td>
                            </tr>
                            <tr>
                                <td>PhalconCMS版本</td>
                                <td><?= $appVersion ?></td>
                            </tr>
                            <tr>
                                <td>PHP版本</td>
                                <td><?= $systemInfo['phpVersion'] ?></td>
                            </tr>
                            <tr>
                                <td>PHP运行方式</td>
                                <td><?= $systemInfo['phpSapi'] ?></td>
                            </tr>
                            <tr>
                                <td>官方QQ群</td>
                                <td>
                                    <div>
                                        广州PHP高端交流群
                                        <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=93dbebc7853f082777b02ef5c239e0b44e7d8d1f8b32b0715055e0fd1d878143">
                                            <img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="广州PHP高端交流" title="广州PHP高端交流">
                                        </a>（158587573）
                                    </div>
                                    <div>
                                        Phalcon玩家群
                                        <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=dd908259341163c58a28af9039179371c8dffa2c94c9252185da60bdf6c912d1">
                                            <img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="Phalcon玩家" title="Phalcon玩家">
                                        </a>（150237524）
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>