<?php 
class Util{
	
	public function getNewStringWithMentions($str){
		$start_limiter = '@[';
		$end_limiter = ']';

		$pattern = '~(?<=' . preg_quote($start_limiter, '~') 
				 . ').+?(?=' . preg_quote($end_limiter, '~') . ')~si';
				 
		if (preg_match_all($pattern, $str, $matches)){
			foreach($matches[0] as $match){
				
				// create the link
				$match_arr=explode(":", $match);
				$fb_obj_id=$match_arr[0];
				$fb_obj_name=$match_arr[2];
				
				$fb_link="<a href='https://fb.com/{$fb_obj_id}' target='_blank'>{$fb_obj_name}</a>";
				
				// replace with the link
				$str=str_replace("@[{$match}]", $fb_link, $str);
			}
		}

		return $str;
	}

	public function formatCount($count){
		return number_format($count, 0, '.', ',');
	}
}
?>