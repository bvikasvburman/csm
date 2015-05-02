<?php
class ViewsHelper {
    
    public static function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
    
    public static function css($path, $secure = null)
    {
        return app('url')->asset("css/".$path.".css", $secure);
    }
    
    public static function js($path, $secure = null)
    {
        return app('url')->asset("js/".$path.".js", $secure);
    }
    
    public static function img($path, $secure = null)
    {
        return app('url')->asset("img/".$path, $secure);
    }
    public static function icons($path, $secure = null)
    {
        return app('url')->asset("img/icons/".$path, $secure);
    }
    
    public static function userImg($path, $secure = null)
    {
        return app('url')->asset("userdata/".$path, $secure);
    }
    
    public static function renderPartial($path, $data = null)
    {
        ob_start();
        echo View::make($path,$data);
        $html =  ob_get_contents ();
        ob_get_clean();
        return $html;
    }
    
    
}