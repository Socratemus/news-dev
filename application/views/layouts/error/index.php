<?php echo doctype();?>
<html>
    
    <head>
        <?php echo meta($data['meta']);?>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
        <style>
            
        </style>
    </head>
    
    <body>
          
        <!--<?php var_dump($view)?>-->
          
            <?php $this->load->view($view,$data); ?>
          
        
    </body>
    
</html>