
<table class="table table-stripped table-bordered commu_table2">
    <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="checkallitem_t"></th>
            <th style="text-align: center;">
                {{trans('company.name')}}
            </th>
            <th style="text-align: center;">
                {{trans('company.first_name')}}
            </th>
            <th style="text-align: center;">
                {{trans('company.title')}}
            </th>
            <th style="text-align: center;">
                {{trans('company.position')}}
            </th>
            <th style="text-align: center;">
                <a class="btn btn-xs btn-success add_person_d">
                    <i class="fa fa-plus"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!($content->isEmpty()))
            foreach ($content as $other_add)
            {
        ?>
        <tr data-id='<?php echo $other_add->id; ?>'>
            <td><input name="selected[]" class="actionsid_t square-blue" value="<?php echo $other_add->id; ?>" type="checkbox"></td>
            <td>
                <input type="text" class="form-control" name="add_surname_<?php echo $other_add->id; ?>" id="add_surname_<?php echo $other_add->id; ?>" value="<?php echo $other_add->surname;?>" />
                
            </td>
            <td>
                <input type="text" class="form-control" name="add_name_<?php echo $other_add->id; ?>" id="add_name_<?php echo $other_add->id; ?>" value="<?php echo $other_add->firstname;?>" />
            </td>
            <td>
                <input type="text" class="form-control" name="add_title_<?php echo $other_add->id; ?>" id="add_title_<?php echo $other_add->id; ?>" value="<?php echo $other_add->title;?>" />
                
            </td>
            <td>
                <input type="text" class="form-control" name="add_position_<?php echo $other_add->id; ?>" id="add_position_<?php echo $other_add->id; ?>" value="<?php echo $other_add->position;?>" />
            </td>
            <td>
                <a class="btn btn-warning get_person_commu btn-xs" data-id="<?php echo $other_add->personno; ?>" >{{trans('common.more')}}</a>
                <a class="btn btn-info save_person btn-xs" data-id="<?php echo $other_add->id; ?>" > {{trans('common.save')}}</a>
            </td>
            
        </tr>
        <?php
            }
        ?>
    </tbody>
    <tfooter>
        {{$content->links()}}
    </tfooter>
</table>