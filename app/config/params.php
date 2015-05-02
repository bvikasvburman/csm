<?php 

//define('ROOT_PATH' , $_SERVER['DOCUMENT_ROOT'].'/laravel/');
define('ROOT_PATH' , base_path()."/");

        return array( 
            'site_name' => 'test',
            'public_root_path' => ROOT_PATH.'public/',
            'userdata_root_path' => ROOT_PATH.'public/userdata/',
            'user_profile_pic' => '100x100,200x200,400x400,600x600',
            'user_vacancy_pic' => '100x100,200x200,400x400,600x600',
            'user_business_pic' => '100x100,200x200,400x400,600x600',
            'user_prof_pic' => '100x100,200x200,400x400,600x600',
            'userdata_path' => url('public/userdata/'),
        );