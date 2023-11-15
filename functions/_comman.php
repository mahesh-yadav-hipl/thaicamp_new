<?php
	function generate_random_string($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function generate_random_capital_string($length = 10) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function generate_otp($length = 4) {	
		$result = '';
		for($i = 0; $i < $length; $i++){
			$result .= mt_rand(0, 9);
		}
		return $result;
	}
	
	function money($money) {
		return number_format ($money ,2,"." ,",");
	}
	
	
	function in_array_2d($needle, $array, $strict = false) {
		foreach ($array as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
	
	function is_current_page($page='') {
		if(in_array(basename($_SERVER['PHP_SELF'],'.php'),explode(',',implode(',', (array)$page)))){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function redirect($page,$data=array(),$time=0) {
		if(!empty($data) && is_array($data)){
			foreach($data as $key=>$val){
				$_SESSION["$key"]=$val;
			}
		}
		
		echo "<script>setTimeout(function(){location.href='$page';},$time);</script>";
		$seconds=$time/1000;
		header( "Refresh:$seconds;Url=$page" );
		exit(0);
		die;
	}
	
	
	function date_formate($date=null,$format='Y-m-d',$extra='+0 day') {
		return date("$format",strtotime($extra,strtotime($date)));
	}
	
	
	function grab_image($url,$saveto) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
		$rawdata = curl_exec($ch);
		$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		curl_close($ch) ;
		$fp = fopen($saveto,'w');
		fwrite($fp, $rawdata); 
		fclose($fp);             
	}

	function debug($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit();
		return;
	}
	
	function age($dob){
	    $age=date_diff(date_create($dob), date_create('today'))->y;
	            if(($age>100) or ($age<1)){
	                return 20;
	            }else{
	                return $age;
	            }
		 
	}
	
	
	function get_profile_percentage($data =array()){
	    
        	$perc = 0;
            if(!empty($data['name'])){
                ++$perc;
            }
            if(!empty($data['email'])){
                ++$perc;
            }
            if(!empty($data['dob'])){
                ++$perc;
            }
            if(!empty($data['phone'])){
                ++$perc;
            }
            if(!empty($data['platform'])){
                ++$perc;
            }
            if(!empty($data['about'])){
                ++$perc;
            }
            if(!empty($data['location'])){
                ++$perc;
            }
            if(!empty($data['price'])){
                ++$perc;
            }
            if(!empty($data['categories'])){
                ++$perc;
            }
            if(!empty($data['gender'])){
                ++$perc;
            }
            if(!empty($data['youtube_link']) || !empty($data['instagram_link'])){
                ++$perc;
            }
            if(!empty($data['price_name'])){
                ++$perc;
            }
            if(!empty($data['price_quantity'])){
                ++$perc;
            }
            if(!empty($data['price_negotiable'])){
                ++$perc;
            }
              $a = $perc / 14 * 100;
          return round($a);
	}
	
	
	function get_brand_profile_percentage($data =array()){
	    
        	$perc = 0;
            if(!empty($data['name'])){
                ++$perc;
            }
            if(!empty($data['email'])){
                ++$perc;
            }
            if(!empty($data['phone'])){
                ++$perc;
            }
            if(!empty($data['brand_name'])){
                ++$perc;
            }
            if(!empty($data['brand_categories'])){
                ++$perc;
            }
            if(!empty($data['location'])){
                ++$perc;
            }
            $a = $perc / 6 * 100;
          return round($a);
	}



	
	
	
	

?>