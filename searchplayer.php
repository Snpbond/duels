<?php
require('config.php');
require('tf2duel.class.php');
include('functions.php');

//Check if any input comes in
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
 
// query the database table for zip codes that match 'term'
$query = 'select * from players where steamname like "%'.mysql_real_escape_string($_REQUEST['term']).'%" limit 5';
$res = mysql_query($query);
 
// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $res && mysql_num_rows($res) )
{
	while( $row = mysql_fetch_array($res, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['steamname'] ,
			'value' => $row['steamid']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();
?>