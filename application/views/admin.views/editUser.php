<form method="POST" action="" enctype="multipart/form-data" class="widget">
    <input type="hidden" name="Access" value="2" />
    <!--<pre><?php //echo validation_errors(); ?></pre>-->
    <div class="widget-header">
        <div class="widget-title">
         <h2>Adauga utilizator </h2>
    
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    
    <div class="widget-body">
        
        <hr />
        <div class="col-md-3">
            <div class="col-md-12">
                <?php if($user->getCover()) : ?>
                    <img width="100%" src="<?php echo $user->getCover()->getMedium();?>" alt="" />
                <?php else : ?>
                    <img width="100%" src="http://iamsrinu.com/bluemoon-admin-theme7/img/profile.png" alt="" />
                <?php endif;?>
                
            </div>
            <div class="col-md-12">
                <label>Adauga poza profil.</label>
                <input type="file" name="Cover" />
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <label>Nume</label>
                    
                    <input type="text" name="Firstname" value="<?php echo $user->getFirstname();?>" class="form-control" placeholder="Firstname"/>
                </div>
                <div class="col-md-12">
                    <label>Prenume</label>
                    <input type="text" name="Lastname" class="form-control" value="<?php echo $user->getLastname();?>" placeholder="Lastname"/>
                </div>
            
                <div class="col-md-12">
                    <label>Username</label>
                    <input type="text" name="Username" class="form-control" value="<?php echo $user->getUsername();?>" placeholder="Username"/>
                </div>
                <div class="col-md-12">
                    <label>Parola</label>
                    <input type="password" name="RealPassword" class="form-control"/>
                </div>
                
                <div class="col-md-12">
                    <label>Quota</label>
                    <textarea name="Quota" class="form-control"><?php echo $user->getQuota();?></textarea>
                </div>
            </div>
            <hr />
            <div class="row mt15">
                <div class="col-md-6">
                    <button class="btn btn-primary">Salveaza</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>