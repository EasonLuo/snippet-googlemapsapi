var mapcenter;

function return_trip(val){
  if (val == 0)
    document.getElementById("return_section").style.display = 'none';
  else
    document.getElementById("return_section").style.display = 'block';
}
function close(id){
	$(id).hide();
}
function selected(input){
	var val = $('#opts_'+input.id+' input:radio[name=addr]').val();
	var latlng = $('#opts_'+input.id+' input:radio[name=addr]').attr('latlng');
	$(input).val(val);
	var inputName = input.name;;
	var latlngName = inputName.replace(/addr/,'latlng');
	$('input:hidden[name='+latlngName+']').val(latlng);
	$("#opts_"+input.id).hide();
	$("#map").hide();
}
function p(obj){
	var s = "{";
	for(prop in obj){
		s += prop+",";
	}
	s +="}";
	alert(s);
}
function showMap(type){
	var inputId = "addr"+type.charAt(0).toUpperCase().concat(type.substr(1));
	var geocoder = new google.maps.Geocoder();
	var marker; 
	input = document.getElementById(inputId);
	if(input.value&&input.value!=""){
		geocoder.geocode({'address':input.value},function(result){
			var dest = result[0].geometry.location;
			input.value = result[0].formatted_address;   
			$(input).next().val(dest.toUrlValue());
		    var options = {
			    zoom: 15,
			    center: dest,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
			var map = new google.maps.Map(document.getElementById("map-content"),options);
			marker = new google.maps.Marker({position:dest,draggable:true});
			marker.setMap(map);
			createOpts(marker,input,geocoder);
		});
	}else{
		var latlng = new google.maps.LatLng(-37.817792,144.967229);
		var options = {
			    zoom: 15,
			    center: latlng,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		var map = new google.maps.Map(document.getElementById("map-content"),options);
		marker = new google.maps.Marker({position: latlng, draggable: true});
		marker.setMap(map);
		createOpts(marker,input,geocoder);
	}
	

	$('#map').height(380).width(485).show();
}
function createOpts(marker,input,geocoder){
	google.maps.event.addListener(marker,'dragend',function(evt){
		mapcenter = evt.latLng;
		geocoder.geocode({'latLng':evt.latLng},function(data){
			if(data&&data.length>0){
				var optsHtml = "";
				var range = Math.min(data.length,3);
				for(var i =0;i<range;i++){
					var addr = data[i].formatted_address;
					optsHtml += "<input type='radio' name='addr' latlng='"+evt.latLng.toUrlValue()+"' value='"+addr+"'>"+addr+"<br>";
				}
				optsHtml +="<div id='opts-bar'>[<a href='javascript:selected("+input.id+")'> OK </a>]  [<a href='javascript:close(opts_"+input.id+")'> CLOSE </a>]</div>";
				$("#opts_"+input.id).html(optsHtml).find('radio:first').select().end().show();
			}
		});
	});
}
$(document).ready(function(){
	var d = new Date();
	var yStart = d.getFullYear();
	var options = {
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			yearRange:yStart+":"+(yStart+10)};
	$('input:text[name=dateCollect]').datepicker(options);
	$('input:text[name=dateReturn]').datepicker(options); 
    $("#orderForm").submit(function(){
    	$('a.extra_add').die();
    	$('a.extra_minus').die();
    	$(document.getElementsByName('extrapoint[]')).die();
        var data = $(this).formToArray();
        $(this).ajaxSubmit({
            target:"#div-order",
			url:"./include/order.php",
			data:data,
			type:"post",
			dataType:"html",
			success:function(responseText){
				$("#div-order").html(responseText);
		        $("#page").css('display', 'none');
		        $("#summary-page").css('display', 'block');
				}
            });
        return false;
	});

	$("#quoteForm").submit(function(){
		var data = $(this).formToArray();
	    $(this).ajaxSubmit({
	        target:"#div-order",
			url:"./include/orderprocess.php",
			data:data,
			type:"post",
			dataType:"html",
			success:function(responseText){
				$("#div-order").empty().html(responseText);
				}
	        });
	    return false;
	});

    
});
