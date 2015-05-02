<?php


class Communication extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
         
        protected $primaryKey = "id";
 
	protected $table = 'communication';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        
        public function address()
        {
            $address = $this->hasOne('Address', 'id_address', 'id_address');
            return $address;
        }
        
        
}