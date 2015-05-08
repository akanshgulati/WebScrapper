# WebScrapper

Flipkart web scrapping tool to get list of product under a single category.

##Documentation 
cURL extension of PHP is used to fetch the content of the website. Various options are specified initially for cURL before it starts execution. These options are as followed.

####CURLOPT_URL

The url below produce 20 products depending upon the starting value. It increments every time while loop is called.
<b>sid</b> is an important field in the below url as it governs the category whose products we want to scrap. 
```php
curl_setopt($ch, CURLOPT_URL,"http://www.flipkart.com/lc/pr/pv1/spotList1/spot1/productList?sid=6bo&filterNone=true&start=".$i+=20);
```
####Timeout

The timeout is being set to higher value so that cURL does not stop after a specific value and while loop can keep on working even after 30 secs( Default Value). The curl connection timeout is set to infinity by specifying 0 as third argument. <b> The cURL timeout</b> has been set to 400 seconds and maximun execution time has been set to 300 seconds.

```php
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 400);
	ini_set('max_execution_time', 300);
```

####Result
The $result variable is storing the scrapped webpage. All the operations are done on this $result data.

```php
$result=curl_exec ($ch);
```
####Regex and Preg_match
Regex variable is stroing the pattern for the preg_match to identify the useful data from the complete source code. The second argument in `preg_match()` function is the $result having complete source code and third variable $data has the result data. <b>PREG_SET_ORDER</b> is used for preg_match_all having multiple data and handling data hierarchically. 

> This perticular block of code captures the url and title of each product
```php
$regex='/<a class="fk-display-block".* href="([^"]*).* title="(.*)"/i';
	preg_match_all($regex, $result, $data, PREG_SET_ORDER);
```
>This block captures the amount of the product
```php
$regex='/<span class="fk-font-17 fk-bold">(.*)<\/span>/i';
	preg_match_all($regex, $result,$price, PREG_SET_ORDER);
```

