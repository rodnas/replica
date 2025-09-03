<?php
function topmenu()
	{
	$topmenu = "<tr><td>";
	$topmenu .= "<table bgcolor='" . $GLOBALS["actcolor"] . "' width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:" . $GLOBALS["color2"] . ";border-width:thin;'>";
	$topmenu .= "<tr height='30'><td><table width='100%' cellspacing='0' cellpadding='0'>";
	$topmenu .= "<tr valign='center' height='15' bgcolor='" . $GLOBALS["actcolor"] . "'>";
	$menu_counter=sizeof($GLOBALS["topmenu"]);
	for ($menu_count = 0;$menu_count < $menu_counter;$menu_count++)
		{
		if ((actual_permission($GLOBALS["modul"][$GLOBALS["topmenu"][$menu_count]]["name"]) & ewAllowview) == ewAllowview)
			{
			$topmenu .= "<td align='center'>";
			$actual_action = viewModul($GLOBALS["topmenu"][$menu_count],"action");
			if (!isset($actual_action))
				{ 
				$topmenu .= "<a href='index.php?modul_select=".$GLOBALS["topmenu"][$menu_count]."&modul_action=list&cmd=resetall' class='leftmenu'>";
				}
			else
				{
				$topmenu .= "<a href='index.php?modul_select=".$GLOBALS["topmenu"][$menu_count]."&modul_action=".$actual_action."&cmd=resetall' class='leftmenu'>";
				}
			$topmenu .= "<span class='header' style='color: #000000;text-decoration:none;'><b>";
			$topmenu .= $GLOBALS["modul"][$GLOBALS["topmenu"][$menu_count]]["title"];
			$is_newitemcount = viewModulParam($GLOBALS["topmenu"][$menu_count],"is_newitemcount");
			if (isset($is_newitemcount) &&
				(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
				@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3))
				{
				if ((actual_permission(viewModul($GLOBALS["topmenu"][$menu_count],"name")) & ewAllowview) == ewAllowview)
					{
					$topmenuFilter = "active=1 AND is_read != 1 OR is_read IS NULL";
					$topmenuSQL = "SELECT COUNT(*) AS topmenucount FROM ".$GLOBALS["topmenu"][$menu_count]." WHERE " .$topmenuFilter;
					$topmenurs = mysqli_query($GLOBALS["conn"],$topmenuSQL);
					$topmenurow = mysqli_fetch_array($topmenurs);
					$topmenucount = @$topmenurow["topmenucount"];
					if ($topmenucount > 0)
						{
						$topmenu .= "<span style='color: blue;'><br>(".$topmenucount."&nbsp;".viewModulParam($modul_select,"newitem").")";
						}
					}
				}
			$topmenu .= "<b></span>";
			$topmenu .= "</a>";
			$topmenu .= "</td>";
			}
		}
	$topmenu .= "</tr>";
	$topmenu .= "</table></td></tr>";
	$topmenu .= "</table>";
	return $topmenu;
	}

function MakeTree(&$Page,&$name,$MysqlTable,$treecountSQL,$treeAdmin)
	{
	$x_treeAdmin = $treeAdmin;
	$usage="publicuse=0 OR publicuse=1";
	$result=mysqli_query($GLOBALS['conn'],"SELECT * FROM ".$MysqlTable." WHERE ".$usage." Order by name");
	while($Folder0=list($id,$name,$bgcolor,$fgcolor,$description,$active,$lang_id,$insert_user_id,$insert_datetime,$modify_user_id,$modify_datetime,$parent_id,$publicuse,$tree_id,$visitcounter,$lastvisit)=mysqli_fetch_array($result))
		{
		$table[$parent_id][$id]=$name;
		$partable[$id]=$parent_id;
		$Folder[$id]=$Folder0;
		};
	unset($Folder0);
	$levels=TreeLevels(0,$table,0);
	if(!isset($Folder[$Page]["name"]))
		{
		$Folder[$Page]["name"]="Home";
		}
	$name=$Folder[$Page]["name"];
	if($Page==0)
		{
		if(!isset($_SESSION[$GLOBALS["which_system"]."expandtree"]))
			{
			$_SESSION[$GLOBALS["which_system"]."expandtree"]=1;
			}
		$_SESSION[$GLOBALS["which_system"]."expandtree"]=-$_SESSION[$GLOBALS["which_system"]."expandtree"];
		if($_SESSION[$GLOBALS["which_system"]."expandtree"]<0)
			{
			$levelexpand=1;
			}
		else
			{
			$levelexpand=1; // or 100000
			}
		if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $treeAdmin)
			{
			$results="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
			$results.="&nbsp;<a href='?Page=0' class='leftmenu'>".viewModulParam($modul_select,"tree_top");
			if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
				{
				$results.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
				}
			$results.="</span></a>";
			$results.="</td>";
			if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
				{ 
				$results.="<td width='22'>";
				$results.="<a href='?modul_action=add&parent_id=0' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
				$results.="</td>";
				}		
			$results.="</td></tr></table>";
			}
		else
			{
			$results="&nbsp;<a href='?Page=0' class='leftmenu'>".viewModulParam($modul_select,"tree_top");
			if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
				{
				$results.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
				}
			$results.= "</span></a>";
			$results.="<br>";
			}
		$results.=TreeExpand(0,$table,$partable,$Folder,$Page,0,$levelexpand);
		}
	else
		{
		if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $treeAdmin)
			{
			$results="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
			$results.="&nbsp;<a href='?Page=0' class='leftmenu'>".viewModulParam($modul_select,"tree_top");
			$results.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
			$results.="</span></a>";
			$results.="</td>";
			$results.="<td width='22'>";
			if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
				{ 
				$results.="<td width='22'>";
				if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
					{
					$results.="<a href='?modul_action=add&parent_id=0' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'>";
					}
				$results.="</span></a>";
				$results.="</td>";
				}		
			$results.="</td></tr></table>";
			}
		else
			{
			$results="&nbsp;<a href='?Page=0' class='leftmenu'>".viewModulParam($modul_select,"tree_top");
			if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
				{
				$results.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
				}
			$results.="</span></a>";
			$results.="<br>";
			}
		$id=$Page;
		$results.=TreeNodes($id,$table,$partable,$Folder,$Page,$levels);
		$_SESSION[$GLOBALS["which_system"]."expandtree"]=1;
		}
	return $results;
	}

function  TreeLevels($parent_id,$table,$level)
	{
	$_SESSION[$GLOBALS["which_system"]."levels"][$parent_id]=$level;
	if (isset($table[$parent_id]))
		{
		while(list($key,$val)=each($table[$parent_id]))
			{
			if (isset($table[$key]))
				{
				TreeLevels($key,$table,$level+1);
				}
			}
		}
	return $_SESSION[$GLOBALS["which_system"]."levels"];
	}

function TreeNodes($id,$table,$partable,$Folder0,$Page,$levels)
	{
	$rez0="";
	$imgfolder0="&nbsp;";
//	$imgfolder0="<img src='".$GLOBALS["image_public"]."/folder.gif' alt='' width='20' height='20'>";
	$imgfolder1="&nbsp;";
//	$imgfolder1="<img src='".$GLOBALS["image_public"]."/folderopen.gif' alt='' width='20' height='20'>";
	if(isset($table[$id]))
		{
		$imgwidth="<img src='".$image_public."tr.gif' width='".(($levels[$id]+1)*10)."' height='1' alt=''>";
		$lisd=$table[$id];
		$id0=$id; $fiplevel=$levels[$id];
		while(list($key,$val)=each($lisd))
			{
			if($Page==$key)
				{
				if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
					$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $GLOBALS["treeAdmin"])
					{
					$rez0.="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
					$rez0.=$imgwidth.$imgfolder1."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez0.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez0.="</span></a>";
					$rez0.="</td>";
					$rez0.="<td>";
					if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
						{ 
						$rez0.="<td width='22'>";
						$rez0.="<a href='?modul_action=add&parent_id=".$Folder0[$key]["id"]."' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
						$rez0.="</td>";
						}		
					$rez0.="</td></tr></table>";
					}
				else
					{
					$rez0.=$imgwidth.$imgfolder1."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez0.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez0.="</span></a>";
					$rez0.="<br>";
					}
				}
			else
				{
				if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
					$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $GLOBALS["treeAdmin"])
					{
					$rez0.="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
					$rez0.=$imgwidth.$imgfolder0."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez0.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez0.="</span></a>";
					$rez0.="</td>";
					$rez0.="<td>";
					if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
						{ 
						$rez0.="<td width='22'>";
						$rez0.="<a href='?modul_action=add&parent_id=".$Folder0[$key]["id"]."' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
						$rez0.="</td>";
						}
					$rez0.="</td></tr></table>";
					}
				else
					{
					$rez0.=$imgwidth.$imgfolder0."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez0.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez0.="</span></a>";
					$rez0.="<br>";
					}
				}
			}
		}
	$res="";
	while ($id!=0)
		{
		$fip=$partable[$id];
		$fiplevel=$levels[$fip];
		$fiplist=$table[$fip];
		$imgwidth="<img src='".$image_public."tr.gif' width='".(($fiplevel+1)*10)."' height='1' alt=''>";
		$rez="";
		while(list($key,$val)=each($fiplist))
			{
			if($Page==$key)
				{
				if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
					$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $GLOBALS["treeAdmin"])
					{
					$rez.="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
					$rez.=$imgwidth.$imgfolder1."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu' style='color: red;'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez.="</span></a>";
					$rez.="</td>";
					$rez.="<td>";
					if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
						{ 
						$rez.="<td width='22'>";
						$rez.="<a href='?modul_action=add&parent_id=".$Folder0[$key]["id"]."' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
						$rez.="</td>";
						}	
					$rez.="</td></tr></table>".$rez0;;
					}
				else
					{
					$rez.=$imgwidth.$imgfolder1."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu' style='color: red;'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez.="</span></a>";
					$rez.="<br>".$rez0;
					}
				}
			else
				{
				if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
					$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $GLOBALS["treeAdmin"])
					{
					$rez.="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
					$rez.=$imgwidth.$imgfolder0."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez.="</span></a>";
					$rez.="</td>";
					$rez.="<td>";
					if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
						{ 
						$rez.="<td width='22'>";
						$rez.="<a href='?modul_action=add&parent_id=".$Folder0[$key]["id"]."' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
						$rez.="</td>";
						}	
					$rez.="</td></tr></table>";
					}
				else
					{
					$rez.=$imgwidth.$imgfolder0."<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$rez.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$rez.="</span></a>";
					$rez.="<br>";
					}
				}
			if($id==$key)
				{
				$rez.=$res; $res="";
				}
			}
		$res.=$rez;
		$id=$partable[$id];
		}
	return $rez;
	}

