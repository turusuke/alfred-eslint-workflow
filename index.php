<?php
$url = 'https://xwxg7mebsb-dsn.algolia.net/1/indexes/*/queries';
$account_data = array(
    'x-algolia-api-key' => "653e00f423bee91f9863571eed16f2f5",
    'x-algolia-application-id'=> "XWXG7MEBSB",
    "x-algolia-agent"=>"Algolia%20for%20vanilla%20JavaScript%203.8.1"
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($account_data)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"requests":[{"indexName":"eslint","params":"query='.$query.'&hitsPerPage=20"}]}');

$res = json_decode(curl_exec($ch));
$filterd = array_filter($res->results[0]->hits, function($v) {
    return $v->category === 'Rules';
});
curl_close($ch);

$obj = array('items' => array());

foreach($filterd as $value) {
    $obj['items'][] = array(
        "uid" => $value->title,
        "title" => $value->title,
        "subtitle" => $value->display_title,
        "arg" => "https://eslint.org".$value->url,
        "autocomplete" => $value->title,
    );
}

print_r(json_encode($obj));

?>