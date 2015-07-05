<form method="POST" action="" enctype="multipart/form-data" class="widget col-md-8 extended">
    
    <!--<pre><?php //echo validation_errors(); ?></pre>-->
    <div class="widget-header">
        <div class="widget-title">
         <h2>Seteaza mesajul zilei </h2>
    
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    
    <div class="widget-body">
        
        <label></label>
        <textarea class="form-control" name="motd" rows=5><?php echo $current[0]?></textarea>
        
        <button class="btn btn-primary mt5 pull-right">Salveaza</button>
        <div class="clearfix"></div>
    </div>
</form>

<div class="widget col-md-8 extended">
    <div class="widget-header">
        <div class="widget-title">
         <h2>Timeline </h2>
    
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    
    <div class="widget-body">
        <div class="timeline col-md-12">
            
            <?php foreach($all as $date =>$motd) :?>
                
                <section class="motd">
                    <h4 style="color : #000"><?php echo $date?></h4>
                    <span><i class="fa fa-pencil" data-original-title="" title=""></i></span>
                    <div class="motd-content-wp">
                        <div class="moth-conteont-inner">
                        <?php echo $motd[0] ?>
                        </div>
                    </div>
                </section>
            
            <?php endforeach; ?>
            
        </div>
        <div class="clearfix"></div>
    </div>
    
</div>