function TreeExpand($parent_id,$table,$partable,$Folder0,$Page,$level,$levelexpand)
	{
	$list=$table[$parent_id]; $width=($level+1)*10; $result='';
	if (isset($list))
		{
		while(list($key,$val)=each($list))
			{
			if($level<$levelexpand)
				{
				if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
					$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3) && $GLOBALS["treeAdmin"])
					{
					$result.="<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td valign='center' align='left'>";
					$result.="<img src='".$image_public."tr.gif' width='".$width."' height='1'>";
					$result.="&nbsp;<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$result.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$result.="</span></a>";
					$result.="</td>";
					$result.="<td>";
					if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
						{ 
						$result.="<td width='22'>";
						$result.="<a href='?modul_action=add&parent_id=".$Folder0[$key]["id"]."' class='header'><img src='" . $GLOBALS["image_button"] . "plus20x20.gif' border='0' name='view' title='".viewModulParam($modul_select,"addTitle")."'></span></a>";
						$result.="</td>";
						}		
					$result.="</td></tr></table>";
					}
				else
					{
					$result.="<img src='".$image_public."tr.gif' width='".$width."' height='1'>";
					$result.="&nbsp;<a href='?Page=".$Folder0[$key]["id"]."' class='leftmenu'>".$Folder0[$key]["name"];
					if (viewModul($GLOBALS["modul_select"],"notreecount")!=1)
						{
						$result.=" (".treecounter($GLOBALS["treecountSQL"]."'".$Folder0[$key]["tree_id"]."%'").")";
						}
					$result.="</span></a>";
					$result.="<br>";
					}
				}
			if (isset($table[$key]))
				{
				$result.=TreeExpand($key,$table,$partable,$Folder0,$Page,$level+1,$levelexpand);
				}
			}
		}
	return $result;
	}

function modul_header($search)
	{
	$result="";
	$menu_counter=sizeof($GLOBALS["topmenu"]);
	for ($menu_count = 0;$menu_count < $menu_counter;$menu_count++)
		{
		if ($GLOBALS["topmenu"][$menu_count]["name"] == $search)
			$result = $GLOBALS["topmenu"][$menu_count]["title"];
		}
	return $result;
	}

function header2()
	{
	$header2 = "<tr><td colspan='2' align='center'>";
	if (!empty($GLOBALS["header"]))
		{
		$headerimage = $GLOBALS["image_public"] . $GLOBALS["header"];
		$headersize = getimagesize($headerimage);
		$header2 .= "<table background='" . $headerimage . "' width='" . $headersize[0] . "' height='" . $headersize[1] . "' cellspacing='0' cellpadding='0'>";
		$date_margin = "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	else
		{
		$header2 .= "<table  bgcolor='".$GLOBALS["actcolor"]."' width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:".$GLOBALS["actcolor"].";border-width:thin;'>";
		$date_margin="";
		}
	$header2 .= "</td></tr>";
	$header2 .= "<tr>";
	$header2 .= "<td width='70' align='right'><span class='header'>".$date_margin . date('Y.m.d.<br>',time()) . "</span></td>";
	$header2 .= "<td align='center'><span class='header'><b>" . $GLOBALS["modul"][$GLOBALS["modul_select"]]["title"] . "</b></td>";
	$header2 .= "<td width='70'><span class='phpmaker'>&nbsp</span></td>";
	$header2 .= "</tr>";
	$header2 .= "</table>";
	$header2 .= "</td></tr>";
	$header2 .= "<tr valign='top'><td align='center' valign='top'>";
	return $header2;
	}

function header3()
	{
	if (!empty($GLOBALS["header"]))
		{
		$headerimage = $GLOBALS["image_public"] . $GLOBALS["header"];
		$headersize = getimagesize(urldecode($headerimage));
		$header3 .= "<table background='" . $headerimage . "' width='" . $headersize[0] . "' height='" . $headersize[1] . "'  cellspacing='0' cellpadding='0'>";
		$date_margin = "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	else
		{
		$header3 .= "<table  bgcolor='".$GLOBALS["actcolor"]."' width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:".$GLOBALS["color2"].";border-width:thin;'>";
		$date_margin="";
		}
	$header3 .= "</td></tr>";
	$header3 .= "<tr>";
	$header3 .= "<td width='70' align='right'><span class='header'>".$date_ . date('Y.m.d.<br>',time()) . "</span></td>";
	$header3 .= "<td align='center'><span class='header'><b>".$GLOBALS["modul"][$GLOBALS["modul_select"]]["title"]."</b></td>";
	$header3 .= "<td width='70'><span class='phpmaker'>&nbsp</span></td>";
	$header3 .= "</tr>";
	$header3 .= "</table>";
	$header3 .= "</td></tr>";
	$header3 .= "<tr align='center' valign='top' height='25'><td>";
	$header3 .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
	$header3 .= "<tr valign='top'>";
	$header3 .= "<td width='40' align='left' valign='middle'>";
	$header3 .= "</td>";
	$header3 .= "<td align='center'>";
	$header3 .= "<table height='25' width='300' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:".$GLOBALS["color2"].";border-width:thin;'>";
	$header3 .= "<tr>";
	$header3 .= "<td align='center' bgcolor='".$GLOBALS["actcolor"]."'><span class='header'><b>".viewModulParam($modul_select,$GLOBALS["modul_action"]."Title")."</b></td>";
	$header3 .= "</tr>";
	$header3 .= "</table>";
	$header3 .= "</td>";
	$header3 .= "<td width='40'>&nbsp;</td>";
	$header3 .= "</tr>";
	$header3 .= "</table>";
	$header3 .= "</td></tr>";
	$header3 .= "<tr><td align='center' valign='top'>";
	return $header3;
	}


function activateTd($which_field)
	{
	$activatetd = "<td bgcolor='" . $GLOBALS["color6"] . "'><span class='phpmaker'>";
	if ($GLOBALS[$which_field]) 
		{
		$activatetd .= "<INPUT NAME='".$which_field."' TYPE='checkbox' CHECKED value='true'>";
		}
	else
		{
		$activatetd .= "<INPUT NAME='".$which_field."' TYPE='checkbox' value='false'>";
		}
	$activatetd .= "</td>";
	return $activatetd;
	}

function activateTr($which_field,$which_head)
	{
	$activatetr = "";
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$activatetr = "<tr>";
		$activatetr .= "<td bgcolor='" . $GLOBALS["actcolor"] . "'><span class='phpmaker'>".viewModulParam($modul_select,$which_head)."&nbsp;</span></td>";
		$activatetr .= "<td bgcolor='" . $GLOBALS["color6"] . "'><span class='phpmaker'>";
		if ($GLOBALS[$which_field]) 
			{
			$activatetr .= "<INPUT NAME='".$which_field."' TYPE='checkbox' CHECKED value='true'>";
			}
		else
			{
			$activatetr .= "<INPUT NAME='".$which_field."' TYPE='checkbox' value='false'>";
			}
		$activatetr .= "</td>";
		$activatetr .= "</tr>";
		}
	else
		{
		$activatetr .= "<input type='hidden' name='".$which_field."' value='" . htmlspecialchars($GLOBALS[$which_field]) . "'>";
		}
		return $activatetr;
	}

// Switch active
function activeTd($x_which_field,$yes_tooltip,$no_tooltip)
	{
	$back_text = "";
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		if (!isset($GLOBALS["bgcolor"]))
			$GLOBALS["bgcolor"] = $GLOBALS["color6"];
		else
			$GLOBALS["bgcolor"] = $GLOBALS["bgcolor"];
		$back_text .= "<td bgcolor='" . $GLOBALS["bgcolor"] . "' align='center'>&nbsp;";
		$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
		if (isset($is_newitemcount) &&
			($GLOBALS["x_is_read"] != 1 || is_null($GLOBALS["x_is_read"])))
			{
			$back_text .= "<span style='color: blue;'>(".viewModulParam($GLOBALS["modul_select"],"newitem").")&nbsp;</span>";
			}
		if (!is_null($x_which_field) && $x_which_field <> 0) 
			{
			$back_text .= "<img src='".$GLOBALS["image_public"]."pipa.gif' border='0' title='".$yes_tooltip."'>";
			}
		else
			{
			$back_text .= "<img src='".$GLOBALS["image_public"]."x.gif' border='0' title='".$no_tooltip."'>";
			}
		$back_text .= "</td>";
		}
	return $back_text;
	}
	
