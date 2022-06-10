<html>
<head></head>
<body>

<?php
//header('Content-Type: application/json');
// If you installed via composer, just use this code to require autoloader on the top of your projects.
require  'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'quanlynv',
    'server' => 'localhost',
    'username' => 'wpadmin',
    'password' => '2Xq?H6!++Mgj0ZqV',
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci'
]);
 
$user = isset($_GET['user']) ? $_GET['user'] : '.'; 

$key =isset($_GET['Metakey']) ? $_GET['Metakey'] : '.';

//Login check
if($key==bin2hex('login.php'))
{
	$datas = $database->select('tblUser', 
	['UserID','UserName','UserPass','DisplayName','IsAdmin']
	,[	"UserName" => $user,	"IsDeleted" => 0]
	
	
);
	if( is_array($datas) && count($datas)>0)
	{
		foreach($datas as $data)
		{	
			echo $data['UserID'] .';'.$data['UserName']  .';'.$data['UserPass'] .';'.$data['DisplayName'] .';'.$data['IsAdmin'];
		} 
	}
	else
{
	echo 'Error_Login';
}
}
else
{
	echo 'Error_Login';
}

//echo json_encode($Result_data, JSON_UNESCAPED_UNICODE). ";";

?>
</body>
</html>