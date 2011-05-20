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
			'city' => new sfWidgetFormInput(array(),array()),
                        'age' => new sfWidgetFormInput(array(),array()),
			'sex' => new sfWidgetFormChoice(array(
				'choices' => array('male' => 'Mężczyzna', 'female' => 'Kobieta'),
                                'multiple' => false,
                                'expanded' => true
                        ), array('style' => 'display: inline;'))
		));

		$this->widgetSchema->setNameFormat('demographic[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'city' => new sfValidatorString(array(
				'required' => true,
                                'trim' => true
                        ),array(
                            'required' => 'Proszę podać miejscowość'
                        )),
                        'age' => new sfValidatorNumber(array(
                            'required' => true
                        ),array(
                            'required' => 'Podaj swój wiek'
                        )),
                        'sex' => new sfValidatorString(array(
				'required' => true,
                                'trim' => true
                        ),array(
                            'required' => 'Podaj płeć'
                        )),                   
		));
	}

}
?>
