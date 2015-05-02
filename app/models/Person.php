<?php


class Person extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
         
        protected $primaryKey = "id";
 
	protected $table = 'person';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
        
}