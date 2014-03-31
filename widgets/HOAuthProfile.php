<?php
/**
 * HOAuth provides widget with buttons for login with social networs 
 * that enabled in HybridAuth config
 * 
 * @uses CWidget
 * @version 1.2.4
 * @copyright Copyright &copy; 2013 Sviatoslav Danylenko
 * @author Sviatoslav Danylenko <dev@udf.su> 
 * @license MIT ({@link http://opensource.org/licenses/MIT})
 * @link https://github.com/SleepWalker/hoauth
 */

/**
 * NOTE: If you want to change the order of button it is better to change this order in HybridAuth config.php file
 */
require_once(dirname(__FILE__).'/HOAuth.php');
class HOAuthProfile extends HOAuth
{
	public $user;

	public function run()
	{
		$config = UserOAuth::getConfig();
		require_once(dirname(__FILE__).'/../hybridauth/Hybrid/Auth.php');
		$hybridauth = new Hybrid_Auth( $config );
		$userOAuths = UserOAuth::model()->findUser($this->user->primaryKey); 
		
		foreach($userOAuths as $userOAuth){
			$adapter = $hybridauth->authenticate($userOAuth->attributes['provider']);
			if($userOAuth->attributes['provider'] == 'Google'){
				$contactInfo = $this->youtubeSubscriptions($adapter);
			}else{
				$contactInfo = $adapter->getUserContacts();
			}
			Yii::log(CVarDumper::dumpAsString($contactInfo, 10, true), 'varDumper', '$contactInfo');
		}
	}
	
	private function youtubeSubscriptions($adapter, $nextPageToken = null, $limit = 50){
		$url = "https://www.googleapis.com/youtube/v3/subscriptions?part=snippet&mine=true&maxResults={$limit}";
		if(!is_null($nextPageToken)){
			$url .= "&pageToken={$nextPageToken}";
		}
		$apiCall = $adapter->api()->api($url);

		$items = $apiCall->items;

		if(isset($apiCall->nextPageToken) && !empty($apiCall->nextPageToken)){
			$nextPage = $this->youtubeSubscriptions($adapter, $apiCall->nextPageToken);
			$items = array_merge($items, $nextPage);
		}
		return $items;
	}
}
?>