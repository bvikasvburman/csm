@extends('layouts.front')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box add_new_comp">
            <div class="box-header">
                <h3 class="box-title">Company details</h3>
            </div>

            <!-- form start -->

            <div class="box-body">
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class="form-group">
                            <label for="com_no">Company Number</label>
                            <input type="text" class="form-control" readonly="readonly" id="com_no" name="com_no" value="<?php echo $data['company']['content']['comp_no'];?>">
                        </div>
                        <div class="form-group">
                            <label for="com_name">Company Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="com_name" name="com_name" value="<?php echo $data['company']['content']['comp_name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="com_type">Company Type</label>
                            <?php
                            $type = $data['company']['content']['comp_type'];
                            $comp_type = array('Own Company', "Customer","Supplier");
                            ?>
                            <input class="form-control" value="<?php echo $comp_type[$type];?>" readonly="readonly">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-lg-6'>
                        <div class="form-group">
                            <h4 ><u>Main Address</u></h4>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <label for="add_street">Street No/Name</label>
                                    <input type="text" placeholder="Street name/number" class="form-control" id="add_street" name="add_street" readonly="readonly" value="<?php if(isset($data['company']['content']['add_street'])) echo $data['company']['content']['add_street'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class='col-lg-6'>
                                    <label for="add_postal">Postal Code</label>
                                    <input readonly="readonly" type="text" placeholder="Postal Code" class="form-control" id="add_postal" name="add_postal" value="<?php  if(isset($data['company']['content']['add_postal'])) echo  $data['company']['content']['add_postal'];?>">
                                </div>
                                <div class='col-lg-6'>
                                    <label for="add_city">City</label>
                                    <input type="text" readonly="readonly" placeholder="City name" class="form-control" id="add_city" name="add_city" value="<?php if(isset($data['company']['content']['add_city'])) echo $data['company']['content']['add_city'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <label for="add_country">Country</label>
                                    <input type="text" placeholder="Country Code" readonly="readonly" class="form-control" id="add_country" name="add_country" value="<?php if(isset($data['company']['content']['add_country'])) echo $data['company']['content']['add_country'];?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class='col-lg-6'>
                        <div class="form-group">
                            <h4 >&nbsp;</h4>
                            <label for="main_add">Communication</label>
                            <table class="table table-stripped table-bordered commu_table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">
                                            Type
                                        </th>
                                        <th style="text-align: center;">
                                            Value
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data['company']['content']['commu']))
                                    foreach ($data['company']['content']['commu'] as $dd)
                                    {
                                    ?>
                                    <tr>
                                    <td>
                                        <?php
                                        echo $dd['type'];?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $dd['value'];?>
                                    </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <a href="{{url('/company/index')}}" class="btn btn-warning">Back</a>
            </div>


        </div>
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
                                <li><a href="#person_commu_tt" data-toggle="tab">Person Communication</a></li>
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
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="person_commu_tt">
                                <div>
                                    <a class="btn btn-sm btn-danger" id="delete_rows_t3" href="{{url('company/deletePersonCommu')}}">
                                        <i class="fa fa-trash-o"></i>
                                        Delete
                                    </a>
                                    <br/>
                                </div>
                                <div style="margin-top: 10px;" class="clearfix"></div>
                                <div id="person_commu_tab">
                                    
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
@stop
