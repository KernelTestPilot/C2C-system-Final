<?php
class place{
	var $lon;
	var $lat;
	var $name;
	
	function __construct($lat,$lon,$name) {
        $this->name=$name;
		$this->lon=$lon;
		$this->lat=$lat;
    }
	
	function get_lon(){
		return $this->lon;
	}
	
	function get_lat(){
		return $this->lat;
	}
	
	function get_name(){
		return $this->name;
	}
}

?>