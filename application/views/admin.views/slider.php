<div class="row mt15">
    <form class="col-xs-12 mb15" method="POST" action="" enctype="multipart/form-data">
        <div class="widget-header">
            <div class="widget-title">
                <h2>Adauga slider</h2>
            </div>
            <span class="tools">
              <i class="fa fa-cogs"></i>
            </span>
        </div>
        <div class="widget-body">
            <div class="col-md-4 mt10">
                <label>Titlu</label>
                <input type="text" name="Title" placeholder="" class="form-control">
            </div>
            <div class="col-md-4 mt10">
                <label>Link</label>
                <input type="text" name="Url" placeholder="" class="form-control">
            </div>
            <div class="col-md-4 mt10">
                <label>Imagine</label>
                <input type="file" name="SliderPhoto" class="form-control">
            </div>
            <div class="col-md-12 mt10">
                <textarea id="Content" name="Content"></textarea>
            </div>
            
            <div class="col-md-6 mt10">
                <select class="form-control" name="Status">
                    <option value="99">Inactiv</option>
                    <option value="1">Activ</option>
                </select>
            </div>
            <div class="col-md-6 mt10 text-right">
                <button class="btn btn-success">Salveaza</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
    <?php foreach($slides as $slide) :?>
    
        <form class="col-xs-6 mb15"  method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="SlideId" value="<?php echo $slide->getSlideId();?>">
            <div class="widget-header">
                <div class="widget-title">
                    <h2>Edit slider</h2>
                </div>
                <span class="tools">
                  <i class="fa fa-cogs"></i>
                </span>
            </div>
            <div class="widget-body">
                <div class="col-xs-12 extended">
                    <div class="col-xs-6">
                        <img class="img100" src="<?php echo $slide->getImage()->getMedium();?>" />
                    </div>
                    
                    <div class="col-xs-6">
                        <label>Imagine</label>
                        <input type="file" name="SliderPhoto">
                    </div>    
                </div>
                
                
                <div class="col-xs-6 mt10">
                    <label>Titlu</label>
                    <input type="text" name="Title" placeholder="" value="<?php echo $slide->getTitle();?>" class="form-control">
                </div>
                <div class="col-xs-6 mt10">
                    <label>Link</label>
                    <input type="text" name="Url" placeholder="" value="<?php echo $slide->getUrl();?>" class="form-control">
                </div>
                <div class="col-xs-12 mt10">
                    <textarea id="Content<?php echo $slide->getSlideId()?>" name="Content"><?php echo $slide->getContent();?></textarea>
                </div>
                
                <div class="col-xs-6 mt10">
                    <select class="form-control" name="Status">
                        <option <?php echo  $slide->getStatus() == 99 ? 'selected' : '';?> value="99">Inactiv</option>
                        <option <?php echo  $slide->getStatus() == 1 ? 'selected' : '';?> value="1">Activ</option>
                    </select>
                </div>
                <div class="col-xs-6 mt10 text-right">
                    <button class="btn btn-success">Salveaza</button>
                    <button class="btn btn-danger">Sterge</button>
                </div>
                
                <div class="clearfix"></div>
            </div>
            
        </form>
    
    <?php endforeach;?>
    
</div>

<script type="text/javascript">
var ids = [];
<?php foreach($slides as $slide) : ?>
    ids.push(<?php echo $slide->getSlideId(); ?>);
<?php endforeach;?>

    $().ready(function(){
        $(ids).each(function(index , value){
            CKEDITOR.replace( 'Content' + value );    
        });
        CKEDITOR.replace( 'Content' );
        
    })
</script>