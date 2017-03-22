<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:20px;margin-left:210px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('admin/groups/create');?>" class="btn btn-primary">Create group</a>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h5><b>Groups</b></h5>

            </div>
            <div class="panel-body">
                <div class="col-lg-12" style="margin-top: 10px;">
                    <?php
                    if(!empty($groups))
                    {
                        echo '<table class="table table-hover table-bordered table-condensed">';
                        echo '<tr><td>ID</td><td>Group name</td></td><td>Group description</td><td>Operations</td></tr>';
                        foreach($groups as $group)
                        {
                            echo '<tr>';
                            echo '<td>'.$group->id.'</td><td>'.anchor('admin/users/index/'.$group->id, $group->name).'</td><td>'.$group->description.'</td><td>'.anchor('admin/groups/edit/'.$group->id,'<span class="glyphicon glyphicon-pencil"></span>');
                            if(!in_array($group->name, array('admin','members'))) echo ' '.anchor('admin/groups/delete/'.$group->id,'<span class="glyphicon glyphicon-remove"></span>');
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                    ?>
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</div>