<?php
session_start();

$fb_page_id=isset($_GET['fb_page_id']) ? $_GET['fb_page_id'] : die();
$json_link = $_SESSION['NEXT_PAGE_PHOTOS_' . $fb_page_id];

if(!empty($json_link)){
	$json = file_get_contents($json_link);

	$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

	$photo_count = count($obj['data']);

	// get next page
	$next_page = isset($obj['paging']['next']) ? $obj['paging']['next'] : "";
	$_SESSION['NEXT_PAGE_PHOTOS_' . $fb_page_id]=$next_page;
	$_SESSION['SET_NUM_PHOTOS_' . $fb_page_id]=$_SESSION['SET_NUM_PHOTOS_' . $fb_page_id]+1;

	echo "<div class='alert alert-info' style='margin:1em 0; overflow:hidden;'>";
		echo "<strong>Photos Set # " . $_SESSION['SET_NUM_PHOTOS_' . $fb_page_id] . "</strong>";
	echo "</div>";

	$first_load=false;
	include_once "photos_template.php";
}
?>