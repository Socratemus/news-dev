<div class="col-md-12 extended widget">
    
    <div class="widget-header">
        <div class="widget-title">
         <h2>Categorii</h2>
          <!--<span class="mini-title">-->
          <!--  Simple, beautiful wysiwyg editors-->
          <!--</span>-->
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
                    <th style="width:40%">
                        Name
                    </th>
                    <th style="width:20%" class="hidden-xs">
                        Slug
                    </th>
                    <th style="width:10%" class="hidden-xs">
                        Status
                    </th>
                    <th style="width:15%" class="hidden-xs">
                        Date
                    </th>
                    <th style="width:10%" class="hidden-xs">
                        Actiuni
                    </th>
                </tr>
            </thead>
            <tbody>
<?php foreach($categories as $category ) : ?>                
                <tr>
                  <td>
                    <input type="checkbox" class="no-margin">
                  </td>
                  <td>
                    <span class="name">
                      <?php echo $category->getTitle(); ?>
                    </span>
                  </td>
                  <td>
                    <?php echo $category->getSlug(); ?>
                  </td>
                  <td>
                     <?php if($category->getStatus() == 1) : ?>
                         <span class="label label-success">
                          Activ
                     <?php else : ?>
                         <span class="label label-warning">
                          Disabled
                     <?php endif; ?>
                    
                    </span>
                  </td>
                  <td>
                    <?php echo $category->getCreated()->format('Y-m-d H:i:s')?>
                  </td>
                  <td class="hidden-xs">
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                        Action 
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="<?php echo site_url('/admin/editCategory?id=' . $category->getCategoryId());?>" data-original-title="" title="">Edit</a>
                        </li>
                        <li>
                          <a href="<?php echo site_url('/admin/removeCategory?id=' . $category->getCategoryId());?>" data-original-title="" title="">Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
<?php endforeach ?>                
            </tbody>
        </table>
    </div>
    
</div>