<?php echo doctype();?>
<html>
    
    <head>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
        <style>
            body{
                background : white;
            }
        </style>
        
    </head>
    
    <body>
    
        <?php $this->load->view($view,$data); ?> 
    
     </body>
    
</html>