<?php 

extract($_POST);

if(isset($_POST['submit']))
{
	$res = array("res" => "yesIsset");
}
else
{
	$res = array("res" => "noIsset", "msg" => $prac_id);
}


echo json_encode($res);
 ?>