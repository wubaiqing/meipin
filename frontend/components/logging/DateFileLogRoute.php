<?php
/**
 *
 *
 * @author qixiaopeng <qixiaopeng@55tuan.com>
 */
class DateFileLogRoute extends CLogRoute
{
	/**
	 * @var string directory storing log files
	 */
	private $_logPath;

	public $logFilepath = '';

	public $logFilename = 'error';

	/**
	 * Initializes the route.
	 * This method is invoked after the route is created by the route manager.
	 */
	public function init()
	{
		parent::init();
		if($this->getLogPath()===null)
			$this->setLogPath();
	}

	/**
	 * @return string directory storing log files. Defaults to application runtime path.
	 */
	public function getLogPath()
	{
		return $this->_logPath;
	}

	/**
	 * @param string $value directory for storing log files.
	 * @throws CException if the path is invalid
	 */
	public function setLogPath($value='')
	{
		$path = Yii::app()->runtimePath . DIRECTORY_SEPARATOR . 'dayLog';
		if (!is_dir($path))
		{
			mkdir($path);
		}
		if (!empty($this->logFilepath))
		{
			$path .= DIRECTORY_SEPARATOR . $this->logFilepath;
		}
		if (!is_dir($path))
		{
			mkdir($path);
		}
		$this->_logPath = $path;
		if($this->_logPath===false || !is_dir($this->_logPath) || !is_writable($this->_logPath))
			throw new CException(Yii::t('yii','CFileLogRoute.logPath "{path}" does not point to a valid directory. Make sure the directory exists and is writable by the Web server process.',
				array('{path}'=>$value)));
	}

	/**
	 * @return string log file name. Defaults to 'application.log'.
	 */
	public function getLogFile()
	{
		return $this->logFilename . "_" . date('Y-m-d') . ".log";
	}

	/**
	 * Saves log messages in files.
	 * @param array $logs list of log messages
	 */
	protected function processLogs($logs)
	{
		$logFile=$this->getLogPath().DIRECTORY_SEPARATOR.$this->getLogFile();
		$fp=@fopen($logFile,'a');
		@flock($fp,LOCK_EX);
		foreach($logs as $log)
			@fwrite($fp,$this->formatLogMessage($log[0],$log[1],$log[2],$log[3]));
		@flock($fp,LOCK_UN);
		@fclose($fp);
	}
}