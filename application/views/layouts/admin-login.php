<!--<?php echo doctype();?>-->
<html>
    
    <head>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
    </head>
    
    <body>
      
            <div class="container">
                <div class="login-window">
                    
                    <form class="" action="<?php echo site_url('auth/check') ?>" method="POST">
                        <div class="toolbar-top">
                            <p>Login Administration Area</p>
                        </div>
                        
                        <div class="window-content">
                            
                            <div class="col-md-12 extended col-xs-12">
                                <label class="col-md-4 col-xs-4 extended">Username: *</label>
                                <input type="text" class="col-md-8 col-xs-8" value="<?php echo set_value('identity'); ?>" name="identity">
                                
                                <?php echo form_error('identity', '<small class="col-xs-12 extended"><em>', '</em></small>'); ?>
                                
                                
                            </div>
                            
                            <div class="mt10 col-md-12 extended col-xs-12">
                                <label class="col-md-4 col-xs-4 extended">Parola: *</label>
                                <input type="password" class="col-md-8 col-xs-8" name="credidential">
                                 <?php echo form_error('credidential', '<small class="col-xs-12 extended"><em>', '</em></small>'); ?>
                            </div>
                            
                            <div class="clearfix"></div>
                            
                        </div>
                        
                        
                        <div class="toolbar-bottom mt5">
                            <button class="pull-right mr5">Send</button>
                            <div class="clearfix"></div>
                        </div>
                        
                    </form>
                    
                </div>
            </div> 
        
    </body>
    
</html>