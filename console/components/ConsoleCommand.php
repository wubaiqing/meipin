<?php
/**
 * 命令行应用的基类
 */
class ConsoleCommand extends CConsoleCommand
{
    public $pidFile = '';

    public function init()
    {
        parent::init();
    }

    private $logs = array();

    public function setPidFile()
    {
        $pid = getmypid();
        if (empty($pid)) {
            return;
        }
        @file_put_contents($this->pidFile, $pid);
    }

    /**
     * 记录日志
     * @param string $message
     */
    public function trace($message, $time = true, $n = true)
    {
        $log = "";
        if ($time == true) {
            $log = date('Y/m/d H:i:s') . " ";
        }
        $log .= $message;
        if ($n == true) {
            $log .= "\n";
        }
        $this->logs[] = $log;
        if ($this->traceEcho) {
            echo $log;
        }
    }
}