function activeTr($x_which_field,$which_head,$yes_tooltip,$no_tooltip)
	{
	$back_text = "";
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$back_text .= "<tr>";
		$back_text .= "<td bgcolor='" . $GLOBALS["actcolor"] . "'><span class='phpmaker'>".viewModulParam($modul_select,$which_head)."&nbsp;</span></td>";
		$back_text .= "<td bgcolor='" . $GLOBALS["color6"] . "'>";
		if ($which_head == "active")
			{
			$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
			if (isset($is_newitemcount) &&
				($GLOBALS["x_is_read"] != 1 || is_null($GLOBALS["x_is_read"])))
				{
				$back_text .= "<span class='phpmaker' style='color: blue;'>(".viewModulParam($modul_select,"newitem").")&nbsp;</span>";
				}
			}
		if (!is_null($x_which_field) && $x_which_field <> 0) 
			{
			$back_text .= "<img src='".$GLOBALS["image_public"]."pipa.gif' border='0' title='".$yes_tooltip."'>";
			}
		else
			{
			$back_text .= "<img src='".$GLOBALS["image_public"]."x.gif' border='0' title='".$no_tooltip."'>";
			}
		$back_text .= "</td>";
		$back_text .= "</tr>";
		}
		return $back_text;
	}

function footer($modul_footer)
	{
	$footer = "";
	if (!empty($modul_footer))
		{
		$footer = "</table>";
		$footer .= "</td></tr>";
		$footer .= "<tr height='10'><td colspan='2' align='center'>";
		$footer .= "<table border=0 width='100%' cellspacing='1' cellpadding='1'><tr>";
		$footer .= "<td width='10'></td>";
		$footer .= "<td width='165'></td>";
		if ($modul_footer!="view")
			{
			$buttonsize = getimagesize(urldecode($GLOBALS["image_button"]."ok.gif"));
			$footer .= "<td align='center'><input type='submit' name='Action' value='&nbsp;' style='width:" . $buttonsize[0] . ";height:" . $buttonsize[1] . ";background-color:transparent;background-image: url(".$GLOBALS["image_button"]."ok.gif);background-repeat:no-repeat;background-position:center;border:0' title='".viewModulParam($modul_select,$modul_footer)."'></td>";
			}
		else
			{
			$footer .= "<td align='center'></td>";
			}			
		$footer .= "<td width='165' align='right'>";
		if (!empty($GLOBALS["which_back"]))
			{
			$footer .= "<a href='index.php?modul_action=".$GLOBALS["which_back"]."'><img src='".$GLOBALS["image_button"].viewModulParam($GLOBALS["modul_select"],"backButton")."' border=0 name='back' title='".viewModulParam($modul_select,"backTitle")."'></a>";
			}
		$footer .= "</td>";
		$footer .= "<td width='10'></td>";
		$footer .= "</tr><table>";
		$footer .= "</td></tr>";
		$footer .= "</form>";
		$footer .= "</table>";
		}
	$footer .= "</td></tr>";
	$footer .= advert("bottomline",viewModul($modul_select,"bottomlineadvert"));
	$footer .= "<tr align='center'><td>";
	if (!empty($GLOBALS["footer"]))
		{
		$footerimage = "images/public/" . $GLOBALS["footer"];
		$footersize = getimagesize(urldecode($footerimage));
		$footer .= "<table background='images/public/" . $GLOBALS["footer"] . "' width='" . $footersize[0] . "' height='" . $footersize[1] . "' cellspacing='1'>";
		}
	else
		{
		$footer .= "<table width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:" . $GLOBALS["actcolor"] . ";border-width:thin;'>";
		}
	$footer .= "</td></tr>";
	$footer .= "<tr height='25'>";
	if (!empty($GLOBALS["footer"]))
		{
		$footer .= "<td colspan='4' align='left'>";
		}
	else
		{
		$footer .= "<td colspan='4' align='left' bgcolor='" . $GLOBALS["actcolor"] . "'>";
		}
	$footer .= "<span class='footer'>&nbsp;&nbsp;&nbsp;&nbsp;" . $GLOBALS["copyright"] . "</td>";
	$footer .= "</tr>";
	$footer .= "</table>";
	$footer .= "</td></tr>";
	$footer .= "</table>";
	$footer .= "<form>";
	$footer .= "</form>";
	$footer .= "</div>";
	$footer .= "</body>";
	$footer .= "</html>";
	$GLOBALS["html_page"] .= $footer;
	ECHO $GLOBALS["html_page"];
//	debug("debug.txt",true);
	}

function srch_footer()
	{
	$srch_footer = "</table>";
	$srch_footer .= "</td></tr>";
	$srch_footer .= "<tr height='10'><td align='center'>";
	$buttonsize = getimagesize(urldecode($GLOBALS["image_button"] . "ok.gif"));
	$srch_footer .= "<input type='submit' name='Action' value='&nbsp;' style='width:" . $buttonsize[0] . ";height:" . $buttonsize[1] . ";background-color:transparent;background-image: url(images/public/" . $actdesign . "/button/ok.gif);background-repeat:no-repeat;background-position:center;border:0'>";
	$srch_footer .= "</td></tr>";
	$srch_footer .= "</form>";
	$srch_footer .= "</table>";
	return $srch_footer;
	}
function submenu()
	{
	if (!isset($GLOBALS["which_action"])) $GLOBALS["which_action"] = $GLOBALS["which_modul"];
	if (!isset($GLOBALS["plus_param"])) $GLOBALS["plus_param"] = "";
	$submenu .= "<tr><td valign='center' align='center'>";
	$submenu .= "<table border=0 cellspacing='1' cellpadding='2'>";
	$submenu .= "<tr align='center' valign='center'>";
	$submenu .= "<td></td>";
	$subbuttonsize = getimagesize(urldecode($GLOBALS["image_button"] . 'view.gif'));
	$subwidthsize = $subbuttonsize[0]+2;
	if (($GLOBALS["ewCurSec"] & ewAllowView) == ewAllowView) 
		{ 
		if (!isset($GLOBALS["noview"]) || !$GLOBALS["noview"])
			{
			$submenu .= "<td width=" . $subwidthsize . ">";
			if ((@$GLOBALS["row"]["id"] != NULL))
				{
				$submenu .= "<a href='index.php?modul_action=view&key=" . urlencode($GLOBALS["x_id"]) . $GLOBALS["plus_param"]."'>";
				}
			else
				{
				$submenu .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$submenu .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"viewButton")."' border='0' name='view' title='".viewModulParam($GLOBALS["modul_select"],"viewTitle")."'></a></td>";
			}
		}
	if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd &&
		($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 || $_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3))
		{ 
		if (!isset($GLOBALS["nocopy"]) || !$GLOBALS["nocopy"])
			{
			$submenu .= "<td width=" . $subwidthsize . ">";
			if ((@$GLOBALS["row"]["id"] != NULL))
				{
				$submenu .= "<a href='index.php?modul_action=add&key=" . urlencode($GLOBALS["x_id"]) . $GLOBALS["plus_param"]."'>";
				}
			else
				{
				$submenu .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$submenu .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"copyButton")."' border='0' name='copy' title='".viewModulParam($GLOBALS["modul_select"],"copyTitle")."'></a></td>";
			}
		} 
	if (($GLOBALS["ewCurSec"] & ewAllowEdit) == ewAllowEdit) 
		{ 
		if (!isset($GLOBALS["noedit"]) || !$GLOBALS["noedit"])
			{
			$submenu .= "<td width=" . $subwidthsize . ">";
			if ((@$GLOBALS["row"]["id"] != NULL))
				{
				$submenu .= "<a href='index.php?modul_action=edit&key=" . urlencode($GLOBALS["x_id"]) . $GLOBALS["plus_param"]."'>";
				}
			else
				{
				$submenu .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$submenu .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"editButton")."' border='0' name='edit' title='".viewModulParam($GLOBALS["modul_select"],"editTitle")."'></a></td>";
			}
		}
	if (($GLOBALS["ewCurSec"] & ewAllowDelete) == ewAllowDelete) 
		{ 
		if (!isset($GLOBALS["nodelete"]) || !$GLOBALS["nodelete"])
			{
			$submenu .= "<td width=" . $subwidthsize . ">";
			if ((@$GLOBALS["row"]["id"] != NULL))
				{
				$submenu .= "<a href='index.php?modul_action=delete&key=" . urlencode($GLOBALS["x_id"]) . $GLOBALS["plus_param"]."'>";
				}
			else
				{
				$submenu .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$submenu .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"deleteButton")."' border='0' name='delete' title='".viewModulParam($GLOBALS["modul_select"],"deleteTitle")."'></a></td>";
			}
		} 
	$submenu .= "</tr></table>";
	$submenu .= "</td></tr>";
	return $submenu;
	}

