<?php
class commentForm extends BaseForm
{
    
        public function configure()
	{
		
                $this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}
        
	private function setWidgetsSchema()
	{
                $this->setWidgets(array(
                        'comment' => new sfWidgetFormTextarea(array(),array('style' => 'width: 450px; height: 150px'))
		));

		$this->widgetSchema->setNameFormat('comment[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
                        'comment' => new sfValidatorString(array(
				'trim' => true,
				'required' => true
			), array(
				'required' => 'Proszę podać treść komentarza!'
			)),                   
		));
	}

}
?>
