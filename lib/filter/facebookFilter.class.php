<?php

class facebookFilter extends sfFilter
{
    /**
     * @param  $filterChain
     * @contextValues
     *  - fbSession (session from Facebook)
     *  -
     * @userValues
     *  - fbuser (user uid)
     *  - me. + $fbuser - user graph /me
     */

	public function execute($filterChain)
	{
		$configFromBase = ConfigTable::getInstance()->findAll();
        if($configFromBase)
        	foreach($configFromBase->toArray() as $option)
        		sfConfig::set('conf_'.$option['name'], $option['value']);
        		
		header('P3P: CP="HONK"');
		// Execute this filter only once
		if (!$this->isFirstCall())
		{
			$filterChain->execute();
			return;
		}

		$context = $this->getContext();
		$this->user = $context->getUser();
		$this->response = $context->getResponse();
		$this->request = $context->getRequest();
		$context->getConfiguration()->loadHelpers('Url');
		$this->user->setCulture('pl_PL');
		

		if ($this->request->hasParameter('signed_request'))
			$this->user->setAttribute('signed_request', $this->request->getParameter('signed_request'), 'signed_request');

		$facebook = FacebookService::getFacebook();
		$session = $facebook->getSession();
		$nextLink = $this->_generateNextLink($context->getConfiguration()->getApplication());
		$loginUrl = $facebook->getLoginUrl(array(
					'canvas' => 1,
					'fbconnect' => 0,
					'req_perms' => sfConfig::get('app_facebook_permissions'),
					'next' => $nextLink
				));

		if (!$session)
		{
			if ($this->request->isXMLHttpRequest())
			{
				$context->getResponse()->setHttpHeader("Content-Type", "application/json; charset=utf-8");
				echo json_encode(array('status' => 200, 'redirect' => $loginUrl));
				exit;
			}
			else
			{
				$this->_redirectToFacebook($loginUrl);
			}
		}
		$context->set('fbSession', $session);

		$fbuser = $facebook->getUser();
		$this->user->setAttribute('fbuser', $fbuser);

		if (!$this->user->hasAttribute('me.' . $fbuser))
		{
			try
			{
				$me = $facebook->api('/me');
				$this->_saveUserData($facebook, $me);
				$this->user->setAttribute('me.' . $fbuser, $me);
			}
			catch (FacebookApiException $e)
			{
				$log = LogsService::getInstance($e);
				$log->fromArray(array(
					'user_id' => $fbuser,
					'type' => 'FacebookApi',
					'message' => 'Problem with get ME from FB Api'
				));
				$log->save();
			}
		}
		else
			$this->getContext()->set('userFromBase',
                Doctrine_Query::create()
                    ->from('Users u')
                    ->select('u.*')
                    ->where('u.id = ?',$fbuser)
                    //->useResultCache(true)
                    ->fetchOne());

        $this->userFromBase = $this->getContext()->get('userFromBase');
        
		$this->_controlAccess($this->user->getAttribute('me.' . $fbuser));
		$filterChain->execute();
	}

	private function _generateNextLink($application)
	{
		if ($application === 'backend')
			return sfConfig::get('app_backend_url') . '' . $_SERVER['REQUEST_URI'];

		return sfConfig::get('app_frontend_url') . '' . $_SERVER['REQUEST_URI'];
	}
	
	private function _controlAccess($me)
	{
		$this->getContext()->getUser()->setAttribute('adminUsers', array(
			'1413392640',
		));
		
//		if($this->user->getAttribute('likesOn') != true && !in_array(sfContext::getInstance()->getModuleName(), array('prices')))
//		{
//	        if(!FacebookService::userLike(sfConfig::get('app_facebook_funpage_id'), $this->userFromBase->id))
//	        {
//	            $this->user->setAttribute('likesOn', true);
//	            $this->getContext()->getController()->getActionStack()->getLastEntry()->getActionInstance()->redirect(url_for2('default', array('module' => 'main', 'action' => 'index'), true));
//	        }
//	        else 
//	        {
//	        	$this->user->setAttribute('likesOn', true);
//	        }
//		}
	}

	private function _redirectToFacebook($loginUrl)
	{
		echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
		exit;
	}

	private function _saveUserData($facebook, $me)
	{
		$existingUser = Doctrine_Core::getTable('users')->findOneById($me['id']);
        $this->getContext()->set('userFromBase', $existingUser);
		if (!$existingUser)
		{
			$friends = json_encode(FacebookService::getUserFriends());
			$userData = array(
				'id' => $me['id'],
				'first_name' => $me['first_name'],
				'last_name' => $me['last_name'],
				'sex' => $me['gender'],
				'friends' => $friends
			);
			
			$newUser = new Users();
			$newUser->fromArray($userData);
			$newUser->save();
			$this->getContext()->set('userFromBase', $newUser);
		}
	}
}
