<?php
function db_connect($p_server, $p_user, $p_password, $p_database)
	{
	$link = mysqli_connect($p_server, $p_user, $p_password, $p_database);
//echo 'hurra<br>';
//echo $link.'<br>';
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*
	if (!$GLOBALS['conn'])
		{
echo 'siker<br>';
		echo "Adatbázis kapcsolódási hiba.\n";
		echo "</BODY>\n</HTML>\n";
		exit;
		}
	if (!mysqli_select_db($p_database, $GLOBALS['conn']))
		{
		echo "Adatbázis megnyitási hiba.\n";
		echo "</BODY>\n</HTML>\n";
		db_close($GLOBALS['conn']);
		exit;
		}
*/
	return $link;
	}


function db_query($sql, $conn)
	{
	return mysqli_query($conn, $sql);
	}

function db_fetch_assoc($result)
	{
	return mysqli_fetch_assoc($result);
	}
    
function db_fetch_row($result)
	{
	return mysqli_fetch_row($result);
	}

function db_fetch_array($result)
	{
	return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}

function db_num_rows($result)
	{
	return mysqli_num_rows($result);
	}

function db_insert_id($conn)
	{
	return mysqli_insert_id($conn);
	}


function db_data_seek($rs,$recCount)
	{
	return @mysqli_data_seek($rs, $recCount);
	}

function db_free_result($result)
	{
	@mysqli_free_result($result);
	}
  
function db_close($conn)
	{
	mysqli_close($conn);
	}


// ha hiba volt egy mûveletnél, kiírja, majd kilép
function db_error()
	{
//	if (!$result)
//		{
		echo "<BR/>\nAdatbázis hiba.\n<BR/>\n";
		echo "MySQL Error: ".mysqli_error();
		echo "</BODY>\n</HTML>\n";
		exit;
//		}
	}

function db_text_conv($s)
	{
//	return mysqli_real_escape_string($s);
	return $s;
	}

function db_actual_datetime()
	{
	return ConvertDateToMysqlFormat(date('Y-m-d H:i:s',time()));
	}

function db_table_list()
	{
	$result = mysqli_list_tables (DB);
	$i = 0;
	while ($i < mysqli_num_rows ($result))
		{
		$tb_names[$i] = mysqli_tablename ($result, $i);
		$i++;
		}
	return $tb_names;
	}
?>
  