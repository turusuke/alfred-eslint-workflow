<?php
$url = 'https://bh4d9od16a-dsn.algolia.net/1/indexes/*/queries';
$account_data = array(
    'x-algolia-api-key' => "891b0e977d96c762a3821e0c00172ac9",
    'x-algolia-application-id'=> "BH4D9OD16A",
    "x-algolia-agent"=>"Algolia%20for%20vanilla%20JavaScript%20(lite)%203.24.7%3Bdocsearch.js%202.5.2"
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($account_data)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"requests":[{"indexName":"eslint","params":"query='.$query.'&hitsPerPage=20"}]}');

$res = json_decode(curl_exec($ch));
$filterd = $res->results[0]->hits;
curl_close($ch);

$obj = array('items' => array());

foreach($filterd as $value) {
    $obj['items'][] = array(
        "uid" => $value->anchor,
        "title" => $value->hierarchy->lvl0,
        "subtitle" => $value->hierarchy->lvl1,
        "arg" => $value->url,
        "autocomplete" => $value->anchor,
    );
}

print_r(json_encode($obj));

?>