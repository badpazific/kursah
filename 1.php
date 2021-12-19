<?php
	require 'db.php';
?>

<?php if( isset($_SESSION['logged_user']) ) : ?>
        
 

<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Главная</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.0.3, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/aptekaru.jpg"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Главная">
    <meta property="og:type" content="website">
  </head>

        <div class="photo"><img src="images/aptekaru.jpg" class="photo" width="150" height="111"></div>
        <div class="us1"><a href="logout.php" >Выйти</a></div>
        <div class="conteiner">
          <div class="btn btn-danger"><a href="addmedicine.php" >Добавить лекарства</a></div>
          <div class="us3">
            <button id="med_btn"class="btn btn-primary med1" name="show_med">Список лекарств</button>
            <div id="med_show"></div>
          </div>
        </div>

        <script>
        jQuery(function($) {
          $(document).on('click', '#med_btn', function(){
            var html = `
                <!-- Лекарства -->
                    <div id="medlist">
                        <?php 
                          require_once('dblek.php');
                        ?>
                    </div>
                <!-- Лекарства -->
            `;
          $('#med_show').html(html);
          });
        });
        </script> 
          
<?php else : ?>  
  <div><p1>Войдите чтобы получить список лекарств</p1></div>
  <form action="index.php">
      <button type="submit">На главную</button>
  </form>
<?php endif; ?>
  </body>
</html>
    