function navigation()
	{
	// Navigation form 
	$navigation = "<tr><td>";
	if ($GLOBALS["totalRecs"] > 0)
		{
		$GLOBALS["rsEof"] = ($GLOBALS["totalRecs"] < ($GLOBALS["startRec"] + $GLOBALS["displayRecs"]));
		$GLOBALS["PrevStart"] = $GLOBALS["startRec"] - $GLOBALS["displayRecs"];
		if ($GLOBALS["PrevStart"] < 1) $GLOBALS["PrevStart"] = 1;
		$GLOBALS["NextStart"] = $GLOBALS["startRec"] + $GLOBALS["displayRecs"];
		if ($GLOBALS["NextStart"] > $GLOBALS["totalRecs"] ) $GLOBALS["NextStart"] = $GLOBALS["startRec"];
		$GLOBALS["LastStart"] = intval(($GLOBALS["totalRecs"]-1)/$GLOBALS["displayRecs"])*$GLOBALS["displayRecs"]+1;
		if ($GLOBALS["startRec"] > $GLOBALS["totalRecs"])
			{
			$GLOBALS["startRec"] = $GLOBALS["totalRecs"];
			}
		$GLOBALS["stopRec"] = $GLOBALS["startRec"] + $GLOBALS["displayRecs"] - 1;
		$GLOBALS["recCount"] = $GLOBALS["totalRecs"] - 1;
		if ($GLOBALS["rsEof"])
			{
			$GLOBALS["recCount"] = $GLOBALS["totalRecs"];
			}
		if ($GLOBALS["stopRec"] > $GLOBALS["recCount"])
			{
			$GLOBALS["stopRec"] = $GLOBALS["recCount"];
			}
		$navigation .= "<center>";
		$navigation .= "<table height='30' border='0' width='100%' cellspacing='0' cellpadding='0'>";
		$navigation .= "<tr valign='center' width='165'><td width='10'></td><td width='180' align='left'><span class='phpmaker'>";
		$navigation .= viewModulParam($modul_select,"item")." <b>" . $GLOBALS["startRec"] . " - " . $GLOBALS["stopRec"] . " / " . $GLOBALS["totalRecs"] . "</b> </span></td>";
		$navigation .= "<form name='navigation'>";
		$navigation .= "<td align='center' valign='top'>";
		$navigation .= "<table border='0' cellspacing='1' cellpadding='2'>";
		$navigation .= "<tr valign='middle'><td width='35' align='left'><span class='phpmaker'>".viewModulParam($modul_select,"page")."</span></td>";
		// first page button
		if ($GLOBALS["startRec"] == 1)
			{
			$navigation .= "<td><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"noButton")."' border='0'></td>";
			}
		else
			{
			$navigation .= "<td><a href='index.php?start=1'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"firstButton")."' border=0 name='first' title='".viewModulParam($modul_select,"firstTitle")."'></a></td>";
			}
		// previous page button
		if ($GLOBALS["PrevStart"] == $GLOBALS["startRec"])
			{
			$navigation .= "<td><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"noButton")."' border='0'></td>";
			}
		else
			{
			$navigation .= "<td><a href='index.php?start=" . $GLOBALS["PrevStart"] . "'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"prevButton")."' border=0 name='backward' title='".viewModulParam($modul_select,"prevTitle")."'></a></td>";
			}
		// current page number
		$navigation .= "<td><span class='phpmaker'><input type='text' name='pageno' value='";
		$navigation .= intval(($GLOBALS["startRec"]-1)/$GLOBALS["displayRecs"])+1;
		$navigation .= "' size='4' style='text-align:right'></span></td>";
		$navigation .= "<td width='40' align='left'><span class='phpmaker'>/<b>";
		$navigation .= intval(($GLOBALS["totalRecs"]-1)/$GLOBALS["displayRecs"])+1;
		$navigation .= "</b></span></td>";
		// next page button
		if ($GLOBALS["NextStart"] == $GLOBALS["startRec"])
			{
			$navigation .= "<td><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"noButton")."' border='0'></td>";
			}
		else
			{
			$navigation .= "<td><a href='index.php?start=" . $GLOBALS["NextStart"] . "'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"nextButton")."' border=0 name='forward' title='".viewModulParam($modul_select,"nextTitle")."'></a></td>";
			}
		// last page button 
		if ($GLOBALS["LastStart"] == $GLOBALS["startRec"])
			{
			$navigation .= "<td><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"noButton")."' border='0'></td>";
			}
		else
			{
			$navigation .= "<td><a href='index.php?start=" . $GLOBALS["LastStart"] . "'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"lastButton")."' border=0 name='last' title='".viewModulParam($modul_select,"lastTitle")."'></a></td>";
			}
		if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
			{
			if (!isset($GLOBALS["noadd"]) || !$GLOBALS["noadd"])
				{
				$navigation .= "<td>";
				$navigation .= "<a href='index.php?modul_action=add" . $GLOBALS["plus_param"]."'>";
				$navigation .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"addButton")."' border=0 name='plus' title='".viewModulParam($modul_select,"addTitle")."'></a></td>";
				}
			}
		$navigation .= "</form>";	
		$navigation .= "</td></tr></table></td>";
		$navigation .= "<td width=165' align='right'>";
		if (!empty($GLOBALS["which_back"]))
			{
			$navigation .= "<a href='index.php?modul_action=" . $GLOBALS["which_back"] . "'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"backButton")."' border=0 name='back' title='".viewModulParam($modul_select,"backTitle")."'></a>";
			}
		$navigation .= "</td>";
		$navigation .= "<td width='10'></td>";
		}
	else
		{
		$navigation .= "<table height='30' border='0' width='100%' cellspacing='0' cellpadding='0'>";
		$navigation .= "<tr>";
		$navigation .= "<td width='180'></td>";
		if (($GLOBALS["ewCurSec"] & ewAllowList) == ewAllowList)
			{
			$navigation .= "<td align='center'>Nincs találat!</td>";
			}
		else
			{
			$navigation .= "<td align='center'>Nincs jogosultság!</td>";
			}
		if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
			{
			if (!isset($GLOBALS["noadd"]) || !$GLOBALS["noadd"])
				{
				$navigation .= "<td>";
				$navigation .= "<a href='index.php?modul_action=add" . $GLOBALS["plus_param"]."'>";
				$navigation .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"addButton")."' border=0 name='plus' title='".viewModulParam($modul_select,"addTitle")."'></a></td>";
				}
			}
		$navigation .= "</td>";
		$navigation .= "<td width='165'></td>";
		if (!empty($GLOBALS["which_back"]))
			{
			$navigation .= "<td align='right'><a href='index.php?modul_action=" . $GLOBALS["which_back"] . "'><img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"backButton")."' border=0 name='back' title='".viewModulParam($modul_select,"backTitle")."'></a></td>";
			}
		$navigation .= "<td width='10'></td>";
		}
	$navigation .= "</td></tr></table></td></tr></center>";
	return $navigation;
	}

