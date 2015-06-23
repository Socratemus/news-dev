<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <div class="widget-header">
        <div class="widget-title">
            <h2>Editare pagina statica - <?php echo $page->getTitle();?></h2>
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        
        <div class="row">
             <div class="col-xs-6">
                 <label>Numele paginii</label>
                 <?php $titleVal = set_value('Title') ?>
                 <input type="text" name="Title" value="<?php echo $titleVal ? $titleVal : $page->getTitle();?>" class="form-control"/>
                 <?php echo form_error('Title', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
             </div>
             <div class="col-xs-6">
                 <label>Slug</label>
                 <?php $slugVal = set_value('Slug') ?>
                 <input type="text" name="Slug" value="<?php echo $slugVal ? $slugVal : $page->getSlug();?>" class="form-control"/>
                 <?php echo form_error('Slug', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
             </div>
        </div>
        <div class="row">
             <div class="col-xs-6">
                 <label>Status pagina</label>
                 <?php $statusVal = set_value('Slug'); $compare = null; ?>
                 <?php 
                    if(!empty($statusVal)) {
                        $compare = $statusVal;
                    } else {
                        $compare = $page->getStatus();
                    }
                 ?>
                 <select class="form-control" name="Status">
                     <option <?php echo $compare == 99 ? 'selected' : '';?> value="99" selected>Disabled</option>
                     <option <?php echo $compare == 1 ? 'selected' : '';?> value="1">Activ</option>
                 </select>
             </div>
        </div>
        
        <div class="row mt15">
            <div class="col-xs-12">
                <?php $contentValue = set_value('Content');?>
                <textarea name="Content" id="ckedt"><?php echo $contentValue ? $contentValue: $page->getContent();?></textarea>
                <?php echo form_error('Content', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
            </div>
        </div>
        
        <div class="row mt15">
            <div class="col-xs-6">
                <button class="btn btn-primary">Salveaza</button>
            </div>
        </div>
        
    </div>
    
</form>

<script type="text/javascript">
    $().ready(function(){
        CKEDITOR.replace( 'ckedt' );        
    });
</script>