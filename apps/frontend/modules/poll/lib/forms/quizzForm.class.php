<?php
class quizzForm extends BaseForm
{
    
        public function configure()
	{
		if (!$this->question = $this->getOption('question'))
		{
			throw new InvalidArgumentException('You must provide a question object.');
		}
                
                $this->multi = $this->getOption('multi');

                $this->points = $this->getOption('points');

                $this->self = $this->getOption('self');
                
                $this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}
        
	private function setWidgetsSchema()
	{
                $this->setWidgets(array(
			'question' => new sfWidgetFormInputHidden(array(), array()),
			'answers' => new sfWidgetFormChoice(array(
				'choices' => $this->_getChoises(),
				'multiple' => $this->multi,
				'expanded' => true
                        ), array())
		));

		$this->widgetSchema->setNameFormat('quizz[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'question' => new sfValidatorString(array('required' => false), array()),
			'answers' => new sfValidatorOr(array(
                            new sfValidatorChoice(array(
				'choices' => array_keys($this->_getChoises())
                            )),
                            new sfValidatorString(array(
                                'required' => false
                            ))
                        ), array())
		));
	}

	private function _getChoises()
	{
		$choises = array();
		if($this->question->QuestionsAnswers)
		{
			foreach($this->question->QuestionsAnswers as $key => $answer)
			{
				$choises[$this->question->id.'___'.$answer->id.'___0'] = $answer->value;
			}
		}
                
                if ($this->self!=false)
                $choises[$this->question->id.'___null___0'] = $this->self;
                
		return $choises;
	}
}
?>
