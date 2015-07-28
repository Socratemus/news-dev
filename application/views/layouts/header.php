<?php if(! isset($_COOKIE['accept_cookie'])) :?>
<div id="cookies" class="text-center row">
    Acest site foloseşte cookies! Continuarea navigării implică acceptarea lor. Mai multe despre cookies.
    <a href="<?php echo site_url('/cookies');?>">Ok</a>
</div>
<?php endif;?>


<!-- Modal -->
<div class="modal fade" id="FacebookLikeAndShare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header hide">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body text-center">
        <div class="fb-page" data-href="https://www.facebook.com/top24h.ro" data-width="568" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/top24h.ro"><a href="https://www.facebook.com/top24h.ro">Top24h.ro</a></blockquote></div></div>
      </div>
      <div class="modal-footer hide">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div id="SdMn">
    <div class="sidebar-content">
        <div class="text-center"> 
            <h3 class="no-margin">Top24h</h3>
        </div>
        <ul class="main-menu mt15 nav nav-bar row">
            
            <li class="col-md-6 col-xs-6 extended">
                <a href="<?php echo site_url();?>">● Acasa</a>
            </li>
            <?php $menucts = $this->category_model->getPrimaryMenuCategories()?>
            <?php foreach($menucts as $menu) :?>
            
            <li class="col-md-6 col-xs-6 extended">
                <a href="<?php echo site_url('/c/' . $menu->getSlug()) ;?>"><?php echo $menu->getTitle();?></a>
            </li>
            
            <?php endforeach;?>
            
            
        </ul>
        
    </div>
    
    
    
</div>

<div class="header-top row">
    
    <div class="col-md-3 col-xs-10">
        <a href="<?php echo base_url();?>" class="mt5 block pl50"><img width="170" src="<?php echo base_url('/public/img/logo_original.png');?>" alt="Top24h" /></a>
    </div>
    <div class="col-xs-2 visible-xs">
        <a id="MbTgl" href=""><i class="fa fa-bars"></i></a>
    <div>
    <div class="col-md-8 hidden-sm hidden-xs">
        <div class="pub-zone" style="border : 0px solid #ccc">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- blogger mare nou -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-5254465822978923"
                 data-ad-slot="6524715497"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>    
        </div>
        
    </div>
    <div class="clearfix"></div>
    
</div>

<div class="row cat-main hidden-xs">
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

<div class="row cat-secondary hidden-xs">
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

<div class="header-bottom hidden-sm hidden-xs row">
    
    <div class="col-md-3">
        <h3 class="uppercase mt20 ml50 pl10">Breaking News</h3>
    </div>
    
    <div class="col-md-8">
        <p id="marque"><?php echo $motd;?></p>
    </div>
    
</div>
