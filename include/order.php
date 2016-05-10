<style>
.getQuote {
	align: middle;
}

.label {
	font-weight: bold;
}

#table-extradrop td {
	padding-right: 5px;
}
</style>
<?php 
$extraAddr = $_POST['addrExtra'];
$extraLatlng = $_POST['latlngExtra'];
$emptyRow = "<tr><td><input name='extrapoint[]' type='text'>";
$emptyRow .= "<input type='button' value='Find' onclick='findOnMap(this)'><input type='hidden' name='extraLatlng[]'></td>";
$emptyRow .= "<td>[<a class='extra_add' href='javascript:return false;'>++</a>/<a class='extra_minus' href='javascript:return false;'>--</a>]</td></tr>";
$entryRow = "<tr><td><input name='extrapoint[]' type='text' value='$extraAddr'>";
$entryRow .= "<input type='button' value='Find' onclick='findOnMap(this)'><input type='hidden' name='extraLatlng[]' value='$extraLatlng'></td>";
$entryRow .= "<td>[<a class='extra_add' href='javascript:return false;'>++</a>/<a class='extra_minus' href='javascript:return false;'>--</a>]</td></tr>";
?>
<form id="quoteForm">
	<div id="div-fieldset">
		<fieldset>
			<legend>Summary</legend>
			<table border="1" cellspacing="10" cellpadding="10">
				<tr>
					<td><span class='label'>Collection address:</span></td>
					<td><?php echo $_POST['addrCollect']?></td>
				</tr>
				<tr>
					<td><span class='label'>Destination address:</span></td>
					<td><?php echo $_POST['addrDest']?></td>
				</tr>
				<tr>
					<td><span class='label'>Extra drop:</span></td>
					<td><table id='table-extradrop'>
<?php 
if(empty($extraAddr)){
    echo $emptyRow;
}else{
	echo $entryRow;
}
  ?>
  </table></td>
				</tr>
				<tr>
					<td><span class='label'>Pickup time:</span></td>
					<td><?php echo $_POST['dateCollect']."  |  ". $_POST['timeCollect']?></td>
				</tr>
				<tr>
					<td><span class='label'>Return time:</span></td>
					<td><?php echo $_POST['dateReturn']."  |  ".$_POST['timeReturn']?></td>
				</tr>
				<tr>
					<td><span class='label'>Route Options:</span></td>
					<td><input type='button' id='routeOptsBtn' value='Show Route'><span
						id='kilometers'></span><span id='total_time'></span></td>
				</tr>
			</table>

			<input type="hidden" name="latlngCollect"
				value="<?php echo $_POST['latlngCollect']?>"> <input type="hidden"
				name="latlngDest" value="<?php echo $_POST['latlngDest']?>"> <input
				type="hidden" name="addrCollect"
				value="<?php echo $_POST['addrCollect']?>"> <input type="hidden"
				name="addrDest" value="<?php echo $_POST['addrDest']?>"> <input
				type="hidden" name="dateCollect"
				value="<?php echo $_POST['dateCollect']?>"> <input type="hidden"
				name="timeCollect" value="<?php echo $_POST['timeCollect']?>"> <input
				type="hidden" name="dateReturn"
				value="<?php echo $_POST['dateReturn']?>"> <input type="hidden"
				name="timeReturn" value="<?php echo $_POST['timeReturn']?>"> <input
				type="hidden" name="addrExtra"
				value="<?php echo $_POST['addrExtra']?>"> <input type="hidden"
				name="ways" value="<?php echo $_POST['ways'][0]?>"> <input
				type='hidden' name='km'> <input type='hidden' name='hr'>
		</fieldset>
		<br>
		<fieldset>
			<legend>Step 2</legend>
