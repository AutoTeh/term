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