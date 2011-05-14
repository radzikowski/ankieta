<?php 
class logoutAction extends sfAction
{
	public function execute($request)
	{
		$this->getContext()->getConfiguration()->loadHelpers('Url');
		$this->getUser()->setAuthenticated(false);
		$this->redirect(url_for2('default', array('module' => 'editions', 'action' => 'index'), true));
    }
}
