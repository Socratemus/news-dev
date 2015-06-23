<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <div class="widget-header">
        <div class="widget-title">
         <h2>Adauga o categorie noua</h2>
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        
        <div class="row">
            
            <div class="col-xs-6">
                <label>Titlu Categorie</label>
                <input type='text' class="form-control" value="<?php echo set_value('Title')?>" name='Title' placeholder="Titlul articolului">
                
                <?php echo form_error('Title', '<small class="col-xs-12 error extended"><em>', '</em></small>'); ?>
                                
            </div>
            
            <div class="col-xs-6">
                <label>Slug</label>
                <input type='text' class="form-control" value="<?php echo set_value('Slug')?>" name='Slug' placeholder="Titlul articolului">
                <?php echo form_error('Slug', '<small class="col-xs-12 extended"><em>', '</em></small>'); ?>
            </div>
            
        </div>
        
        <hr />
        
        <div class="row mt15">
            
            <div class="col-xs-2">
                <label>In meniul principal</label> <br />
                
                <input type='checkbox' class="" <?php echo set_value('PrMenu') ? 'checked' : ''; ?> name='PrMenu' value="1" placeholder="Titlul articolului">
            </div>
            
            <div class="col-xs-2">
                <label>In meniul secundar</label> <br />
                
                <input type='checkbox' class="" <?php echo set_value('ScMenu') ? 'checked' : ''; ?> name='ScMenu' value="1" placeholder="Titlul articolului">
            </div>
            
            <div class="col-xs-2">
                <label>Front page Top</label> <br />
                <input type='checkbox' class="" <?php echo set_value('Fpt') ? 'checked' : ''; ?> name='Fpt' value="1" placeholder="Titlul articolului">
            </div>
            
            <div class="col-xs-2">
                <label>Front page Bottom</label> <br />
                <input type='checkbox' class="" <?php echo set_value('Fpb') ? 'checked' : ''; ?> name='Fpb' value="1" placeholder="Titlul articolului">
            </div>
            
            <div class="col-xs-2">
                <label>Activ</label> <br />
                <input type='checkbox' class="" <?php echo set_value('Status') ? 'checked' : ''; ?> value="1" name='Status' placeholder="Titlul articolului">
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