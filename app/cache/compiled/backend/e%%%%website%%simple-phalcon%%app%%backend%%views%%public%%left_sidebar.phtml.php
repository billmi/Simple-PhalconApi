<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <button class="btn btn-success">
            <i class="icon-signal"></i>
        </button>
        <button class="btn btn-info">
            <i class="icon-pencil"></i>
        </button>
        <button class="btn btn-warning">
            <i class="icon-group"></i>
        </button>
        <button class="btn btn-danger">
            <i class="icon-cogs"></i>
        </button>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>
        <span class="btn btn-info"></span>
        <span class="btn btn-warning"></span>
        <span class="btn btn-danger"></span>
    </div>
</div>
<ul class="nav nav-list" id="sidebar-box">
    <li>
        <a href="<?= $this->url->get('dashboard/index') ?>">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> 控制面板 </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="dropdown-toggle">
            <i class="icon-text-width"></i>
            <span class="menu-text"> 内容管理 </span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li>
                <a href="<?= $this->url->get('articles/index') ?>">
                    <i class="icon-double-angle-right"></i>
                    文章管理
                </a>
            </li>
            <li>
                <a href="<?= $this->url->get('categorys/index') ?>">
                    <i class="icon-double-angle-right"></i>
                    分类管理
                </a>
            </li>
            <li>
                <a href="<?= $this->url->get('tags/index') ?>">
                    <i class="icon-double-angle-right"></i>
                    标签管理
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="dropdown-toggle">
            <i class="icon-cogs"></i>
            <span class="menu-text"> 站点管理 </span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li>
                <a href="<?= $this->url->get('menu/index') ?>">
                    <i class="icon-double-angle-right"></i>导航管理
                </a>
            </li>
            <li>
                <a href="<?= $this->url->get('menu/index') ?>">
                    <i class="icon-double-angle-right"></i>菜单管理
                </a>
            </li>
            <li>
                <a href="<?= $this->url->get('options/base') ?>">
                    <i class="icon-double-angle-right"></i>基本设置
                </a>
            </li>
            <li>
                <a href="<?= $this->url->get('options/read') ?>">
                    <i class="icon-double-angle-right"></i>阅读设置
                </a>
            </li>
        </ul>
    </li>
</ul>
<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>
<script type="text/javascript">
    $('#sidebar-box a').each(function(){
        var href = $.trim($(this).attr('href'));
        if(href == window.location.pathname){
            $(this).parent("li").parent("ul").parent("li").addClass("active").addClass("open");
            $(this).parent("li").addClass("active");
            return false;
        }
    });
</script>