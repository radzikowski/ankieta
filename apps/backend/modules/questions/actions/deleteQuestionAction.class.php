<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class deleteQuestionAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->question = QuestionsTable::getInstance()->findOneById($this->getRequest()->getParameter('id'));
		if($this->question)
		{
			$this->deleteQuestionForm = new deleteQuestionForm();
			$this->deleteQuestionForm->setDefaults($this->question->toArray());

			if ($this->getRequest()->hasParameter('deleteQuestion'))
			{
				$this->deleteQuestionForm->bind($this->getRequest()->getParameter('deleteQuestion'));
				if($this->deleteQuestionForm->isValid())
				{
					$this->question->delete();
					$this->redirect(url_for2('default_index', array('module' => 'questions'), true).'?id='.$this->question->id);
				}
			}
		}
	}
}
