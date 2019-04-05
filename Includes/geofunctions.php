<?php
/*
function distance($lat1, $lon1, $lat2, $lon2, $unit, $place) {
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);
		if ($unit == "K") {
			$mile = $miles * 1.609344;
			return array("$mile" => "$place");
		} else if ($unit == "N") {
			$mile = $miles * 0.8684;
			return array($mile,$place);
		} else {
			return array($miles,$place);
		}
}
	*/
function Get_DistanceKM($place1,$place2){
	$theta = $place1->get_lon() - $place2->get_lon();
	$dist = sin(deg2rad($place1->get_lat())) * sin(deg2rad($place2->get_lat())) +  cos(deg2rad($place1->get_lat())) * cos(deg2rad($place2->get_lat())) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	#$unit = strtoupper($unit);
	return $miles * 1.609344;
}
?>