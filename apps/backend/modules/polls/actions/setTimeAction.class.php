<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class setTimeAction extends sfAction
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function execute($request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->setTimeForm = new setTimeForm();
		$this->configStartTime = ConfigTable::getInstance()->findOneByName('startTime');
		if (!$this->configStartTime)
		{	
			$this->configStartTime = new Config();
			$this->setTimeForm->setDefault('start_time', time());
		}else{
			$this->setTimeForm->setDefault('start_time', strtotime($this->configStartTime->value));
		}
		
		$this->configEndTime = ConfigTable::getInstance()->findOneByName('endTime');
		if (!$this->configEndTime)
		{
			$this->configEndTime = new Config();
			$this->setTimeForm->setDefault('end_time', strtotime('+15 day'));
		}else{
			$this->setTimeForm->setDefault('end_time', strtotime($this->configEndTime->value));
		}
		

		if ($this->getRequest()->hasParameter(get_class($this->setTimeForm)))
		{
			$this->setTimeForm->bind($this->getRequest()->getParameter(get_class($this->setTimeForm)));
			if ($this->setTimeForm->isValid())
			{
				$this->configStartTime = ConfigTable::getInstance()->findOneByName('startTime');
				if (!$this->configStartTime)
					$this->configStartTime = new Config();
					
				$this->configStartTime->fromArray(array(
					'name' => 'startTime',
					'value' => $this->setTimeForm->getValue('start_time')
				));
				$this->configStartTime->save();

				$this->configEndTime = ConfigTable::getInstance()->findOneByName('endTime');
				if (!$this->configEndTime)
					$this->configEndTime = new Config();
				
				$this->configEndTime->fromArray(array(
					'name' => 'endTime',
					'value' => $this->setTimeForm->getValue('end_time')
				));
				$this->configEndTime->save();
				
				$this->getUser()->setFlash('setTime', true);
				$this->redirect(url_for2('default', array('module' => 'days', 'action' => 'index'), true));
			}
		}
	}

}
