<?php
	//distance-api.php
	
	//Provides web api to find out shortest route to destination on a 2D Plane
	
	require_once(__DIR__ . "/distance-fnc.php");
	
	function Success($paths) {
		
		header("Content-Type:application/json");
		
		$paths['status'] = "Success";
		$paths['Success'] = TRUE;
		
		die( json_encode($paths) );
		
	}
	
	function Error($msg) {
		
		header("Content-Type:application/json");
		
		die( json_encode( array("status" => "Error" , "message" => $msg , "Success" => False) ) );
		
	}
	
	function _coords($p , $to) {
		
		$a = array();
		
		foreach($p as $c)
			$a[] = $to == 'string' ? "{$c->x},{$c->y}" : array($c->x,$c->y);
		
		return $a;
	}
	
	function _extract( $c ) {
		$c = str_replace( array("(",")") , "" , $c );
		
		$c = explode("," , $c);
		
		return new COORD( $c[0] , $c[1] );
	}
	
	function extractCoords($str){
		$str = str_replace(" ",'',$str); //remove all whitespaces
		
		preg_match_all("/\(((-|\+)?\d+(\.\d+)?),((-|\+)?\d+(\.\d+)?)\)/" , $str , $m);
		
		$path = array();
		
		foreach($m[0] as $c) {
			$path[] = _extract($c);
		}
		
		return $path;
	}
	
	function addOrigin($origin,$routes) {
		
		$ar = array();
		
		foreach($routes as $r) {
			$ar[] = array_merge( array( $origin ) , $r );
		}
		
		return $ar;
	}
	
	if(isset($_REQUEST['origin']) && isset($_REQUEST['routes'])) {
		
		if(!isset($_REQUEST['format']))
			$_REQUEST['format'] = 'json';
		
		$origin = extractCoords( $_REQUEST['origin'] )[0];
		
		if(!$origin || !is_object($origin))
			Error("Invalid Origin Coordinates");
		else if(!is_array($_REQUEST['routes']))
			Error("Routes must be an Array");
		
		$routes = array();
		foreach($_REQUEST['routes'] as $r)
			$routes[] = extractCoords( $r );
		
		if(count($routes) < 1)
			Error("User must provide atleast 1 route");
		
		$pathOrder = paths( $routes , $origin );
		
		
		$result = array();
		
		foreach($pathOrder as $i=>$p)
			$result[ $i+1 ] = _coords( $p , $_REQUEST['format'] );
		
		Success( $result );
	}