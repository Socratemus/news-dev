<?php $slides =  $this->sliderModel->getAllActive(); ?>


<div class="col-md-12 extended mb25" style="margin-top : 3px">
    <div class="crs" id="Crs">
        
        <?php foreach($slides as $slide) :?>
        <div class="">
            <img src="<?php echo $slide->getImage()->getMedium()?>" alt="" />
            <h4 class="ml15"><?php echo $slide->getTitle();?></h4>
            <!--<p class="ml15"><?php echo $slide->getContent();?></p>-->
        </div>
        <div class="">
            <img src="<?php echo $slide->getImage()->getMedium()?>" alt="" />
            <h4 class="ml15"><?php echo $slide->getTitle();?></h4>
            <!--<p class="ml15"><?php echo $slide->getContent();?></p>-->
        </div>
        
        <?php endforeach;?>
        
    </div>    
</div>



<div class="col-md-12 news-section">
    
    <?php $fptc = $this->categoryModel->getFpt();?>
    <?php foreach($fptc as $fptct) :?>
    <div class="col-md-4">
        <h3 class="main-section-title uppercase title">
            <span>
                <a href=""><?php echo $fptct->getTitle();?></a>
            </span>    
        </h3>
        
        <br />
        
        <?php $first = $fptct->getStories()->first();?>
        <?php if($first) : ?>
        <article class="mn">
            
            <div class="cv-hld">
                <a href="<?php echo site_url('/a/' . $first->getSlug());?>">
                    <img src="<?php echo $first->getCover()->getMedium();?>" alt="article title"/>     
                </a>
            </div>
            
            <h3 class="article-title">
                <a href=""><?php echo $first->getTitle();?></a>
            </h3>
            
            <div class="meta-data">
                <?php $pubDate = $first->getPubDate()->format('d') . ' ' . Utils::getMonth($first->getPubDate()->format('m')) . ', ' .$first->getPubDate()->format('Y');  ?>
                <span class="pub-date"><?php echo $pubDate;?> </span>
                <span class="comm-no"><a href="">0 comentarii</a></span>
            </div>
            
            <div class="desc">
                <p><?php echo $first->getShortDescription();?></p>
            </div>
            
        </article>
        <?php endif;?>
        
        <?php
            $featured = array();
            $ftcnt = 3;
            while($ftcnt > 0 ){
                if($tmp = $fptct->getStories()->next()){
                    $featured[] = $tmp;
                }
                unset($tmp);
                $ftcnt--;
            }
        ?>
        
        
        <ul class="featured">
            
            <?php foreach($featured as $article) :?>
            <li>
    			<h4 class="article-title"><a href="<?php echo site_url('/a/' . $article->getSlug()); ?>" title=""><?php echo $article->getTitle();?></a></h4>
    			<div class="clear"></div>
    		</li>
    		<?php endforeach;?>
    		
        </ul>
        
    </div>
    <?php endforeach;?>
    
</div>

