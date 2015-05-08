<!DOCTYPE HTML>
<html>
<head>
    <link href="css/foundation.css" rel="stylesheet" type="text/css"><!-- Using Foundation HTML Framework -->
    <link href="css/style.css" rel="stylesheet" type="text/css"> <!-- Custom Styling Table and Heading-->
</head>
<body>
<div class="row fullWidth" >
    <div class="small-12 columns small-centered heading"> Flipkart Web Scrapper</div>
</div>

<div class="row" id="data">
    <div class="small-12 columns scrapper">
        <table>
            <tr>
                <th class="serial">Serial</th>
                <th class="item">Item</th>
                <th class="price">Price</th>
            </tr>
<?php
static $i=-19;
static $counter=1; // using static to store old value while incrementing next time
while(1) //using die at the end to stop the loop
{
   //Using Curl to scrap the url.
	$ch= curl_init();// Enabled the Curl and Initialising it.
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"); //defining the User Agent
	curl_setopt($ch, CURLOPT_URL,"http://www.flipkart.com/lc/pr/pv1/spotList1/spot1/productList?sid=6bo&filterNone=true&start=".$i+=20);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 400);
	ini_set('max_execution_time', 300);
	$result=curl_exec ($ch);
	curl_close ($ch);
	if( $result )
	{
	$regex='/<a class="fk-display-block".* href="([^"]*).* title="(.*)"/i';
	preg_match_all($regex, $result, $data, PREG_SET_ORDER);
	$regex='/<span class="fk-font-17 fk-bold">(.*)<\/span>/i';
	preg_match_all($regex, $result,$price, PREG_SET_ORDER);
		if(isset($data[0][0])){
			foreach( $data as $key=>$item) {
						echo "<tr><td class='serial'>".$counter++."</td><td class='item'><a href='http://flipkart.com$item[1]' target='_blank'>$item[2]</a></td><td class='price'>".$price[$key][1]."</td></tr>";

			}

		}
		else
		{
			die("<tr><td colspan=3>No More Products</td></tr>");
		}

	}
}
?>
</table>
    </div>
</div>

</body>
</html>