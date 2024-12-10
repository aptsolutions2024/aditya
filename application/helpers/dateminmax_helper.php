<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed'); 


function minDate(){
	$yearArray=explode('-',preg_replace('/\s+/', '',$_SESSION['current_year']));
	$mindate=$yearArray[0]."-04";
	return $mindate;
}

function maxDate(){
	$yearArray=explode('-',preg_replace('/\s+/', '',$_SESSION['current_year']));
	$maxdate="20".$yearArray[1]."-03";
	return $maxdate;
}
 function getMinDate(){
    $yearArray=explode('-',preg_replace('/\s+/', '',$_SESSION['current_year']));
	$mindate=$yearArray[0]."-04-01";
	return $mindate;
 }
function getMaxDate(){
 	$yearArray=explode('-',preg_replace('/\s+/', '',$_SESSION['current_year']));
	$maxdate="20".$yearArray[1]."-03-31";
	return $maxdate;
 }
?>