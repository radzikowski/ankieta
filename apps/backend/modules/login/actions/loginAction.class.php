<?php 
class loginAction extends sfAction
{
	public function preExecute()
	{
        $this->setLayout('login');
        $this->logins = array(
        	'ahilles107' => 'ck8daj',
        	'geek' => 'nieznamgo12#'
        );
        $this->user = sfContext::getInstance()->getUser();
        $this->getContext()->getConfiguration()->loadHelpers('Url');
        if($this->user->isAuthenticated() == true)
        	$this->user->setAuthenticated(false);
	}
	public function execute($request)
	{
        $this->loginForm = new loginForm();
        $this->error = false;
        
        if($request->hasParameter(get_class($this->loginForm)))
        {
        	$this->loginForm->bind($request->getParameter(get_class($this->loginForm)));
        	if($this->loginForm->isValid())
        	{
        		if(array_key_exists($this->loginForm->getValue('username'), $this->logins))
        		{
        			if($this->logins[$this->loginForm->getValue('username')] == $this->loginForm->getValue('password') )
        			{
        				$this->user->setAuthenticated(true);
        				$this->redirect(url_for2('default', array('module' => 'main', 'action' => 'index'), true));
        			}
        		}
        		else 
        		{
        			$this->error = 'Login lub hasło jest nie poprawne';
        		}
        	}
        }
    }
}
