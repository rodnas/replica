<?php
function buildsql()
	{
	// build SQL
	if ($GLOBALS["DefaultFilter"] <> "")
		{
		$GLOBALS["whereClause"] .= "(" . $GLOBALS["DefaultFilter"] . ") AND ";
		}
	if ($GLOBALS["dbwhere"] <> "" )
		{
		$GLOBALS["whereClause"] .= "(" . $GLOBALS["dbwhere"] . ") AND ";
		}
	if (($GLOBALS["ewCurSec"] & ewAllowList) <> ewAllowList)
		{
		$GLOBALS["whereClause"] .= "(0=1) AND ";
		}
	if (substr($GLOBALS["whereClause"], -5) == " AND ")
		{
		$GLOBALS["whereClause"] = substr($GLOBALS["whereClause"], 0, strlen($GLOBALS["whereClause"])-5);
		}
	if ($GLOBALS["whereClause"] <> "")
		{
		$GLOBALS["strsql"] .= " WHERE " . $GLOBALS["whereClause"];
		}
	if ($GLOBALS["GroupBy"] <> "")
		{
		$GLOBALS["strsql"] .= " GROUP BY " . $GLOBALS["GroupBy"] . " ";
		}
	if ($GLOBALS["OrderBy"] <> "")
		{
		$GLOBALS["strsql"] .= " ORDER BY " . $GLOBALS["OrderBy"] . " " . @$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"];
		}
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2)
		{
//		echo "[".$GLOBALS["strsql"]."]"; // comment out this line to view the SQL
		}
	}
function checkorder()
	{
	// check for an Order parameter
	$GLOBALS["OrderBy"] = "";
	if (@$_GET["order"] <> "")
		{
		$GLOBALS["OrderBy"] = $_GET["order"];
		// check if an ASC/DESC/NOSORT toggle is required
		if (@$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OB"] == $GLOBALS["OrderBy"])
			{
			if (@$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] == "ASC")
				{
				$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] = "DESC";
				}
			else if (@$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] == "DESC")
				{
				$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] = "NOSORT";
				$GLOBALS["OrderBy"] = "";
				}
			else
				{
				$_SESSION_[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] = "ASC";
				}
			}
		else
			{
			$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] = "ASC";
			}
		$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OB"] = $GLOBALS["OrderBy"];
		$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"] = 1;
		}
	else
		{
		$GLOBALS["OrderBy"] = @$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OB"];
		if ($GLOBALS["OrderBy"] == "")
			{
			$GLOBALS["OrderBy"] = $GLOBALS["DefaultOrder"];
			$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OB"] = $GLOBALS["OrderBy"];
			$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_OT"] = $GLOBALS["DefaultOrderType"];
			}
		}
	}

function checkstart()
	{
	// check for a START parameter
	if (@$_GET["start"] <> "")
		{
		$GLOBALS["startRec"] = $_GET["start"];
		$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"] = $GLOBALS["startRec"];
		}
	elseif (@$_GET["pageno"] <> "")
		{
		$GLOBALS["pageno"] = $_GET["pageno"];
		if (is_numeric($GLOBALS["pageno"]))
			{
			$GLOBALS["startRec"] = ($GLOBALS["pageno"] - 1)*$GLOBALS["displayRecs"] + 1;
			if ($GLOBALS["startRec"] <= 0)
				{
				$GLOBALS["startRec"] = 1;
				}
			elseIf ($GLOBALS["startRec"] >= (($GLOBALS["totalRecs"]-1)/$GLOBALS["displayRecs"])*$GLOBALS["displayRecs"]+1)
				{
				$GLOBALS["startRec"] = (($GLOBALS["totalRecs"]-1)/$GLOBALS["displayRecs"])*$GLOBALS["displayRecs"] + 1;
				}
			$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"] = $GLOBALS["startRec"];
			}
		else
			{
			$GLOBALS["startRec"] = @$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"];
			if (!is_numeric($GLOBALS["startRec"]))
				{			
				$GLOBALS["startRec"] = 1; // reset start record counter
				$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"] = $GLOBALS["startRec"];
				}
			}
		}
	else
		{
		$GLOBALS["startRec"] = @$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"];
		if (!is_numeric($GLOBALS["startRec"]))
			{		
			$GLOBALS["startRec"] = 1; // reset start record counter
			$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"] . "_REC"] = $GLOBALS["startRec"];
			}
		}	
	}
function builddbwhere()
	{
	// build dbwhere
	if ($GLOBALS["masterdetailwhere"] <> "" )
		{
		$GLOBALS["dbwhere"] .= "(" . $GLOBALS["masterdetailwhere"] . ") AND ";
		}
	if ($GLOBALS["searchwhere"] <> "" )
		{
		$GLOBALS["dbwhere"] .= "(" . $GLOBALS["searchwhere"] . ") AND ";
		}
	if (strlen($GLOBALS["dbwhere"]) > 5)
		{
		$GLOBALS["dbwhere"] = substr($GLOBALS["dbwhere"], 0, strlen($GLOBALS["dbwhere"])-5); // trim rightmost AND
		}
	}

function buildsearch()
	{
	// build search criteria
	if ($GLOBALS["a_search"] <> "")
		{
		$GLOBALS["searchwhere"] = $GLOBALS["a_search"]; //advanced search
		}
	elseIf ($GLOBALS["b_search"] <> "")
		{
		$GLOBALS["searchwhere"] = $GLOBALS["b_search"]; //basic search
		}
	}

function savesearch()
	{
	// save search criteria
	if ($GLOBALS["searchwhere"] <> "")
		{
		$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"]."_searchwhere"] = $GLOBALS["searchwhere"];	
		$GLOBALS["startRec"] = 1; //reset start record counter (new search)
		$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"]."_REC"] = $GLOBALS["startRec"];
		}
	else
		{
		$GLOBALS["searchwhere"] = @$_SESSION[$GLOBALS["which_system"].$GLOBALS["modul_select"]."_searchwhere"];
		}
	}


function treecounter($tree_actualSQL)
	{
	$tree_actualrs = mysqli_query($GLOBALS["conn"],$tree_actualSQL);
	$tree_actualrow = mysqli_fetch_array($tree_actualrs);
	$x_treecounter = $tree_actualrow["treecounter"];
	@mysqli_free_result($tree_actualrs);
	return $x_treecounter;
	}

/* backup the db OR just a table */
function backup_db($host,$user,$pass,$name,$tables = '*')
	{
/*
	// if mysqldump is on the system path you do not need to specify the full path
	// simply use "mysqldump --add-drop-table ..." in this case
	$dumpfname = $name . "_" . date("YmdHis").".sql";
	$command = "D:\\prog\\xampp183\\mysql\\bin\\mysqldump --add-drop-table --host=$host --user=$user ";
	if ($pass)
		{
		$command.= "--password=". $pass ." ";
		}
	$command.= $name;
	$command.= " > " . $dumpfname;
	system($command);
 
	// zip the dump file
	$zipfname = '../sql/'.$name . "_" . date("YmdHis").".zip";
	$zip = new ZipArchive();
	if($zip->open($zipfname,ZIPARCHIVE::CREATE))
		{
		$zip->addFile($dumpfname,$dumpfname);
		$zip->close();
		}
	unlink($dumpfname);
*/
	}

?>
