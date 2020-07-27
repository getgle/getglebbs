<?php
$pass = "bidenpxy";

$db = json_decode(file_get_contents("db.json"));
$settings = json_decode(file_get_contents("settings.json"));

if($_POST["pass"] == $pass){
	echo "password correct";
	// delete post
	if($_POST["function"] == "delete"){
		for($i=0; $i < count($db); $i++){
			if($db[$i]->id == $_POST["postid"]){
				unset($db[$i]);
				echo "post deleted";
			}
	}
}
}else{
	echo "password wrong";
}
?>