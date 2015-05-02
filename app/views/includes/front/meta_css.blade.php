<meta charset="UTF-8">
<title><?php echo Config::get('params.site_name');?> | {{trans('common.dashboard')}} </title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" type="text/css" href="{{ ViewsHelper::css('bootstrap.min') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ ViewsHelper::css('font-awesome.min') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ ViewsHelper::css('iCheck/all') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ ViewsHelper::css('AdminLTE') }}"/>

    @if(isset($view_data['css_array']))
            @foreach ($view_data['css_array'] as $css_array)
<link rel="stylesheet" type="text/css" href="{{ ViewsHelper::css($css_array) }}"/>
    @endforeach
@endif