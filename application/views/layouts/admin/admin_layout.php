<?php echo doctype();?>
<html>
    
    <head>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
    </head>
    
    </body>
    
        <header class="container-fluid">
            
            <?php $this->load->view('layouts/admin/header.php',$data); ?>
            
        </header>
        
        <main class="container-fluid">
            
            <div class="col-md-12 extended main-menu">
                
                <ul class="admin-nav">
                    
                    <li class="active"> 
                        <a href="">
                            <i class="fa fa fa-align-justify"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <li> 
                        <a href="">
                            <i class="fa fa-laptop"></i> 
                            Cms
                        </a>
                    </li>
                    
                    <li> 
                        <a href="">
                            <i class="fa fa-laptop"></i> 
                            Categories
                        </a>
                    </li>
                    
                    <li> 
                        <a href="">
                            <i class="fa fa-laptop"></i> 
                            Articles
                        </a>
                    </li>
                    
                    <li> 
                        <a href="">
                            <i class="fa fa-gear"></i> 
                            Setari
                        </a>
                    </li>
                    
                </ul>
                
                <div class="clearfix"></div>
                
            </div>
            
            <div class="col-md-12 main-wrapper">
                
                
                <?php $this->load->view($view,$data); ?> 
                
                
                    
            </div>
            
            <div class="col-md-12 footer">
                
            <?php $this->load->view('layouts//admin/footer.php',$data); ?>
            
            </div>
            
        </main>
    
    </body>
    
</html>