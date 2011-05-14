<?php
class questionForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'question' => new sfWidgetFormTextarea(array(), array('id' => 'question'))
		));

		$this->widgetSchema->setNameFormat('editQuestion[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'question' => new sfValidatorString(array(
				'required' => true,
				'trim' => true
			), array(
				'required' => 'Podaj pytanie',
			))
		));
	}

}
?>
