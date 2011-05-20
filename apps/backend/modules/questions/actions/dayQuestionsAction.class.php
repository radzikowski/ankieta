<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dayQuestionsAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

		$this->dayNumber = $this->getRequest()->getParameter('nr');
		
		$this->questions = Doctrine_Query::create()
			->select('q.*, qo.*')
			->from('Questions q')
			->leftJoin('q.QuestionsOrder qo')
			->where('qo.day_number =? ', $this->dayNumber)
			->execute();
		
		if ($this->questions)
		{			
			$this->questionsCollectionForm = new questionsCollectionForm(null, array('questions' => $this->questions));
			if ($this->getRequest()->hasParameter('questionsCollection'))
			{
				$this->questionsCollectionForm->bind($this->getRequest()->getParameter('questionsCollection'));
				if ($this->questionsCollectionForm->isValid())
				{
					$i = 0;
					foreach($this->questionsCollectionForm->getValues() as $question)
					{
						if($this->questions[$i]->id == $question['id'])
						{
							$this->questions[$i]->fromArray($question);
							$this->questions[$i]->save();
							$i++;
						}
						else
						{
							$invalidAnswer = QuestionsTable::getInstance()->findOneById($question['id']);
							$invalidAnswer->fromArray($question);
							$invalidAnswer->save();
						}
					}
				}
			}
		}
	}

}
