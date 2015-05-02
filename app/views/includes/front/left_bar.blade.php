<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ ViewsHelper::img('avatar3.png') }}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>{{trans('common.hello')}}, <?php
                echo Auth::user()->username;
                ?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> {{trans('common.online')}}</a>
        </div>
    </div>
    <!-- search form -->
    <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="active">
            <a href="{{url('/')}}">
                <i class="fa fa-dashboard"></i> <span>{{trans('common.dashboard')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('company/index')}}">
                <i class="fa fa-file"></i> <span>{{trans('common.company_details')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('logout')}}">
                <i class="fa fa-sign-out"></i> <span>{{trans('common.logout')}}</span>
            </a>
        </li>
    </ul>
</section>