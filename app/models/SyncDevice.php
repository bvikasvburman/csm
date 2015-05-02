<?php


class SyncDevice extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
         
        protected $primaryKey = "id";
 
	protected $table = 'syncdevice';

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
        
	public function user()
        {
            $address = $this->hasOne('User', 'id_user', 'id_user');
            return $address;
        }
        
        public function interest_professional()
        {
            $address = $this->hasMany('InterestProfessional', 'id_interest_professional', 'id_interest_professional');
            return $address;
        }
	public function getUserProfessional($id_prof)
        {
            return Professional::whereIdProfessional($id_prof)->first();
        }
        
        public function getProfUsers()
        {
            return $this->orderByRaw("RAND()")->paginate(15);
        }
        
        
        
        
}