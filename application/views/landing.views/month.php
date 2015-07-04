<div class="col-md-12 mt15" >
    <h1 class="col-md-12 extended title"><span><?php echo Utils::getMonth($date->format('m'))?> <?php echo $date->format('Y');?><?php //echo $category->getTitle();?></span></h1>    
    
    <div class="clearfix"></div>
    
</div>

<div class="col-md-12 extended mt20 mb40">
    
    <div class="col-md-8">
        
        <?php $i = 0;?>
        <?php foreach($articles as $article) : $i++;?>
        <article class="hz">
            
            <div class=" cv col-xs-5">
                <img src="<?php echo $article->getCover()->getMedium();?>" alt="<?php echo $article->getTitle();?>" /> 
            </div>
            <div class="col-xs-7">
                <h3 class="article-title mt0">
                    <a href="<?php echo site_url('/a/' . $article->getSlug())?>">
                        <?php echo $article->getTitle();?>
                    </a>
                </h3>
                <?php $pubDate = $article->getPubDate()->format('d') . ' ' . Utils::getMonth($article->getPubDate()->format('m')) . ', ' . $article->getPubDate()->format('Y');  ?>
                <p class="pub-data">By <a href="" class="author">Cornelius Maximus</a> <span class="pub-date"><?php echo $pubDate;?></span> <a href="">0 comments</a></p>
                <p><?php echo $article->getShortDescription();?></p>
            </div>
            <div class="clearfix"></div>
        </article>
        <?php endforeach; ?>
        <?php if($i == 0) :?>
        <h3>Nu s-au gasit articole.</h3>
        <?php endif;?>
        
    </div>
    
    <sidebar class="col-md-4">
            
        <ul class="nav nav-tabs side-nav mb15">
            
            <li class="active">
                <a href="#recent" data-toggle="tab">
                Recent Posts
                </a>
            </li>
            <li>
                <a href="#tags" data-toggle="tab">
                    Tags
                </a>
            </li>
            <li>
                <a href="#archive" data-toggle="tab">
                    Arhive
                </a>
            </li>
                
        </ul>
            
        <div class="tab-content" id="tabs">
            
            <div class="tab-pane active" id="recent">
                
                <?php $mostViewed = $this->article_model->getMostViewed();?>
                <?php foreach($mostViewed as $mv):?>
                <article class="sb">
                    
                    <div class="col-xs-4 cv pl0">
                        <img src="<?php echo $mv->getCover()->getMedium();?>" alt="<?php echo $mv->getTitle();?>" />
                    </div>
                    
                    <div class="col-xs-8 extended">
                        <h5 class="mt0"><a href="<?php echo site_url('/a/' . $mv->getSlug())?>"><?php echo $mv->getTitle();?></a></h5>
                    </div>
                    
                    <div class="clearfix"></div>
                </article>
                <?php endforeach;?>
                                
                                
            </div>
                
            <div class="tab-pane" id="tags">
                
                <?php foreach($this->tag_model->getAll() as $tag) :?>
                    <a href="<?php echo site_url('/tag/' . $tag->getSlug());?>" class="tag-name"><?php echo $tag->getTitle();?></a>
                <?php endforeach;?>
                    
            </div>
                
            <div class="tab-pane" id="archive">
                <?php $months = $this->article_model->getMonths(); ?>
                <ul class="pl0 archive">
                    <?php foreach($months as $date) : $date['MONTH'] = $date['MONTH'] < 10 ? '0' . $date['MONTH'] : $date['MONTH'] ?>
                    
                	<li><a href="<?php echo site_url($date['YEAR'] . '/' . $date['MONTH'])?>"><?php echo Utils::getMonth($date['MONTH'])?> <?php echo $date['YEAR']?></a></li>
                	<?php endforeach;?>
        		</ul>
            </div>
        </div>
            
        <div class="col-md-12 extended mt30 hide">
            <h3 class="main-section-title uppercase title">
                <span>
                    <a href="">Tehnology</a>
                </span>    
            </h3>
            
            <br />
            
            <article class="mn">
                
                <div class="cv-hld">
                    <a href="">
                        <img src="http://demo.wpzoom.com/compass/files/2015/02/100708_Pudong_Hero_PR-640x400.jpeg" alt="article title"/>     
                    </a>
                </div>
                
                <h3 class="article-title">
                    <a href="">Take a sneak peak inside Apple’s gorgeous new Chongqing Store</a>
                </h3>
                
                <div class="meta-data">
                    <span class="pub-date">February 16, 2015 </span>
                    <span class="comm-no"><a href="">0 comments</a></span>
                </div>
                
                <div class="desc">
                    <p>This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a place holder for people who need some type to visualize what the actual copy might look like if it were real content. If you want to read, I might suggest a good […]</p>
                </div>
                
            </article>
            
            <ul class="featured">
                <li>
        			<h4 class="article-title"><a href="http://demo.wpzoom.com/compass/2015/02/16/apple-reports-record-earnings-and-ipad-sales/" title="Apple Reports Record Earnings and iPad Sales">Apple Reports Record Earnings and iPad Sales</a></h4>
        			<div class="clear"></div>
        		</li>
        		
        		<li>
        			<h4 class="article-title"><a href="http://demo.wpzoom.com/compass/2015/02/16/apple-reports-record-earnings-and-ipad-sales/" title="Apple Reports Record Earnings and iPad Sales">Apple Reports Record Earnings and iPad Sales</a></h4>
        			<div class="clear"></div>
        		</li>
        		
        		<li>
        			<h4 class="article-title"><a href="http://demo.wpzoom.com/compass/2015/02/16/apple-reports-record-earnings-and-ipad-sales/" title="Apple Reports Record Earnings and iPad Sales">Apple Reports Record Earnings and iPad Sales</a></h4>
        			<div class="clear"></div>
        		</li>
        		
            </ul>
            
        </div>
        <div class="clearfix"></div>
    </sidebar>
    
</div>

<div class="clearfix"></div>