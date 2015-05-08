# WebScrapper
Flipkart web scrapping tool to get list of product under a single category.
##Documentation 
cURL extension of PHP is used to fetch the content of the website. Various options are specified initially for cURL before it starts execution. These options are as followed.
####1. CURLOPT_URL
The url below produce 20 products depending upon the starting value.
<b>sid</b> is an important field in the below url as it governs the category whose products we want to scrap. 
```php
curl_setopt($ch, CURLOPT_URL,"http://www.flipkart.com/lc/pr/pv1/spotList1/spot1/productList?sid=6bo&filterNone=true&start=".$i+=20);
```
2. CURL
