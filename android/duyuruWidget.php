<?php
$sources = array(
	array(
		"line1" => "YBU Haberler",
		"line2" => "Okulumuzun anasayfasındaki tüm güncel haberler.",
		"sourceLink" => "http://api.ybubiltek.org/mobilybu/andorid/duyuruWidgetUpdate.php?id=0"
	),
	array(
		"line1" => "YBU Duyurular",
		"line2" => "Okulumuzun anasayfasındaki tüm güncel duyurular.",
		"sourceLink" => "http://api.ybubiltek.org/mobilybu/andorid/duyuruWidgetUpdate.php?id=1"
	),
	array(
		"line1" => "YBU Öğrenci İşleri",
		"line2" => "Okulumuzun öğrenci işleri anasayfasındaki tüm güncel duyurular.",
		"sourceLink" => "http://api.ybubiltek.org/mobilybu/andorid/duyuruWidgetUpdate.php?id=2"
	)
);
$anHour = 60*60;
$thirtyMins = 30*60;
$fifteenMins = 0.5*60;
$twoHours = 2*$anHour;
$intervals = array(
	array(
		"desc" => "15 Dakika",
		"int" => "$fifteenMins",
	),
	array(
		"desc" => "30 Dakika",
		"int" => "$thirtyMins",
	),
	array(
		"desc" => "Bir saat",
		"int" => "$anHour",
	),
	array(
		"desc" => "İki saat",
		"int" => "$twoHours",
	),
);
echo json_encode(array($intervals,$sources), JSON_PRETTY_PRINT);