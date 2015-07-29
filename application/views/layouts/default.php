<?php echo doctype();?>
<html>
    
    <head>
        <?php echo meta($data['meta']);?>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('favicon.ico?v=2')?>"/>
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url('favicon.ico')?>"/>
        <title><?php echo $this->headtitle;?></title>
    </head>
    
    <body>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-64794488-1', 'auto');
          ga('send', 'pageview');
        
        </script>
        
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

