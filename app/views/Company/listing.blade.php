<div class="box-body">
    <table class="table table-bordered">
        <tbody><tr>
                <th style="width: 10px"><input type="checkbox" id="checkallitem_t"></th>
                <th>{{trans('company.company_number')}}</th>
                <th>{{trans('company.name')}}</th>
                <th>{{trans('company.type')}}</th>
                <th>{{trans('company.city')}}</th>
                <th style="width: 40px">{{trans('common.action')}}</th>
            </tr>
            <?php
            
            if(!empty($data))
            {
            foreach ($data as $datas)
            {
            ?>
            <tr>
                <td><input name="selected[]" class="actionsid_t square-blue" value="<?php echo $datas->id; ?>" type="checkbox"></td>
                <td><?php echo $datas->companyno;?></td>
                <td><?php echo $datas->companyname;?></td>
                <td><?php 
                $type_arr = array('Own','Customer',"Supplier");
                if(isset($type_arr[$datas->businesstype])) echo $type_arr[$datas->businesstype];?></td>
                <td><?php 
                    $city_s =  ($datas->company_city($datas->companyno));
                    echo($city_s['city']);
                ?></td>
                
                <td>
                    
                    <a class="btn btn-xs btn-warning" href="<?php echo url('company/more/'.$datas->id);?>">
                        <i class="fa fa-plus"></i> {{trans('common.more')}}
                    </a>
                    <!--
                    <a class="btn btn-xs btn-primary edit_comp_data" data-url= "<?php echo url('company/more/'.$datas->id);?>" data-id="<?php echo $datas->id;?>">
                        <i class="fa fa-edit"></i> {{trans('common.edit')}}
                    </a>
                    -->
                    
                    <a class="btn btn-xs btn-primary more_vic_data" data-url= "{{ URL::to('company/vic/data') }}" data-id="{{ $datas->id }}" >
                        <i class="fa fa-edit"></i> {{trans('common.edit')}}
                    </a>
                        
                </td>
            </tr>
            <?php
            }
            }else
            {
            ?>
            <tr>
                <td colspan="10" class="text-center">
                    <span class="badge bg-blue">{{trans('common.no_record_found')}}</span>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody></table>
</div><!-- /.box-body -->
<div class="box-footer clearfix">
    {{ $data->links() }}
    
</div>