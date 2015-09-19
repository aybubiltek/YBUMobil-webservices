<?php
	// Durak numarasından otobüs sorgulama
	
if(isset($_GET["durak"])){
    $durak_no = $_GET["durak"];
	if($durak_no == 0){
		$durak_no = 20813;
	}else if($durak_no == 1){
		$durak_no = 21259;
	}else if($durak_no == 2){
		$durak_no = 20885;
	}else if($durak_no == 3){
		$durak_no = 20886;
	}else if($durak_no == 4){
		$durak_no = 20795;
	}else if($durak_no == 5){
		$durak_no = 11604;
	}else if($durak_no == 6){
		$durak_no = 30007;
	}else if($durak_no == 7){
		$durak_no = 30007;
	}
	
    $ch = curl_init();
    $sID = (rand(0,100)/rand(100,200));
    $ip = "46.45.162.145";
    curl_setopt($ch, CURLOPT_URL, "http://www.ego.gov.tr/mobil/mapToDo.asp?AjaxSid={$sID}&AjaxCid={$ip}&AjaxApp=OtobusNerede&AjaxLog=False"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    curl_setopt($ch, CURLOPT_REFERER, "http://www.ego.gov.tr/mobil/otobusnerede.asp"); 
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "fnc=DuraktanGeçecekOtobüsler&durak=".$durak_no); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)"); 
    $data = curl_exec($ch); 
    curl_close($ch); 
    $data = @iconv("windows-1254","UTF-8",$data); 
    $data = str_replace("'","\"",$data);
    $json = json_decode($data);
    
	foreach($json as $key => $value){
		$result[] = $value;
	}
		$sayac = 0;
	foreach($value as $key => $value){
		$kodu[] = $value->kodu;
		$adi[] = $value->adi;
		$detay[] = $value->detay;
		$sayac++;
	}
echo '{

"otobusler" : 

{

"otobus" : "';

	for($i=0 ; $i<$sayac ; $i++){
		$suresi = $detay[$i];
		$suresi = explode(":",$suresi);
		$suresi = $suresi[count($suresi) -2];
		$suresi = trim($suresi, "Konumu");
		$suresi = trim($suresi);
		$suresi = trim($suresi,"<br />");
		
		$konumu = $detay[$i];
		$konumu = explode(":",$konumu);
		$konumu = $konumu[count($konumu) -1];
		$konumu = trim($konumu);
		$id = $i+1;
		/*
			$kodu[$i]
			$adi[$i]
			$konumu
			$suresi
		*/
			echo $kodu[$i] ."-". $adi[$i] ."-". $konumu ."\n". $suresi .'<-a->';

	}

echo '"

}

}';
}



?>