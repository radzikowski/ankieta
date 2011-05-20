<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class addPollAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$dayNumber = DaysOrderTable::getInstance()->count();
		$this->addDayForm = new addDayForm();
//		$this->addDayForm->setDefault('day_number', $dayNumber+1);

		if ($this->getRequest()->hasParameter('addDay'))
		{
			$this->addDayForm->bind($this->getRequest()->getParameter('addDay'));
			if ($this->addDayForm->isValid())
			{
				$this->poll = new Poll();
				
				
				$this->poll->fromArray(array(
					'' => $this->addDayForm->getValue('day_number'),
					'' => $this->addDayForm->getValue('day_tip'),
					'' => $this->addDayForm->getValue('day_letter'),
				));				
				$this->poll->save();
				$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'dayQuestions'), true).'?nr='.$this->day->day_number);
			}
		}
	}

}
