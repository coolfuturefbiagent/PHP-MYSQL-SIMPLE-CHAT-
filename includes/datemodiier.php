<?php 

function startdate($date){

	$s=explode("-",$date);
	$year=$s[0];
$month=$s[1];
global $day;
$day=$s[2];

$rmonth;
switch($month){
	case 1:
	$rmonth="Jan";
	break;
		case 2:
		break;
	$rmonth="Feb";
		case 3:
	$rmonth="Mar";
	break;
	case 4:
	$rmonth="Apr";
	break;
	case 5:
	$rmonth="May";
	break;
		case 6:
	$rmonth="June";
	break;
			case 7:
	$rmonth="July";
	break;
		case 8:
	$rmonth="Aug";
	break;
		case 9:
	$rmonth="Sep";
	break;
		case 10:
	$rmonth="Oct";
	break;
		case 11:
	$rmonth="Nov";
	break;
		case 12:
	$rmonth="Des";
	break;
	


}
	global $fullstartdate;
	$fullstartdate=$rmonth."\t \t".$day.", \t \t".$year."\t \t";	
}

function enddate($date2){
	

$s2=explode('-',$date2);
$year2=$s2[0];

$day2=$s2[2];
$month2=$s2[1];
$nmoth;


switch($month2){
	
		case 1:
	$nmoth="Jan";
	break;
		case 2:
	$nmoth="Feb";
	break;
		case 3:
	$nmoth="Mar";
	break;
	case 4:
	$nmoth="Apr";
	break;
	case 5:
	$nmoth="May";
	break;
		case 6:
	$nmoth="June";
	break;
			case 7:
	$nmoth="July";
	break;
		case 8:
	$nmoth="Aug";
	break;
		case 9:
	$nmoth="Sep";
	break;
		case 10:
	$nmoth="Oct";
	break;
		case 11:
	$nmoth="Nov";
	break;
		case 12:
	$nmoth="Des";
	break;
	default:
	$nmoth="UNDIFINED";
}
global $fullenddate;
$fullenddate=$nmoth."\t \t \t".$day2.", \t \t \t".$year2."\t \t \t";
			}	
	

?>