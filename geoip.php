<?php
if(!function_exists("curl_init")
	die("cURL is required for the geoip library");

$ip_cache = array();
if(!function_exists("geoip_record_by_name")) {
	function geoip_record_by_name($host) {

		if(isset($ip_cache[$host]))
			return $ip_cache[$host];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://freegeoip.net/json/".$host);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);

		curl_setopt($ch, CURLOPT_GET, true);

		$result = json_decode(curl_exec($ch), true);

		curl_close($ch);
		
		$ip_cache[$host] = $result;
		
		return $result;
	}
}

if(!function_exists("geoip_continent_code_by_name)")) {
	function geoip_continent_code_by_name($host) {
		// Not supported, need to look into it
		return false;
	}
}

if(!function_exists("geoip_country_code_by_name)")) {
	function geoip_country_code_by_name($host) {
		$record = geoip_record_by_name($host);
		return $record["country_code"];
	}
}

if(!function_exists("geoip_country_code3_by_name")) {
	function geoip_country_code3_by_name($host) {
		// Not supported, need to look into it
		return false;
	}
}

if(!function_exists("geoip_country_name_by_name)")) {
	function geoip_country_name_by_name($host) {
		$record = geoip_record_by_name($host);
		return $record["country_name"];
	}
}
 
if(!function_exists("geoip_region_by_name)")) {
	function geoip_continent_code_by_name($host) {
		$record = geoip_record_by_name($host);
		return array("country_code" => $record["country_code"], "region" => $record["region_code"]);
	}
}

if(!function_exists("geoip_region_name_by_code)")) {
	function geoip_region_name_by_code($country, $region) {
		// Not supported, need to look into it
		//$record = geoip_record_by_name($host);
		//return $record["region_name"];
		return false;
	}
}

if(!function_exists("geoip_time_zone_by_country_and_region)")) {
	function geoip_time_zone_by_country_and_region($country, $region = "") {
		// Not supported, need to look into it
		return false;
	}
}
?>