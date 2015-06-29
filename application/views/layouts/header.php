<div class="header-top row">
    
    <div class="col-md-3 ">
        <h1 class="mt35 pl50"><strong>TOP24H</strong></h1>
    </div>
    
    <div class="col-md-7">
        <div class="pub-zone">
            
        </div>
        
    </div>
    
</div>

<div class="row cat-main">
    <div class="col-xs-10 ">
        <ul class="main-menu nav nav-bar ml45">
            
            <li>
                <a href="<?php echo site_url();?>">Acasa</a>
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
        <p id="marque">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
    </div>
    
</div>