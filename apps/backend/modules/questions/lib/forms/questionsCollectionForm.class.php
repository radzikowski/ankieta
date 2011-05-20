<?php
class questionsCollectionForm extends BaseForm
{
	public function configure()
	{
		if (!$questions = $this->getOption('questions'))
		{
			throw new InvalidArgumentException('You must provide a answers object.');
		}

		for ($i = 0; $i < count($questions); $i++)
		{
			$form = new questionForm(null, array('question' => $questions[$i]));
			$form->setDefaults($questions[$i]->toArray());
			$this->embedForm($i, $form);
			$this->widgetSchema->setNameFormat('questionsCollection[%s]');
		}
	}
}
?>
