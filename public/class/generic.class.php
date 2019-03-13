<?php
// ************************************************
// This file has been written by David Domingues
// you are free to use it and change it as you need
// but i will ask you to keep this header on the file
// and never remove it.
// comLogin downloaded at http://www.webrickco.com
// webrickco@gmail.com
// ************************************************
// PHP Document

class Generic
{
  var $hostname;
  var $database;
	var $admin;
	var $password;
	var $prefix;
	var $db;
	
	var $language;
	
	function __construct() 
	{
	/*
		$this->hostname		= $hostname;
		$this->database		= $database;
		$this->admin		= $admin;
		$this->password		= $password;
		$this->prefix		= $prefix;

		$db = mysql_connect ($this->hostname, $this->admin, $this->password) or die('Database access denied!');
		mysql_select_db ($this->database, $db);
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');	
		
		$this->db = $db;
		
		return $this->db;
	*/
    }	
	
	// Quote variable to make safe 
	function quote_smart($value) 
	{ 
		// Stripslashes 
		if (get_magic_quotes_gpc()) { 
			 $value = stripslashes($value); 
		} 
		// Quote if not a number or a numeric string 
		if (!is_numeric($value) || strlen($value) >= 10) { 
			 $value = "'" . mysql_real_escape_string($value) . "'"; 
		} 
		return $value; 
	} 
 
	function generatecode($length)
	{
		$str = '';
		for ($i=1; $i<=$length; $i++)
		{
			$set = array(rand (65,90));
			$str .= chr($set[rand(0,0)]);
		}
		return $str;
	}
	
	function generatecodeloweraZ($length)
	{
		$str = '';
		for ($i=1; $i<=$length; $i++){
		$set = array(rand (65,90),rand(97,122));
		$str .= chr($set[rand(0,1)]);
		}
		return $str;
	}
	function generatecodeupperAZ($length)
	{
		$str = '';
		for ($i=1; $i<=$length; $i++){
		$set = array(rand (65,90));
		$str .= chr($set[rand(0,0)]);
		}
		return $str;
	}

	function textcutting($text, $len) {
		$retorno = '';
		$split = array();
		
		if (strlen($text) <= $len) {	
			$retorno = $text;
		} else {
			$split = explode(' ', $text);
			$i = 0;
			while (strlen($retorno) <= $len && $i < count($split)) {
				$retorno .= $split[$i].' ';
				$i++;
			}
			$retorno .= '...';
		}	
		return $retorno;	
	}
  
	
	/*
	Sanitize class
	Copyright (C) 2007 CodeAssembly.com  
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see http://www.gnu.org/licenses/
	*/
	
	/**
	 * Sanitize only one variable .
	 * Returns the variable sanitized according to the desired type or true/false 
	 * for certain data types if the variable does not correspond to the given data type.
	 * 
	 * NOTE: True/False is returned only for telephone, pin, id_card data types
	 *
	 * @param mixed The variable itself
	 * @param string A string containing the desired variable type
	 * @return The sanitized variable or true/false
	 */
	
