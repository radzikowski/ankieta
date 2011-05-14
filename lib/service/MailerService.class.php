<?php
class MailerService
{
	public static function sendEmail($from, $to, $subject, $body)
	{	
		$mailer = MailerService::getMailer();
		$message = $mailer->compose();
		$message->setSubject($subject);
		$message->setTo($to);
		$from = MailerService::prepareEmailAddress($from);
		$message->setFrom($from[1], $from[0]);
		$message->setBody($body, 'text/html');

		$mailer->send($message);
		
		error_log($to.' - '.$subject);
	}
	
	public static function getMailer()
	{
		return sfContext::getInstance()->getMailer();
	}
	
	/**
	 * function is responsible for receiving e-mail address in the form of Paweł Mikolajczuk 
	 * <p.mikolajczuk@creativeapps.pl> and only p.mikolajczuk@creativeapps.pl
	 * @param $address
	 * @return $data with email address
	 */
	private static function prepareEmailAddress($address)
	{
		if(strpos($address, '<'))
		{
			$temp = explode('<', $address);
			$data = array(
				$temp[0], 
				str_replace('>','', $temp[1])
			);
		}
		else
		{
			$data = array(
				null, 
				$address
			);
		}
		return $data;
	}
}