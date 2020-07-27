<?php
function json_search($database, $value, $key){
	$results = [];
	for($i=0; $i < count($database); $i++){
		if($database->$value == $key){
			array_push($results, $database[$i]);
		}
	}
	return $results;
}

// get replies to thread
function get_replies($database, $id){
	$replies = array();
	for($i=0; $i < count($database); $i++){
		if($database[$i]->reply == $database[$id]->id){
			array_unshift($replies, $database[$i]);
		}
	}
	return $replies;
}

// render the threads for the "list" page
function render_threadlist($database, $postNum, $board){
	$replies = get_replies($database, $postNum);
	//var_dump($replies);
	echo "<tr>";
	echo "<td><a href='index.php?board=" . $board . "&thread=" . $database[$postNum]->id . "'>" . $database[$postNum]->name . "</a></td>"; //post headline
	echo "<td>" . count($replies) . "</td>"; // number of replies
	if($replies[0] == NULL){
		echo "<td>" . $database[$postNum]->date . "</td>"; //post headline
	} else{
	echo "<td>" . $replies[0]->date . "</td>"; // date of last reply
	}
	echo "</tr>";
}
// Render an OP post.
function render_op($database, $postNum){
		echo '<div class="op">';
		echo '<span class="postHeadline">' .  $database[$postNum]->name . '</span>';
		if(isset($database[$postNum]->admin)){
			echo '<span class="postAdmin"> ' . "## Getgle Golden God" . '</span>';
		}
		echo '<span class="postDate"> ' . $database[$postNum]->date . '</span>';
		echo '<span class="postName"> No. ' . $database[$postNum]->id . '</span>';
		echo '<a href="?board=' . $_GET["board"] . '&thread=' . $database[$postNum]->id . '">    [reply]</a>';

		if($database[$postNum]->style == "monospace"){
			echo '<pre>' . str_replace(["nigger", "NIGGER", "Nigger"], ["kulak", "KULAK", "Kulak"], $database[$postNum]->post) . '</pre>';
		}
		if($database[$postNum]->style == "homosexual"){
			echo '<p id="homosexual">' . str_replace(["nigger", "NIGGER", "Nigger"], ["kulak", "KULAK", "Kulak"], $database[$postNum]->post) . '</p>';
		}
		if($database[$postNum]->style == "normal" or !isset($database[$postNum]->style)){
		echo '<p>' . str_replace(["\r\n", "nigger", "NIGGER", "Nigger", "Zchan", "zchan"], ["<br>", "kulak", "KULAK", "Kulak", "Cuckchan", "cuckchan"], $database[$postNum]->post) . '</p>';
		}
		if(isset($database[$postNum]->fortune)){
			echo "<span id='fortune'>Fortune: " . $database[$postNum]->fortune  . "</span>";
		}
		if(isset($database[$postNum]->roll)){
			echo "<span id='roll'>You rolled: " . $database[$postNum]->roll  . "</span>";
		}
		echo "<span class='disclaimer'><i>Disclaimer: this post and the subject matter and contents thereof - text, media, or otherwise - do not necessarily reflect the views of the Getgle administration.</i></span>";
}
// Render a Reply post.
function render_replies($database, $postNum){
		echo '<div class="reply">';
		echo '<span class="postName">' . $database[$postNum]->name . '</span>';
		echo '<span class="postDate"> ' . $database[$postNum]->date . '</span>';
		echo '<span class="postNum">' . "<a href='#" . $database[$postNum]->id . "'> No. " . $database[$postNum]->id . '</a></span>';
		if($database[$postNum]->style == "monospace"){
			echo '<pre>' . str_replace(["nigger", "NIGGER", "Nigger"], ["kulak", "KULAK", "Kulak"], $database[$postNum]->post) . '</pre>';
		}
		if($database[$postNum]->style == "homosexual"){
			echo '<p id="homosexual">' . str_replace(["nigger", "NIGGER", "Nigger"], ["kulak", "KULAK", "Kulak"], $database[$postNum]->post) . '</p>';
		}
		if($database[$postNum]->style == "normal" or !isset($database[$postNum]->style)){
		echo '<p>' . str_replace(["\r\n", "nigger", "NIGGER", "Nigger"], ["<br>", "kulak", "KULAK", "Kulak"], $database[$postNum]->post) . '</p>';
		}
		if(isset($database[$postNum]->fortune)){
			echo "<span id='fortune'>Fortune: " . $database[$postNum]->fortune  . "</span>";
		}
		if(isset($database[$postNum]->roll)){
			echo "<span id='roll'>You rolled: " . $database[$postNum]->roll  . "</span>";
		}
		echo "<span class='disclaimer'><i>Disclaimer: this post and the subject matter and contents thereof - text, media, or otherwise - do not necessarily reflect the views of the Getgle administration.</i></span>";
		echo '</div>';

}
?>
