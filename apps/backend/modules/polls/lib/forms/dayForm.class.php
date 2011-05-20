<?php
class dayForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'day_number' => new sfWidgetFormInput(array(), array('id' => 'day_number')),
			'day_tip' => new sfWidgetFormTextarea(array(), array()),
			'day_letter' => new sfWidgetFormInput(array(), array()),
			'image_name' => new sfWidgetFormInputFile(array(), array()),
			'image_name2' => new sfWidgetFormInputFile(array(), array())	
		));

		$this->widgetSchema->setNameFormat('editDay[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'day_number' => new sfValidatorNumber(array(
				'required' => true,
			), array(
				'required' => 'Numer dani musi zostać podany',
			)),
			'day_tip' => new sfValidatorString(array(
				'required' => true,
				'trim' => true
			), 
			array(
				'required' => 'Podpowiedź dnia musi zostać wpisana'
			)),
			'day_letter' => new sfValidatorString(array(
				'required' => true,
				'trim' => true
			), 
			array(
				'required' => 'Litera dnia musi zostać wpisana'
			)),
			'image_name' => new sfValidatorFile(array(
				'max_size' => '8388608',
				'mime_types' => 'web_images',
				'required' => false,
			), array(
				'max_size' => 'Zdjece: Maksymalny rozmiar zdjęcia to 8MB',
				'mime_types' => 'Zdjęcie: Wgrywany plik nie jest zdjęciem',
				'required' => 'Zdjęcie: Wybierz zdjęcie.',
			)),
			'image_name2' => new sfValidatorFile(array(
				'max_size' => '8388608',
				'mime_types' => 'web_images',
				'required' => false,
			), array(
				'max_size' => 'Zdjęcie 2: Maksymalny rozmiar zdjęcia to 8MB',
				'mime_types' => 'Zdjęcie 2: Wgrywany plik nie jest zdjęciem',
				'required' => 'Zdjęcie 2: Wybierz zdjęcie.',
			)),
			));
	}

}
?>
