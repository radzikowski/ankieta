<?php
class setWinnerAction extends sfAction
{
	public function preExecute()
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
	}
	
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function execute($request)
	{
		$this->user = Doctrine_Query::create()
				->select('u.*, ue.*')
				->from(' Users u')
				->leftJoin('u.UsersExplains ue')
				->addWhere('u.id = ?',$request->getParameter('userId'))
				->orderBy('ue.created_at DESC')
				->fetchOne()->toArray();	
		$this->winner = WinnersTable::getInstance()->findOneByUserId($this->user['id']);
		
		$this->setWinnerForm = new setWinnerForm();
		$this->setWinnerForm->setDefault('id', $this->user['id']);
		if($request->isMethod('post') && $request->hasParameter(get_class($this->setWinnerForm)))
		{				
			$this->setWinnerForm->bind($request->getParameter(get_class($this->setWinnerForm)));
			if($this->setWinnerForm->isValid())
			{
				if($this->winner)
				{
					$this->getUser()->setFlash('info', 'Ten użytkownik już wygrał!');
					$this->redirect(url_for2('default_index', array('module' => 'stories'), true));
				}
				else 
				{
					$winner = new Winners();
					$winner['user_id'] = $this->user['id'];
					$winner->save();
					$this->getUser()->setFlash('info', 'Poprawnie dodano zwycięsce!');
					$this->redirect(url_for2('default_index', array('module' => 'stories'), true));
				}
			}
		}
	}
}
