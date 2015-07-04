<!--<div class="row article-main">-->
    
    <div class="col-md-12 extended mt15" style="border-bottom : 1px solid #eee;">
        
        <h1 class="title-big col-md-12"><?php echo $article->getTitle();?></h1>    
        
        <div class="mt20 mb10 col-md-5">
            <?php $author = $article->getAuthor();?>
            <p class="pub-data">
                Scris de 
                <?php if($author ) : ?>
                <a href="javascript:void(0);" class="author"></a> 
                <?php else : ?>
                <a href="javascript:void(0);" class="author">Anonim</a> 
                <?php endif;?>
                <?php $pubDate = $article->getPubDate()->format('d') . ' ' . Utils::getMonth($article->getPubDate()->format('m')) . ', ' .$article->getPubDate()->format('Y') . ' ' . $article->getPubDate()->format('H:i');  ?>
                <span class="pub-date"><?php echo $pubDate;?> </span>
            
            </p>    
        </div>
        
        <div class="share mt20 mb10 text-right col-md-7">
            <a href="https://twitter.com/intent/tweet?url=<?php echo site_url('/a/' . $article->getSlug())?>" target="_blank" title="Tweet this on Twitter" onclick="app.popup(this);event.preventDefault();" class="twitter with-popup"><i class="fa fa-twitter"></i> Tweet</a>
            
            <a href="https://facebook.com/sharer/sharer.php?u=<?php echo site_url('/a/' . $article->getSlug())?>&display=popup&ref=plugin&src=share_button" target="_blank" onclick="app.popup(this);event.preventDefault();" title="Distribuie pe facebook Facebook" class="with-popup facebook"><i class="fa fa-facebook"></i> Share</a>

            <a href="https://plus.google.com/share?url=<?php echo site_url('/a/' . $article->getSlug())?>" target="_blank" title="Post this to Google+" onclick="app.popup(this);event.preventDefault();" class="gplus"><i class="fa fa-google-plus with-popup"></i> Share</a>
            
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
           
            <?php $author = $article->getAuthor(); if($author) : ?>
            <footer class="article-footer">
                <div class="col-md-2 extended cv author">
                    <img src="<?php echo $author->getCover()->getMedium();?>" alt="author" />
                </div>
                <div class="col-md-10">
                    
                    <h3 class="mt10"><span>Scris de</span> <?php echo $author->getFirstname() . ' ' . $author->getLastname() ; ?> </h3>
                    <p class="mt15"><?php echo $author->getQuota();?></p>
                </div>
                
                <div class="clearfix"></div>
            </footer>
            <?php endif;?>
            
            <hr />
            <?php if($article->getComments()->count() > 0 ) :?>
            <div class="comment-section hide">
                <?php foreach($article->getComments() as $comment) :?>
                <section class="comment">
                    <h3><span class="capitalize"><?php echo $comment->getName();?></span> a spus :</h3>
                
                    <?php $pubDate = $comment->getCreated()->format('d') . ' ' . Utils::getMonth($comment->getCreated()->format('m')) . ', ' .$comment->getCreated()->format('Y') . ' ' . $comment->getCreated()->format('H:i');  ?>
                    <em class="pub-data">La data de : <?php echo $pubDate; ?></em> <br/>
                    <?php echo $comment->getContent();?>
                    <hr />
                </section>
                <?php endforeach;?>
            </div>
            <?php else : ?>
            <!--<h2>No comments</h2>-->
            <!--<hr />-->
            <?php endif; ?>
            
            
            <h2 class="hide">Lasa un comentariu</h2>
             
            <p class="mt15 hide"><em>Adresa ta de email / website nu vor fi publicate. Campurile marcate cu * sunt obligatorii.</em></p>
             
            <form method="POST" class="col-md-12 mt15 hide" action="<?php echo site_url('/landing/addComment');?>" id="CommentForm">
                <input type="hidden" name="StoryId" value="<?php echo $article->getStoryId();?>" />
                
                <div class="row">
                    <div class="col-md-4 pl0">
                        <label>Nume</label>
                        <input type="text" class="form-control" name="Name" placeholder="Numele tau">        
                    </div>
                    
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Email" placeholder="E-mail">        
                    </div>
                    
                    <div class="col-md-4">
                        <label>Website</label>
                        <input type="text" class="form-control" name="Website" placeholder="Website">        
                    </div>
                </div>
                
                <div class="row mt15">
                    <div class="col-md-12 pl0">
                        <label>Comentariu *</label>
                        <textarea name="Content" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="row mt15">
                    <button class="btn btn-primary">Trimite comentariu</button>
                </div>
                
            </form>
             
            <div class="fb-comments" data-href="<?php echo site_url('/a/' . $article->getSlug());?>" data-version="v2.3"></div>
             
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

<script type="text/javascript">
    $().ready(function(){
        app.validateComment();
    });
</script>