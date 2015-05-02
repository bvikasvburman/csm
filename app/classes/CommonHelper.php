<?php
class CommonHelper {
    
    function getClientUserData($format = 0, $skipIp = false) {
        $ret_arr = array();
        if (!$skipIp) {
            $ret_arr['ip'] = CommonHelper::get_client_ip();
        }

        $ret_arr['user_agent'] = @$_SERVER['HTTP_USER_AGENT'];

        switch ($format) {
            case 0:
                $ret_arr = json_encode($ret_arr);
                break;
            case 1:
                $ret_arr = serialize($ret_arr);
                break;
            case 2:
                break;
            default:
                $ret_arr = serialize($ret_arr);
                break;
        }

        return $ret_arr;
    }

    function get_client_ip() {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    static public function timestampToDate($timestamp, $time = false, $timeStamp = false) {
        date_default_timezone_set('Asia/Calcutta');
        if ($timeStamp == false)
            $timestamp = strtotime($timestamp);
        if (strlen($timestamp) > 0) {
            $date = date("F j, Y", $timestamp);

            if ($time != false) {
                $date = date("F j, Y, h:i:s A", $timestamp);
            }

            return $date;
        }
    }

    /**
     * Generate Random Key for ID
     * @return string
     */
    public static function random_guid() {
        $randomKey = 0;
        $randomKey2 = 0;
        do {
            $randomKey = CommonHelper::randomKey();
            $randomKey2 = CommonHelper::randomKey();
        } while ($randomKey == $randomKey2);

        return ($randomKey2);
    }

    public static function randomKey() {
        return mt_rand(10000, 999999);
    }
    
    /**
     * Function to Generate Random Salt ..
     * @author cis
     * @todo Need to change the Salt generation logic
     */
    public function getRandomSalt() {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        return $random_salt;
    }

    /**
     * Function to Encrypt password ...
     * @param unknown_type $password
     * @return string | encrypted password string
     */
    public function encryptPassword($password = null, $random_salt = null) {

        if (!$password) {
            return false;
        }

        if (is_null($random_salt)) {
            $random_salt = $this->getRandomSalt();
        }

        $password = $this->passwordEncryptionMethod($password, $random_salt);
        return $password;
    }

    
    function defaultJson()
    {
        return array(
                    'success' => 0,
                    'success_mess' => "",
                    'error' => 0,
                    'error_mess' => "",
                );
    
    }
    
}