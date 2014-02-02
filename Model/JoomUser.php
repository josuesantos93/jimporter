<?php
/**
 * User Model
 *
 * @category User.Model
 * @package  Croogo.User.Model
 * @version  0.1
 * @author   Josue Santos <contato@josuesantos.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://josuesantos.net
 */
class JoomUser extends JimportAppModel {
        
        public $useTable = 'users';
        
        public function extractUser($user){
                $data = array(
                                'role_id' => 2,
                                'name' => $user['name'],
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'created' => $user['registerDate'],
                                'timezone' => $this->timeZone($user['params']),
                                'status' => true,
                                'activation_key' => md5(uniqid())
                               );
                return $data;
        }
        
        private function timeZone($params){
                $configs = explode("\n", $params);
		foreach ($configs as $config) {
			$c = parse_str($config);
			if (isset($timezone)) {
				return $timezone;
			}
		}
		return '';
        }
}