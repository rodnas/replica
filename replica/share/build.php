<?php
// Module properties
$modul_image_path = $image_path . "product/";
$which_function = "list";
$which_php = $which_modul . $which_function . ".php";
$modul_header = "Nyelv";
include ($share_path . "header1.php");
include ($share_path . "header2.php");
?>
<script language="JavaScript">
<!--
var specifyimage=new Array(); 
specifyimage[0]="images/public/build.gif";
specifyimage[1]="images/public/build.gif";
specifyimage[2]="images/public/build.gif";
specifyimage[3]="images/public/build.gif";

var delay=4000 //2 seconds

//Counter for array 
var count =1;

var cubeimage=new Array()
for (i=0;i<specifyimage.length;i++)
	{
	cubeimage[i]=new Image()
	cubeimage[i].src=specifyimage[i]
	}

function movecube()
	{
	if (window.createPopup)
		cube.filters[0].apply()
	document.images.cube.src=cubeimage[count].src;
	if (window.createPopup)
		cube.filters[0].play()
	count++;
	if (count==cubeimage.length)
		count=0;
	setTimeout("movecube()",delay)
	}

window.onload=new Function("setTimeout('movecube()',delay)");
// end JavaScript -->
-->
</SCRIPT>
<?php
$html_page .= "<table border='0' height='300' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td valign='center' align='center'>";
$html_page .= "<img src='" . $image_public . "build.gif' name='cube'  border=0 style='filter:progid:DXImageTransform.Microsoft.Stretch(stretchStyle=\"PUSH\")'>";
$html_page .= "</td>";
include ($share_path . "footer.php");
?>


