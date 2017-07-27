<?php
/**
* Redirects to Login if User is not logged in
* Has to be before ANY html output.
**/
function redirectToLogin()
{
	session_start();

	if(empty($_SESSION['user']))
	{
		header('Location: login.php');
		die();
	}
}
/**
* Establishes a connection via mysli to the database for a given User in the global
* SESSION array.
* @return mysqli result
**/
function establishLinkForUser()
{
	if($_SESSION['user']=='Lehrer' || $_SESSION['user']=='Verwaltung')
	{
		$db_link = mysqli_connect('localhost', 'Reporting', 'Passwort12345', 'itverwaltung');
	}
	else
	{
		$db_link = mysqli_connect('localhost', 'Full', 'Passwort12345', 'itverwaltung');
	}
	return $db_link;
}

function breadCrumb()
{
	if(!isset($_SESSION['History']))
	{
		$_SESSION['History'] = array();
	}

	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$urlArray = explode("/", $url);
	$lastEl = array_values(array_slice($urlArray, -1))[0];
	$split = explode(".", $lastEl);
	$currentPage = $split[0];
	
	if($currentPage != "overview")
	{
		if(in_array($currentPage, $_SESSION['History']))
		{
			$key = array_search($currentPage, $_SESSION['History']);
			$array = array_slice($_SESSION['History'], 0, $key-1);
			$_SESSION['History'] = $array;
		}
		else
		{
			$_SESSION['History'][] = $currentPage;
		}
	}
	else 
	{
		$_SESSION['History'] = array($currentPage);
	}

	$breadCrumb = '<div class="breadcrumb">';
	foreach($_SESSION['History'] as $value)
	{
		$breadCrumb.= '<a href="'.$value.'.php">'.$value.'</a> > ';
	}
	$breadCrumb.= '</div>';

	return $breadCrumb;
}

function ArraySelect($key)
{
	if($key == "Raum") { $search = "r_bezeichnung"; }
	if($key == "Komponentenart") { $search = "ka_komponentenart"; }
	$con = establishLinkForUser();
	$query = "SELECT ".$search." FROM ".$key;
	$result = mysqli_query($con, $query);

	return $result;
}

function queryToArray($result) {
	$tmp = array();
	while($row = mysqli_fetch_assoc($result)) {
    $tmp[] = $row;
  }
	return $tmp;
}
/**
* Creates a log entry in db with given status and description.
* @parameter $link: mysqli link
* @paramenter string $status: status to be set should be 'Neu', 'Änderung' or 'Löschen'
* @paramenter string $description: description to be set 
* @return int: id of log entry
* @author: Lukas Dallhammer
**/
function createLog($link, $status)
{	//needs db change to default log_date to date(now)
	$createLogWithStatus = "
		INSERT INTO logging (log_description, log_status)
		VALUES('$description', '$status');";
	$query = mysqli_query($link, $createLogWithStatus);
	return mysqli_insert_id($link);
}
?>
