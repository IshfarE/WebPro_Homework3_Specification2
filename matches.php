<?php include("common.php"); ?> <!--Include common code-->

<form action="matches-submit.php" method="get">  <!--Redirect to matches-submit.php that gets the attributes from singles.txt-->
	<strong>Returning User:</strong>
	<br>
	<strong>Name:</strong>      <!--Name: 16-character user input-->
    <input type="text" name="name" size="16"/>
	
	<input type="submit" value="View My Matches"/>
</form>