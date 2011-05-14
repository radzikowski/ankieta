<?php 
class indexAction extends sfAction
{
	public function preExecute()
	{
        $this->user = sfContext::getInstance()->getUser();
	}
	public function execute($request)
	{
    }
}
