<!doctype html>
<html>
  <head>
    <title>Contact</title>
      <meta charset='utf-8'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- L I N K S -->
      <?php include("frontend/inc/yogonzo-links.php"); ?>
  </head>
  <body>
    <?php include_once("frontend/inc/analyticstracking.php") ?>
    <section class="main-section">

      <?php include("frontend/inc/main-logo-main-header.php"); ?>

      <div class="mensagemErro">teste</div>

      <div class="TTWForm-container">
      
        <form action="backend/sendmail.php" class="TTWForm ui-sortable-disabled" method="post"
                 novalidate="">
                                  
          <div id="field1-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field1">First Name *</label>          
            <input type="text" name="field1" id="field1" required="required">
          </div>
                        
          <div id="field4-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field4">Last Name *</label>          
            <input type="text" name="field4" id="field4" required="required">
          </div>
                          
          <div id="field5-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field5">Email *</label>
            <input type="email" name="field5" id="field5" required="required">
          </div>
                                   
          <div id="field6-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field6">Message *</label>
            <textarea rows="5" cols="20" name="field6" id="field6" required="required"></textarea>
          </div>
                       
          <div id="form-submit" class="field f_100 clearfix submit">
            <input type="submit" value="SUBMIT">
          </div>

        </form>
    
      </div>

      <div class="extra-bottom-space"></div>
      <?php include("frontend/inc/social-icons.php"); ?>

    </section>
    


<!-- S C R I P T S -->
<?php include("frontend/inc/yogonzo-scripts.php"); ?>      
  </body>
</html>  