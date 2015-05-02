@extends('layouts.front')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="show_more_data">
        </div>
        <div class="box add_new_comp" style="display: none;">
            <div class="box-header">
                <h3 class="box-title"> {{ trans('company.company_details') }} </h3>
            </div>
            
            <!-- form start -->
            <form role="form" class="cstFrmCont" name="frmAddCom" id="frmAddCom">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class="form-group">
                                <label for="com_no">{{ trans('company.company_number') }} </label>
                                <input type="text" class="form-control" id="com_no" name="com_no">
                            </div>
                            <div class="form-group">
                                <label for="com_name">{{ trans('company.company_name') }} </label>
                                <input type="text" class="form-control" id="com_name" name="com_name" >
                            </div>
                            <div class="form-group">
                                <label for="com_type">{{ trans('company.company_type') }} </label>
                                <select class="form-control" id="com_type" name="com_type" >
                                    <option value="">{{ trans('common.select') }}</option>
                                    <option value="0">Own Company</option>
                                    <option value="1">Customer</option>
                                    <option value="2">Supplier</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <h4 ><u>{{ trans('company.main_address') }}</u></h4>
                                <div class='row'>
                                    <div class='col-lg-12'>
                                        <label for="add_street"> {{ trans('company.street_no_name') }} </label>
                                        <input type="text" placeholder="{{ trans('company.street_no_name') }}" class="form-control" id="add_street" name="add_street" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class='col-lg-6'>
                                        <label for="add_postal"> {{ trans('company.postal_code') }}</label>
                                <input type="text" placeholder="{{ trans('company.postal_code') }}" class="form-control" id="add_postal" name="add_postal" >
                                    </div>
                                    <div class='col-lg-6'>
                                        <label for="add_city">{{ trans('company.company_details') }}</label>
                                        <input type="text" placeholder="{{ trans('company.city_name') }}" class="form-control" id="add_city" name="add_city" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class='row'>
                                    <div class='col-lg-12'>
                                        <label for="add_country">{{ trans('company.country') }} </label>
                                        <input type="text" placeholder="{{ trans('company.country_code') }}" class="form-control" id="add_country" name="add_country" >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <h4 >&nbsp;</h4>
                                <label for="main_add"> {{ trans('company.communication') }} </label>
                                <table class="table table-stripped table-bordered commu_table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{ trans('company.type') }}
                                        </th>
                                        <th>
                                            {{ trans('company.value') }}
                                        </th>
                                        <th>
                                            <a class="btn btn-xs btn-success add_commu">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submitFrm" class="btn btn-primary">{{ trans('common.submit') }} </button>
                    <button type="submit" class="btn btn-warning add_cancel">{{ trans('common.cancel') }} </button>
                </div>
            </form>  

        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('company.company_listing') }}</h3>

                <div class="box-tools">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info add_new_btn" href=#"">
                            <i class="fa fa-plus-square"></i>
                            {{ trans('company.add_new_company') }}
                        </a>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="box-tools">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" value="" class="form-control " placeholder="{{ trans('company.search_by_company_number') }}" name="searchComNo" id="searchComNo"/>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" value="" class="form-control" placeholder="{{ trans('company.search_by_company_name') }}" name="searchComName" id="searchComName"/>
                        </div>
                        <div class="col-lg-4">
                            <input type="button" value="{{ trans('common.search') }}" class="btn btn-primary" name="searchComBtn" id="searchComBtn"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <br/>
                        <div class="col-lg-12">
                            <a class="btn btn-sm btn-danger" id="delete_rows_t" href="{{url('company/companyDelete')}}">
                                <i class="fa fa-trash-o"></i>
                                {{ trans('common.delete') }}
                            </a>
                            
                        </div>
                    </div>
                    
                </div>


            </div>
            <div id='company_listing'>

            </div>
        </div><!-- /.box -->

    </div>
</div>

<div id="modal_view_page" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{ trans('common.close') }}</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var is_logged = '<?php echo (Auth::check()) ? 1 : 0 ?>';
    var comp_id = 0;
    var edit_mode = 0;
    var comp_commu_tab = 0;
</script>

<script type="text/template" id="commu_tab_template">
    <tr>
        <td>
            <input type="text" value="" name="{template_name_1}" id="{template_id_1}" class="form-control commu_inp" placeholder="Enter Type">
        </td>
        <td>
            <input type="text" value="" name="{template_name_2}" id="{template_id_2}" class="form-control commu_inp" placeholder="Enter Type">
            <input type="hidden" value="" class="commu_inp" name="{template_name_3}" id="{template_id_3}">
        </td>
        <td>
            <a class="btn btn-xs btn-warning remove_commu">
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
</script>
@stop