	function sanitizeOne($var, $type)
	{       
		$var = str_replace("<script>", "", $var);
		$var = str_replace("</script>", "", $var);
		$var = str_replace("alert", "", $var);
		$var = str_replace("document", "", $var);
		$var = str_replace("<", "", $var);
		$var = str_replace(">", "", $var);
		
		//echo $var;
		
		switch ( $type ) {
			case 'int': // integer
				$var = (int) $var;
				break;

			case 'str': // trim string
				$var = trim ( $var );
				break;
				
			case 'nocode': // trim string
				$var = strip_tags( $var );
				break;

			case 'nohtml': // trim string, no HTML allowed
				$var = htmlentities ( trim ( $var ), ENT_QUOTES );
				break;

			case 'plain': // trim string, no HTML allowed, plain text
				$var =  htmlentities ( trim ( $var ) , ENT_NOQUOTES )  ;
				break;

			case 'upper_word': // trim string, upper case words
				$var = ucwords ( strtolower ( trim ( $var ) ) );
				break;

			case 'ucfirst': // trim string, upper case first word
				$var = ucfirst ( strtolower ( trim ( $var ) ) );
				break;

			case 'lower': // trim string, lower case words
				$var = strtolower ( trim ( $var ) );
				break;
	
			case 'urle': // trim string, url encoded
				$var = urlencode ( trim ( $var ) );
				break;

			case 'trim_urle': // trim string, url decoded
				$var = urldecode ( trim ( $var ) );
				break;
					
			case 'telephone': // True/False for a telephone number
				$size = strlen ($var) ;
				for ($x=0;$x<$size;$x++)
				{
					if ( ! ( ( ctype_digit($var[$x] ) || ($var[$x]=='+') || ($var[$x]=='*') || ($var[$x]=='p')) ) )
					{
						return false;
					}
				}
				return true;
				break;
			
			case 'pin': // True/False for a PIN
				if ( (strlen($var) != 13) || (ctype_digit($var)!=true) )
				{
					return false;
				}
				return true;
				break;
		
			case 'id_card': // True/False for an ID CARD
				if ( (ctype_alpha( substr( $var , 0 , 2) ) != true ) || (ctype_digit( substr( $var , 2 , 6) ) != true ) || ( strlen($var) != 8))
				{
					return false;
				}
				return true;
				break;
	
			case 'sql': // True/False if the given string is SQL injection safe
			//  insert code here, I usually use ADODB -> qstr() but depending on your needs you can use mysql_real_escape();
				return mysql_real_escape_string($var);
				break;
			}       
			return $var;
	}
	
	//sanitize with no HTML code and exceptions
	function sanitizeNocode($var, $type, $exceptions)
	{       
		switch ( $type ) {
				
			case 'nocode': // trim string
				$var = strip_tags( $var , $exceptions);
				break;

		}
			return $var;
	}
	
	/**
	 * Sanitize an array.
	 * 
	 * sanitize($_POST, array('id'=>'int', 'name' => 'str'));
	 * sanitize($customArray, array('id'=>'int', 'name' => 'str'));
	 *
	 * @param array $data
	 * @param array $whatToKeep
	 */
	
	function sanitize( &$data, $whatToKeep )
	{
		$data = array_intersect_key( $data, $whatToKeep ); 
		foreach ($data as $key => $value)
		{
			$data[$key] = $this->sanitizeOne( $data[$key] , $whatToKeep[$key] );
		}
	}

   	public function getalllanguage($lang)
   	{
		if ($lang == '' || $lang == 'neutral')
		{
			$query_string="select id, description from ".$this->prefix."language;";
		} else {
			$query_string=sprintf("select id, description from ".$this->prefix."language where lang = %s;",
				$this->quote_smart($lang)); 
		}

		$response=mysql_query($query_string, $this->db);
		$ar = mysql_fetch_row ($response);
		$result = array();
		if ($ar) 
		{
			while ($ar)
			{
				array_push($result, $ar);	
				$ar = mysql_fetch_row ($response);
			}
		}
			
		return $result;		
	}
	
	function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
	 /*
	  $interval can be:
	  yyyy - Number of full years
	  q - Number of full quarters
	  m - Number of full months
	  y - Difference between day numbers
	   (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
	  d - Number of full days
	  w - Number of full weekdays
	  ww - Number of full weeks
	  h - Number of full hours
	  n - Number of full minutes
	  s - Number of full seconds (default)
	 */
	 
	 if (!$using_timestamps) {
	  $datefrom = strtotime($datefrom, 0);
	  $dateto = strtotime($dateto, 0);
	 }
	 $difference = $dateto - $datefrom; // Difference in seconds
	  
