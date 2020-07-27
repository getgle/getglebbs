<style>
body{
color:#f00;
background:#000;
}
</style>
<body>
<?php

$bbspass = "changeme";

$postAllowed = true;
$postName = $_POST["name"];
$postText = $_POST["post"];
$postReply = $_POST["reply"];
$postBoard = $_POST["board"];
$postAdmin = $_POST["admin"]; // admin post?

function indianName(){
$indianfirstnames = ["Xi", "Wang", "Yang", "Li", "Bao", "Chun", "Jìngyi", "Mao", "Dong", "Harry", "Get"];
$indianlastnames = ["Chang", "Jinping", "Zedong", "Zhū", "Zhèng", "Sòng", "Tián", "Chiang", "Dong", "Gle"];
return $indianfirstnames[array_rand($indianfirstnames)] . " " . $indianlastnames[array_rand($indianlastnames)];
}

$fortunes = ["It is certain.", "Reply hazy, try again.", "Don't count on it.", "Without a doubt.", "Better not tell you now", "My reply is no.", "Yes, definitely.", "Very doubtful.", "My sources say no."];
$db = json_decode(file_get_contents("db.json"));

//all the error crap

if(isset($postAdmin)){
	if($postAdmin != $bbspass){
		$postAllowed = false;
		echo "ERROR: INCORRECT ADMIN PASSWORD.";
	}
}

if(!isset($postName) or $postName == ""){
	if($postReply == 0){
		$postAllowed = false;
		echo "ERROR: Please enter a title for your thread.";
	} else {
		$postName = indianName();
	}
}
if(!(isset($postText)) or $postText == ""){
	$postAllowed = false;
	echo "ERROR: You didn't enter a post.";
}
if(!(isset($postReply)) or $postReply == ""){
	$postAllowed = false;
	echo "You know what you did, idiot.";
}
if(!(isset($postBoard)) or $postBoard == ""){
	$postAllowed = false;
	echo "Board not specified";
}
if(strlen($postText) > 4096){
	$postAllowed = false;
	echo "Your post is too long. Maximum post size is 4,096 chars.";
}
if(strlen($postName) > 256){
	$postAllowed = false;
	echo "Your post name is too long. Maximum name size is 256 chars.";
}

// Finally, lets get to the posting.
if($postAllowed == true){
	file_put_contents("backups/" . "db.json_backup" . uniqid(), json_encode($db)); //backup all posts 
	file_put_contents("backups/" . "db.json", json_encode($db));
	$newPost = array(
	"id" => count($db)+1,
	"name" => htmlspecialchars($postName),
	"date" => date("Y/m/d g:i:s"),
	"reply" => intval($postReply),
	"board" => $postBoard,
	"post" => htmlspecialchars($postText),
	"info" => crypt($_SERVER['REMOTE_ADDR'], "wewlad"), 
	"style" => "normal"
	);
	//  >"hurrr durrr use a switch statement!!"
	// No, they perform basically the same as ifs in PHP and if statements look better.
	if(isset($_POST["homo"])){
		$newPost["style"] = "homosexual";
	}
	if(isset($_POST["mono"])){
		$newPost["style"] = "monospace";
	}
	if(isset($_POST["roll"])){
		$newPost["roll"] = rand(100000, 999999);
	}
	if(isset($_POST["fortune"])){
		$newPost["fortune"] = $fortunes[array_rand($fortunes)];
	}
	if(isset($_POST["admin"])){
		$newPost["admin"] = true;
		$newPost["post"] = htmlspecialchars_decode($newPost["post"]);
	}
	if($postReply == 0){
	array_unshift($db, $newPost);
	} else {
		array_push($db, $newPost);
		if($postName != "sage"){
		for($i=0; $i < count($db); $i++){
			if($db[$i]->id == intval($postReply)){
				$bumpPost = $db[$i];
				unset($db[$i]);
				array_unshift($db, $bumpPost);
			}
		}
		}

		//var_dump($bumpPost);
	}
	file_put_contents("db.json", json_encode($db));
	if($postReply == 0){ // it's an OP
		Header("Location: index.php?board=" . $postBoard);
	} else { // it's a reply
		Header("Location: index.php?board=" . $postBoard . "&thread=" . $postReply);
	}
}
?>
</body>
