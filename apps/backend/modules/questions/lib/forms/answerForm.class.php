<?php
class answerForm extends BaseForm
{
	public function configure()
	{
		if (!$this->question = $this->getOption('answer'))
		{
			throw new InvalidArgumentException('You must provide a answer object.');
		}

		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'id' => new sfWidgetFormInputHidden(array(), array()),
			'value' => new sfWidgetFormInput(array(), array('class' => 'value'))
		));

		$this->widgetSchema->setNameFormat('answers[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'value' => new sfValidatorString(array(
				'trim' => true,
				'required' => true
			), array(
				'required' => 'Odpowiedź jest wymagana!'
			)),
			'id' => new sfValidatorNumber(array(
				'required' => true
			), array(
				'required' => 'Ilość punktów jest wymagana'
			))
		));
	}
}
?>
