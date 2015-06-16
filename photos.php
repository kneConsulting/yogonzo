<?php
	session_start();

	include "frontend/libs/php/util.php";
	$util=new Util();

	$album_id = isset($_GET['album_id']) ? $_GET['album_id'] : die('Album ID not specified.');
	$album_name_slugged = isset($_GET['album_name']) ? $_GET['album_name'] : die('Album name not specified.'); // should be slugged

	// access token
	$access_token="1574818609451101|HPM_w0Js-jtGi_H3_Owhkm5BtXI";

	// get details of the album
	$fields="count,link,name,description,likes.limit(0).summary(true),comments.limit(0).summary(true)";

	$json_link="https://graph.facebook.com/v2.3/{$album_id}?fields={$fields}&access_token={$access_token}";
	$json = file_get_contents($json_link);

	$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

	$album_photos_count=isset($obj['count']) ? $util->formatCount($obj['count']) : "0";
	$album_link=isset($obj['link']) ? $obj['link'] : "";
	$album_name=isset($obj['name']) ? $obj['name'] : "";
	$album_description=isset($obj['description']) ? $util->getNewStringWithMentions($obj['description']) : "";
	$album_likes_count=isset($obj['likes']['summary']['total_count']) ? $util->formatCount($obj['likes']['summary']['total_count']) : "0";
	$album_comments_count=isset($obj['comments']['summary']['total_count']) ? $util->formatCount($obj['comments']['summary']['total_count']) : "0";

	$page_title = "{$album_name}";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $page_title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<!-- L I N K S -->
	    <?php include("frontend/inc/yogonzo-links.php"); ?>

		<style>
		.item_box{
			width:271px;
			margin:0 1em 1em 0;
			float:left; 
		}
		
		.photo-thumb{
			width:271px;
			height:271px;
			float:left; 
			border: thin solid #d1d1d1;
		}
		
		div#blueimp-gallery div.modal {                                                  
			overflow: visible;                                                           
		}  
		
		#last_item_loader{
			text-align:center; 
			display:block; 
			width:100%; 
			overflow:hidden; 
			margin:1em 0; 
			font-weight:bold;
		}
		
		.blueimp-gallery>.prev, .blueimp-gallery>.next{
			border:none;
		}
		
		.display-none{
			display:none;
		}
		</style>
	</head>
	<body>
		<?php include_once("frontend/inc/analyticstracking.php") ?>
		<section class="main-section">

		<?php include("frontend/inc/main-logo-main-header.php"); ?>
	     
		<!-- pre-load image loader -->
		<img src="frontend/images/ajax-loader.gif" class="display-none" />

			<div class="container">
		
				<?php
					$fb_page_id = isset($_GET['fb_page_id']) ? $_GET['fb_page_id'] : "315361598603265";
					
					echo "<h1 class='page-header'>";
						echo "<a href='events.php?fb_page_id={$fb_page_id}'>Albums</a> / {$album_name}";
					echo "</h1>";
					
					echo "<p style='color:#888;'>";
						echo "{$album_photos_count} Photos. {$album_likes_count} Likes. {$album_comments_count} Comments. <a href='{$album_link}' target='_blank'>View album on Facebook.</a>";
					echo "</p>";

					// echo "<p>";
					// 	echo "{$album_description}";
					// echo "</p>";
					
					
					// get photos
					$fields="source,name,link,likes.limit(0).summary(true),comments.limit(0).summary(true)";
					$limit="20";
					
					$json_link = "https://graph.facebook.com/v2.3/{$album_id}/photos?fields={$fields}&limit={$limit}&access_token={$access_token}";
					$json = file_get_contents($json_link);

					$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
					
					$photo_count = count($obj['data']);
					
					// get next page
					$next_page = isset($obj['paging']['next']) ? $obj['paging']['next'] : "";
					$_SESSION['NEXT_PAGE_PHOTOS_' . $fb_page_id]=$next_page;
					$_SESSION['SET_NUM_PHOTOS_' . $fb_page_id]=1;
					
					$first_load=true;
					include_once "photos_template.php";
					
					echo "<div id='last_item_loader'></div>";
				?>

			</div>
	 
			<!-- Bootstrap Image Gallery lightbox, should be a child element of the document body -->
			<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">

		    <!-- Container for the modal slides -->
			    <div class="slides"></div>
			    <!-- Controls for the borderless lightbox -->
			    <h3 class="title"></h3>
			    <a class="prev">&#9668;</a>
			    <a class="next">&#9658;</a>
			    <a class="close">X</a>
			    <a class="play-pause"></a>
			    <!-- <ol class="indicator"></ol> -->
			    <!-- The modal dialog, which will be used to wrap the lightbox content -->
			    <div class="modal fade">
			        <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title"></h4>
			                </div>
			                <div class="modal-body next"></div>
			                <div class="modal-footer">
			                    <button type="button" class="btn btn-default pull-left prev">
			                        <i class="glyphicon glyphicon-chevron-left"></i>
			                        Previous
			                    </button>
			                    <button type="button" class="btn btn-primary next">
			                        Next
			                        <i class="glyphicon glyphicon-chevron-right"></i>
			                    </button>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php include("frontend/inc/social-icons.php"); ?>
		</section>
		
	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	 
	<!-- S C R I P T S -->

	<?php include("frontend/inc/yogonzo-scripts.php"); ?>

	<script>
	$('#blueimp-gallery').data('useBootstrapModal', false);
	$('#blueimp-gallery').toggleClass('blueimp-gallery-controls', true);

	$(window).on('load', function () {
		$('p').linkify();
	});

	function load_NextSet() {
		
		$('div#last_item_loader').html('<img src="frontend/images/ajax-loader.gif">');
		
		$.post("photos_more.php?fb_page_id=<?php echo $fb_page_id; ?>", function(data){
			if (data != "") {
				$(".item_box:last").after(data); 
			}
			
			if(data==""){
				$('div#last_item_loader').html(" ");
			}else{
				$('div#last_item_loader').empty();
			}
		});
	}; 

	</script>

	</body>
</html>