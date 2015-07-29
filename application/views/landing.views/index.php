<?php $slides =  $this->sliderModel->getAllActive(); ?>


<div class="col-md-12 extended mb25 hidden-sm hidden-xs" style="margin-top : 3px">
    <div class="crs" id="Crs">
        
        <?php foreach($slides as $slide) :?>
        <div class="">
            <a href="<?php echo $slide->getUrl();?>">
                <img src="<?php echo $slide->getImage()->getMedium()?>" alt="" />
                <p class="ml15 mr15 mt10" style=""><?php echo $slide->getTitle();?></p>    
            </a>
            
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
                <a href="<?php echo site_url('/a/' . $first->getSlug());?>"><?php echo $first->getTitle();?></a>
            </h3>
            
            <div class="meta-data">
                <?php $pubDate = $first->getPubDate()->format('d') . ' ' . Utils::getMonth($first->getPubDate()->format('m')) . ', ' .$first->getPubDate()->format('Y');  ?>
                <span class="pub-date"><?php echo $pubDate;?> </span>
                <span class="comm-no hide"><a href="">0 comentarii</a></span>
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
            <span>Cele mai recente stiri</span>
        </h3>
        <?php foreach($recents as $article) : ?>
        <article class="hz">
            
            <div class="cv col-md-5 col-xs-12">
                <a href="<?php echo site_url('/a/' . $article->getSlug())?>">
                    <img width="100%" src="<?php echo $article->getCover()->getMedium();?>" alt="<?php echo $article->getTitle();?>" /> 
                </a>
            </div>
            <div class="col-xs-12 col-md-7">
                <h3 class="article-title mt0">
                    <a href="<?php echo site_url('/a/' . $article->getSlug())?>">
                        <?php echo $article->getTitle();?>
                    </a>
                </h3>
                <?php $pubDate = $article->getPubDate()->format('d') . ' ' . Utils::getMonth($article->getPubDate()->format('m')) . ', ' . $article->getPubDate()->format('Y');  ?>
                <?php $author = $article->getAuthor(); ?>
                <p class="pub-data">Scris de  
                <?php if($author) : ?>
                    <a href="" class="author"><?php echo $author->getFirstname() . ' ' . $author->getLastname(); ?></a>
                <?php else :?>
                    Anonim
                <?php endif;?>
                <span class="pub-date"><?php echo $pubDate;?></span> </p>
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
        
    <div class="col-md-4" style="overflow : hidden;">
         
         
        <div class="" style="margin : auto;    width : 300px; height : 600px; border : 0px solid gray;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- baneer 300x600 home -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-5254465822978923"
                 data-ad-slot="5506066691"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
         
        <ul class="nav nav-tabs side-nav mb15">
            
            <li class="active">
                <a href="#recent" data-toggle="tab">
                Cele mai vizualizuate
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
                    
                	<li><a href="<?php echo site_url($date['YEAR'] . '/' . $date['MONTH']);?>"><?php echo Utils::getMonth($date['MONTH'])?> <?php echo $date['YEAR']?></a></li>
                	<?php endforeach;?>
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