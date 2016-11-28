<?php
if(!isset($_GET['id']) OR empty($_GET['id'])){ // if $_GET['id'] is not set or empty redirect to homepage
	header("Location: index.php");
}

//Get projects from database
$time_result = pg_query($db, "SELECT id,project_id,start,finish,(finish-start) spent  FROM project_time WHERE project_id=".$_GET['id']." ORDER BY id ASC"); //Select all from the time table
$project_result = pg_query($db, "SELECT * FROM project_details WHERE id=".$_GET['id']); //Select all the columns from the project table
$sumtime_result = pg_query($db, "SELECT sum(finish-start) total FROM project_time WHERE project_id=".$_GET['id']); //Select all from the time table

$project_row = pg_fetch_array($project_result); //Assign the project rows to the array $row

$sumtime = pg_fetch_array($sumtime_result);

if(!isset($project_row['id'])){ // if there's no project with the ID in  $_GET['id'] redirect to homepage
	header("Location: index.php");
}

//Assign the project times rows to the array $row
while ($time_rowi = pg_fetch_array($time_result))
{

    $time_row[] = $time_rowi;
}

//Correct hour view of one project
$Temp = explode('.', $sumtime['total']);
$sumtime = $Temp[0];

//Correct time log one project
// $Temp2 = explode('.', $time_row[$i]['spent']);
// $sumtimelog = $Temp2[0];
