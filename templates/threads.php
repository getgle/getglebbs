<html>
<head>
<?php
include "functions.php";
$db = json_decode(file_get_contents("db.json"));
$settings = json_decode(file_get_contents("settings.json"));
$thread = $_GET["thread"];
$board = $_GET["board"];
?>
<link rel="stylesheet" type="text/css" href="style.css?v=1.1">
</head>
<body>
<div id="page">
<?php
include "header.php";

for($i=0; $i < count($db); $i++){
	if($db[$i]->reply == $thread and $db[$i]->board == $board or $db[$i]->reply == $thread and $board == "all"){
		render_op($db, $i);
		for($z=0; $z < count($db); $z++){
			if($db[$z]->reply == $db[$i]->id){
				render_replies($db, $z);
			}
		}
		echo "</div>";
	}
}

?>
</div>
	<h6>powered by getgle-bbs</h6>
</body>
</html>
