<?php
class demogrphicForm extends BaseForm
{
    
        public function configure()
	{
		
                $this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}
        
	private function setWidgetsSchema()
	{
                $this->setWidgets(array(
			//'place' => new sfJqueryPlugin(array(),array()),
                        'age' => new sfWidgetFormInput(array(),array()),
			'sex' => new sfWidgetFormChoice(array(
				'choices' => array('male' => 'Mężczyzna', 'female' => 'Kobieta'),
                                'multiple' => false,
                                'expanded' => true
                        ), array())
		));

		$this->widgetSchema->setNameFormat('demographic[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			//'question' => new sfValidatorString(array('required' => false), array()),
			'age' => new sfValidatorNumber(array('required' => true),array()),
                        'sex' => new sfValidatorString(array(
				'required' => true
                        ),array()),                   
		));
	}

}
?>
