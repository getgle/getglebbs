<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css?v=1.1">
</head>
<body>
<div id="page">
<?php
include "header.php";
?>
<?php
include "functions.php";
$db = json_decode(file_get_contents("db.json"));
$thread = $_GET["thread"];
$board = $_GET["board"];

for($i=0; $i < count($db); $i++){
	if($db[$i]->id == $thread){
		render_op($db, $i);
	}
}

for($i=0; $i < count($db); $i++){
	if($db[$i]->reply == $thread){
		render_replies($db, $i);
	}

}

?>
<div id="createthread">
<span class="createThreadHeader">New Reply</span>
<form action="createthread.php" method="post">
<table>
<tr>
<td id="postTable">Name:</td><td > <input type="text" name="name" value=""><input type="submit" value="Post"></td>
<input type="text" name="reply" value="<?php echo $thread ?>" style="display:none;">
<input type="text" name="board" value="<?php echo $board; ?>" style="display:none;">

</tr>
<tr>
<td id="postTable">Post:</td><td><textarea name="post"></textarea></td>
</tr>
</table>
<input type="checkbox" name="mono" id="mono">
<label for="mono">monospace</label>
<input type="checkbox" name="homo" id="homo">
<label for="homo">homosexual</label>
<input type="checkbox" name="roll" id="homo">
<label for="roll">roll</label>
<input type="checkbox" name="fortune" id="homo">
<label for="fortune">fortune</label>
</form>
</div>
</div>
</body>

</html>
