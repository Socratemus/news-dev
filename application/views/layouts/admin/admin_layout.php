<?php echo doctype();?>
<html>
    
    <head>
        
        <?php echo $this->headlink;?>
        
        <?php echo $this->headscript;?>
        
    </head>
    
    <body>
    
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
                        <div class="dropdown">
                          <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-pencil-square-o"></i> 
                            CMS System
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo site_url('/admin/cms')?>">Listare pagini statice</a></li>
                            <li><a href="<?php echo site_url('/admin/newCmsPage')?>">Adauga pagina noua</a></li>
                          </ul>
                        </div>
                    </li>
                    
                    <li> 
                        <div class="dropdown">
                          <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-laptop"></i> 
                            Categories
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo site_url('/admin/categories')?>">Listare categorii</a></li>
                            <li><a href="<?php echo site_url('/admin/newCategory')?>">Adauga o categorie</a></li>
                          </ul>
                        </div>

                    </li>
                    
                    <li> 
                        <div class="dropdown">
                          <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-newspaper-o"></i> 
                            Articole
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo site_url('/admin/articles')?>">Listare articole</a></li>
                            <li><a href="<?php echo site_url('/admin/newArticle')?>">Adauga un articol</a></li>
                            <li><a href="<?php echo site_url('/admin/users')?>">Listeaza autorii</a></li>
                            <li><a href="<?php echo site_url('/admin/newUser')?>">Adauga un autor</a></li>
                          </ul>
                        </div>
                    </li>
                    
                    <li> 
                        <div class="dropdown">
                          <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-gear"></i> 
                            Setari
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo site_url('/admin/seo')?>">SEO</a></li>
                            <li><a href="<?php echo site_url('/admin/slider')?>">Slider</a></li>
                          </ul>
                        </div>
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