<?php 
$opts = "";
for ($i=1;$i<=70;$i++){
	$opts .= "<option value='".$i."'>".$i."</option>";
}
$jourType=array(
		"Family Event",
		"Business Travel",
		"Wedding",
		"Hens / Bucks Event",
		"Airport Transfer",
		"Sporting Event",
		"Cub or Society",
		"School Trip",
		"Road Show",
		"Cultral Event",
		"Christmas Party",
		"Birthday",
		"Wine Tour",
		"Concert",
		"Show Trip"
);
$jourOpts = "";
foreach ($jourType as $index=>$type){
	$jourOpts .= "<option value='".$index."'>".$type."</option>";
}
?>
<table border="0" cellspacing="5" cellpadding="5">
				<tr>
					<td>Number of passengers<label class='mark-require' for='psnNum'>*</label>:
					</td>
					<td><select id="psnNum" class='required' name="psnNumber">
							<option value="">--------------select--------------</option> <?php echo $opts?>
  </select></td>
					<td><span id='psnNum-msg' class='msg'>Number of passengers is
							required.</span></td>
				</tr>
				<tr>
					<td>Bus type*:</td>
					<td><select id="busType" name="busType">
							<option value="">--------------select--------------</option>
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td>Journey type<label class='mark-require' for='jourType'>*</label>:
					</td>
					<td><select id="jourType" class='required' name="jourType">
							<option value="">--------------select--------------</option> <?php echo $jourOpts?>
  </select></td>
					<td><span id='jourType-msg' class='msg'>Journey type is required.</span></td>
				</tr>
				<tr>
					<td>Contact name<label class='mark-require' for='contactName'>*</label>:
					</td>
					<td><input id='contactName' class='required' type="text"
						name="contactName"></td>
					<td><span id='contactName-msg' class='msg'>Contact name is
							required.</span></td>
				</tr>
				<tr>
					<td>Contact email<label class='mark-require' for='contactEmail'>*</label>:
					</td>
					<td><input id='contactEmail' class='required' type="text"
						name="contactEmail"></td>
					<td><span id='contactEmail-msg' class='msg'>Contact email is
							required.</span></td>
				</tr>
				<tr>
					<td>Mobile number<label class='mark-require' for='mobileNumber'>*</label>:
					</td>
					<td><input id='mobileNumber' class='required' type="text"
						name="mobileNumber"></td>
					<td><span id='mobileNumber-msg' class='msg'>Mobile number is
							required.</span></td>
				</tr>
				<tr>
					<td>Company name:</td>
					<td><input type="text" name="companyName"></td>
					<td></td>
				</tr>
				<tr>
					<td>Notes:</td>
					<td><textarea name="notes" class="resizable"></textarea></td>
					<td></td>
				</tr>
			</table>

			<div class="getQuote _button _button-5">
				<input type="submit" value="Submit Quote"
					style="background: transparent; border: none; width: 100%; line-height: 2em;">
				<div id='validate-msg'></div>
			</div>
		</fieldset>

</form>

<script src="./scripts/jquery-1.11.1.min.js"></script>
<script src="./scripts/jquery.form.js"></script>
<script src="./scripts/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
var select = function(){};
function p(obj){
	var s = "{";
	for(prop in obj){
		s += prop+",";
	}
	s +="}";
	alert(s);
}
/**
 * create proper location options after dropping marker on the map
 */
function createOptions(marker,input,geocoder,index){
	select = function(){
			var val = $('#opts_addrExtra input:radio[name=addr]').val();
			var xlatlng = $('#opts_addrExtra input:radio[name=addr]').attr('latlng');
			$(input).val(val);
			$(document.getElementsByName('extraLatlng[]')[index+1]).val(xlatlng);
			$("#opts_addrExtra").hide();
			$("#map").hide();
			showRoutes();
		};
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
				optsHtml +="<div id='opts-bar'>[<a href='javascript:select()'> OK </a>]  [<a href='javascript:close(opts_addrExtra)'> CLOSE </a>]</div>";
				$("#opts_addrExtra").html(optsHtml).show();
			}
		});
	});
}
/**
 * show location on map
 */
