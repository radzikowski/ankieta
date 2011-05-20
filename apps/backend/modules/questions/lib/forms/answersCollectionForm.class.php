<?php
class answersCollectionForm extends BaseForm
{
	public function configure()
	{
		if (!$answers = $this->getOption('answers'))
		{
			throw new InvalidArgumentException('You must provide a answers object.');
		}

		for ($i = 0; $i < count($answers); $i++)
		{
			$form = new answerForm(null, array('answer' => $answers[$i]));
			$form->setDefaults($answers[$i]->toArray());
			$this->embedForm($i, $form);
			$this->widgetSchema->setNameFormat('answersCollection[%s]');
		}
	}
}
?>
