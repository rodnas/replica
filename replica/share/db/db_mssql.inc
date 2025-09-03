<?php
function connect()
	{
	$conn = mssql_connect($GLOBALS["db_server"], $GLOBALS["db_username"], $GLOBALS["db_password"]);
	if (!$GLOBALS['conn'])
		{
		echo "Adatbázis kapcsolódási hiba.\n";
		echo "</BODY>\n</HTML>\n";
		exit;
		}
	if (!mssql_select_db($GLOBALS["db_name"], $GLOBALS['conn']))
		{
		echo "Adatbázis megnyitási hiba.\n";
		echo "</BODY>\n</HTML>\n";
		db_close($GLOBALS['conn']);
		exit;
		}
	return $conn;
	}


function db_query($sql, $GLOBALS['conn'])
	{
	return mssql_query($sql, $GLOBALS['conn']);
	}

function db_fetch_assoc($result)
	{
	return mssql_fetch_assoc($result);
	}
    
function db_fetch_row($result)
	{
	return mssql_fetch_row($result);
	}

function db_fetch_array($result)
	{
	return mssql_fetch_array($result);
	}

function db_num_rows($result)
	{
	return mssql_num_rows($result);
	}

function db_insert_id($GLOBALS['conn'])
	{
	$id_result = db_query("SELECT @@IDENTITY", $GLOBALS['conn']);
	db_err($id_result);
	$id_row = db_fetch_row($id_result);
	$last_inserted_id = $id_row[0];
	db_free_result($id_result);
	return $last_inserted_id;
	}


function db_data_seek($rs,$recCount)
	{
	return @mssql_data_seek($rs, $recCount);
	}

function db_free_result($result)
	{
	mssql_free_result($result);
	}
  
function db_close($GLOBALS['conn'])
	{
	mssql_close($GLOBALS['conn']);
	}


// ha hiba volt egy mûveletnél, kiírja, majd kilép
function db_err($result)
	{
	if (!$result)
		{
		echo "<BR/>\nAdatbázis hiba.\n<BR/>\n";
		echo "MSSQL Error: ".mssql_get_last_message();
		echo "</BODY>\n</HTML>\n";
		exit;
		}
	}

function db_text_conv($s)
	{
	$from  = array("'");
	$to = array("''");
	return str_replace($from, $to, $s);
	}

function db_actual_datetime()
	{
	return "convert(datetime,'".date('Y-m-d H:i:s',time())."',120)";
	}

?>
  