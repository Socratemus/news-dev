<?php echo doctype();?>
<html>
    
    <head>
        <?php echo meta($data['meta']);?>
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
    </head>
    
    <body>
        
        <header>
            
        </header>
       
        <?php $this->load->view($view,$data); ?>   
        
        <footer>
            
        </footer>
        
        <?php echo $this->inlinescript;?>
        
    </body>
    
</html>

