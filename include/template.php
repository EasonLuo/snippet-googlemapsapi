<!-- *************** navigation part *************** -->
<body class="body index clearfix">
  <div class="container">
    <div class="header clearfix">
      <!-- *************** logo *************** -->
      <div class="logo"><a href="/index.php"><img src="/images/logo.png" alt="logo" width="200" height="70"></a></div>
      <!-- *************** menu *************** -->
     <div class="navigation">
        <ul>
          <a href="/index.php"><li class="menu menu-1" id="menu-1">HOME</li></a>
          <a href="/fleet.php"><li class="menu menu-2" id="menu-2">FLEET</li></a>
          <a href="/tours.php"><li class="menu menu-3" id="menu-3">TOURS</li></a>
          <a href="/service.php"><li class="menu menu-4" id="menu-4">SERVICE</li></a>
          <a href="/about.php"><li class="menu menu-5" id="menu-5">ABOUT</li></a>
          <a href="/contact.php"><li class="menu menu-6" id="menu-6">CONTACT</li></a>
        </ul>
      </div>
      <!-- *************** login *************** -->
      <div class="login">
        <form  method="post" action="/lib/Process/loginProcess.php">
            <input type="text" name="username" class="_input _input-1" placeholder="Username"/>
            <input type="password" name="password" class="_input _input-2" placeholder="Password">
            <button class="_button">Login</button>
        </form>
      </div>
    </div>
<!-- *************** slider part *************** -->
    <div class="slider clearfix">
<div id="map" class="map">
<div id="map-title">Please drag the marker to your destination</div>
<div id="opts_addrCollect"></div>
<div id="opts_addrDest"></div>
<div id="opts_addrExtra"></div>
<div id="map-content"></div>
<div id="map-bar">
[<a href="javascript:close(map)">CLOSE</a>]
</div>
</div>
<!-- *************** quotation *************** -->
      <div class="quote">
<?php 
$t = strtotime(date("d-m-Y",time()));
$opts = "";
for($i = 0;$i<24*4;$i++){
	$v = date("H:i",$t+$i*15*60);
	$l = date("H:i A",$t+$i*15*60);
	$opts .= "<option value='".$v."'>".$l."</option>" ;
}
?>

        <p class="text text-7">&nbsp;Rent a bus at low prices</p>
        <form id="orderForm">

        <p class="text text-8">Return&nbsp;&nbsp;
          <input type="radio" name="ways[]" value="2" checked="checked" onclick="return_trip(1)">
        </p>

        <p class="text text-9">One way&nbsp;&nbsp;
          <input type="radio" name="ways[]" value="1"  onclick="return_trip(0)">
        </p>

        <input id="addrCollect" name="addrCollect" class="_input _input-3"></input>
        <input type='hidden' name='latlngCollect'>
        <p class="text text-10">Pick-up Location&nbsp;</p>
        <input type="button" value="Find" class="_button _button-2" onclick="showMap('collect')">

        <input id="addrDest" name="addrDest" class="_input _input-4"></input>
        <input type='hidden' name='latlngDest'>
        <p class="text text-11">Destination Location&nbsp;</p>
        <input type="button" value="Find" class="_button _button-3" onclick="showMap('dest')">

        <input id="addrExtra" name="addrExtra" class="_input _input-5" type="text">
        <input type='hidden' name='latlngExtra'>
        <p class="text text-12">Extra Drop Location&nbsp;</p>
        <input type="button" value="Find" class="_button _button-4" onclick="showMap('extra')">

        <input class="_input _input-6" placeholder="dd-mm-yyyy" value="" id="dateCollect" name="dateCollect" type="text">
        <p class="text text-13">Pick-up Date and Time</p>
        <select name="timeCollect" class="_input _input-7">
          <?php echo $opts ?>
        </select>

    <div id="return_section">
        <input class="_input _input-8" placeholder="dd-mm-yyyy" value="" name="dateReturn" id="dateReturn" type="text">
        <p class="text text-14">Return Date and Time</p>
        <select name="timeReturn" class="_input _input-9">
          <?php echo $opts ?>
        </select>
    </div>

        <input type="submit" class="_button _button-5" value="Get A Quote Now">
</form>
      </div>
    </div>
<!-- *************** main part *************** -->
    <div class="main clearfix">
<!-- *************** main left *************** -->
      <div class="leftsider">
        <div class="contact"></div>
        <div class="route">
          <p class="text">Popular Route</p>
          <div class="route_pic_l">
            <a href="/tour/great_ocean_road.php" >
            <img src="/images/tours/p1_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Great Ocean Road</p>
            </a>
          </div>
          <div class="route_pic_r">
            <a href="/tour/phillip_island.php" >
            <img src="/images/tours/p3_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Phillip Island</p>
            </a>
          </div>
          <div class="route_pic_l">
            <a href="/tour/mt_buller.php" >
            <img src="/images/tours/p7_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Mt Buller</p>
            </a>
          </div>
          <div class="route_pic_r">
            <a href="/tour/sovereign_hill.php" >
            <img src="/images/tours/p5_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Sovereign Hill</p>
            </a>
          </div>
          <div class="route_pic_l">
            <a href="/tour/mornington.php" >
            <img src="/images/tours/p2_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Mornington Hotspring</p>
            </a>
          </div>
          <div class="route_pic_r">
            <a href="/tour/yarra_valley.php" >
            <img src="/images/tours/p6_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Yarra Valley</p>
            </a>
          </div>
          <div class="route_pic_l">
            <a href="/tour/stonelea.php" >
            <img src="/images/tours/p12_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Stonelea Estate</p>
            </a>
          </div>
          <div class="route_pic_r">
            <a href="/tour/lake_moutain.php" >
            <img src="/images/tours/p11_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Lake Moutain</p>
            </a>
          </div>
          <div class="route_pic_l">
            <a href="/tour/city_tour.php" >
            <img src="/images/tours/p9_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Melbourne City Tour</p>
            </a>
          </div>
          <div class="route_pic_r">
            <a href="../tour/mornington_winery.php" >
            <img src="/images/tours/p8_s_sale.jpg" alt="" class="routepic">
            <p class="routename">Mornington Winery</p>
            </a>
          </div>
          <div class="route_pic_l">
          </div>
          <div class="route_pic_r">
          </div>
        </div>

      </div>

<!-- *************** main right page for order summary*************** -->
      <div class="page" id="summary-page">
        <p class="title">Order Summary</p>
        <div class="content">
          <div id="div-order"></div>
        </div>
      </div>
