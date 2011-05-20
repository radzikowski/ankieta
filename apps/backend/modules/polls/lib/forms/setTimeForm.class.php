<?php
class setTimeForm extends BaseForm
{
	public function configure()
	{
		$this->setWidgetsSchema();
		$this->setValidatorsSchema();
	}

	private function setWidgetsSchema()
	{
		$this->setWidgets(array(
			'start_time' => new sfWidgetFormDateTime(array(
				'date' =>array(
					'format'=>'%year%-%month%-%day%',
					'can_be_empty' =>false
				),
				'time' => array(
					'format'=>'%hour%:%minute%',
					'can_be_empty' =>false
				)
			), array()),
			'end_time' => new sfWidgetFormDateTime(array(
				'date' =>array(
					'format'=>'%year%-%month%-%day%',
					'can_be_empty' =>false
				),
				'time' => array(
					'format'=>'%hour%:%minute%',
					'can_be_empty' =>false
				)
			), array()),
		));

		$this->widgetSchema->setNameFormat(get_class($this).'[%s]');
	}

	private function setValidatorsSchema()
	{
		$this->setValidators(array(
			'start_time' => new sfValidatorDateTime(array(
				'date_format' => '~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>\d{2}):(?P<minute>\d{2}):(?P<second>\d{2})/~',
				'with_time' => true,
				'datetime_output' => 'Y-m-d H:i:s',
				'required' => true
			), array(
				'bad_format' => 'Data startu nie jest prawidłowa',
				'required' => 'Data startu jest wymagana'
			)),
			'end_time' => new sfValidatorDateTime(array(
				'date_format' => '~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>\d{2}):(?P<minute>\d{2}):(?P<second>\d{2})/~',
				'with_time' => true,
				'datetime_output' => 'Y-m-d H:i:s',
				'required' => true
			), array(
				'bad_format' => 'Data końca nie jest prawidłowa',
				'required' => 'Data końca jest wymagana'
			)),
		));
	}
}
?>
