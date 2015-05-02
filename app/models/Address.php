<?php

class Address extends \Eloquent {
	Protected $primaryKey = "id";
        protected $table = 'address';
        
        public function city()
        {
            $city = $this->hasOne('City', 'id_city', 'id_city');
            return $city;
        }
}