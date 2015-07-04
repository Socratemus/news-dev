<div class="col-md-12 extended widget">
    
    <div class="widget-header">
        <div class="widget-title">
         <h2>Utilizatori</h2>
          
        </div>
        <span class="tools">
          <i class="fa fa-cogs"></i>
        </span>
    </div>
    <div class="widget-body">
        <table class="table table-responsive table-striped table-bordered table-hover no-margin">
            <thead>
                <tr>
                    <th style="width:5%">
                        <input type="checkbox" class="no-margin">
                    </th>
                    <th style="width:5%">
                        
                    </th>
                    <th style="width:40%">
                        Name
                    </th>
                    <th style="width:20%" class="hidden-xs">
                        Prenume
                    </th>
                    <th style="width:10%" class="hidden-xs">
                        Acces
                    </th>
                    <th style="width:15%" class="hidden-xs">
                        Created
                    </th>
                    <th style="width:10%" class="hidden-xs">
                        Actiuni
                    </th>
                </tr>
            </thead>
            
            <tbody>
                
<?php   foreach($users as $user ) : ?>                
                
                <tr>
                  <td>
                    <input type="checkbox" class="no-margin">
                  </td>
                  <td>
                    <img src="<?php echo $user->getCover()->getThumb();?>" width="50" alt="profile photo" />
                  </td>
                  <td>
                    <span class="name">
                      <?php echo $user->getFirstname(); ?>
                    </span>
                  </td>
                  
                  <td>
                    <span class="name">
                      <?php echo $user->getLastname(); ?>
                    </span>
                  </td>
                  
                  <td>
                    <span class="name">
                      <?php echo $user->getAccess(); ?>
                    </span>
                  </td>
                  
                  <td>
                    <span class="name">
                      <?php echo $user->getCreated()->format('Y-m-d'); ?>
                    </span>
                  </td>
                  
                  <td>
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                        Action 
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="<?php echo site_url('/admin/editUser?id=' . $user->getUserId());?>" data-original-title="" title="">Edit</a>
                        </li>
                        <li>
                          <a href="<?php echo site_url('/admin/editUser?id=' . $user->getUserId());?>" data-original-title="" title="">Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                  
                </tr>
                
<?php   endforeach; ?>
            </tbody>    
        </table>
        
    </div>