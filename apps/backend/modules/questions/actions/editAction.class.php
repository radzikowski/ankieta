<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class editAction extends sfAction
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute($request)
  {
	  sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
	  $this->editForm = new questionForm();
	  $this->question = QuestionsTable::getInstance()->findOneById($this->getRequest()->getParameter('id'));
	  if($this->question)
		$this->editForm->setDefaults($this->question->toArray()); 

	  	if($this->getRequest()->hasParameter('editQuestion'))
		{
			$this->editForm->bind($this->getRequest()->getParameter('editQuestion'));
			if($this->editForm->isValid())
			{
				$this->question->fromArray($this->editForm->getValues());
				$this->question->save();
				$this->getUser()->setFlash('editSuccess', true);
				$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'index')));
			}
		}
  }
}
