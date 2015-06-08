	function ReceiveTabelFilterID(ID, NameTabel, NameTabelHead, Field) {
		$.ajax({
		  cache: false,
		  type: 'POST',
		  url: '/zub123/' + NameTabel + '/filterid',
		  data: {'searchfild':Field,
				 'searchtable':NameTabelHead,
		  		 'search':ID},
		  dataType:	'html',
		  success: function(data){
		    $('.' + NameTabelHead + '_' + ID).html(data);
		  }
		});
	}

	function editselect(response, Name){            if (response != ""){            	resp_obj = JSON.parse(response);				if(typeof resp_obj.area != 'undefined') {$('.controls_' + Name + '_area').html(resp_obj.area);}
				if(typeof resp_obj.city != 'undefined') {$('.controls_' + Name + '_city').html(resp_obj.city);}
				if(typeof resp_obj.city_area != 'undefined') {$('.controls_' + Name + '_city_area').html(resp_obj.city_area);}
				if(typeof resp_obj.locality != 'undefined') {$('.controls_' + Name + '_locality').html(resp_obj.locality);}
				if(typeof resp_obj.street != 'undefined') {$('.controls_' + Name + '_street').html(resp_obj.street);}
				if(typeof resp_obj.add_area != 'undefined') {$('.controls_' + Name + '_add_area').html(resp_obj.add_area);}
				if(typeof resp_obj.street_add_area != 'undefined') {$('.controls_' + Name + '_street_add_area').html(resp_obj.street_add_area);}
			} else {				var flag = false;
				var myArray = [ "region", "area", "city", "city_area", "locality", "street", "add_area", "street_add_area" ];
				for(var i = 0; i < myArray.length; i++)
				{
					 if (flag == true) $('.controls_' + Name + '_' + myArray[i]).html('<select name=""><option value=""></option></select>');					 if (myArray[i] ==	'region') flag = true;
				}
			}
	}

	function get_address(ID, Page, Name){
		$.ajax({
		    url: '/zub123/address/' + Page,
		    type: "post",
		    data: {'search': ID,
		    	   'NameField': Name},
		    dataType: "html",
		    success: function(response){
		    	editselect(response, Name);
		    }
		});
	}