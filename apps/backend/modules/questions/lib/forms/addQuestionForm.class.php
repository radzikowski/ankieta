<?php
class addQuestionForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'question' => new sfWidgetFormTextarea(array(), array()),
		));

		$this->widgetSchema->setNameFormat('addQuestion[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'question' => new sfValidatorString(array(
				'trim' => true,
				'required' => true
			), array(
				'required' => 'Treść pytania jest wymagana',
			)),
		));
	}
}
?>
