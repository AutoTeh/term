<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<?php echo $Table;?>

<?PHP if (!$js == ''): ?>

<script type="text/javascript">
    var table_Props_<?php echo $IDTable;?> = {
    	base_path: '/zub123/js/TableFilter/',
    	stylesheet: '/zub123/css/filtergrid.css',
    	popup_filters: true,
    	paging: true,
        paging_length: 30,
        btn_next_page_html: '<a href="javascript:;" style="margin:3px;">Далее</a>',
        btn_prev_page_html: '<a href="javascript:;" style="margin:3px;">Назад</a>',
        btn_last_page_html: '<a href="javascript:;" style="margin:3px;">>></a>',
        btn_first_page_html: '<a href="javascript:;" style="margin:3px;"><<</a>',
        loader: true,
        loader_html: '<h5 style="color:red;">Загрузка, подождите...</h4>',
        col_<?php echo $CountColTable;?>: "none"
    };
    <?php echo $js; ?>
</script>
<?php endif; ?>


