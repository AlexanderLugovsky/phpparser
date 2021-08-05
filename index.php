<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_ALL, 'ru_RU');
date_default_timezone_set('Europe/Moscow');
header('Content-type: text/html; charset=utf-8');

$html = file_get_contents('https://rozetka.com.ua/');
//$html = iconv('utf-8//IGNORE', 'windows-1251//IGNORE', $html);

include_once __DIR__ . '/phpQuery/phpQuery.php';
$doc = phpQuery::newDocument($html);

$entry = $doc->find('title');
$data['title'] = pq($entry)->text();
echo $data['title'];
echo '<br>';
// $entry = $doc->find('body meta[name="MSSmartTagsPreventParsing"]');
// $data['keywords'] = pq($entry)->attr('content');
// echo $data['keywords'];

$entry = $doc->find('main-goods__cell ng-star-inserted');
$data['akcia'] = pq($entry)->text();
echo $data['akcia'];


$data['breadcrumbs'] = array();
 
$entry = $doc->find('.main-goods ng-star-inserted');
foreach ($entry as $row) {
	$ent = pq($row);
	$name = $ent->text();
	$url = $ent->attr('href');
	$data['breadcrumbs'][$name] = $url;
}
 
print_r($data['breadcrumbs']);

// Выгрузка документа
//phpQuery::unloadDocuments();
?>