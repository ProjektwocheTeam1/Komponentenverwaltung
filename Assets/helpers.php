<?php
/**
* Establishes a connection via mysli to the database for a given User in the global
* SESSION array.
* @return mysqli result
**/
function establishLinkForUser()
	{
		if($_SESSION['user']=='Lehrer' || $_SESSION['user']=='Verwaltung')
		{
			$db_link = mysqli_connect('localhost', 'otherUser', 'password', 'db');
		}
		else
		{
			$db_link = mysqli_connect('localhost', 'user', 'password', 'db');
		}
		return $db_link;
	}
?>