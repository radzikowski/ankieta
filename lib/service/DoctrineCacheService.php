<?php
class DoctrineCacheService
{
	public static function deleteCache($key)
	{
		$cacheDriver = Doctrine_Manager::getInstance()->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
		$cacheDriver->delete($key, 0);
	}
}