<?php echo doctype();?>
<html>
    
    <head>
        <?php echo meta($data['meta']);?>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
    </head>
    
    <body>
        
        <header id="Header" class="container-fluid">
            <?php $this->load->view('layouts/header.php',$data); ?>
        </header>
           
        <section id="Wrapper" class="container-fluid">
            <?php $this->load->view($view,$data); ?>       
        </section>
        
        
        <footer id="Footer" class="container-fluid">
            <?php $this->load->view('layouts/footer.php',$data); ?>
        </footer>
        
        <?php echo $this->inlinescript;?>
        
    </body>
    
</html>

