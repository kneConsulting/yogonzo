<?php 

if($first_load==false){
	include "frontend/libs/php/util.php";
	$util=new Util();
}

for($x=0; $x<$photo_count; $x++){
	
	$source = isset($obj['data'][$x]['source']) ? $obj['data'][$x]['source'] : "";
	$name = isset($obj['data'][$x]['name']) ? $obj['data'][$x]['name'] : "";
	$link = isset($obj['data'][$x]['link']) ? $obj['data'][$x]['link'] : "";
	$likes_count = isset($obj['data'][$x]['likes']['summary']['total_count']) 
					? $util->formatCount($obj['data'][$x]['likes']['summary']['total_count']) : "";
	$comments_count = isset($obj['data'][$x]['comments']['summary']['total_count']) 
					? $util->formatCount($obj['data'][$x]['comments']['summary']['total_count']) : "";
	
	echo "<div class='item_box'> ";
		echo "<a href='{$source}' title=\"{$likes_count} Likes. {$comments_count} Comments. {$name}\" data-gallery>";
			echo "<div class='photo-thumb'  title=\"{$name}\" style='background: url({$source}) 50% 50% no-repeat;'>";
				
			echo "</div>";
		echo "</a>";
		echo "<a href='{$link}' target='_blank'>{$likes_count} Likes. {$comments_count} Comments.</a>";
	echo "</div>";
}
?>