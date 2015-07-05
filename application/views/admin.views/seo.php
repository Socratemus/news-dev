<form method="POST" action="" enctype="multipart/form-data" class="widget">
   
    <!--<pre><?php //echo validation_errors(); ?></pre>-->
    <div class="widget-header">
        <div class="widget-title">
         <h2>Setari search engine</h2>
          
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        
        <div class="row">
            <div class="col-xs-12">
                <label>Meta Title</label>
                <input type="text" name="title" value="<?php echo $data['title']?>" class="form-control">
            </div>
            <div class="col-xs-12">
                <label>Meta Description</label>
                <textarea class="form-control" name="description" rows="4"><?php echo $data['description']?></textarea>
            </div>
            <div class="col-xs-12">
                <label>Meta Keywords</label>
                <input type="text" name="keywords" value="<?php echo $data['keywords']?>" class="form-control">
            </div>
            <div class="col-xs-12">
                 <label>News Keywords</label>
                <input type="text" name="news_keywords" value="<?php echo $data['news_keywords']?>" class="form-control">
            </div>
            <div class="col-xs-12">
                <label>Meta Publisher</label>
                <input type="text" name="publisher" value="<?php echo $data['publisher']?>" class="form-control">
            </div>
        </div>
        
        <div class="row mt15">
            <div class="col-xs-12">
                <button class="btn btn-success pull-right">Save</button>
            </div>
        </div>
        
    </div>
    
</form>