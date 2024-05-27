<?php 

extract($_POST);

if(isset($_POST['submit']))
{
	$res = array("res" => "yesIsset");
}
else
{
	$res = array("res" => "noIsset", "msg" => $ex_id);
}


echo json_encode($res);
 ?>