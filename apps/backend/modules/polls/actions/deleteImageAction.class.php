<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class deleteImageAction extends sfAction
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
			$this->day['image_name2'] = null;
			$this->day->save();	
		}

		$this->redirect(url_for2('default_index', array('module' => 'days'), true));
		
	}
}
