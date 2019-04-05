<?php 
include_once 'place.inc.php';
include_once 'geofunctions.php';
?>
<?php

$SkövdeHis = new place(58.394066,13.853498,"Högskolan i Skövde");
#$KTH = new place(59.34965,18.070554,"Kungliga Tekniska Högskolan");
#$Lekskola = new place(65.617810,22.140144,"Luleås Lekskola");
#$schools = array($SkövdeHis, $KTH, $Lekskola);
$schools = array($SkövdeHis);

if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
	$lat1 = $_POST['latitude'];
	$lon1 = $_POST['longitude'];
	$MyPos = new place($lat1,$lon1,"Mypos"); 

	
	$MinDist = 0;
	$FirstTime = true;
	$SchoolClosest;
	foreach ($schools as $school){	
		$Distance = Get_DistanceKM($MyPos,$school);		
		if($FirstTime){
			$FirstTime = false;
			$MinDist = $Distance;
			$SchoolClosest = $school;
		}
		if($MinDist > $Distance){
			$MinDist = $Distance;
			$SchoolClosest = $school;
		}
	}
	
	echo "<a href='UserPage/site.php?school=".urlencode($SchoolClosest->get_name())."'>";
	echo "<strong>";
	echo $SchoolClosest->get_name();
	$_SESSION["School"] = $SchoolClosest->get_name();
	echo "</strong>";
	echo " $MinDist" ; 
	echo "</a>";
}


?>