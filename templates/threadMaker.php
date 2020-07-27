<link rel="stylesheet" type="text/css" href="style.css">
<body>
<?php
include "functions.php";
$db = json_decode(file_get_contents("db.json"));
$settings = json_decode(file_get_contents("settings.json"));
$thread = $_GET["thread"];
$board = $_GET["board"];
$admin = $_GET["admin"];
?>
<div id="page">
<?php
include "header.php";
?>
<div id="createthread">
<span class="createThreadHeader">New Thread</span>
<form action="createthread.php" method="post">
<table>
<tr>
<td id="postTable">Headline:</td><td> <input type="text" name="name" value=""><input type="submit" value="Post"></td>
<input type="text" name="reply" value="0" style="display:none;">
<input type="text" name="board" value="<?php echo $board; ?>" style="display:none;">

</tr>
<tr>
<td id="postTable">Post:</td><td><textarea name="post"></textarea></td>
</tr>
<?php
if(isset($admin)){
	echo '<tr><td id="postTable">Admin:</td><td> <input type="text" name="admin" value=""></td></tr>';
}
?>
</table>
<input type="checkbox" name="mono" id="mono">
<label for="mono">monospace</label>
<input type="checkbox" name="homo" id="homo">
<label for="homo">homosexual</label>
<input type="checkbox" name="roll" id="homo">
<label for="roll">roll</label>
<input type="checkbox" name="fortune" id="homo">
<label for="fortune">fortune</label>
<?php
if(isset($admin)){
	echo '<input type="checkbox" name="html" id="html">
<label for="html">html</label>';
}
?>
</form>
</div>
</div>
</body>
