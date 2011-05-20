<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class deleteDayAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->day = DaysOrderTable::getInstance()->findOneById($this->getRequest()->getParameter('id'));
		if($this->day)
		{
			$this->deleteDayForm = new deleteDayForm();
			$this->deleteDayForm->setDefaults($this->day->toArray());

			if ($this->getRequest()->hasParameter('deleteDay'))
			{
				$this->deleteDayForm->bind($this->getRequest()->getParameter('deleteDay'));
				if($this->deleteDayForm->isValid())
				{
					$this->day->delete();
					$this->redirect(url_for2('default_index', array('module' => 'days'), true));
				}
			}
		}
	}
}
