<?php
class deleteAnswerForm extends BaseForm
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
		));

		$this->widgetSchema->setNameFormat('deleteAnswer[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'id' => new sfValidatorNumber(array(
				'required' => true
			), array(
				'required' => 'Podane Id jest nieprawidłowe'
			))
		));
	}
}
?>
