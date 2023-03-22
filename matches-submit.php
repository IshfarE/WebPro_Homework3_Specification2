<?php include("common.php"); ?> <!--Include common code-->

<h1>Matches for <?= $_GET["name"] ?></h1> <!--Retrieve the name of the user-->
<div class='match'>
	<?php matchPrint(); ?> <!--Call function to print matches to use-->
</div>

<?php
	function matchPrint()
	
	$retrievedInfo = ""; //Retrive info that was added into singles.txt
	//Singles attributes are in this order: username, gender, age, personality type, operating system, and seeking age range
	foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $retrievedInfo) //FILE_IGNORE_NEW_LINES skips new line arguments at array element end
	{																	   //Break retrieved contents into elements based on their $_POST attributes from signup.php
																		   //And use "Name" as the target attribute
		$retrivedName = $_GET["name"];                    //Variable of Name retrieved from file
		$nameVerifier = explode(",", $retrievedInfo)[0];  //Variable to check if the user's name is correct
		
		if ($retrivedName == $nameVerifier)               //Verify if the name to verify matches the retrieved name
		{
			break;                                        //End process if name is matched
		}	
	}
	
	foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $findMatch) //Check attributes of potential matches
	{//Split potential match strings into array elements
		$matchName = explode(",", $findMatch)[0];                 
		$matchGender = explode(",", $findMatch)[1];
		$matchAge = explode(",", $findMatch)[2];
		$matchPT = explode(",", $findMatch)[3];
		$matchOS = explode(",", $findMatch)[4];
		
		//Split user string into array elements
		$userName = explode(",", $retrievedInfo)[0];            
		$userGender = explode(",", $retrievedInfo)[1];
		$userAgeMin = explode(",", $retrievedInfo)[2];
		$userAgeMax = explode(",", $retrievedInfo)[3];
		$userPT = explode(",", $retrievedInfo)[4];
		$userOS = explode(",", $retrievedInfo)[5];
		
		if
		(
			$userName != $matchName         //Name: Do not match people with the same name
			&&
			$userGender != $matchGender     //Gender: Do not match people with the same gender
			&&
			$userAgeMin <= $matchAge && $userAgeMax >= $matchAge //Age range: Match user with people within the selected age range
			&&
			$userPt == $matchPt      //Personality Type: Match people with the same personality type
			&&
			$userOS == $matchOS    //Operating system: Match people with the same favorite operating system
		)
		{
			?> <!--Break off php as the following elements are in html-->
			<img src="user.png" alt="user">
			<div><?= $matchName?></div>    <!--Print Name of Match-->
			
			<ul>
                <li><b>Gender:</b><?= $matchGender ?></li> <!--Print all other attributes of the match in an unordered list-->
                <li><b>Age:</b><?= $matchAge ?></li>
                <li><b>Personality Type:</b><?= $matchPT ?></li>
                <li><b>Operating System:</b><?= $matchOS ?></li>
            </ul>
			<?php //fill rest of contents in php	
		}	
	}
?>