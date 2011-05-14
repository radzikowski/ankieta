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
			'id_question' => new sfWidgetFormInputHidden(array(), array()),
			'value' => new sfWidgetFormInput(array(), array())
		));

		$this->widgetSchema->setNameFormat('addAnswer[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'id_question' => new sfValidatorNumber(array(
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
