<script src="<?= $this->url->getStatic('ace/js/ace.min.js?_v=') . $assetsVersion ?>"></script>
<script src="<?= $this->url->getStatic('treegrid/js/jquery.treegrid.js?_v=') . $assetsVersion ?>"></script>
<script src="<?= $this->url->getStatic('assets/js/public.js?_v=') . $assetsVersion ?>"></script>

<script>
    $('.tree-grid').treegrid({
        expanderExpandedClass: 'glyphicon glyphicon-minus',
        expanderCollapsedClass: 'glyphicon glyphicon-plus',
    });
</script>