<div class="col-md-12 main-bottom">
    
    <div class="col-md-8">
        <h3 class="title">
            <span>Latest News</span>
        </h3>
        <?php foreach($recents as $article) : ?>
        <article class="hz">
            
            <div class=" cv col-xs-5">
                <img src="<?php echo $article->getCover()->getMedium();?>" alt="<?php echo $article->getTitle();?>" /> 
            </div>
            <div class="col-xs-7">
                <h3 class="article-title">
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
        
        <div class="bs-example" style="text-align : center;">
            <?php 
                $currPage = $this->input->get('page');
                $currPage = $currPage ? $currPage : 1; 
                $prev = $currPage == 1 ? 1 : $currPage - 1;
                $next = $currPage == $pages ? $pages : $currPage + 1;
            ?>
            <ul class="pagination">
                <li><a href="<?php echo site_url('?page=' . $prev);?>">&laquo;</a></li>
                <?php for($i = 1 ; $i<= $pages ; $i++) :?>
                <li><a href="<?php echo site_url('?page=' . $i);?>"><?php echo $i;?></a></li>
                <?php endfor;?>
                
                <li><a href="<?php echo site_url('?page=' . $next);?>">&raquo;</a></li>
            </ul>
        </div>
    </div>    
        
    <div class="col-md-4">
        
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
                <?php for($i = 0 ; $i < 4 ; $i++) :?>
                <article class="sb">
                    
                    <div class="col-xs-4 cv pl0">
                        <img src="http://demo.wpzoom.com/compass/files/2015/02/100708_Pudong_Hero_PR-90x75.jpeg" alt="article-title" />
                    </div>
                    
                    <div class="col-xs-8 extended">
                        <h3><a href="">This fierce blizzard has made February Boston’s snowiest month ever</a></h3>
                    </div>
                    
                    <div class="clearfix"></div>
                </article>
                <?php endfor;?>
                
            </div>
            <div class="tab-pane" id="tags">
                <?php for($i = 0 ; $i < 15 ; $i++) :?>
                    <a href="" class="tag-name">Sport</a>
                    <a href="" class="tag-name">Politica</a>
                    <a href="" class="tag-name">Audi</a>
                <?php endfor;?>
            </div>
            <div class="tab-pane" id="archive">
                <ul class="pl0 archive">
                	<li><a href="">February 2015</a></li>
                	<li><a href="">January 2015</a></li>
                	<li><a href="">March 2014</a></li>
                	<li><a href="">October 2013</a></li>
                	<li><a href="">April 2013</a></li>
                	<li><a href="">March 2013</a></li>
                	<li><a href="">February 2013</a></li>
                	<li><a href="">August 2012</a></li>
                	<li><a href="">June 2012</a></li>
                	<li><a href="">May 2012</a></li>
                	<li><a href="">April 2012</a></li>
                	<li><a href="">March 2012</a></li>
        		</ul>
            </div>
        </div>
    
    </div>
        
</div>

<div class="col-md-12 news-section">
    
    <?php $fpbc = $this->categoryModel->getFpb();?>
    <?php foreach($fpbc as $fpbct) :?>
    <div class="col-md-3">
        <h3 class="main-section-title uppercase title">
            <span>
                <a href="<?php echo site_url('/c/'.$fpbct->getSlug())?>"><?php echo $fpbct->getTitle();?></a>
            </span>    
        </h3>
        
        <br />
        <?php $first= $fpbct->getStories()->first();?>
        <?php if($first) : ?>
        <article class="mn">
            
            <div class="cv-hld">
                <a href="">
                    <img src="<?php echo $first->getCover()->getMedium();?>" alt="<?php echo $first->getTitle();?>"/>     
                </a>
            </div>
            
            <h3 class="article-title">
                <a href="<?php echo site_url('/a/' . $first->getSlug());?>"><?php echo $first->getTitle();?></a>
            </h3>
            
            <div class="meta-data">
                <?php $pubDate = $first->getPubDate()->format('d') . ' ' . Utils::getMonth($first->getPubDate()->format('m')) . ', ' .$first->getPubDate()->format('Y');  ?>
                <span class="pub-date"><?php echo $pubDate;?> </span>
                <span class="comm-no"><a href="">0 comments</a></span>
            </div>
            
            <div class="desc">
                <p><?php echo $first->getShortDescription();?></p>
            </div>
            
        </article>
        <?php endif;?>
        
        <ul class="featured">
            <?php
                $featured = array();
                $ftcnt = 3;
                while($ftcnt > 0 ){
                    if($tmp = $fpbct->getStories()->next()){
                        $featured[] = $tmp;
                    }
                    unset($tmp);
                    $ftcnt--;
                }
            ?>
            <?php foreach($featured as $article) : ?>
            <li>
    			<h4 class="article-title"><a href="<?php echo site_url('/a/' . $article->getSlug())?>" title=""><?php echo $article->getTitle()?></a></h4>
    			<div class="clear"></div>
    		</li>
    		<?php endforeach;?>

        </ul>
        
    </div>
    <?php endforeach;?>

</div>

<div class="clearfix"></div>

<script type="text/javascript">
    $().ready(function(){
        
    });
</script>