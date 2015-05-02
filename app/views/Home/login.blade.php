@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-lg-6 wrap-center">
        <div class="row-fluid">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title primary-headline"><i class="fa fa-lock fa-2x"></i> {{trans('common.login')}} <small> {{trans('common.enter_details')}}...</small></h3>
                </div>
                <div class="box-body">
                    <!-- PAGE HEADER -->
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open(array('url' => 'login','class' => 'form-horizontal')) }}
			        <div class="row-fluid">
                                    <div class="form-group col-lg-12">
                                        @if($errors->any())
                                        <div class="alert alert-danger" id="rep_mess_w">
                                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user color-grey"></i></span>
                                                    {{ Form::text('username', '', array('placeholder' => trans('common.username') , 'class' => 'form-control input-lg')) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key color-grey"></i></span>
                                                    {{ Form::password('epassword', array('placeholder' => trans('common.password'),'class' => 'form-control input-lg')) }}
                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                
                                                {{ Form::submit(trans('common.login'), array('class' => 'btn btn-primary btn-lg')) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	
</div>

@stop