	 switch($interval) {
	  
	  case 'yyyy': // Number of full years

	   $years_difference = floor($difference / 31536000);
	   if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
		$years_difference--;
	   }
	   if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
		$years_difference++;
	   }
	   $datediff = $years_difference;
	   break;

	  case "q": // Number of full quarters

	   $quarters_difference = floor($difference / 8035200);
	   while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
		$months_difference++;
	   }
	   $quarters_difference--;
	   $datediff = $quarters_difference;
	   break;

	  case "m": // Number of full months

	   $months_difference = floor($difference / 2678400);
	   while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
		$months_difference++;
	   }
	   $months_difference--;
	   $datediff = $months_difference;
	   break;

	  case 'y': // Difference between day numbers

	   $datediff = date("z", $dateto) - date("z", $datefrom);
	   break;

	  case "d": // Number of full days

	   $datediff = floor($difference / 86400);
	   break;

	  case "w": // Number of full weekdays

	   $days_difference = floor($difference / 86400);
	   $weeks_difference = floor($days_difference / 7); // Complete weeks
	   $first_day = date("w", $datefrom);
	   $days_remainder = floor($days_difference % 7);
	   $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
	   if ($odd_days > 7) { // Sunday
		$days_remainder--;
	   }
	   if ($odd_days > 6) { // Saturday
		$days_remainder--;
	   }
	   $datediff = ($weeks_difference * 5) + $days_remainder;
	   break;

	  case "ww": // Number of full weeks

	   $datediff = floor($difference / 604800);
	   break;

	  case "h": // Number of full hours

	   $datediff = floor($difference / 3600);
	   break;

	  case "n": // Number of full minutes

	   $datediff = floor($difference / 60);
	   break;

	  default: // Number of full seconds (default)

	   $datediff = $difference;
	   break;
	 }  

	 return $datediff;

	}

	public function viewTime($time)
	{
		$f = ":";
		return sprintf("%02d%s%02d", floor($time/3600), $f, ($time/60)%60);
	}

	public function getSecondsFromTime($time)
	{
		$wtime = explode(':', $time);
		$result = 0;
		if (count($wtime) == 2) {
			$result = $wtime[0] * 3600 + $wtime[1] * 60;
		}
    if (count($wtime) == 3) {
			$result = $wtime[0] * 3600 + $wtime[1] * 60 + $wtime[2];
		}
		return $result;
	}


	public function encapsulateMessage($message)
	{	
		$messagesend = '
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		body {
			font-family: "Raleway", sans-serif;
			font-weight: 100;
			height: 100vh;
			width: 100vw;
			margin: 0;
			padding: 0;
		}
		
		h1 {
			font-size: 30px;
			font-weight: 400;
			color: #E5C41A;
		}
		
		a {
			text-decoration: none;
			color: #E5C41A;
		}
		
		a:hover {
			text-decoration: none;
		}
		
		div {
			display: table;
		}
		
		img {
			vertical-align: middle;
			display: table-cell;
		}
		
		span {
			vertical-align: middle;
			display: table-cell;
		}
		
		.atable {
			width: 80%;
			margin-left: 10%;
			margin-right: 10%;
		}
		
		.fake_img {
			display: inline-block;
			margin: 5px 5px;
			padding: 5px;
		}

		
        input.abutton {
            padding: 20px;
            cursor: pointer;
            font-weight: bold;
            font-size: 100%;
            background: #E5C41A;
            color: black;
            border: 1px solid #E5C41A;
            border-radius: 10px;
		}

		.bbutton {
			border-radius: 2px;
		}

		.bbutton a {
			padding: 8px 12px;
			border: 1px solid #E5C41A;
			border-radius: 2px;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 14px;
			color: #ffffff; 
			text-decoration: none;
			font-weight: bold;
			display: inline-block;  
		}
	</style>

</head>

<body>
	<table style="min-width: 600px; width: 100%">
		<tr>
			<td width="100%">
			<!-- Header -->
				<table class="atable">
					<tr>
						<td width="80%">
							<a href="http://www.whiterabbitcomputers.com">
								<span><img src="http://www.whiterabbitcomputers.com/img/whiterabbit-logo-64.png" /></span>
								<span><h1>WhiteRabbit Computers</h1></span>
							</a>
						</td>
						<td>
							'.date("d-m-Y").'
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<!-- content -->
				<table class="atable" style="margin-top: 2em; margin-bottom: 2em;">
					<tr>
						<td width="10%">&nbsp;</td>
						<td width="80%">
							'.$message.'
						</td>
						<td width="10%">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td width="80%">
							Melhores cumprimentos, <br> A equipa WhiteRabbit.
						</td>
						<td width="10%">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td width="100%">
				<!-- Footer -->
				<table class="atable">

					<!-- Footer Elements -->
					<tr>
						<td style="text-align: center">

							<!-- Social buttons -->
							<div class="fake_img">
								<a target="_blank" href="https://www.facebook.com/whiterabbitservice/">
									<img src="http://www.whiterabbitcomputers.com/img/icon/withborder/facebook-variation.png" alt="facebook">
								</a>
							</div>
							<div class="fake_img">
								<a target="_blank" href="https://twitter.com/whiterabbitime">
									<img src="http://www.whiterabbitcomputers.com/img/icon/withborder/twitter-variation.png" alt="twitter">
								</a>
							</div>
							<!-- Social buttons -->
						</td>
					</tr>
					<!-- Footer Elements -->

					<!-- Copyright -->
					<tr>
						<td style="text-align: center">
							© 2019 Copyright:
							<a href="http://www.whiterabbitcomputers.com">whiterabbitcomputers.com</a>
						</td>
					</tr>
					<!-- Copyright -->

					<!-- Footer -->
				</table>
			</td>
		</tr>
	</table>				

</body>

</html>
';

    //print $messagesend;
		
		// Mail it
		// $a = @mail($to, $subject, $messagesend, $headers);
		//print $messagesend;
		// return $a;
    return $messagesend;
	} 

	public function headmail($message)
	{	
		$messagesend = '
<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#f5f6f4">
   <tr>
      <td align="center"><br/>
         <table width="600" cellspacing="0" cellpadding="0" style="font-family:\'Lucida Grande\';color:#666" bgcolor="#FFF">
            <tr>
               <td height="77" bgcolor="#F6F6F6" style="padding:10px">
				  <a href="http://www.whiterabbitservice.com" style="text-decoration: none;"> 	
				  <img src="http://www.whiterabbitservice.com/assets/images/whiterabbit-logo-160.png" style="vertical-align: middle;" /><font color="#CCCCCC" size="2"><strong>  WhiteRabbit</strong></font>
				  </a>
               </td>
			   <td bgcolor="#F6F6F6" style="padding:10px" align="right">
					<font color="#CCCCCC" size="2"><strong>'.date("d-m-Y").'</strong></font>
			   </td>
            </tr>
            <tr>
               <td valign="top" colspan="2" style="padding:10px">'
.$message.'                  
               </td>
            </tr>
            <tr>
               <td colspan="2" align="center" style="border-top:1px #cccccc solid">
				  <br/><a href="http://www.whiterabbitservice.com">WhiteRabbit - 2017 &copy;</a>	
               </td>
            </tr>
         </table><br/>
      </td>
   </tr>
</table>
';		
		
		return $messagesend;
	}

	public function drawPagination($totalPages, $currentPage, $itemperpage) {
		if ($totalPages > 0) {
			$minpage = ($currentPage-2)<=1?1:$currentPage-2;
			$maxpage = ($currentPage+2)>=$totalPages?$totalPages:$currentPage+2;
			print '<ul class="pagination">';
			if ($minpage > 1) {
				print '<li data-id="1"><a href="javascript: getPage(1, '.$itemperpage.');">&laquo;</a></li>';
			}
			for ($i = $minpage; $i <= $maxpage; $i++) {
				print '<li data-id="'.$i.'"';
				if ($currentPage == $i) {
					print ' class="active"';
				}
				print '><a href="javascript: getPage('.$i.', '.$itemperpage.');">'.$i.'</a></li>';
			}
			if ($maxpage < $totalPages) {
				print '<li data-id="'.$totalPages.'"><a href="javascript: getPage('.$totalPages.', '.$itemperpage.');">&raquo;</a></li>';
			}
			print '</ul>';
		}
	}
}
?>