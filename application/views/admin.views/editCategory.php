<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <input type="hidden" value="<?php echo $category->getCategoryId();?>" name="CategoryId">
    
    <div class="widget-header">
        <div class="widget-title">
         <h2>Editeaza categorie - <?php echo $category->getTitle();?></h2>
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        <?php //var_dump($category);?>
        <div class="row">
            
            <div class="col-xs-6">
                <label>Titlu Categorie</label>
                <?php $titleValue = set_value('Title')?>
                <input type='text' class="form-control" value="<?php echo $titleValue ? $titleValue : $category->getTitle();?>" name='Title' placeholder="Titlul articolului">
                
                <?php echo form_error('Title', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
                                
            </div>
            
            <div class="col-xs-6">
                <label>Slug</label>
                <?php $slugValue = set_value('Slug')?>
                <input type='text' class="form-control" value="<?php echo $slugValue ? $slugValue : $category->getSlug();?>" name='Slug' placeholder="Titlul articolului">
                <?php echo form_error('Slug', '<small class="col-xs-12 extended"><em>', '</em></small>'); ?>
            </div>
            
        </div>
        
        <hr />
        
        <div class="row mt15">
            
            <div class="col-xs-2">
                <label>In meniul principal</label> <br />
                <?php $menuValue = set_value('PrMenu');?>
                <input type='checkbox' class="" <?php echo $menuValue || $category->getPrMenu() ? 'checked' : ''; ?> name='PrMenu' value="1" placeholder="">
            </div>
            <div class="col-xs-2">
                <label>In meniul secundar</label> <br />
                <?php $menuValue = set_value('ScMenu');?>
                <input type='checkbox' class="" <?php echo $menuValue || $category->getScMenu() ? 'checked' : ''; ?> name='ScMenu' value="1" placeholder="">
            </div>
            
            <div class="col-xs-2">
                <label>Front page Top</label> <br />
                <?php $fptValue = set_value('Fpt');?>
                <input type='checkbox' class="" <?php echo $fptValue || $category->getFpt() ? 'checked' : ''; ?> name='Fpt' value="1" placeholder="">
            </div>
            
            <div class="col-xs-2">
                <label>Front page Bottom</label> <br />
                <?php $fpbValue = set_value('Fpb');?>
                <input type='checkbox' class="" <?php echo $fpbValue || $category->getFpb() ? 'checked' : ''; ?> name='Fpb' value="1" placeholder="">
            </div>
            
            <div class="col-xs-2">
                <label>Activ</label> <br />
                <?php $statusValue = set_value('Status');?>
                <input type='checkbox' class="" <?php echo $statusValue || $category->getStatus() ?  'checked' : ''; ?> value="1" name='Status' placeholder="">
            </div>
            
        </div>
        
        <hr />
        
        <div class="row mt30">
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary">
            </div>
        </div>
        
    </div>
    
</form>