/////////////////////////////////////////
//
//  1.)receive 
// 
//
//
//
//
//
//
//
//
///////////////////////////////////////////

<?php
if (array_key_exists('upload', $_POST)) {
	define('UPLOAD_DIR', '/Applications/MAMP/htdocs/Datasculptures/Uploads/');
	move_uploaded_file($_FILES['song']['tmp_name'], UPLOAD_DIR.$_FILES['song']['name']);
}




?>