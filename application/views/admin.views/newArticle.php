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
    <div class="widget-header">
        <div class="widget-title">
         <h2>Adauga articol nou</h2>
          <!--<span class="mini-title">-->
          <!--  Simple, beautiful wysiwyg editors-->
          <!--</span>-->
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        <div class="col-md-6 extended">
            
            <div class="row ">
                <div class="col-xs-12">
                    <label>Titlu Articol</label>
                    <input type='text' class="form-control" name='Title' placeholder="Titlul articolului">
                </div>
            </div>
            
            <hr />
        
            <div class="row ">
                <div class="col-xs-6">
                    <label>Slug</label>
                    <input type='text' class="form-control" name='Slug' placeholder="Titlul din url al articolului">
                </div>
                <div class="col-xs-6">
                    <label>Publicat la data</label>
                
                    <input id="datetimepicker" name="PubDate" type="text" class="form-control" >
                </div>
            </div>
            
            <hr />
            
            <div class="row ">
                <div class="col-xs-6">
                    <label>Categorie</label>
                
                    <select class="form-control" name="CategoryId">
                        <option value="">Selecteaza categoria</option>
                        <?php foreach($categories as $category) :?>
                        <option value="<?php echo $category->getCategoryId();?>" ><?php echo $category->getTitle();?></option>
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
                
                     <input type="text" id="demo2" />
                </div>
            </div>
            
        </div>
        
        <div class="col-xs-6">
            <label>Imagine stire</label>
            <input type="file" name="Cover" class="form-control" />
            
            <div class="col-xs-12 extended articol-cover-wp">
                
                <img src="<?php echo base_url('public/img/default-article.png')?>" alt="Imaginea Articolului" />
                
            </div>
            
        </div>
        
        <div class="clearfix"></div>
        <hr />
    
        <div class="row ">
            <div class="col-xs-12">
                <label>Descriere scurta</label>
            </div>
            <div class="col-xs-12">
                <textarea name="ShortDescription" id="ArticleShort" rows=2></textarea>
            </div>
            
        </div>
    
        <div class="row ">
            <div class="col-xs-12">
                <label>Descriere lunga</label>
            </div>
            <div class="col-xs-12">
                <textarea name="LongDescription" id="ArticleLong" rows=2></textarea>
            </div>
            
        </div>
        
        <div class="row mt30">
            <div class="col-xs-12">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </div>
        
    </div>
    
</form>





<script type="text/javascript">
    $().ready(function(){
        //ADD JQUERY UI TO ENABLE AUTOCOMPLETE!!
        $('#demo2').tagEditor({
            autocomplete: {
                delay: 0, // show suggestions immediately
                position: { collision: 'flip' }, // automatic menu position up/down
                source: ['ActionScript', 'AppleScript', 'Asp','Python', 'Ruby']
            },
            forceLowercase: false,
            placeholder: 'Cuvinte cheie ale stirii'
        });
        jQuery('#datetimepicker').datetimepicker();
        CKEDITOR.replace( 'ArticleShort' );
        CKEDITOR.replace( 'ArticleLong' );
        admin.article.initialize();
    });
</script>