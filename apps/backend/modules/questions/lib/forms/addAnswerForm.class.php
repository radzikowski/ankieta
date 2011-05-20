<?php
class addAnswerForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'question_id' => new sfWidgetFormInputHidden(array(), array()),
			'value' => new sfWidgetFormInput(array(), array())
		));

		$this->widgetSchema->setNameFormat('addAnswer[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'question_id' => new sfValidatorNumber(array(
				'required' => true
			), array(
				'required' => 'Podane Id jest nieprawidłowe'
			)),
			'value' => new sfValidatorString(array(
				'trim' => true,
				'required' => true
			), array(
				'required' => 'Treść odpowiedzi jest wymagana',
			))
		));
	}
}
?>
