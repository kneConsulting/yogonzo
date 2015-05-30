<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$page_title = "Events";

?>
<!doctype html>
<html>
  <head>
    <title><?php echo $page_title; ?></title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="frontend/css/reset.min.css">
      <link rel="stylesheet" type="text/css" href="frontend/scripts/add-ins/royal-slider/royalslider.css">
      <link rel="stylesheet" media="screen" href="frontend/libs/js/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
      <style>
        .col-md-4{
          margin: 0 0 2em 0;
        }
        
        .photo-thumb{
          width:100%;
          height:200px;
          float:left; 
          border: thin solid #d1d1d1;
          margin:0 1em 1em 0;
        }
        
        #last_item_loader{
          text-align:center; 
          display:block; 
          width:100%; 
          overflow:hidden; 
          margin:1em 0; 
          font-weight:bold;
        }
        
        .item_box{
          height:320px;
        }
        
        .display-none{
          display:none;
        }
      </style>
  </head>
  <body>
        <section class="main-section">

            <div class="top-logo-container">
                <div class="main-logo">
                    <a href="index.html" class="logo"><img src="frontend/images/yogonzo-small-logo.png" class="ri"></a>
                </div>
            </div>

            <header class="main-menu">
                <nav class='menu-res'>
                    <ul>
                       <li class='has-sub'><a href='index.html'><span>Gallery</span></a>
                          <ul>
                             <li class='has-sub last'><a href='portraits.html'><span>Portraits</span></a></li>
                             <li class='has-sub last'><a href='family-portraits.html'><span>Family Portraits</span></a></li>
                             <li class='has-sub last'><a href='events.php'><span>Events</span></a></li>
                          </ul>
                       </li>
                       
                       <li class='has-sub last'><a href='about.html'><span>About</span></a></li>
                       <li class='has-sub last'><a href='contact.html'><span>Contact</span></a></li>
                    </ul>
                    </nav>
            </header>

            <img src="frontend/images/ajax-loader.gif" class="display-none" />

            <div class="events-section">

              <div class="container">

                <?php
                  
                  echo "<div class='col-lg-12'>";
                    echo "<h1 class='page-header'>{$page_title}</h1>";
                  echo "</div>";
                                
                  $fb_page_id = isset($_GET['fb_page_id']) ? $_GET['fb_page_id'] : "315361598603265";
                  $fields="id,name,description,link,cover_photo,count,likes.limit(0).summary(true),comments.limit(0).summary(true)";
                  $limit="9";
                  $access_token="1574818609451101|HPM_w0Js-jtGi_H3_Owhkm5BtXI";
                  
                  $json_link = "https://graph.facebook.com/v2.3/{$fb_page_id}/albums?fields={$fields}&limit={$limit}&access_token={$access_token}";
                  $json = file_get_contents($json_link);

                  $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
                  
                  $album_count = count($obj['data']);
                  
                  // get next page
                  $next_page = $obj['paging']['next'];
                  $_SESSION['NEXT_PAGE_PHOTO_ALBUMS_' . $fb_page_id]=$next_page;
                  $_SESSION['SET_NUM_PHOTO_ALBUMS_' . $fb_page_id]=1;
                  
                  include_once 'albums_template.php';
                  echo "<div id='last_item_loader' style='text-align:center;'></div>";
                ?>
              </div>
            </div>
        </section>

    <script type="text/javascript" src="frontend/scripts/add-ins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="frontend/libs/js/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="frontend/libs/js/bootstrap/docs-assets/js/holder.js"></script>
    <script type="text/javascript" src="frontend/scripts/add-ins/royal-slider/jquery.royalslider.min.js"></script>
    <script type="text/javascript" src="frontend/scripts/yogonzo.js"></script>

    <script>

    function load_NextSet() {
      $('div#last_item_loader').html('<img src="images/ajax-loader.gif">');
  
      $.post("albums_more.php?fb_page_id=<?php echo $fb_page_id; ?>", function(data){
        if (data != "") {
          $(".item_box:last").after(data); 
        }
    
        if(data==""){
          $('div#last_item_loader').html("All photo albums were loaded.");

        }else{
          $('div#last_item_loader').empty();
        }
      });
    };
    </script>       
  </body>
</html>