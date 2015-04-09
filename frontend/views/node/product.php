<?php
use yii\helpers\Html;
use yii\grid\GridView;

if ($isContent == 0){
	foreach ($modelItem as $item) {
		echo $item->title . " - " . $item->body . "<br>";
	}
} else {
	echo $modelItem->title . "<br>";
	echo $modelItem->description . "<br>";
	echo $modelItem->body . "<br>";
}
?>
