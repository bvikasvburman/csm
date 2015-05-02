<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Other Details</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-tools">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#address_data_t" data-toggle="tab">Address</a></li>
                                <li><a href="#person_data_t" data-toggle="tab">Person</a></li>
                            </ul>
                        </div><!-- nav-tabs-custom -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="address_data_t">
                                <div>
                                    <a class="btn btn-sm btn-danger" id="delete_rows_t2" href="{{url('company/deleteOtherAdd')}}">
                                        <i class="fa fa-trash-o"></i>
                                    Delete
                                    </a>
                                    
                                </div>    
                                <div style="margin-top: 10px;" class="clearfix"></div>
                                <div id="address_tab"></div>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="person_data_t">
                                <div class="row">
                                    <div class="col-lg-7">
                                <div>
                                    <a class="btn btn-sm btn-danger" id="delete_rows_t" href="{{url('company/deletePerson')}}">
                                        <i class="fa fa-trash-o"></i>
                                        Delete
                                    </a>
                                    <br/>
                                </div>
                                <div style="margin-top: 10px;" class="clearfix"></div>
                                <div id="person_tab">
                                    
                                </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div id="person_commu_tab">

                                        </div>
                                    </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                        </div>
                    </div>

                </div>


            </div>
        </div><!-- /.box -->

    </div>
</div>

<script>
    var is_logged = '<?php echo (Auth::check()) ? 1 : 0 ?>';
    var comp_id="<?php echo $data['company']['content']['comp_id'];?>"
    var comp_no="<?php echo $data['company']['content']['comp_no'];?>";
    var person_ref_no="";
</script>

<script type="text/template" id="commu_tab_template1">
    <tr data-id='new'>
        <td></td>
        <td>
                    <?php
                    $addType = array('1'=> 'Delivery','2'=>'Invoice');
                    ?>
            <select class="form-control" name="add_type_new" id="add_type_new">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($addType as $key => $type_r)
                                                    {
                                                ?>
                                                <option value="<?php echo $key;?>"><?php echo $type_r;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="add_postal_new" id="add_postal_new" value="" />
        </td>
        <td>
            <input type="text" class="form-control" name="add_city_new" id="add_city_new" value="" />

        </td>
        <td>
            <input type="text" class="form-control" name="add_country_new" id="add_country_new" value="" />

        </td>
        <td>
            <input type="text" class="form-control" name="add_street_new" id="add_street_new" value="" />

        </td>
        <td>
            <a class="btn btn-info save_other_add" data-id="new" >Save</a>
        </td>
    </tr>
</script>
    
<script type="text/template" id="commu_tab_template2">
    <tr data-id='new'>
        <td></td>
        <td>
            <input type="text" class="form-control" name="add_surname_new" id="add_surname_new" value="" />

        </td>
        <td>
            <input type="text" class="form-control" name="add_name_new" id="add_name_new" value="" />
        </td>
        <td>
            <input type="text" class="form-control" name="add_title_new" id="add_title_new" value="" />

        </td>
        <td>
            <input type="text" class="form-control" name="add_position_new" id="add_position_new" value="" />
        </td>
        <td>
            <a class="btn btn-info save_person" data-id="new" >Save</a>
        </td>
    </tr>
</script>

<script type="text/template" id="commu_tab_template3">
    <tr data-id='new'>
        <td></td>
        <td>
            <input type="text" class="form-control" name="commu_type_new" id="commu_type_new" value="" />

        </td>
        <td>
            <input type="text" class="form-control" name="commu_value_new" id="commu_value_new" value="" />
        </td>
        <td>
            <a class="btn btn-info save_person_commu" data-id="new" >Save</a>
        </td>
    </tr>
</script>

