<?php


class City extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
         
        protected $primaryKey = "id_city";
 
	protected $table = 'city';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        
        public function state()
        {
            $state = $this->belongsTo('State', 'id_state', 'id_state');
            return $state;
        }
	
	
}