<?php echo doctype();?>
<html>
    
    <head>
        <?php echo meta($data['meta']);?>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        <title>TOP24H - Top NEWS 24H A DAY</title>
    </head>
    
    <body>
        <script>
            window.fbAsyncInit = function() {
            FB.init({
              appId      : '448407545284216',
              xfbml      : true,
              version    : 'v2.3'
            });
            };
            
            (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <header id="Header" class="container-fluid">
            <?php $this->load->view('layouts/header.php',$data); ?>
        </header>
           
        <section id="Wrapper" class="container-fluid">
            <?php $this->load->view($view,$data); ?>       
        </section>
        
        <!--<div-->
        <!--  class="fb-like"-->
        <!--  data-share="true"-->
        <!--  data-width="450"-->
        <!--  data-show-faces="true">-->
        <!--</div>-->
        <footer id="Footer" class="container-fluid">
            <?php $this->load->view('layouts/footer.php',$data); ?>
        </footer>
        
        <?php echo $this->inlinescript;?>
        
    </body>
    
</html>

