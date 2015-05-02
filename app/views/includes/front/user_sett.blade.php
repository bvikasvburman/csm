<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span><?php
                echo Auth::user()->username;
                ?> <i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-light-blue">
            <img src="{{ ViewsHelper::img('avatar3.png') }}" class="img-circle" alt="User Image" />
            <p>
                <?php
                echo Auth::user()->username;
                ?>
                <small>{{trans('common.member_since')}} <?php
                echo CommonHelper::timestampToDate(Auth::user()->created_at);
                ?></small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <!--div class="col-xs-4 text-center">
                <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
            </div-->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
<!--                <a href="#" class="btn btn-default btn-flat">Profile</a>-->
            </div>
            <div class="pull-right">
                <a href="{{url('logout')}}" class="btn btn-default btn-flat">{{trans('common.signout')}}</a>
            </div>
        </li>
    </ul>
</li>