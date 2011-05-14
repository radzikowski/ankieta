<?php

class FacebookService
{

    public static function getFacebook()
	{
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
		return $facebook = new Facebook(array(
			'appId' => sfConfig::get('app_facebook_app_id'),
			'secret' => sfConfig::get('app_facebook_secret_key'),
			'cookie' => true,
		));
	}

	public static function getUserFriends()
	{
		$facebook = FacebookService::getFacebook();
		return $facebook->api('/me/friends');
	}

    /*
	*	FacebookService::publishStream( array(
	*				'message' => 'Check out this funny article',
	*				'link' => 'http://www.example.com/article.html',
	*				'picture' => 'http://jchutchins.net/site/wp-content/uploads/2009/06/facebook-logo.jpg',
	*				'name' => 'Article Title',
	*				'caption' => 'Caption for the link',
	*				'description' => 'Longer description of the link'
	*	));
    */

    public static function publishStream($data)
	{
		if (sfConfig::get('app_allow_publish') == 1)
		{
			$user = sfContext::getInstance()->get('userFromBase');
			$facebook = FacebookService::getFacebook();
			try
			{
				$statusUpdate = $facebook->api('/me/feed', 'post', $data);
			}
			catch (FacebookApiException $e)
			{
				$log = LogsService::getInstance($e);
				$log->fromArray(array(
					'user_id' => $user->id,
					'type' => 'publishStreamError',
					'message' => 'Problem with publishing stream'
				));
				$log->save();
			}
		}
	}

	public static function decrementCount($uid)
	{
		$access = FacebookService::getAdminAccessToken();
		$facebook = FacebookService::getFacebook();
		$facebook->api(array(
			'method' => 'dashboard.decrementCount',
			'uid' => $uid,
			'access_token' => $access[1]
		));
	}

	public static function incrementCount($uids)
	{
		$access = FacebookService::getAdminAccessToken();
		$facebook = FacebookService::getFacebook();
		$facebook->api(array(
			'method' => 'dashboard.multiIncrementCount',
			'uids' => $uids,
			'access_token' => $access[1]
		));
	}

	public static function getAdminAccessToken()
	{
		$args = array(
			'grant_type' => 'client_credentials',
			'client_id' => sfConfig::get('app_facebook_app_id'),
			'client_secret' => sfConfig::get('app_facebook_secret_key')
		);

		$ch = curl_init();
		$url = 'https://graph.facebook.com/oauth/access_token';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		$data = curl_exec($ch);
		return $access = explode('=', $data);
	}

    public static function userLike($pageId, $userId)
    {
        try
        {
            $facebook = FacebookService::getFacebook();
            $data= $facebook->api(''.$pageId.'/members/'.$userId.'');
            if(array_key_exists('0', $data['data']))
            {
                if(count($data['data'][0]) == 2)
                    return true;
            }
            return false;
        }
        catch (FacebookApiException $e)
        {
            $log = LogsService::getInstance($e);
            $log->fromArray(array(
                'user_id' => $userId,
                'type' => 'Like Error',
                'message' => 'problem with checking whether the user likes page'
            ));
            $log->save();
            return false;
        }

    }

}
