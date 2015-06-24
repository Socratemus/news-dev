<style>
    #textarea{width : 300px; padding : 5px;}
    .text-core .text-wrap .text-tags{
        position : relative;
        /*margin-top : -16px;*/
    }
    .text-core .text-wrap .text-tags .text-tag .text-button{
        padding-left : 8px;padding-right: 20px;
        /*padding-top : 5px; padding-bottom :  5px;*/
        /*height : initial;*/
    }
    
    
    
</style>

<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <?php if($article->getStoryId() == null) :?>
    <strong>Acest articol nu mai exista.</strong>
    <?php else :?>
    <input type="hidden" name="StoryId" value="<?php echo $article->getStoryId(); ?>">
    <!--<pre><?php echo validation_errors(); ?></pre>-->
    <div class="widget-header">
        <div class="widget-title">
         <h2>Editeaza articol - <?php echo $article->getTitle();?></h2>
          <!--<span class="mini-title">-->
          <!--  Simple, beautiful wysiwyg editors-->
          <!--</span>-->
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="col-md-6 extended">
            
            <div class="row ">
                <div class="col-xs-12">
                    <label>Titlu Articol - <?php $title = set_value('Title');?></label>
                    <input type='text' class="form-control" value="<?php echo $title ? $title : $article->getTitle();?>" name='Title' placeholder="Titlul articolului">
                </div>
            </div>
            
            <hr />
        
            <div class="row ">
                <div class="col-xs-6">
                    <label>Slug</label>
                    <?php $slugValue = set_value('Slug');?>
                    <input type='text' class="form-control" name='Slug' value="<?php echo $slugValue? $slugValue : $article->getSlug();?>" placeholder="Titlul din url al articolului">
                </div>
                <div class="col-xs-6">
                    <label>Publicat la data</label>
                    <?php $pubDateValue = set_value('PubDate');?>
                    <input id="datetimepicker" name="PubDate" type="text" value="<?php echo $pubDateValue ? $pubDateValue : $article->getPubDate()->format('Y/m/d H:i');?>" class="form-control" >
                </div>
            </div>
            
            <hr />
            
            <div class="row ">
                <div class="col-xs-6">
                    <label>Categorie</label>
                    <?php 
                        $categoryId = set_value('CategoryId');
                        $categoryId = $categoryId ? $categoryId : $article->getCategory()->getCategoryId();
                    ?>
                    <select class="form-control" name="CategoryId">
                        <option>Selecteaza categoria</option>
                        <?php foreach( $categories as $category) :  ?>
                        <option <?php echo $category->getCategoryId() == $categoryId  ? 'selected' : ''; ?> value="<?php echo $category->getCategoryId();?>"> <?php echo $category->getTitle();?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-xs-6">
                    <label>Autor</label>
                
                    <select class="form-control" name="">
                        <option>Selecteaza autorul</option>
                    </select>
                </div>
            </div>
            
            <hr />
            
            <div class="row ">

                <div class="col-xs-12">
                    <label>Taguri</label>
                     <input type="text" name="Tags" id="demo2" />
                </div>
            </div>
            
            <div class="row mt15">
                <div class="col-xs-6">
                    <label>Activ</label> <br/>
                    <?php $statusValue = set_value('Status');?>
                    <input type="checkbox" name="Status" <?php echo $statusValue || $article->getStatus() == 1 ? 'checked' : '' ?> value='1' id="" />
                </div>
            </div>
            
        </div>
        
        <div class="col-xs-6">
            <label>Imagine stire</label>
            <input type="file" name="Cover" class="form-control" />
            
            <div class="col-xs-12 extended articol-cover-wp">
                <?php if($article->getCover()) :?>
                    <img src="<?php echo $article->getCover()->getMedium();?>" alt="Imaginea Articolului" />
                <?php else :?>
                    <img src="<?php echo base_url('public/img/default-article.png')?>" alt="Imaginea Articolului" />
                <?php endif;?>
                
                
            </div>
            
        </div>
        
        <div class="clearfix"></div>
        <hr />
    
        <div class="row ">
            <div class="col-xs-12">
                <label>Descriere scurta</label>
            </div>
            <div class="col-xs-12">
                <?php $shortDescriptionValue = set_value('ShortDescription') ;?>
                <textarea name="ShortDescription" id="ArticleShort" rows=2><?php echo $shortDescriptionValue? $shortDescriptionValue : $article->getShortDescription();?></textarea>
            </div>
            
        </div>
    
        <div class="row ">
            <div class="col-xs-12">
                <label>Descriere lunga</label>
            </div>
            <div class="col-xs-12">
                <?php $longDescriptionValue = set_value('LongDescription') ;?>
                <textarea name="LongDescription" id="ArticleLong" rows=2><?php echo $longDescriptionValue ? $longDescriptionValue : $article->getLongDescription();?></textarea>
            </div>
            
        </div>
        
        <div class="row mt30">
            <div class="col-xs-12">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </div>
        
    </div>
    <?php endif;?>
</form>

<?php
    $initial = array();
    $allTags = array();
    
    foreach($article->getTags() as $tg){
        // echo $tg->getTitle();
        array_push($initial , $tg->getTitle());
    }
    foreach($tags as $tg){
        // echo $tg->getTitle();
        array_push($allTags , $tg->getTitle());
    }
    $initial = json_encode($initial);
    $allTags = json_encode($allTags);
?>

<script type="text/javascript">
    var initialTags = <?php echo $initial;?>;
    var allTags = <?php echo $allTags;?>;
    $().ready(function(){
        //console.log(initialTags);
        //ADD JQUERY UI TO ENABLE AUTOCOMPLETE!!
        $('#demo2').tagEditor({
            autocomplete: {
                delay: 0, // show suggestions immediately
                position: { collision: 'flip' }, // automatic menu position up/down
                source: allTags
            },
            onChange :function (field, editor, tags){
                console.log(field, editor, tags); 
            },
            initialTags: initialTags,
            forceLowercase: false,
            placeholder: 'Cuvinte cheie ale stirii'
        });
        jQuery('#datetimepicker').datetimepicker();
        CKEDITOR.replace( 'ArticleShort' );
        CKEDITOR.replace( 'ArticleLong' );
        admin.article.initialize();
    });
</script>