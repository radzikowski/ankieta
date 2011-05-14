<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class addAnswerAction extends sfAction
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
		if ($this->question)
		{
			$this->addAnswerForm = new addAnswerForm();
			$this->addAnswerForm->setDefault('id_question',$this->question->getId());

			if ($this->getRequest()->hasParameter('addAnswer'))
			{
				$this->addAnswerForm->bind($this->getRequest()->getParameter('addAnswer'));
				if ($this->addAnswerForm->isValid())
				{
					$this->questionAnswer = new QuestionsAnswers();
					$this->questionAnswer->fromArray($this->addAnswerForm->getValues());
					$this->questionAnswer->save();
					$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$this->question->id);
				}
			}
		}
	}

}
