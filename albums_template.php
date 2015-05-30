<?php
include "frontend/libs/php/util.php";
$util=new Util();

for($x=0; $x<$album_count; $x++){

	$id = isset($obj['data'][$x]['id']) ? $obj['data'][$x]['id'] : "";
	$name = isset($obj['data'][$x]['name']) ? $obj['data'][$x]['name'] : "";
	$description = isset($obj['data'][$x]['description']) ? $obj['data'][$x]['description'] : "";
	$link = isset($obj['data'][$x]['link']) ? $obj['data'][$x]['link'] : "";
	$cover_photo = isset($obj['data'][$x]['cover_photo']) ? $obj['data'][$x]['cover_photo'] : "";
	$count = isset($obj['data'][$x]['count']) ? $util->formatCount($obj['data'][$x]['count']) : "0";
	$likes_count=isset($obj['data'][$x]['likes']['summary']['total_count']) 
					? $util->formatCount($obj['data'][$x]['likes']['summary']['total_count']) : "0";
	$comments_count=isset($obj['data'][$x]['comments']['summary']['total_count']) 
					? $util->formatCount($obj['data'][$x]['comments']['summary']['total_count']) : "0";

	$name_orig=urlencode($name);
	
	if(strlen($name)>24){
		$name=substr($name,0,24) . "...";
	}
	
	if(empty($description)){
		$description="No description.";
	}else{
		if(strlen($description)>80){
			$description=substr(strip_tags($util->getNewStringWithMentions($description)),0,80) . "...";
		}
	}
	$show_pictures_link = "photos.php?album_id={$id}&album_name={$name_orig}&fb_page_id={$fb_page_id}";
	
	// album not to include
	if(
		$name!="Untitled Album"
	){
	
		echo "<div class='col-md-4 item_box'>";
			echo "<a href='{$show_pictures_link}'>";
			
				$source="https://graph.facebook.com/{$cover_photo}/picture";
				echo "<div class='photo-thumb' style='background: url({$source}) 40% 40% no-repeat;'>";
				echo "</div>";
				
			echo "</a>";
			echo "<h3>";
				echo "<a href='{$show_pictures_link}'>{$name}</a>";
			echo "</h3>";
			
			$count_text="Photo";
			if($count>1){ $count_text="Photos"; }
			
			echo "<p>";
				echo "<div style='color:#888;'>";
					echo "{$count} {$count_text} / $likes_count Likes / $comments_count Comments / ";	
					echo "<a href='{$link}' target='_blank' title='View album on Facebook'>FB</a>";
				echo "</div>";
				echo $description;
			echo "</p>";
		echo "</div>";
	}
}
?>