<!--<div class="row article-main">-->
    
    <div class="col-md-12 extended mt15" style="border-bottom : 1px solid #eee;">
        
        <h1 class="title-big col-md-12"><?php echo $article->getTitle();?></h1>    
        
        <div class="mt20 mb10 col-md-5">
            <p class="pub-data">By <a href="" class="author">Cornelius Maximus</a> <span class="pub-date">February 16, 2015 </span> <a href="">0 comments</a></p>    
        </div>
        
        <div class="share mt20 mb10 text-right col-md-7">
            <a href="https://twitter.com/intent/tweet?url=myurl" target="_blank" title="Tweet this on Twitter" class="twitter"><i class="fa fa-twitter"></i> Tweet</a>

            <a href="https://facebook.com/sharer.php?url=myurl" target="_blank" title="Share this on Facebook" class="facebook"><i class="fa fa-facebook"></i> Share</a>

            <a href="https://plus.google.com/share?url=mylink" target="_blank" title="Post this to Google+" class="gplus"><i class="fa fa-google-plus"></i> Share</a>
            <div class="clear"></div>
        </div>
        
        <div class="clearfix"></div>
        
    </div>
    
    <div class="col-md-12 extended mt20 mb40">
        
        <article class="article col-md-8">
            
            
            <div class="cv mb15">
                <img src="<?php echo $article->getCover()->getBig();?>" alt="" />
            </div>    
            <div class="entry-content">
                <?php echo $article->getLongDescription();?>
            </div>
            
            <hr />
            
            <footer class="article-footer">
                <div class="col-md-2 cv author">
                    <img src="http://0.gravatar.com/avatar/d95e7dab8e934dcaa30a9829f50b2f6a?s=100&r=pg&d=mm" alt="author" />
                </div>
                <div class="col-md-10">
                    <h3 class="mt10"><span>Written by</span> Cornelius Iancus </h3>
                    <p class="mt15">Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum</p>
                </div>
                
                <div class="clearfix"></div>
            </footer>
            
            <hr />
            
            <h2>No comments</h2>
            
            <hr />
            
            <h2>Lasa un comentariu</h2>
             
            <p class="mt15"><em>Your email address will not be published. Required fields are marked *</em></p>
             
            <form method="POST" class="col-md-12 mt15" action="">
                <input type="hidden" name="StoryId" value="" />
                
                <div class="row">
                    <div class="col-md-4 pl0">
                        <label>Nume</label>
                        <input type="text" class="form-control" name="" placeholder="Numele tau">        
                    </div>
                    
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="" placeholder="E-mail">        
                    </div>
                    
                    <div class="col-md-4">
                        <label>Website</label>
                        <input type="text" class="form-control" name="" placeholder="Website">        
                    </div>
                </div>
                
                <div class="row mt15">
                    <div class="col-md-12 pl0">
                        <label>Comentariu *</label>
                        <textarea name="Comment" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="row mt15">
                    <button class="btn btn-primary">Trimite comentariu</button>
                </div>
                
            </form>
             
        </article>
        
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
                        
                    	<li><a href=""><?php echo Utils::getMonth($date['MONTH'])?> <?php echo $date['YEAR']?></a></li>
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
<!--</div>-->