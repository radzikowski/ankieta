<?php

/**
 * Base project form.
 * 
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
	public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
	{
		parent::__construct($defaults, $options, $CSRFSecret);
	}
	
	public function getErrorsArray()
	{
		$errors = array();
		foreach ($this as $field) {
			$field->hasError() ? $errors[$field->getName()] = $field->getError()->__toString() : null;
		}
		
		return $errors;
	}
}