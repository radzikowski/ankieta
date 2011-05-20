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
		$this->addDayForm->setDefault('day_number', $dayNumber+1);

		if ($this->getRequest()->hasParameter('addDay'))
		{
			$this->addDayForm->bind($this->getRequest()->getParameter('addDay'), $this->getRequest()->getFiles('addDay'));
			if ($this->addDayForm->isValid())
			{
				$this->day = new DaysOrder();
				
				$files = $request->getFiles('addDay');
				$i = '';
        		foreach($files as $key => $file)
        		{
        			if ($file['name'])
        			{
	        			$image = new UploadService();
	        			$image -> setPath('./uploads/');
	        			$image -> setFile($file);
	        			$image -> setFileName(md5($file['name'] . date('YmdGis')).'.'.UploadService::findexts($file['name']));
	        			$image -> save();
        				$this->day['image_name'.$i] = $image->getFileName();
        			}
        			$i = 2;
        			
        		}
				
				$this->day->fromArray(array(
					'day_number' => $this->addDayForm->getValue('day_number'),
					'day_tip' => $this->addDayForm->getValue('day_tip'),
					'day_letter' => $this->addDayForm->getValue('day_letter'),
				));				
				$this->day->save();
				$this->redirect(url_for2('default', array('module' => 'questions', 'action' => 'dayQuestions'), true).'?nr='.$this->day->day_number);
			}
		}
	}

}
