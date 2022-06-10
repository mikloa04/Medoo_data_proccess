<html>
<head></head>
<body>

<?php
require  'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'quanlynv',
    'server' => 'localhost',
    'username' => 'wpadmin',
    'password' => 'admin@WP@4ever@',
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci'
]);

$action = isset($_GET['action']) ? $_GET['action'] : '.'; 
 
$IsAll = isset($_GET['IsAll']) ? $_GET['IsAll'] : '0';

$IsDeleted = isset($_GET['IsDeleted']) ? $_GET['IsDeleted'] : '.';

$key = isset($_GET['Metakey']) ? $_GET['Metakey'] : '.';

$DepartmentID = isset($_GET['DepartmentID']) ? $_GET['DepartmentID'] : '.';

$DepartmentName = isset($_GET['DepartmentName']) ? $_GET['DepartmentName'] : '.';

$privatekey=bin2hex('department.php');


if($key==$privatekey)
{
	if($action =='select')
	{
		if($IsAll=='1')
		{
			$datas = $database->select('tblDepartment', 
			['DepartmentID','DepartmentName','IsDeleted']);
		}
		else
		{
			$datas = $database->select('tblDepartment', 
			['DepartmentID','DepartmentName','IsDeleted']
			,["IsDeleted" => $IsDeleted]);
		}
		if( is_array($datas) && count($datas)>0)
		{
			foreach($datas as $data)
			{	
				echo $data['DepartmentID'] .';'.$data['DepartmentName']  .';'.$data['IsDeleted'] .'*<br/>';
			} 
		}
		else
		{
			echo 'Error_Login';
		}
	}
	elseif($action =='insert')
	{
		$olddata = $database->get('tblDepartment', 
			['DepartmentID']
			,['DepartmentName' => $DepartmentName]);
		//Check duplicated	
		if( is_array($olddata) && count($olddata)>0)
		{
			$Update_id = $olddata['DepartmentID'];
			//Exists: Isdelete=0
			$data = $database->update("tblDepartment", [
										"IsDeleted" => 0
									], [
										"DepartmentID" =>$Update_id
									]);
			
		}
		else
		{
			//None: add new
			$database->insert("tblDepartment", [						
						"DepartmentName" => $DepartmentName,
						"IsDeleted" => 0
						]);
			$Update_id = $database->id();
		}
		echo $Update_id;
	
	}
	else
	{
		echo 'Error';
	}
}
else
{
	echo 'Error';
}

?>
</body>
</html>