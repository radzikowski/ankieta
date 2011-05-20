<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class editAction extends sfAction
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute($request)
  {
	  sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
	  $this->editForm = new dayForm();
	  $this->day = DaysOrderTable::getInstance()->findOneById($this->getRequest()->getParameter('id'));
	  if($this->day)
		$this->editForm->setDefaults($this->day->toArray()); 

	  	if($this->getRequest()->hasParameter('editDay'))
		{
			$this->editForm->bind($this->getRequest()->getParameter('editDay'), $this->getRequest()->getFiles('editDay'));
			if($this->editForm->isValid())
			{
				$files = $request->getFiles('editDay');
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
					'day_number' => $this->editForm->getValue('day_number'),
					'day_tip' => $this->editForm->getValue('day_tip'),
					'day_letter' => $this->editForm->getValue('day_letter'),
				));
				$this->day->save();
				$this->getUser()->setFlash('editSuccess', true);
				$this->redirect(url_for2('default', array('module' => 'days', 'action' => 'index')));
			}
		}
  }
}
