<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<?php //require_once('../inc/encabezado.inc.php'); ?>

<body>



<form name="testform">
	<!-- calendar attaches to existing form element -->

	<input type="text" name="testinput" />


	<link rel="stylesheet" href="../lib/tigra_calendar/calendar.css">
	<script language="JavaScript" src="../lib/tigra_calendar/calendar_db.js">

	new tcal ({
		// form name
		'formname': 'testform',
		// input name
		'controlname': 'testinput'
	});

	</script>

</form>

</body>

</html>

