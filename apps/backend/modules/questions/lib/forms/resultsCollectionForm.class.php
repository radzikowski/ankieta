<?php
class resultsCollectionForm extends BaseForm
{
	public function configure()
	{
		if (!$results = $this->getOption('results'))
		{
			throw new InvalidArgumentException('You must provide a results object.');
		}

		for ($i = 0; $i < count($results); $i++)
		{
			$form = new resultForm(null, array('results' => $results[$i]));
			$form->setDefaults($results[$i]->toArray());
			$this->embedForm($i, $form);
		}
		$this->widgetSchema->setNameFormat('resultsCollection[%s]');
	}
}
?>
