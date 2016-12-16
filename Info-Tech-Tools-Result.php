<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Survey Result</title>
<link rel="stylesheet" href="project.css">
<style type="text/css">
.resultStyle {
	font-family:Arial;
	font-size:14px;
	margin-top:25px;
	border-style: solid;
	background-color: #F0E68C;
	padding-top: 50px;
    padding-right: 50px;
    padding-bottom: 50px;
    padding-left: 50px;
    line-height: 200%;
}
a { color: inherit; }
</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>


	<div id="pageContent">
	<nav>
		<div id="home">
			<a href="firstPage.html">Home</a>
		</div>

		<div class="dropdown">
			<a href="#">Info Tech</a>
							
			<div class="dropdown-content">
			    <a class="each-content" href="Info-Tech-Intro.html">Intro</a>
			    <a class="each-content" href="Info-Tech-OpenSource.html">Open Source Tool</a>
			    <a class="each-content" href="Info-Tech-Tools.html">Tools Survey</a>
		 	</div>
		</div>

		<div class="dropdown">
			<a href="#">Interest</a>
					
			<div class="dropdown-content">
		    	<a class="each-content" href="Interest-Intro.html">Intro - Cloud Computing</a>
				<a class="each-content" href="Interest-Vid.html">History</a>
				<a class="each-content" href="Interest-Cast.html">Management</a>
		 	</div>
		</div>

		<div id="about">
			<a href="about.html">About</a>
		</div>

	</nav>
	<div id="mainContent">
	<h1>Open Source Tools Survey Results</h1>
	<h2>This is the results of the form...</h2>

	<?php

	// use function displayPostArray to be able to display contents of $_POST 
	// in a way that is flexible in terms of items stored in $_POST
	displayPostArray($_POST);

	// ADDED in Step 8

	// want to connect to MySQL database
	// first load into memory the database credentials defined in login file
	require_once 'login_bhandare.php'; // remember to change to your lastname
	// use database credentials to connect to MySQL
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
	// test if successful in connecting to MySQL
	if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
	// test if successful in connecting to your database
	mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());

	//
	// test to make sure that each tool is non-empty ... 
	// just to make sure in case JavaScript validation gets by passed
	if (isset($_POST['Loomio']) &&
	    isset($_POST['ScribeFramework']) &&
	    isset($_POST['ArchivesSpace']) &&
	    isset($_POST['Omeka']) &&
	    isset($_POST['Vufind']) &&
	    isset($_POST['BlueGriffon']) &&
	    isset($_POST['FFmpeg']) &&
	    isset($_POST['Brushtail']) &&
	    isset($_POST['Eclipse']) &&
	    isset($_POST['Refbase'])
		)
	{
		// assign to variables after "cleansing" data by using function mysql_fix_string (defined further down)
		$tool1 = mysql_fix_string($_POST['Loomio']);
		$tool2 = mysql_fix_string($_POST['ScribeFramework']);
		$tool3 = mysql_fix_string($_POST['ArchivesSpace']);
		$tool4 = mysql_fix_string($_POST['Omeka']);
		$tool5 = mysql_fix_string($_POST['Vufind']);
		$tool6 = mysql_fix_string($_POST['BlueGriffon']);
		$tool7 = mysql_fix_string($_POST['FFmpeg']);
		$tool8 = mysql_fix_string($_POST['Brushtail']);
		$tool9 = mysql_fix_string($_POST['Eclipse']);
		$tool10 = mysql_fix_string($_POST['Refbase']);
		// create query for entering data in to MySQL table = tools
		// need to specify which attributes we are providing since we don't provide all attributes
		$query = "INSERT INTO tools (Loomio, Scribe_Framework, IArchivesSpace, Omeka, Vufind, BlueGriffon, FFmpeg, Brushtail, Eclipse, Refbase) VALUES" .
	        "('$tool1', '$tool2', '$tool3', '$tool4', '$tool5', '$tool6', '$tool7', '$tool8', '$tool9', '$tool10')";
		// testing if successful inserting data in table 
		if (!mysql_query($query, $db_server))
	            echo "INSERT failed: $query<br />" .
	            mysql_error() . "<br /><br />";
	}

	//
	echo "Display AVERAGE SCORES for table = 'tools'.<br/>";
	$query = "SELECT * FROM tools";
	$result = mysql_query($query, $db_server);
	$rows = mysql_num_rows($result);
	// create query that returns SUM of scores for each tool
	$query = "SELECT SUM(Loomio), SUM(Scribe_Framework), SUM(IArchivesSpace), SUM(Omeka), SUM(Vufind), SUM(BlueGriffon), SUM(FFmpeg), SUM(Brushtail), SUM(Eclipse), SUM(Refbase) FROM tools";
	// $result will return a single row of SUMs
	$result = mysql_query($query, $db_server);
	if (!$result) die ("Database access failed: " . mysql_error());
	// fetch first (and only row) and this will be regular array
	$firstrow = mysql_fetch_row($result);
	// add div tag with class .results applied using \ to escape " quotation marks
	// Note: don't mix singe and double quotation marks
	echo '<div class=\'resultStyle\'>';
	// display SUM values and Average with is SUM / $rows (the latter computed further up)
	echo '<span class=\'bold\'>Loomio : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[0].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[0] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Scribe Framework : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[1].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[1] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>ArchivesSpace : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[2].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[2] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Omeka : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[3].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[3] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Vufind : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[4].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[4] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>BlueGriffon : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[5].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[5] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>FFmpeg : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[6].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[6] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Brushtail : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[7].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[7] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Eclipse : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[8].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[8] / $rows, 2) . '</span><br/>';
	echo '<span class=\'bold\'>Refbase : </span>SUM = ' . '<span class=\'bold\'>'.$firstrow[9].'</span>' . ' and AVE = <span class=\'bold\'>' . number_format($firstrow[9] / $rows, 2) . '</span><br/>';
	// add closing div tag
	echo '</div>';

	// define functions ... it is okay that they are defined after they are being called
	//
	function displayPostArray ($postarray) {
		// echo ("displayPostArray.<br/>");
		
		// want to loop through each item of associative array
		// Use of => is similar to the regular = assignment operator, 
		// except that you are assigning a value to an index and not to a variable. 
		// "as" is used to assign a specific element of array to variable $tool
		// and => is used to assign value associated with $tool to the variable $score
		foreach ($postarray as $tool => $score)
		{
			echo "$tool" . " = " . "$score<br/>";
		}
		echo "<hr>";
		//
	}

	// create function to make sure date sent to database is safe
	// passes each retrieved item through the mysql_real_escape_string function to strip out any characters 
	// that a hacker may have inserted in order to break into or alter your database
	function mysql_fix_string($string)
	{
	    if (get_magic_quotes_gpc()) $string = stripslashes($string);
	    return mysql_real_escape_string($string);
	}

	?>
	</div>
	<footer>
			<h5>@2016 | shreyas.bhandare@rutgers.edu </h5>
	</footer>
	</div>

</body>
</html>