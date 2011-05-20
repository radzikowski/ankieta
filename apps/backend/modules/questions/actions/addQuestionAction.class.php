<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class addQuestionAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->addQuestionForm = new addQuestionForm();
		if ($this->getRequest()->hasParameter('nr'))
		{	
			$this->dayNumber = $this->getRequest()->getParameter('nr');
		}
		
		if ($this->getRequest()->hasParameter('addQuestion'))
		{
			$this->addQuestionForm->bind($this->getRequest()->getParameter('addQuestion'));
			if ($this->addQuestionForm->isValid())
			{
				$this->question = new Questions();
				$this->question->fromArray($this->addQuestionForm->getValues());
				$this->question->save();
				
				$questionNumber = QuestionsOrderTable::getInstance()->findByDayNumber($this->dayNumber)->count();
				
				$this->questionOrder = new QuestionsOrder();
				$this->questionOrder->fromArray(array(
					'day_number' => $this->dayNumber,
					'question_number' => $questionNumber,
					'question_id' => $this->question->id
				));
				$this->questionOrder->save();
				
				$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'answers'), true) . '?id=' . $this->question->id);
			}
		}
	}

}
