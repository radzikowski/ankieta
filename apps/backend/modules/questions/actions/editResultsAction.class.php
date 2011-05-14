<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class editResultsAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->results = QuestionsResultsTable::getInstance()->findAll();

		$this->resultsCollectionForm = new resultsCollectionForm(null, array('results' => $this->results));

		if ($this->getRequest()->hasParameter('resultsCollection'))
		{
			$this->resultsCollectionForm->bind($this->getRequest()->getParameter('resultsCollection'));
			if ($this->resultsCollectionForm->isValid())
			{
				$i = 0;
				$values = $this->resultsCollectionForm->getValues();
				 foreach ($this->results as $result)
				 {
						$result->fromArray($values[$i]);
						$result->save();
						$i++;
				 }
			}
		}
	}

}
