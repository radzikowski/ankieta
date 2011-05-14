<?php
class UserService
{
	public static function getUserFriendsIdsArray($user)
	{
		if(is_object($user) && get_class($user) == 'Doctrine_Record')
			$user->toArray();
			
		$friends = (array)json_decode($user['friends']);
		$friendsIds = array();
		foreach($friends['data'] as $friend)
		{
			$friend = (array)$friend;
			$friendsIds[] = $friend['id'];
		}
		return $friendsIds;
	}
	
	public static function getUserPicturesArray($userEditions)
	{
		if(is_object($userEditions) && get_class($userEditions) == 'Doctrine_Record')
			$editionPictures = $userEditions->toArray();
			
		return (array)json_decode($userEditions['edition_pictures'], true);	
	}
	
    public static function getLeftPictures($userEditions)
    {
    	if(!$userEditions || $userEditions['edition_pictures'] == null)
			return 1;
			
		$editionPicturesArray = UserService::getUserPicturesArray($userEditions);
		$number = ($userEditions['invited_friends_count'] +1) - count($editionPicturesArray);
		if($number >= 0)
			return $number;
		else
			return 0;
    }
}
