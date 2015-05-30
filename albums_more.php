<?php
session_start();

$fb_page_id=isset($_GET['fb_page_id']) ? $_GET['fb_page_id'] : die();
$json_link = $_SESSION['NEXT_PAGE_PHOTO_ALBUMS_' . $fb_page_id];

if(!empty($json_link)){

	$json = file_get_contents($json_link);
	$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
	
	$album_count = count($obj['data']);
	
	// get next page
	$next_page = $obj['paging']['next'];
	$_SESSION['NEXT_PAGE_PHOTO_ALBUMS_' . $fb_page_id]=$next_page;
	$_SESSION['SET_NUM_PHOTO_ALBUMS_' . $fb_page_id]=$_SESSION['SET_NUM_PHOTO_ALBUMS_' . $fb_page_id]+1;
	
	include_once 'albums_template.php';
}
?>