function searchtop()
	{
	if (($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3))
		{
		$left_width = 250;
		}
	else
		{
		$left_width = 220;
		}
	$searchtop = "<tr valign='top' align='center' bgcolor='" . $GLOBALS["color1"] . "'><td width='".$left_width."' bgcolor='" . $GLOBALS["color3"] . "' style='border-style:solid;border-color:" . $GLOBALS["color3"] . ";border-width:thin;'>";
	if (!isset($GLOBALS["which_action"])) $GLOBALS["which_action"] = $GLOBALS["which_modul"];
	$searchtop .= "<table border=0 width='100%' bgcolor='" . $GLOBALS["color1"] . "' cellspacing='0' cellpadding='0'>";

	$searchtop .= "<form action='index.php?action=" . $GLOBALS["which_action"] . "list' method='post' name='listsrch'>";
/*
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
		{
		if (is_file($GLOBALS["import_path"]."/imp.txt"))
			{
			$searchtop .= "<tr valign='center' align='left'>";
			$searchtop .= "<td align='center'>";
			$searchtop .= "<table width='100%' border=0 bgcolor='" . $GLOBALS["color1"] . "' cellspacing='1' cellpadding='2'>";
			$searchtop .= "<tr valign='center'>";
			$searchtop .= "<td width='50' align='center'>";
			$searchtop .= "<a href='index.php?modul_select=message_wall&modul_action=list&cmd=resetall'>";
			$searchtop .= "<img src='" .$GLOBALS["modul"]["import"]["icon"] . "' border=0 name='import' title='".viewModul("import","title")."'>";
			$searchtop .= "</a>";
			$searchtop .= "</td>";
			$searchtop .= "<td>";
			$searchtop .= "<span class='phpmaker'>".viewModulParam($modul_select,"newitem")."</span>";
			$searchtop .= "</td>";
			$searchtop .= "</tr>";
			$searchtop .= "</table>";
			$searchtop .= "</td>";
			$searchtop .= "</tr>";
			$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
			}
		}
*/	
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] > 1)
		{
		if ((actual_permission(viewModul("message_wall","name")) & ewAllowview) == ewAllowview)
			{
			$messageFilter = "active=1 AND is_read != 1";
			$messageFilter .= " AND target_user_id=".$_SESSION[$GLOBALS["which_system"] . "status_UserID"];
			$messagesql = "SELECT COUNT(*) AS messcount FROM message_wall WHERE " .$messageFilter;
			$messagers = mysqli_query($GLOBALS["conn"],$messagesql);
			$messagerow = mysqli_fetch_array($messagers);
			$messagecount = @$messagerow["messcount"];
			if ($messagecount > 0)
				{
				$searchtop .= "<tr valign='center' align='left'>";
				$searchtop .= "<td align='center'>";
				$searchtop .= "<table width='100%' border=0 bgcolor='" . $GLOBALS["color1"] . "' cellspacing='1' cellpadding='2'>";
				$searchtop .= "<tr valign='center'>";
				$searchtop .= "<td width='50' align='center'>";
				$searchtop .= "<a href='index.php?modul_select=message_wall&modul_action=list&cmd=resetall'>";
				$searchtop .= "<img src='" .$GLOBALS["modul"]["message_wall"]["icon"] . "' border=0 name='newmessage_wall' title='".viewModul("message_wall","title")."'></a>";
				$searchtop .= "</td>";
				$searchtop .= "<td>";
				$searchtop .= "<span class='phpmaker'><b>".$messagecount."</b>&nbsp;".viewModulParam($modul_select,"newitem")."</span>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "</table>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
				}
			}
		}
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
		{
		if ((actual_permission(viewModul("orders","name")) & ewAllowview) == ewAllowview)
			{
			$ordersFilter = "active=1 AND (is_read = 0 OR is_read IS NULL)";
			$orderssql = "SELECT COUNT(*) AS orderscount FROM orders WHERE " .$ordersFilter;
			$ordersrs = mysqli_query($GLOBALS["conn"],$orderssql);
			$ordersrow = mysqli_fetch_array($ordersrs);
			$orderscount = @$ordersrow["orderscount"];
			if ($orderscount > 0)
				{
				$searchtop .= "<tr valign='center' align='left'>";
				$searchtop .= "<td align='center'>";
				$searchtop .= "<table width='100%' border=0 bgcolor='" . $GLOBALS["color1"] . "' cellspacing='1' cellpadding='2'>";
				$searchtop .= "<tr valign='center'>";
				$searchtop .= "<td width='50' align='center'>";
				$searchtop .= "<a href='index.php?modul_select=orders&modul_action=list&cmd=resetall'>";
				$searchtop .= "<img src='" .$GLOBALS["modul"]["orders"]["icon"] . "' border=0 name='neworders' title='".viewModul("orders","title")."'></a>";
				$searchtop .= "</td>";
				$searchtop .= "<td>";
				$searchtop .= "<span class='phpmaker'><b>".$orderscount."</b>&nbsp;".viewModulParam($modul_select,"newitem")."</span>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "</table>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
				}
			}
		}
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
		{
		if ((actual_permission(viewModul("advert_item","name")) & ewAllowview) == ewAllowview)
			{
			$advertFilter = "active=1 AND is_read != 1 OR is_read IS NULL";
			$advertSQL = "SELECT COUNT(*) AS advertcount FROM advert_item WHERE " .$advertFilter;
			$advertrs = mysqli_query($GLOBALS["conn"],$advertSQL);
			$advertrow = mysqli_fetch_array($advertrs);
			$advertcount = @$advertrow["advertcount"];
			if ($advertcount > 0)
				{
				$searchtop .= "<tr valign='center' align='left'>";
				$searchtop .= "<td align='center'>";
				$searchtop .= "<table width='100%' border=0 bgcolor='" . $GLOBALS["color1"] . "' cellspacing='1' cellpadding='2'>";
				$searchtop .= "<tr valign='center'>";
				$searchtop .= "<td width='50' align='center'>";
				$searchtop .= "<a href='index.php?modul_select=advert_item&modul_action=list&cmd=resetall'>";
				$searchtop .= "<img src='" .$GLOBALS["modul"]["advert_item"]["icon"] . "' border=0 name='newadvert' title='".viewModul("advert_item","title")."'></a>";
				$searchtop .= "</td>";
				$searchtop .= "<td>";
				$searchtop .= "<span class='phpmaker'><b>".$advertcount."</b>&nbsp;".viewModulParam("advert","newitem")."</span>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "</table>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
				}
			}
		}
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
		{
		if ((actual_permission(viewModul("support_item","name")) & ewAllowview) == ewAllowview)
			{
			$supportFilter = "active=1 AND is_read != 1 OR is_read IS NULL";
			$supportSQL = "SELECT COUNT(*) AS supportcount FROM support_item WHERE " .$supportFilter;
			$supportrs = mysqli_query($GLOBALS["conn"],$supportSQL);
			$supportrow = mysqli_fetch_array($supportrs);
			$supportcount = @$supportrow["supportcount"];
			if ($supportcount > 0)
				{
				$searchtop .= "<tr valign='center' align='left'>";
				$searchtop .= "<td align='center'>";
				$searchtop .= "<table width='100%' border=0 bgcolor='" . $GLOBALS["color1"] . "' cellspacing='1' cellpadding='2'>";
				$searchtop .= "<tr valign='center'>";
				$searchtop .= "<td width='50' align='center'>";
				$searchtop .= "<a href='index.php?modul_select=support_item&modul_action=list&cmd=resetall'>";
				$searchtop .= "<img src='" .$GLOBALS["modul"]["support_item"]["icon"] . "' border=0 name='newsupport_item' title='".viewModul("support_item","title")."'></a>";
				$searchtop .= "</td>";
				$searchtop .= "<td>";
				$searchtop .= "<span class='phpmaker'><b>".$supportcount."</b>&nbsp;".viewModulParam($modul_select,"newitem")."</span>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "</table>";
				$searchtop .= "</td>";
				$searchtop .= "</tr>";
				$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
				}
			}
		}
	$searchtop .= "<tr valign='top' align='left'>";
	$searchtop .= "<td align='center'><span class='phpmaker'><b>".viewModulParam($modul_select,"search")."</b></span></td>";
	$searchtop .= "</tr>";
	$searchtop .= "<tr valign='top' align='center'>";
	$searchtop .= "<td><span class='phpmaker'><input type='text' name='psearch' value='".stripcslashes($GLOBALS["pSearchOriginal"])."' size='25'></span></td>";
	$searchtop .= "</tr>";
/* 2005.10.15. New version
	$searchtop .= "<tr valign='top' align='right'>";
	$searchtop .= "<td align='left'><span class='phpmaker'>";
	$searchtop .= "<input type='radio' name='psearchtype' value='' checked>".viewModulParam($modul_select,"exact")."<br>";
	$searchtop .= "<input type='radio' name='psearchtype' value='AND'>".viewModulParam($modul_select,"allword")."<br>";
	$searchtop .= "<input type='radio' name='psearchtype' value='OR'>".viewModulParam($modul_select,"anyword")."</span></td>";
	$searchtop .= "</tr>";
*/
	$searchtop .= "<tr valign='top' align='center'>";
	$searchtop .= "<td>";
	$searchtop .= "<span class='phpmaker'>";
	$searchtop .= "</span>";
	$searchtop .= "</td>";
	$searchtop .= "</tr>";
	$searchtop .= "<tr width='100%' >";
	$searchtop .= "<td align='right'>";
	$searchtop .= "<table>";
	$searchtop .= "<tr align='right'>";
	$buttonsize = getimagesize(urldecode($GLOBALS["image_button"] . "ok.gif"));
	$tdwidth = $buttonsize[0]+5;
