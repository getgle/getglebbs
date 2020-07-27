<div id="boards">
boards: [<a href="index.php">/home/</a>,<a href="index.php?board=all">/all/</a>, <a href="index.php?board=lounge">/lounge/</a>, <a href="index.php?board=monkey">/monkey/</a>]
</div>
<div id="header">
<span class="logo"><?php echo $settings->name ?> - /<?php echo $board ?>/</span><br>
<a href=<?php echo '"?board=' . $board ?>">frontpage,</a> 
<a href=<?php echo '"?board=' . $board . '&page=list"' ?>>catalog,</a> 
<a href=<?php echo '"?board=' . $board . '&page=create"' ?>>create thread</a> 
</div>
