<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class delCorrectAnswerAction extends sfAction
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute($request)
  {
	sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
  	$questionId = $this->getRequest()->getParameter('questionId');
  	
  	$question = QuestionsTable::getInstance()->findOneById($questionId);
  	if ($question)
  	{
  		$question['answer_id'] = null;
  		$question->save();
  	}
  		
  	$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$questionId);
  	
  }
}
