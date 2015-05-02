<script>
    var HTTP_PATH = "{{url('/')}}/";
    <?php
    if(Auth::check())
    {
    ?>
    var USER_PATH = "{{url('userdata/'.Auth::user()->id_user.'/')}}";
    <?php
    }
    ?>
    var JS_PATH = "{{url('js')}}/";
    var IMG_PATH = "{{url('img')}}/";
    var ICONS_PATH = "{{url('img/icons')}}/";
</script>