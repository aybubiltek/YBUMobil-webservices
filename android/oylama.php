<?php

	require_once("sql.php");
	// $user and $pass are imported from above statement
	try{
	$db = new PDO("mysql:host=localhost;dbname=admin_mobil;charset=utf8",$user,$pass);
	}catch(PDOException $e){
	echo "SQL ERROR";
		exit;
	}

	function tarihConvert($tarih){
		$tarih = explode("-", $tarih);
		$year = $tarih[0];
		$mount = $tarih[1];
		$day = $tarih[2];

		for ($i=1; $i <= 9; $i++) { 
			switch ($mount) {
				case $i:
					$mount = "0".$i;
					break;
			}
		}

		for ($j=1; $j <= 9; $j++) { 
			switch ($day) {
				case $j:
					$day = "0".$j;
					break;
			}
		}

		$t1 = $year."-".$mount."-".$day;
		return $t1;
	}

	if(isset($_GET["yemekTarih"]) && isset($_GET["sira"]) && isset($_GET["oy"]) && isset($_GET["imei"])){

	$sira = $_GET["sira"];
	$oy = $_GET["oy"];
	$imei = $_GET["imei"];

	$tarih = $_GET["yemekTarih"];
	$tarih = tarihConvert($tarih);
	$data = $db->query('select * from yemek where yemekTarih = "'.$tarih.'" order by id asc');
	$data = $data->fetchAll(PDO::FETCH_ASSOC);

	if($sira == 1){
		$id = $data[0]["id"];
		$kullananlar = $data[0]["kullananlar"];
		$yemekPuan1 = $data[0]["yemekPuan1"] + 1;
		$yemekPuan2 = $data[0]["yemekPuan2"] + 1;
		$yemekPuan3 = $data[0]["yemekPuan3"] + 1;
	}
	if($sira == 2){
		$id = $data[1]["id"];
		$kullananlar = $data[1]["kullananlar"];
		$yemekPuan1 = $data[1]["yemekPuan1"] + 1;
		$yemekPuan2 = $data[1]["yemekPuan2"] + 1;
		$yemekPuan3 = $data[1]["yemekPuan3"] + 1;
	}
	if($sira == 3){
		$id = $data[2]["id"];
		$kullananlar = $data[2]["kullananlar"];
		$yemekPuan1 = $data[2]["yemekPuan1"] + 1;
		$yemekPuan2 = $data[2]["yemekPuan2"] + 1;
		$yemekPuan3 = $data[2]["yemekPuan3"] + 1;
	}

	$kullananlar1 = explode(",", $kullananlar);
	foreach ($kullananlar1 as $value) {
		if ($value == $imei) {
		echo "kullanmış";
		exit;
		}
	}

	$kullananlar .= ",".$imei;

	if($oy == "1"){
		
		$sql = "UPDATE yemek SET yemekPuan1=?, kullananlar=? WHERE id=?";
		$q = $db->prepare($sql);
		$q->execute(array($yemekPuan1,$kullananlar,$id));
	}


	if($oy == "2"){
		$sql = "UPDATE yemek SET yemekPuan2=?, kullananlar=? WHERE id=?";
		$q = $db->prepare($sql);
		$q->execute(array($yemekPuan2,$kullananlar,$id));
	}

	if($oy == "3"){
		$sql = "UPDATE yemek SET yemekPuan3=?, kullananlar=? WHERE id=?";
		$q = $db->prepare($sql);
		$q->execute(array($yemekPuan3,$kullananlar,$id));
	}



	}