/*
	$searchtop .= "<td width='" . $tdwidth . "'>";
	$searchtop .= "<span class='phpmaker'><a href='index.php?modul_action=srch'><img src='" . $GLOBALS["image_button"] . "srch.gif' border='0' title='".viewModulParam($modul_select,"asrch")."' name='all'></a></span>";
	$searchtop .= "</td>";
*/
	$searchtop .= "<td width='" . $tdwidth . "'>";
	if ((!empty($GLOBALS["sqlfilter"]) && $GLOBALS["sqlfilter"] <> "ALL") || !empty($GLOBALS["searchwhere"]))
		{
		$searchtop .= "<span class='phpmaker'><a href='index.php?action=" . $GLOBALS["modul_include"] . "&cmd=RESET'><img src='" . $GLOBALS["image_button"] . "all.gif' border='0' title='".viewModulParam($modul_select,"showall")."' name='all'></a></span>";
		}
	$searchtop .= "</td>";
	$searchtop .= "<td width='" . $tdwidth . "'><span class='phpmaker'>";
	$searchtop .= "<input type='submit' name='Submit' value='&nbsp;'  style='width:" . $buttonsize[0]. ";height:" . $buttonsize[1]. ";background-color:transparent;background-image: url(" . $GLOBALS["image_button"] . "ok.gif);background-repeat:no-repeat;background-position:center;border:0' title='".viewModulParam($modul_select,"srch")."'></span></td>";
	$searchtop .= "</tr>";
	$searchtop .= "</table>";
	$searchtop .= "</td>";
	$searchtop .= "</tr>";
	$searchtop .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
	return $searchtop;
	}

function searchbottom()
	{
	if ($GLOBALS["counter"] == "1")
		{
		$statfull ="counter/allcounter.txt";
		if  (is_file($statfull))
			{
			if ($faf = fopen( $statfull, "r"))
				{
				flock( $faf, 1) ;
				while (!feof($faf))
					{
					$sorf = fgets($faf, 1024);
					}
				flock($faf, 3);
				fclose($faf);
				}
		
			}
		else
			{
			touch($statfull);
			}
		$searchbottom .= "<tr height='10'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
		$searchbottom .= "<tr bgcolor='" . $GLOBALS["color3"] . "'><td align='center'>";
		$searchbottom .= "<span class='header' style='font-size: x-small;color:" . $GLOBALS["color1"] . ";'><b>".viewModulParam($modul_select,"visitor")."</b></span>";
		$searchbottom .= "</td></tr>";
		$searchbottom .= "<tr align='center' bgcolor='" . $GLOBALS["color1"] . "' height='4'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
		$searchbottom .= "<tr align='center' bgcolor='" . $GLOBALS["color1"] . "'><td bgcolor='" . $GLOBALS["color3"] . "'>";
		$searchbottom .= "<table border='0' width='90%' cellspacing='0' cellpadding='0'  style='border-style:groove;border-color:" . $GLOBALS["color3"] . ";border-width:2pt 2pt 2pt 2pt;'>";
		$searchbottom .= "<tr bgcolor='" . $GLOBALS["color2"] . "'><td align='right'>";
		$searchbottom .= "<span class='phpmaker' style='font-size: x-small;color:black;'>".$sorf."&nbsp;</span>";
		$searchbottom .= "</td></tr>";
		$searchbottom .= "</table>";
		$searchbottom .= "</td></tr>";
		if (!empty($GLOBALS["llogoleft"]))
			{
			$searchbottom .= "<tr height='10'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
			$searchbottom .= "<tr align='center' bgcolor='" . $GLOBALS["color1"] . "'><td bgcolor='" . $GLOBALS["color3"] . "'>";
			$searchbottom .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
			$searchbottom .= "<tr bgcolor='" . $GLOBALS["color3"] . "'><td align='center'>";
			$searchbottom .= "<span class='phpmaker'><img src='".$GLOBALS["image_public"].$GLOBALS["llogoleft"]."' border=0></span>";
			$searchbottom .= "</td></tr>";
			$searchbottom .= "</table>";
			$searchbottom .= "</td></tr>";
			}
		}
	$searchbottom .= "</form>";
	$searchbottom .= "</table>";
	return $searchbottom;
	}

function itemstatus()
	{
	$itemstatus = "";
	if (!empty($GLOBALS["x_description"]))
		{
		$itemstatus .= "<tr height='20' valign='top' align='center'>";
		$itemstatus .= "<td><table width='90%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:" . $GLOBALS["color2"] . ";border-width:thin'>";
		$itemstatus .= "<tr bgcolor='".$GLOBALS["actcolor"]."' align='left'>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "<td><span class='phpmaker'>";
		$itemstatus .= viewModulParam($GLOBALS["modul_select"],"descriptionTitle");
		$itemstatus .= "</span>&nbsp;</td>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "</tr>";
		$itemstatus .= "<tr bgcolor='".$GLOBALS["color6"]."' align='left'>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "<td><span class='phpmaker'>";
//		$itemstatus .= textwrapper($GLOBALS["x_description"]);
		$itemstatus .= $GLOBALS["x_description"];
		$itemstatus .= "</span>&nbsp;</td>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "</tr>";
		$itemstatus .= "</table></td>";
		$itemstatus .= "</tr>";
		}

	if (!empty($GLOBALS["x_comment"]))
		{
		$itemstatus .= "<tr height='20' valign='top' align='center'>";
		$itemstatus .= "<td><table width='90%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:" . $GLOBALS["color2"] . ";border-width:thin'>";
		$itemstatus .= "<tr bgcolor='".$GLOBALS["actcolor"]."' align='left'>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "<td><span class='phpmaker'>";
		$itemstatus .= viewModulParam($GLOBALS["modul_select"],"commentTitle");
		$itemstatus .= "</span>&nbsp;</td>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "</tr>";
		$itemstatus .= "<tr bgcolor='".$GLOBALS["color6"]."' align='left'>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "<td><span class='phpmaker'>";
//		$itemstatus .= textwrapper($GLOBALS["x_comment"]);
		$itemstatus .= $GLOBALS["x_comment"];
		$itemstatus .= "</span>&nbsp;</td>";
		$itemstatus .= "<td width='10'></td>";
		$itemstatus .= "</tr>";
		$itemstatus .= "</table></td>";
		$itemstatus .= "</tr>";
		}

	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$itemstatus .= "<tr height='10'><td></td></tr>";
		$itemstatus .= "<tr valign='bottom'><td align='center'>";
		$itemstatus .= "<table width='100%' border=0 cellspacing='1' cellpadding='2'>";
		$itemstatus .= "<tr bgcolor='" . $GLOBALS["actcolor"] . "'>";
		$itemstatus .= "<td width='60' align='center'><span class='phpmaker'>".viewModulParam($modul_select,"itemactive")."</span></td>";
		$itemstatus .= "<td width='60'><span class='phpmaker'>".viewModulParam($modul_select,"itemlang")."</span></td>";
		$itemstatus .= "<td><span class='phpmaker'>".viewModulParam($modul_select,"itemcreator")."</span></td>";
		$itemstatus .= "<td width='140'><span class='phpmaker'>".viewModulParam($modul_select,"itemcreatewhen")."</span></td>";
		$itemstatus .= "<td><span class='phpmaker'>".viewModulParam($modul_select,"itemmodifier")."</span></td>";
		$itemstatus .= "<td width='140'><span class='phpmaker'>".viewModulParam($modul_select,"itemmodifywhen")."</span></td>";
		if (!empty($GLOBALS["x_visitcounter"]))
			{
			$itemstatus .= "<td width='90'><span class='phpmaker'>".viewModulParam($modul_select,"itemvisitcount")."</span></td>";
			$itemstatus .= "<td width='90'><span class='phpmaker'>".viewModulParam($modul_select,"itemvisitlast")."</span></td>";
			}
		$itemstatus .= "</tr>";
		$itemstatus .= "<tr bgcolor='".$GLOBALS["color6"]."'>";
		$itemstatus .= activeTd($GLOBALS["x_active"],$GLOBALS["enable"]["yes"],$enable["no"],$GLOBALS["x_is_read"]);
		$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>";
		if (!is_null($GLOBALS["x_lang_id"])) 
			{
			$sqlwrk = "SELECT * FROM language";
			$sqlwrk .= " WHERE id = " . $GLOBALS["x_lang_id"];
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				if (!is_null($rowwrk["pictURL"])) 
					{ 
					$itemstatus .=	"<img src='" . $rowwrk["pictURL"] . "' border='0'>";
					} 
				else 
					{
					$itemstatus .= $rowwrk["name"];
					}
				}
			@mysqli_free_result($rswrk);
			}
		$itemstatus .= "&nbsp;</b></span></td>";
		$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>";
		if (!is_null($GLOBALS["x_insert_user_id"])) 
			{
			$sqlwrk = "SELECT * FROM users";
			$sqlwrk .= " WHERE id = " . $GLOBALS["x_insert_user_id"];
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				$itemstatus .= $rowwrk["shortname"];
				}
			@mysqli_free_result($rswrk);
			} 
		else 
			{
			$itemstatus .= $GLOBALS["x_name"];
			}
		$itemstatus .= "&nbsp</b></span></td>";
		$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>" . FormatDateTime($GLOBALS["x_insert_datetime"],8) . "</b></span></td>";
		$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>";
		if (!is_null($GLOBALS["x_modify_user_id"])) 
			{
			$sqlwrk = "SELECT * FROM users";
			$sqlwrk .= " WHERE id = " . $GLOBALS["x_modify_user_id"];
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				$itemstatus .= $rowwrk["shortname"];
				}
			@mysqli_free_result($rswrk);
			} 
		else 
			{
//			$itemstatus .= $GLOBALS["x_name"];
			}
		$itemstatus .= "&nbsp</b></span></td>";
		$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>" . FormatDateTime($GLOBALS["x_modify_datetime"],8) . "</b></span></td>";
		if (!empty($GLOBALS["x_visitcounter"]))
			{
			$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>" . $GLOBALS["x_visitcounter"] . "</b></span></td>";
			$itemstatus .= "<td height='20' align='left'><span class='phpmaker'><b>" . FormatDateTime($GLOBALS["x_lastvisit"],8) . "</b></span></td>";
			}
		$itemstatus .= "</tr></table></td></tr>";
		}
	return $itemstatus;
	}

