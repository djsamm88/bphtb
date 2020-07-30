<?php 
$text = $_GET['text'];
include "qrlib.php";

$str = 'data/'.strtolower(str_replace(" ", "_", $text)).'.png';

QRcode::png($text);
//echo "<img src='img.png'>";

//echo $str;