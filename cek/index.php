<!DOCTYPE html>
<html>
	<head>
		<title> Inspektorat Cianjur </title>

		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<script type="text/javascript" src="jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
	</head>

	<body>
		<div class="col-sm-12"><br/><br/><br/><br/><br/></div>
		<h1 align="center">- CEK USERNAME & PASSWORD INSPEKTORAT -</h1> <hr/>

		<form action="cek.php" method="post">
			<table width="18%" border="0" align="center">
				<thead>
					<tr>
						<td width="40%"></td>
						<td></td>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td> CARI NAMA </td>
						<td> <input type="text" name="nama" value="xxx"> </td>
					</tr>

					<tr>
						<td colspan="2" align="center"> <input type="submit" name="submit" value="Periksa" class="btn-sm btn-primary btn-block"> </td>
					</tr>
				</tbody>
			</table>
		</body> 
	</form> 

</html>

<?php



function secondsToWords($seconds)
{
    $ret = "";

    /*** get the days ***/
    $days = intval(intval($seconds) / (3600*24));
    if($days> 0)
    {
        $ret .= "$days days ";
    }

    /*** get the hours ***/
    $hours = (intval($seconds) / 3600) % 24;
    if($hours > 0)
    {
        $ret .= "$hours hours ";
    }

    /*** get the minutes ***/
    $minutes = (intval($seconds) / 60) % 60;
    if($minutes > 0)
    {
        $ret .= "$minutes minutes ";
    }

    /*** get the seconds ***/
    $seconds = intval($seconds) % 60;
    if ($seconds > 0) {
        $ret .= "$seconds seconds";
    }

    /*** get the days custom ***/
    $dayCustom = $seconds / (2*3.25);
    /*if($days> 0)
    {*/
        $ret .= " | $dayCustom days (custom) | => ".  6.5/(2*3.25);
    //}

    return $ret;
}

//echo secondsToWords(6.5);