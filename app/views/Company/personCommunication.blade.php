<div>
    <a class="btn btn-sm btn-danger" disabled="disabled" id="delete_rows_t3" href="{{url('company/deletePersonCommu')}}">
        <i class="fa fa-trash-o"></i>
        Delete
    </a>
    <br/>
</div>
<div style="margin-top: 10px;" class="clearfix"></div>
<table class="table table-stripped table-bordered commu_table3">
    <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="checkallitem_t3"></th>
            <th style="text-align: center;">
                {{trans('company.type')}}
            </th>
            <th style="text-align: center;">
                {{trans('company.value')}}
            </th>
            <th style="text-align: center;">
                <a class="btn btn-xs btn-success person_commu_d">
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
            <td><input name="selected[]" class="actionsid_t3 square-blue" value="<?php echo $other_add->id; ?>" type="checkbox"></td>
            <td>
                <input type="text" class="form-control" name="commu_type_<?php echo $other_add->id; ?>" id="commu_type_<?php echo $other_add->id; ?>" value="<?php echo $other_add->type;?>" />
            </td>
            <td>
                <input type="text" class="form-control" name="commu_value_<?php echo $other_add->id; ?>" id="commu_value_<?php echo $other_add->id; ?>" value="<?php echo $other_add->data;?>" />
            </td>
            <td>
                <a class="btn btn-info save_person_commu" data-id="<?php echo $other_add->id; ?>"> {{trans('common.save')}}</a>
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