function orderchange($which_modul,$which_field)
	{
	$actualOrder = viewModulParam($which_modul,$which_field);
	if (ISSET($actualOrder))
		{
		$order_box = "<table cellspacing='0' cellpadding='0'><tr>";
		$order_box .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($which_modul,$which_field)."</span></td>";
		$order_box .= "<td width='30' align='right'>";
		$really_order = str_replace("OrderHead","",$which_field);
		$order_box .="<a href='index.php?modul_action=list&order=" . urlencode($really_order) . "'>";
		if ($GLOBALS["OrderBy"] == $really_order) 
			{ 
		 	if (@$_SESSION[$GLOBALS["which_system"].$which_modul . "_OT"] == "ASC") 
				{
				$order_box .= "<img src='" . $GLOBALS["image_button"] . "asc.gif' border='0'>";
				}
			else if (@$_SESSION[$GLOBALS["which_system"].$which_modul . "_OT"] == "DESC") 
				{
				$order_box .= "<img src='" . $GLOBALS["image_button"] . "desc.gif' border='0'>";
				}
			else
				{
				$order_box .= "<img src='" . $GLOBALS["image_button"] . "nosort.gif' border='0'>";
				}
			}
		else
			{
			$order_box .= "<img src='" . $GLOBALS["image_button"] . "nosort.gif' border='0'>";
			}
		$order_box .= "</a>";
		$order_box .= "</td>";
		$order_box .= "</tr></table>";
		}
	else
		{
		$order_box = NULL;
		}
	return $order_box;
	}
function viewTitle($which_table,$which_field)
	{
	return $GLOBALS["title"][$which_table][$which_field];
	}

function viewModulShare($which_title)
	{
	return $GLOBALS["modulShare"][$which_title];
	}

function viewErrorMsg($which_table,$which_error)
	{
	return $GLOBALS["errormsg"][$which_table][$which_error];
	}

function viewModul($which_table,$which_modul)
	{
	return $GLOBALS["modul"][$which_table][$which_modul];
	}

function viewModulParam($which_table,$which_modul)
	{
	$modulParam = viewModul($which_table,$which_modul);
	if (!isset($modulParam))
		{
		$modulParam = viewModulShare($which_modul);
		}
	return $modulParam;
	}

function fromdictionary($dictionarySQL,$dictionaryMemoryField,$dictionaryTableField,$dictionaryActualField, $dictionaryFieldTitle)
	{
	$dictionary = "<table border=0 width='100%' bgcolor='" . $GLOBALS["color1"] . "' cellspacing='0' cellpadding='0'>";
	$dictionary .= "<tr><td align='center'>";
	$dictionaryrswrk = mysqli_query($GLOBALS["conn"],$dictionarySQL);
	$x_dictionaryList = "<select name=\"p_".$dictionaryMemoryField."\" onChange=\"document.forms['listsrch'].submit();\" style='border:none;width:180;background-color:" . $GLOBALS["actcolor"] . ";'>";
	if ($_POST["x_".$dictionaryMemoryField] == "ALL")
		$x_dictionaryList .= "<option selected value=\"ALL\">";
	else                                       
		$x_dictionaryList .= "<option value=\"ALL\">";
	$x_dictionaryList .= "---- ". $dictionaryFieldTitle." ----</option>";
	$cbo_x_dictionary_js = ""; // initialise
	if ($dictionaryrswrk)
		{
		$dictionaryrowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($dictionaryrswrk))
			{
			$x_dictionaryList .= "<option value=\"". htmlspecialchars($datawrk[$dictionaryTableField]) . "\"";
			if ($datawrk[$dictionaryTableField] == @$dictionaryActualField)
				{
				$x_dictionaryList .= " selected";
				}
			$x_dictionaryList .= ">" . $datawrk["name"] . "</option>";
			$dictionaryrowcntwrk++;
			}
		}
	@mysqli_free_result($dictionaryrswrk);
	$x_dictionaryList .= "</select>";
	$dictionary .= $x_dictionaryList;
	$dictionary .= "</td></tr>";
	return $dictionary;
	}

function whichpictureview($whichpicture, $picturetitle)
	{
	if (!empty($whichpicture)) 
		{ 
		if (is_file($whichpicture))
			{
			if (empty($picturetitle))
				{
				$whichpictureview = "<img src='" . $whichpicture . "' border='0'>";
				}
			else
				{
				$whichpictureview = "<img src='" . $whichpicture . "' border='0' title='".$picturetitle."'>";
				}
			}
		else
			{
			$whichpictureview = "<img src='".$GLOBALS["image_public"]."nopict.gif' border='0'>";
			}
		} 
	else
		{
		$whichpictureview = "<img src='".$GLOBALS["image_public"]."nopict.gif' border='0'>";
		}
	return $whichpictureview;	

	}

function pictFrameWidth($pictType)
	{
	$pictwidth = viewModul($GLOBALS["modul_select"],$pictType)+4;
	return $pictwidth;
	}

function pictFrameHeight($pictType)
	{
	$pictheight = viewModul($GLOBALS["modul_select"],$pictType)+4;
	return $pictheight;
	}

function notLoggedTextView()
	{
	$notlogged_text = viewModul($GLOBALS["modul_select"],"notlogged");
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 1 && isset($notlogged_text))
		{
		$GLOBALS["html_page"] .= "<tr bgcolor='#CCCCCC'>";
		$GLOBALS["html_page"] .= "<td align='center' style='border-style:groove;border-color:".$GLOBALS["color2"].";border-width:thin'>";
		$GLOBALS["html_page"] .= "<span class='header'><b>";
		$GLOBALS["html_page"] .= $notlogged_text;
		$GLOBALS["html_page"] .= "</b></span>&nbsp;</td>";
		$GLOBALS["html_page"] .= "</tr>";
		}
	}

function advert($where_advert,$no_advert)
	{
	$advertWrite = "";
	switch($where_advert)
		{
		case "right":
			if (!isset($GLOBALS["no_advertright"]) && !isset($no_advert))
				{
				$advertWrite = advertright();
				}
			break;
		case "left":
			if (!isset($GLOBALS["no_advertleft"]) && !isset($no_advert))
				{
				echo "[kell bal reklám]<br>";
				}
			break;
		case "top":
			if (!isset($GLOBALS["no_adverttop"]) && !isset($no_advert))
				{
//				echo "[kell felsõ reklám]<br>";
				}
			break;
		case "topline":
			if (!isset($GLOBALS["no_adverttop"]) && !isset($no_advert))
				{
				$advertWrite = adverttopline();
				}
			break;
		case "bottom":
			if (!isset($GLOBALS["no_advertbottom"]) && !isset($no_advert))
				{
				echo "[kell alsó reklám]<br>";
				}
			break;
		case "bottomline":
			if (!isset($GLOBALS["no_advertbottom"]) && !isset($no_advert))
				{
				$advertWrite = advertbottomline();
				}
			break;
		}
	return $advertWrite;
	}

