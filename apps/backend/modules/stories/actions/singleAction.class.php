<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class singleAction extends sfAction
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute($request)
  {
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->user = Doctrine_Query::create()
				->select('u.*, ue.*')
				->from(' Users u')
				->leftJoin('u.UsersExplains ue')
				->addWhere('u.id = ?',$request->getParameter('id'))
				->orderBy('ue.created_at DESC')
				->fetchOne()->toArray();	
		$this->winner = WinnersTable::getInstance()->findOneByUserId($this->user['id']);
  }

}
