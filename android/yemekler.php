<?php

	require_once("sql.php");
	// $user and $pass are imported from above statement
	try{
	$db = new PDO("mysql:host=127.0.0.1;dbname=admin_mobil;charset=utf8",$user,$pass);
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



	if(isset($_GET["tarih"])){
		$tarih = $_GET["tarih"];
		$tarih = tarihConvert($tarih);
		$data = $db->query('select * from yemek where yemekTarih = "'.$tarih.'" order by id asc');
		$data = $data->fetchAll(PDO::FETCH_ASSOC);
		if(empty($data[0]["yemek"]) OR empty($data[1]["yemek"]) OR empty($data[2]["yemek"])){
			$data[0]["yemek"] = "Yemek Bulunamadı";
			$data[1]["yemek"] = "Yemek Bulunamadı";
			$data[2]["yemek"] = "Yemek Bulunamadı";
			$notFound = true;
		}else{
			$notFound = false;
		}
			echo '{'."\n"."\n";
			echo '"yemekler" :'."\n"."\n";

			echo '{'."\n"."\n";
			echo '"ymk1" : "'.$data[0]["yemek"].'",'."\n";
			echo '"ymk2" : "'.$data[1]["yemek"].'",'."\n";
			echo '"ymk3" : "'.$data[2]["yemek"].'",'."\n";
			if($notFound){
			echo '"not" : "true"'."\n";
			}else{
			echo '"not" : "false"'."\n";
			}
			echo '}'."\n"."\n";

			echo '}'."\n";

	}
