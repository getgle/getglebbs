<?php
$dbfile = file_get_contents("db.json");
if($dbfile == null or $dbfile == ""){
file_put_contents("db.json", file_get_contents("backups/db.json"));
}
$db = json_decode(file_get_contents("db.json"));

$settings = json_decode(file_get_contents("settings.json"));
$thread = $_GET["thread"];
$page = $_GET["page"];
$board = $_GET["board"];

if($page == "create"){
	include_once("templates/threadMaker.php");
}

if($page == "list"){
	include_once("templates/threadlist.php");
} else{
if($board == ""){
	include_once("templates/index.php");
} else{
if(in_array($board, $settings->boards) && $thread == ""){
	include_once("templates/threads.php");
}
if(in_array($board, $settings->boards) && isset($thread)){
	include_once("templates/thread.php");
}

if(!in_array($board, $settings->boards) or $board == ""){
	echo "this board does not exist";
}
}
}
?>
