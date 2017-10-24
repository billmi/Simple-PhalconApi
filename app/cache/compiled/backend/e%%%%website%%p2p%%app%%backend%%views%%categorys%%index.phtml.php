<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="<?= $this->url->get('dashboard/index') ?>">控制面板</a>
        </li>
        <li>
            <a href="<?= $this->url->get('categorys/index') ?>">分类管理</a>
        </li>
    </ul>
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            <a href="<?= $this->url->get('categorys/index') ?>">分类管理</a>
            <small>
                <i class="icon-double-angle-right"></i>
                分类列表
            </small>
        </h1>
    </div>
    <div class="col-lg-12">
        <div class="btn-panel">
            <a href="<?= $this->url->get('categorys/write') ?>" class="btn btn-success btn-sm" role="button">新增分类</a>
            <a href="<?= $this->url->get('categorys/refresh') ?>" class="btn btn-pink btn-sm" role="button">清除分类缓存</a>
        </div>
        <div class="table-responsive">
                <table class="table tree-grid table-bordered table-condensed table-hover" id="category-table">
                    <thead>
                        <tr>
                            <th>分类名称</th>
                            <th>缩略名</th>
                            <th>排序</th>
                            <th>更新时间</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <?php if (!empty($categoryList)) { ?>
                        <tbody>
                            <?php foreach ($categoryList as $category) { ?>
                                <?php if (!empty($category['parent_cid'])) { ?>
                                    <tr class="treegrid-<?= $category['cid'] ?> treegrid-parent-<?= $category['parent_cid'] ?>">
                                <?php } else { ?>
                                    <tr class="treegrid-<?= $category['cid'] ?>">
                                <?php } ?>
                                    <td>
                                        <a href="<?= $this->url->get('categorys/write?cid=' . $category['cid']) ?>" title="编辑分类">
                                            <?= $category['category_name'] ?>
                                        </a>
                                    </td>
                                    <td><?= $category['slug'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="category-sort-block" data-name="sort"
                                           data-url="<?= $this->url->get('categorys/savesort') ?>"
                                           data-pk="<?= $category['cid'] ?>" data-type="text"
                                           data-placement="top" data-title="修改分类排序">
                                            <?= $category['sort'] ?>
                                        </a>
                                    </td>
                                    <td><?= $category['modify_time'] ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-success" href="<?= $this->url->get('categorys/write?parentcid=' . $category['cid']) ?>">
                                            <i class="icon-plus bigger-120"></i>
                                        </a>
                                        <a class="btn btn-xs btn-info" href="<?= $this->url->get('categorys/write?cid=' . $category['cid']) ?>">
                                            <i class="icon-edit bigger-120"></i>
                                        </a>
                                        <button class="btn btn-xs btn-danger delete-category" data-url="<?= $this->url->get('categorys/delete?cid=' . $category['cid']) ?>">
                                            <i class="icon-trash bigger-120"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } else { ?>
                        <tbody>
                            <tr>
                                <td colspan="8">暂无数据</td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
        </div>
    </div>
</div>
<link href="<?= $this->url->getStatic('bootstrap-editable/css/bootstrap-editable.css?_v=') . $assetsVersion ?>" rel="stylesheet"/>
<script src="<?= $this->url->getStatic('bootstrap-editable/js/bootstrap-editable.min.js?_v=') . $assetsVersion ?>"></script>
<script>
    $.fn.editable.defaults.mode = 'popup';
    $('.category-sort-block').editable({
        params:function(params){
            params.sort = params.value;
            params.cid = params.pk;
            if(params.sort <= 0 || params.sort > 999){
                params.sort = 999;
            }
            return params;
        },
        success:function(response, value){
            if (typeof response !== 'object') response = JSON.parse(response);
            if(response.code == 1){
                tips_message(response.message, 'success');
            }else{
                tips_message(response.message, 'error');
            }
            return true;
        },
        error:function(response){
            tips_message('网络错误，请重试');
        },
        display:function(value){
            if(value <= 0 || value > 999){
                value = 999;
            }
            $(this).html(value);
        }
    });

    $('.delete-category').on('click', function(){
        var dataUrl = $.trim($(this).attr('data-url'));
        if(!window.confirm('确定要删除选中分类吗？此操作不可挽回')){
            return false;
        }
        window.location.href = dataUrl;
    });
</script>