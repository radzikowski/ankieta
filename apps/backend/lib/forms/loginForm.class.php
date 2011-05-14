<?php
class loginForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'username' => new sfWidgetFormInput(array(), array()),
			'password' => new sfWidgetFormInputPassword(array(), array())
		));

		$this->widgetSchema->setNameFormat(get_class($this).'[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'username' => new sfValidatorString(array(
				'required' => true,
				'trim' => true,
				'min_length' => 3
			), array(
				'required' => 'Login jest wymagany',
				'min_length' => 'Minimalna ilość znaków to 3'
			)),
			'password' => new sfValidatorString(array(
				'required' => true,
				'trim' => true,
				'min_length' => 3
			), array(
				'required' => 'Hasło jest wymagane',
				'min_length' => 'Minimalna ilość znaków to 3'
			))			
		));
	}
}
?>