function adverttopline()
	{
//	$conn = mysqli_connect(HOST, USER, PASS. DB);
	$advertSQL = "SELECT * FROM advert_item";
	$advertSQL .= " WHERE active=1 AND topic_id = 1";
	$rswrk = mysqli_query($GLOBALS['conn'],$advertSQL);
	$GLOBALS["adverttoplinecount"] = intval(@mysqli_num_rows($rswrk));
	$adverttoplineWrite = "";
	if ($GLOBALS["adverttoplinecount"] != 0)
		{
		$adverttoplineWrite .= "<script language=\"JavaScript\" type=\"text/JavaScript\">\n";
		$adverttoplineWrite .= "<!--\n";
		$adverttoplineWrite .= "var toplineurlArray = new Array(".$GLOBALS["adverttoplinecount"].");\n"; //for URL's, increase size as necessary
		$adverttoplineWrite .= "var toplinebanArray = new Array(".$GLOBALS["adverttoplinecount"].");\n"; //for banners, increase size as necessary
		$adverttoplineWrite .= "var toplinecounter = 1;\n";
		if ($rswrk)
			{
			$rowcntwrk = 0;
			while ($datawrk = mysqli_fetch_array($rswrk))
				{
				$adverttoplineWrite .= "toplinebanArray[".$rowcntwrk."]='".$datawrk["description"]."';\n";
				$rowcntwrk++;
				}
			}
		@mysqli_free_result($rswrk);
		//calls the changeBanner() function every 3 seconds
		//change the timer as necessary (minutes * 60000) or (seconds * 1000)
		$adverttoplineWrite .= "var toplinetimer = window.setInterval(\"toplinechangeBanner()\", 5000);\n";
		$adverttoplineWrite .= "//-->\n";
		$adverttoplineWrite .= "</script>\n";
		$adverttoplineWrite .= "<tr><td>";
		$adverttoplineWrite .= "<table bgcolor='" . $GLOBALS["actcolor"] . "' width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:".$GLOBALS["color2"].";border-width:thin;'>";
		$adverttoplineWrite.= "<tr bgcolor='#CCCCCC'>";
		$adverttoplineWrite .= "<td width='50' align='center'><font color='blue' class='header' style='font-family:Webdings;'><b>&nbsp;~~</b></font></td>";
		$adverttoplineWrite .= "<td align='center'><font color='blue' class='header'><b>";
		$adverttoplineWrite .= "<script>document.write('<SPAN id=toplineadverttext>'+toplinebanArray[0]+'</SPAN>')</script>";
		$adverttoplineWrite.= "</b></font>&nbsp;</td>";
		$adverttoplineWrite .= "<td width='50' align='center'><font color='blue' class='header' style='font-family:Webdings;'><b>&nbsp;~~</b></font></td>";
		$adverttoplineWrite .= "</tr></table></td></tr>";
		}
	return $adverttoplineWrite;
	}

function advertbottomline()
	{
	$advertSQL = "SELECT * FROM advert_item";
	$advertSQL .= " WHERE active=1 AND topic_id = 3";
	$rswrk = mysqli_query($GLOBALS["conn"],$advertSQL);
	$GLOBALS["advertbottomlinecount"] = intval(@mysqli_num_rows($rswrk));
	$advertbottomlineWrite = "";
	if ($GLOBALS["advertbottomlinecount"] != 0)
		{
		$advertbottomlineWrite .= "<script language=\"JavaScript\" type=\"text/JavaScript\">\n";
		$advertbottomlineWrite .= "<!--\n";
		$advertbottomlineWrite .= "var bottomlineurlArray = new Array(".$GLOBALS["advertbottomlinecount"].");\n"; //for URL's, increase size as necessary
		$advertbottomlineWrite .= "var bottomlinebanArray = new Array(".$GLOBALS["advertbottomlinecount"].");\n"; //for banners, increase size as necessary
		$advertbottomlineWrite .= "var bottomlinecounter = 1;\n";
		if ($rswrk)
			{
			$rowcntwrk = 0;
			while ($datawrk = mysqli_fetch_array($rswrk))
				{
				$advertbottomlineWrite .= "bottomlinebanArray[".$rowcntwrk."]='".$datawrk["description"]."';\n";
				$rowcntwrk++;
				}
			}
		@mysqli_free_result($rswrk);
		//calls the changeBanner() function every 3 seconds
		//change the timer as necessary (minutes * 60000) or (seconds * 1000)
		$advertbottomlineWrite .= "var bottomlinetimer = window.setInterval(\"bottomlinechangeBanner()\", 15000);\n";
		$advertbottomlineWrite .= "//-->\n";
		$advertbottomlineWrite .= "</script>\n";
		$advertbottomlineWrite.= "<tr>";
		$advertbottomlineWrite .= "<table  bgcolor='" . $GLOBALS["actcolor"] . "' width='100%' cellspacing='0' cellpadding='0' style='border-style:groove;border-color:".$GLOBALS["color2"].";border-width:thin;'>";
		$advertbottomlineWrite .= "<tr bgcolor='#CCCCCC'>";
		$advertbottomlineWrite .= "<td width='50' align='center'><font color='blue' class='header' style='font-family:Webdings;'><b>&nbsp;~~</b></font></td>";
		$advertbottomlineWrite .= "<td align='center'><font color='blue' class='header'><b>";
		$advertbottomlineWrite .= "<script>document.write('<SPAN id=bottomlineadverttext>'+bottomlinebanArray[0]+'</SPAN>')</script>";
		$advertbottomlineWrite .= "</b></font>&nbsp;</td>";
		$advertbottomlineWrite .= "<td width='50' align='center'><font color='blue' class='header' style='font-family:Webdings;'><b>&nbsp;~~</b></font></td>";
		$advertbottomlineWrite .= "</tr></table></td></tr>";
		}
	return $advertbottomlineWrite;
	}

function advertright()
	{
	$advertSQL = "SELECT * FROM advert_item";
	$advertSQL .= " WHERE active=1 AND topic_id = 2";
	$rswrk = mysqli_query($GLOBALS["conn"],$advertSQL);
	$GLOBALS["advertrightcount"] = intval(@mysqli_num_rows($rswrk));
	$advertrightWrite = "";
	if ($GLOBALS["advertrightcount"] != 0)
		{
		$advertrightWrite .= "<script language=\"JavaScript\" type=\"text/JavaScript\">\n";
		$advertrightWrite .= "<!--\n";
		$advertrightWrite .= "var righturlArray = new Array(".$GLOBALS["advertrightcount"].");\n"; //for URL's, increase size as necessary
		$advertrightWrite .= "var rightbanArray = new Array(".$GLOBALS["advertrightcount"].");\n"; //for banners, increase size as necessary
		$advertrightWrite .= "var rightcounter = 1;\n";
		if ($rswrk)
			{
			$rowcntwrk = 0;
			while ($datawrk = mysqli_fetch_array($rswrk))
				{
				$rightadvertBOX = "";
				if (!empty($datawrk["jumpURL"]))
					{
					$rightadvertBOX .= "<A HREF='".addslashes($datawrk["jumpURL"])."' target='_new'>";
					}
				if (!empty($datawrk["pictURL"]))
					{
					$rightadvertBOX .= addslashes(whichpictureview($GLOBALS["modul_image_path"].$datawrk["pictURL"],""));
					}
				else if (!empty($datawrk["description"]))
					{
					$rightadvertBOX .= addslashes($datawrk["description"]);
					}
				$advertrightWrite .= "rightbanArray[".$rowcntwrk."]=\"".$rightadvertBOX."\";\n";
				$rowcntwrk++;
				}
			}
		@mysqli_free_result($rswrk);
		//calls the changeBanner() function every 3 seconds
		//change the timer as necessary (minutes * 60000) or (seconds * 1000)
		$advertrightWrite .= "var righttimer = window.setInterval(\"rightchangeBanner()\", 5000);\n";
		$advertrightWrite .= "//-->\n";
		$advertrightWrite .= "</script>\n";
		$advertrightWrite .= "<td width='190' align='right' bgcolor='" . $GLOBALS["color3"] . "'>";
		$advertrightWrite .= "<table bgcolor='" . $GLOBALS["color1"] . "' width='100%' cellspacing='1' cellpadding='2' style='border-style:groove;border-color:" . $GLOBALS["color3"] . ";background-color:" . $GLOBALS["color1"] . ";border-width:thin;'>";
		$advertrightWrite .= "<tr><td align='center'>";
		$advertrightWrite .= "<script>document.write('<SPAN id=rightadverttext>'+rightbanArray[0]+'</SPAN>')</script>";
		$advertrightWrite .= "</td></tr>";
		$advertrightWrite .= "</table>";
		$advertrightWrite .= "</td>";
		}
	return $advertrightWrite;
	}
?>
