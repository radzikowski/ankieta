<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class answersAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->answers = QuestionsAnswersTable::getInstance()->findByIdQuestion($this->getRequest()->getParameter('id'));
		$this->question = QuestionsTable::getInstance()->findOneById($this->getRequest()->getParameter('id'));
		if ($this->answers)
		{
			$this->answersCollectionForm = new answersCollectionForm(null, array('answers' => $this->answers));
			if ($this->getRequest()->hasParameter('answersCollection'))
			{
				$this->answersCollectionForm->bind($this->getRequest()->getParameter('answersCollection'));
				if ($this->answersCollectionForm->isValid())
				{
					$i = 0;
					foreach($this->answersCollectionForm->getValues() as $answer)
					{
						if($this->answers[$i]->id == $answer['id'])
						{
							$this->answers[$i]->fromArray($answer);
							$this->answers[$i]->save();
							$i++;
						}
						else
						{
							$invalidAnswer = QuestionsAnswersTable::getInstance()->findOneById($answer['id']);
							$invalidAnswer->fromArray($answer);
							$invalidAnswer->save();
						}
					}
				}
			}
		}
	}

}
