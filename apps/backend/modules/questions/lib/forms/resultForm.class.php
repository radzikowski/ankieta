<?php
class resultForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'id' => new sfWidgetFormInputHidden(array(), array()),
			'result' => new sfWidgetFormTextarea(array(), array('class' => 'result')),
		));

		$this->widgetSchema->setNameFormat('result[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'result' => new sfValidatorString(array(
				'trim' => true,
				'required' => true
			), array(
				'required' => 'Wynik jest wymagany!'
			)),
			'id' => new sfValidatorNumber(array(
				'required' => true
			), array(
				'required' => 'Id jest wymagane'
			))
		));
	}
}
?>
