<div class="header-top row">
    
    <div class="col-md-3 ">
        <a href="<?php echo base_url();?>" class="mt5 block pl50"><img width="170" src="<?php echo base_url('/public/img/logo_original.png');?>" alt="Top24h" /></a>
    </div>
    
    <div class="col-md-7">
        <div class="pub-zone" style="border : 1px solid #ccc">
            
        </div>
        
    </div>
    
</div>

<div class="row cat-main">
    <div class="col-xs-10 ">
        <ul class="main-menu nav nav-bar ml45">
            
            <li>
                <a href="<?php echo site_url();?>">● Acasa</a>
            </li>
            <?php $menucts = $this->category_model->getPrimaryMenuCategories()?>
            <?php foreach($menucts as $menu) :?>
            
            <li>
                <a href="<?php echo site_url('/c/' . $menu->getSlug()) ;?>"><?php echo $menu->getTitle();?></a>
            </li>
            
            <?php endforeach;?>
            
            
        </ul>
    </div>
</div>

<div class="row cat-secondary">
    <div class="col-xs-10 ">
        <ul class="main-menu nav nav-bar ml45">
        
            <?php $menucts = $this->category_model->getSecondaryMenuCategories()?>
            <?php foreach($menucts as $menu) :?>
            
            <li>
                <a href="<?php echo site_url('/c/' . $menu->getSlug()) ;?>"><?php echo $menu->getTitle();?></a>
            </li>
            
            <?php endforeach;?>
            
            
        </ul>
    </div>
</div>

<div class="header-bottom hidden-xs row">
    
    <div class="col-md-3">
        <h3 class="uppercase mt20 ml50 pl10">Breaking News</h3>
    </div>
    
    <div class="col-md-8">
        <p id="marque"><?php echo $motd;?></p>
    </div>
    
</div>
