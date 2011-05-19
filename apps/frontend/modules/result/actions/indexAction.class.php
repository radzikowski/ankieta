<?php
class indexAction extends sfAction
{
	public function preExecute()
	{
		$this->user = $this->getContext()->get('userFromBase');
		$this->getContext()->getConfiguration()->loadHelpers('Url');
	}
	public function execute($request)
	{
            $this->polls = Doctrine_Query::create()
                    ->select('p.*')
                    ->from('Poll p')
                    ->where('p.is_active = ?','1')
                    ->orderBy('p.id DESC')
                    ->execute();
	}
}
