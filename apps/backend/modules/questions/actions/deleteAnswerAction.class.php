<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class deleteAnswerAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->question = QuestionsTable::getInstance()->findOneById($this->getRequest()->getParameter('questionId'));
		if($this->question)
			$this->answer = QuestionsAnswersTable::getInstance()->findOneByIdQuestionAndId($this->question->id, $this->getRequest()->getParameter('answerId'));
		if ($this->answer)
		{
			$this->deleteAnswerForm = new deleteAnswerForm();
			$this->deleteAnswerForm->setDefaults($this->answer->toArray());

			if ($this->getRequest()->hasParameter('deleteAnswer'))
			{
				$this->deleteAnswerForm->bind($this->getRequest()->getParameter('deleteAnswer'));
				if($this->deleteAnswerForm->isValid()){
					$this->answer->delete();
					$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$this->question->id);
				}
			}
		}
	}

}
