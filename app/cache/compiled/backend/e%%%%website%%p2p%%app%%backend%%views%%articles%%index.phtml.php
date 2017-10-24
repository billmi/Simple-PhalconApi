<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="<?= $this->url->get('dashboard/index') ?>">控制面板</a>
        </li>
        <li>
            <a href="<?= $this->url->get('articles/index') ?>">文章管理</a>
        </li>
    </ul>
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            <a href="<?= $this->url->get('articles/index') ?>">文章管理</a>
            <small>
                <i class="icon-double-angle-right"></i>
                文章列表
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-2">
                        <select name="cid" class="form-control">
                            <option>请选择分类</option>
                            <?php foreach ($categoryList as $value) { ?>
                                <?php if (!empty($cid) && $cid == $value['cid']) { ?>
                                    <option value="<?= $value['cid'] ?>" selected="selected">
                                <?php } else { ?>
                                    <option value="<?= $value['cid'] ?>">
                                <?php } ?>
                                <?php if ($value['parent_cid'] > 0) { ?>
                                    ├─<?= str_repeat('──', substr_count($value['path'], '/')) ?>
                                    <?= $value['category_name'] ?>
                                <?php } else { ?>
                                    ├─<?= $value['category_name'] ?>
                                <?php } ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="请输入文章标题" <?php if (!empty($keyword)) { ?>value="<?= $keyword ?>"<?php } ?> />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-sm">
                                    搜索
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="btn-panel">
                            <a href="<?= $this->url->get('articles/write') ?>" class="btn btn-success btn-sm" role="button">新增文章</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table tree-grid table-striped table-bordered table-condensed table-hover" id="test-table">
                    <thead>
                        <tr>
                            <th>文章标题</th>
                            <th>分类</th>
                            <th>发布时间</th>
                            <th>更新时间</th>
                            <th>阅读量</th>
                            <th>作者</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <?php if (!empty($articles)) { ?>
                        <tbody>
                            <?php foreach ($articles as $article) { ?>
                                <tr>
                                    <td>
                                        <a href="<?= $this->url->get('articles/write?aid=' . $article['aid']) ?>" title="编辑文章">
                                            <?= $article['title'] ?>
                                        </a>
                                        <?php if ($article['status'] == 2) { ?>
                                            <span class="label label-sm arrowed arrowed-right">
                                                <s>草稿</s>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php foreach ($article['categorys'] as $ck => $cv) { ?>
                                            <?php if ($ck == 0) { ?>
                                                <a href="<?= $this->url->get('articles/index?cid=' . $cv['cid']) ?>" title="查看分类下的文章">
                                                    <?= $cv['category_name'] ?>
                                                </a>
                                            <?php } else { ?>
                                                ,<a href="<?= $this->url->get('articles/index?cid=' . $cv['cid']) ?>" title="查看分类下的文章">
                                                    <?= $cv['category_name'] ?>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td><?= $article['create_time'] ?></td>
                                    <td><?= $article['modify_time'] ?></td>
                                    <td><?= $article['view_number'] ?>次</td>
                                    <td><?= $userinfo['realname'] ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="<?= $this->url->get('articles/write?aid=' . $article['aid']) ?>" title="编辑文章">
                                            <i class="icon-edit bigger-120"></i>
                                        </a>
                                        <?php if ($article['is_top'] == 1) { ?>
                                            <a class="btn btn-xs btn-success" href="<?= $this->url->get('articles/top?type=0&aid=' . $article['aid']) ?>" title="取消置顶">
                                                <i class="icon-arrow-down"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a class="btn btn-xs btn-success" href="<?= $this->url->get('articles/top?type=1&aid=' . $article['aid']) ?>" title="设为置顶">
                                                <i class="icon-arrow-up"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($article['is_recommend'] == 1) { ?>
                                            <a class="btn btn-xs btn-primary" href="<?= $this->url->get('articles/recommend?type=0&aid=' . $article['aid']) ?>" title="取消推荐">
                                                <i class="icon-heart"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a class="btn btn-xs btn-primary" href="<?= $this->url->get('articles/recommend?type=1&aid=' . $article['aid']) ?>" title="设为推荐">
                                                <i class="icon-heart-empty"></i>
                                            </a>
                                        <?php } ?>
                                        <button class="btn btn-xs btn-danger delete-articles" data-url="<?= $this->url->get('articles/delete?aid=' . $article['aid']) ?>" title="删除文章">
                                            <i class="icon-trash bigger-120"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } else { ?>
                        <tbody>
                        <tr>
                            <td colspan="7">暂无数据</td>
                        </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <?php if (!empty($articles)) { ?>
                    <?= $this->partial('public/paginator') ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-articles').on('click', function(){
        var dataUrl = $.trim($(this).attr('data-url'));
        if(!window.confirm('确定要删除选中的文章吗？此操作不可挽回')){
            return false;
        }
        window.location.href = dataUrl;
    });
</script>