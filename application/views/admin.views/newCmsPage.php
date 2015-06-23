<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <div class="widget-header">
        <div class="widget-title">
            <h2>Adauga o pagina noua</h2>
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        
        <div class="row">
             <div class="col-xs-6">
                 <label>Numele paginii</label>
                 <input type="text" name="Title" value="<?php echo set_value('Title')?>" class="form-control"/>
                 <?php echo form_error('Title', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
             </div>
             <div class="col-xs-6">
                 <label>Slug</label>
                 <input type="text" name="Slug" value="<?php echo set_value('Slug')?>" class="form-control"/>
                 <?php echo form_error('Slug', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
             </div>
        </div>
        <div class="row">
             <div class="col-xs-6">
                 <label>Status pagina</label>
                 <select class="form-control" name="Status">
                     <option value="99" selected>Disabled</option>
                     <option value="1">Activ</option>
                 </select>
             </div>
        </div>
        
        <div class="row mt15">
            <div class="col-xs-12">
                <textarea name="Content" id="ckedt"><?php echo set_value('Content')?></textarea>
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