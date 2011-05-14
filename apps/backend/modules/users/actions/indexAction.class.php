<?php

/**
 * main actions.
 *
 * @package    creativeapps
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexAction extends sfAction
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute($request)
  {
	  sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
	  // Creating pager object
		$this->pager = new Doctrine_Pager(
				 Doctrine_Query::create()
					->from( 'Users u' )
					->addWhere('u.is_active = ?', 1)
					->orderby( 'u.created_at DESC' ),
				$this->getRequest()->getParameter('page', 0), // Current page of request
			25
		);

		$this->pagerLayout = new Doctrine_Pager_Layout(
						$this->pager ,
						new Doctrine_Pager_Range_Sliding(array(
							'chunk' => 5
						)),
						url_for2('default_index', array('module' => 'users'), true).'?page={%page_number}'
		);
		$this->pagerLayout->setTemplate(' <li><a href="{%url}">{%page}</a></li> ');

		$this->users = $this->pager->execute();
  }
}
