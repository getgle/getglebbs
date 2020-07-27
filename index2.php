<?php
$db = json_decode(file_get_contents("db.json"));
$settings = json_decode(file_get_contents("settings.json"));

$thread = $_GET["thread"];
$board = $_GET["board"];
//$boards = ["lounge", "music", "all"];

function render_post($database, $postNum){
		echo '<div class="reply">';
		echo '<span class="postName">' . $database[$postNum]->name . '</span>';
		echo '<span class="postName"> ' . $db[$postNum]->date . '</span>';
		echo '<span class="postName"> No. ' . $database[$postNum]->id . '</span>';
		echo '<p>' . $database[$postNum]->post . '</p>';
		echo '</div>';
}


if($board == ""){
	echo include_once("templates/index.php");
}
if(in_array($board, $settings->boards)){
	echo include_once("templates/threads.php");
}

if(!in_array($board, $settings->boards) or $board == ""){
	echo "this board does not exist";
}

for($i=0; $i < count($db); $i++){
	if($db[$i]->reply == $thread and $db[$i]->board == $board){
		render_post($db, $i);
	}
	if($db[$i]->reply == $thread and $board == "all"){
		render_post($db, $i);
	}

}

?>
