<?php
class LogsService
{

    public static function getInstance($e)
    {
        $log = self::_getLog();
        $log['details'] = $e->getMessage() . ' | Line:' . $e->getLine() . ' | Code: ' . $e->getCode() . ' Track: ' . $e->getTraceAsString();
        return $log;
    }

    private static function _getLog()
    {
        try
        {
            return new Logs();
        }
        catch (Exception $e)
        {
            throw new Exception('Problem with Logs class | '.$e->getMessage());
        }
    }
}
?>
