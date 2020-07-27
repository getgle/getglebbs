<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="page">
<?php
include "header.php";
?>
<br>
<center>
<table id="catalogTable">
<tr>
    <th id="postTable">Headline</th>
    <th id="postTable">Replies</th>
    <th id="postTable">Last Updated</th>
</tr>
<?php
include_once "functions.php";
for($i=0; $i < count($db); $i++){
	if($db[$i]->reply == $thread and $db[$i]->board == $board or $board == "all" and $db[$i]->reply == $thread){
	render_threadlist($db, $i, $_GET["board"]);
	}
}
?>
</table>
	<h6>website powered by GetgleBBS, getgle.org</h6>
</center>
</div>
</body>
</html>
