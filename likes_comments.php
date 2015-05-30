<?php 
echo "<div class='like-count-sum post-content' style='padding:.3em; margin:1em 0; cursor:pointer;'>";
	echo "<div style='float:left; margin:0 .6em 0 0;'>";
		if($likes_count>=25){
			echo "<span class='like-icon'></span> $likes_count+ ";
		}else{
			echo "<span class='like-icon'></span> $likes_count ";
		}
	echo "</div>";
	
	echo "<div style='float:left;'>";
		if($comments_count>=25){
			echo "<span class='comment-icon'></span> $comments_count+ ";
		}else{
			echo "<span class='comment-icon'></span> $comments_count ";
		}
	echo "</div>";
echo "</div>"; // end 'like-count-sum'
?>