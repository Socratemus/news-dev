<div class="row header">
    
    <div class="col-xs-2">
        <h3 class="mt5 mb5">Administrare</h3>
    </div>
    
    <div class="col-xs-10">
        <ul class="pull-right">
            
            
            <li>
                <?php $identity = $this->user_model->getIdentity();?>
                Bine ai venit , <?php echo ucwords($identity->getFirstName()) . ' ' .  ucwords($identity->getLastName());  ?>
                <a href="<?php echo site_url('auth/logout')?>">Log out</a>
            </li>
        </ul>
    </div>
    
</div>