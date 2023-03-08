<?php

include "../../../../../../config.php";

$id=$USER->id;
$sql = mysql_query("select firstname,lastname from mdl_user where id=$id");

$row = mysql_fetch_array($sql);
$name=$row['firstname']." ".$row['lastname'];
$level=$_GET['level'];
$seconds=$_GET['seconds'];
$attempt=mysql_query("select max(attemptno) as maxattemptno from game_score where userid=$id and game='Memory Game-IEAP'");
$row1 = mysql_fetch_array($attempt);
$attempt = $row1['maxattemptno']+1;

$points= round(100000 * ($level + 1) / $seconds / $attempt);

$sql1=mysql_query("insert into game_score (userid,firstname,game,level,no_of_seconds,attemptno,points) values('$id','$name','Memory Game-IEAP','Easy','$seconds','$attempt','$points')") or die(mysql_error());

header("Location:../062vsieact22h.html");
?>