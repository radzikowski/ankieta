<?php
class quizzCollectionForm extends BaseForm
{
	public function configure()
	{
		if (!$questions = $this->getOption('questions'))
		{
			throw new InvalidArgumentException('You must provide a questions object.');
		}
                if ($this->getOption('multi') == 'radio')
                    $this->multi = false;
                else
                    $this->multi = true;
                
                if ($this->getOption('points') == 'points')
                    $this->points = true;
		else
                    $this->points = false;
                
                $this->self = array();
                for($i=0;$i< count($questions) ;$i++)
                {
                    if ($this->getOption('self'.$i)!= '0')
                        $this->self[$i] = $this->getOption('self'.$i);
                    else
                        $this->self[$i] = false;
                }
                
		for ($i = 0; $i < count($questions); $i++)
		{
			$form = new quizzForm(null, array(
                            'question' => $questions[$i],
                            'multi' => $this->multi,
                            'points' => $this->points,
                            'self' => $this->self[$i]
                                
                        ));
			$form->setDefaults(array(
				'question' => $questions[$i]->question
			));
			$this->embedForm($i, $form);
			$this->widgetSchema->setNameFormat('quizzCollection[%s]');
		}
	}
}
?>
