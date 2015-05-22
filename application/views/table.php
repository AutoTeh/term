<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $Table;?>
<br>
<?PHP if (!$js == ''): ?>

<script type="text/javascript">
	function ReceiveTabelFilterID(ID, NameTabel, NameTabelHead, Field) {
		$.ajax({
		  cache: false,
		  type: 'POST',
		  url: '/zub123/' + NameTabel + '/filterid',
		  data: {'searchfild':Field,
		  		  'search':ID},
		  dataType:	'html',
		  success: function(data){
		    $('.' + NameTabelHead + '_' + ID).html(data);
		  }
		});
	}

    var table_Props_<?php echo $IDTable;?> = {
    	base_path: '/zub123/js/TableFilter/',
    	stylesheet: '/zub123/css/filtergrid.css',
    	popup_filters: true,
        col_<?php echo $CountColTable;?>: "none"
    };
    <?php echo $js; ?>
</script>
<?php endif; ?>


