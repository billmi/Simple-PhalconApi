<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="<?= $this->url->get('dashboard/index') ?>">控制面板</a>
        </li>
        <li>
            <a href="<?= $this->url->get('tags/index') ?>">标签管理</a>
        </li>
    </ul>
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            <a href="<?= $this->url->get('tags/index') ?>">标签管理</a>
            <small>
                <i class="icon-double-angle-right"></i>
                查看
            </small>
        </h1>
    </div>
    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">标签列表</h3>
            </div>
            <div class="panel-body">
                <div class="tags-box">
                    <?php if (!empty($tagsList)) { ?>
                        <ul>
                            <?php $tagclound = ['label-success', 'label-warning', 'label-danger', 'label-info', 'label-inverse', 'label-pink', 'label-yellow', 'label-purple']; ?>
                            <?php foreach ($tagsList as $tagk => $tag) { ?>
                                <li>
                                    <span class="label <?= $tagclound[array_rand($tagclound)] ?> arrowed-in-right arrowed">
                                        <a href="<?= $this->url->get('tags/index?tid=' . $tag['tid']) ?>" title="编辑标签">
                                            <?= $tag['tag_name'] ?>
                                        </a>
                                        <a href="javascript:void(0);" class="delete-tag" data-url="<?= $this->url->get('tags/delete?tid=' . $tag['tid']) ?>" title="删除标签">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        暂无标签数据
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">保存标签</h3>
            </div>
            <div class="panel-body" >
                <form action="<?= $this->url->get('tags/save') ?>" method="post" class="form-horizontal" id="tag-form">
                    <div class="form-group">
                        <label for="tag-name" class="col-sm-2 control-label">标签名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php if (!empty($taginfo)) { ?><?= $taginfo['tag_name'] ?><?php } ?>"
                                   class="form-control" id="tag-name" placeholder="请填写标签名称">
                            <span class="form-tips">标签名称由中英文字符、数字、下划线和横杠组成</span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="tag-slug" class="col-sm-2 control-label">缩略名</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" value="<?php if (!empty($taginfo)) { ?><?= $taginfo['slug'] ?><?php } ?>"
                                   class="form-control" id="taginfo-slug" placeholder="请填写缩略名">
                            <span class="form-tips">标签缩略名用于创建友好的链接形式，建议使用英文字母、数据、下划线和横杠。默认为空</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <?php if (!empty($taginfo['tid'])) { ?>
                                <input type="hidden" name="tid" value="<?= $taginfo['tid'] ?>" />
                                <button type="submit" id="tag-btn" class="btn btn-info btn-sm">保存标签</button>
                            <?php } else { ?>
                                <button type="submit" id="tag-btn" class="btn btn-info btn-sm">新增标签</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-tag').on('click', function(){
        var dataUrl = $.trim($(this).attr('data-url'));
        if(!window.confirm('确定要删除选中标签吗？此操作不可挽回')){
            return false;
        }
        window.location.href = dataUrl;
    });

    $('#tag-btn').on('click', function(){
        var tagName = $.trim($('#tag-name').val());
        var tagNamePattern = /^[\u4e00-\u9fa5\w-]+$/i;
        if(!tagNamePattern.test(tagName)){
            tips_message('标签名称由中英文字符、数字、下划线和横杠组成');
            return false;
        }

        var tagSlug = $.trim($('#tag-slug').val());
        var tagSlugPattern = /^[\w-]+$/i;
        if(tagSlug == true && !tagSlugPattern.test(tagSlug)){
            tips_message('标签缩略名由英文字符、数字、下划线和横杠组成');
            return false;
        }

        $('#tag-form').submit();
    });
</script>