function findOnMap(obj){
	var input = $(obj).prev();
	var index = input.index();
	var val = input.val();
	var geocoder = new google.maps.Geocoder();
	var marker; 
	if(val&&val!=""){
		// add marker to selected location
		geocoder.geocode({'address':val},function(result){
			var dest = result[0].geometry.location;
			input.val(result[0].formatted_address);
			input.next().next().val(dest.toUrlValue());            
		    var options = {
			    zoom: 15,
			    center: dest,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
			var map = new google.maps.Map(document.getElementById("map-content"),options);
			marker = new google.maps.Marker({position:dest,draggable:true});
			marker.setMap(map);
			createOptions(marker,input[0],geocoder,index);
		});
	}else{
		// set default map center
		var latlng = new google.maps.LatLng(-37.817792,144.967229);
		var options = {
			    zoom: 15,
			    center: latlng,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		var map = new google.maps.Map(document.getElementById("map-content"),options);
		marker = new google.maps.Marker({position: latlng, draggable: true});
		marker.setMap(map);
		createOptions(marker,input[0],geocoder,index);
	}
	$('#map').height(380).width(485).show();
}
/**
 * display routes on map based on the selection
 */
function showRoutes(){
	var options = {
		    zoom: 16,
		    center: mapcenter,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	var directionsDisplay = new google.maps.DirectionsRenderer();  
	var directionsService = new google.maps.DirectionsService();
	var map = new google.maps.Map(document.getElementById("map-content"),options);
	directionsDisplay.setMap(map);
	//directionsDisplay.setPanel(document.getElementById('direction-panel'));
	var start = $('input:hidden[name=addrCollect]').val();
	var dest = $('input:hidden[name=addrDest]').val();
	var extrapoints = [];
	var extraLatlng = [];
	$(document.getElementsByName('extrapoint[]')).each(function(index){
		extrapoints.push($(this).val());
	});
	$(document.getElementsByName('extraLatlng[]')).each(function(index){
		extraLatlng.push($(this).val());
	});
	var waypoints = [];
	for(var i =0;i<extraLatlng.length;i++){
		if(!extrapoints[i]||extrapoints[i]==''){
			continue;
		}
		//add extra drop waypoints
		waypoints.push({location:extrapoints[i]});
		//add extra markers on map
		var m = new google.maps.Marker({position:new google.maps.LatLng(extraLatlng[i])});
		m.setMap(map);
	}
	var request = {
			origin:start,
			destination:dest,
			waypoints:waypoints,
			optimizeWaypoints:true,
			travelMode:google.maps.DirectionsTravelMode.DRIVING
		};
	directionsService.route(request,function(response,status){
		if(status==google.maps.DirectionsStatus.OK){
			directionsDisplay.setDirections(response);
			$('#map').show();
			calculateRoute(response);
		}
		
	});
}
function enterToFind(event){
	if(event.keyCode==13){
		$(this).next().click();
	}
}

/**
 * calculate and show route infomation for reference
 */
function calculateRoute(response){
	var legs = response.routes[0].legs;
	var meters = 0;
	var seconds = 0;
	for(var i=0;i<legs.length;i++){
		meters += legs[i].distance.value;
		seconds += legs[i].duration.value;
	}
	$('input:hidden[name=hr]')
	var km = (meters/1000).toFixed(2);
	var time = (seconds/(3600)>>0)+" hours "+seconds%60+" minutes";
	var hr = (seconds/3600).toFixed(2);

	$('input:hidden[name=km]').val(km);
	$('input:hidden[name=hr]').val(hr);

	//show on the page
	$('#kilometers').html(km+" km    ");
	$('#total_time').html(time);
}
$(document).ready(function(){
	$("#psnNum").change(function(){
		$.ajax({
			url:"./include/bustype.php?seat="+$("#psnNum option:selected").val(),
			type:"get",
			dataType:"html",
			success:function(data){
				$("#busType").html(data);
				}});
	});
	
	$('#routeOptsBtn').click(function(){
		showRoutes();
	});
	$("label.mark-require").each(function(index,label){
		var inputId = $(label).attr('for');
		$("#"+inputId).blur(function(event){
			var val = $(this).val();
			if(!val||val==''){
				var id = $(this).addClass('miss').attr('id');
				$('#'+id+'-msg').show();
			}else{
				var id = $(this).removeClass('miss').attr('id');
				$('#'+id+'-msg').hide();
			}
		});
	});
	$('a.extra_add').die().live('click',function(event){
		$("<?php echo $emptyRow?>").appendTo("#table-extradrop").find('input:text[name^=extrapoint]').keypress(enterToFind);
		event.stopPropagation();
		return false;
	});

	$('a.extra_minus').die().live('click',function(event){
		$(event.target).parent().parent().remove();
		return false;
	});

	$(document.getElementsByName('extrapoint[]')).each(function(index){
		$(this).die().live('keypress',enterToFind);
	});

	//process quotation request
	$("#quoteForm").submit(function(){
		var data = $(this).formToArray();
	    $(this).ajaxSubmit({
	        target:"#div-order",
			url:"./include/orderprocess.php",
			data:data,
			type:"post",
			dataType:"html",
			success:function(responseText){
				$("#div-order").html(responseText);
			},
			beforeSubmit:function(){
				var validate = true;
	            $('.required').each(function(){
	                var val = $(this).val();
	                if(!val||val==''){
						$('#validate-msg').html('Some fields are required. Please check your input.').show();
						validate = false;
						return false;
	                }
	            });
	            if(!validate){
					return false;
	            }
	        }
	    });
	    return false;
	});
	showRoutes();
});

</script>
