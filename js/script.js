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

	function editselect(response, num){            if (response != ""){            	resp_obj = JSON.parse(response);				if(typeof resp_obj.area != 'undefined') {$('.controls_area').html(resp_obj.area);}
				if(typeof resp_obj.city != 'undefined') {$('.controls_city').html(resp_obj.city);}
				if(typeof resp_obj.city_area != 'undefined') {$('.controls_city_area').html(resp_obj.city_area);}
				if(typeof resp_obj.locality != 'undefined') {$('.controls_locality').html(resp_obj.locality);}
				if(typeof resp_obj.street != 'undefined') {$('.controls_street').html(resp_obj.street);}
				if(typeof resp_obj.add_area != 'undefined') {$('.controls_add_area').html(resp_obj.add_area);}
				if(typeof resp_obj.street_add_area != 'undefined') {$('.controls_street_add_area').html(resp_obj.street_add_area);}
			} else {			var arr = [ "area", "city", "city_area", "locality", "street", "add_area", "street_add_area" ];
			for(var i = num; i<arr.length; i++) {
					$('.controls_' + arr[i]).html('<select name=""><option value=""></option></select>');
			}
			}
	}

	function submitformRegion(ID){		$.ajax({
		    url: '/zub123/address/region',
		    type: "post",
		    data: {'search': ID},
		    dataType: "html",
		    success: function(response){		    	editselect(response, 0);
		    }
		});
	}

	function submitformarea(ID){
		$.ajax({
		    url: '/zub123/address/area',
		    type: "post",
		    data: {search: ID},
		    success: function(response){			editselect(response, 1);
		    },
		    dataType: "html"
		});
	}

	function submitformcity(ID){
		$.ajax({
		    url: '/zub123/address/city',
		    type: "post",
		    data: {search: ID},
		    success: function(response){
			editselect(response, 2);
		    },
		    dataType: "html"
		});
	}

	function submitformcity_area(ID){
		$.ajax({
		    url: '/zub123/address/city_area',
		    type: "post",
		    data: {search: ID},
		    success: function(response){
			editselect(response, 3);
		    },
		    dataType: "html"
		});
	}

	function submitformlocality(ID){
		$.ajax({
		    url: '/zub123/address/locality',
		    type: "post",
		    data: {search: ID},
		    success: function(response){
			editselect(response, 4);
		    },
		    dataType: "html"
		});
	}

	function submitformstreet(ID){
		$.ajax({
		    url: '/zub123/address/street',
		    type: "post",
		    data: {search: ID},
		    success: function(response){
		    editselect(response, 5);
		    },
		    dataType: "html"
		});
	}

	function submitformadd_area(ID){
		$.ajax({
		    url: '/zub123/address/add_area',
		    type: "post",
		    data: {search: ID},
		    success: function(response){
			editselect(response, 6);
		    },
		    dataType: "html"
		});
	}