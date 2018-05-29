<?
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

Loc::loadMessages(__FILE__);

if (class_exists('tests_randomuser'))
{
	return;
}


class tests_randomuser extends \CModule
{
	public $MODULE_ID = 'tests.randomuser';
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_GROUP_RIGHTS;
	public $PARTNER_NAME;
	public $PARTNER_URI;


	function __construct()
	{
		$arModuleVersion = [];
		include('version.php');

		$this->MODULE_NAME = GetMessage('TESTS_RANDOMUSER_MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('TESTS_RANDOMUSER_MODULE_DESCRIPTION');
		$this->MODULE_GROUP_RIGHTS = 'N';
		$this->MODULE_VERSION = $arModuleVersion['VERSION'];
		$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
	}


	public function DoInstall()
	{
		global $USER;

		if ($USER->IsAdmin())
		{
			ModuleManager::registerModule($this->MODULE_ID);
            $this->InstallDB();
            //$this->InstallFiles();
		}
	}


	public function DoUninstall()
	{
		global $USER;

		if ($USER->IsAdmin())
		{
			ModuleManager::unRegisterModule($this->MODULE_ID);
            $this->UnInstallDB();
            //$this->UnInstallFiles();
		}
	}


    function InstallFiles()
    {
        CopyDirFiles(
            Application::getDocumentRoot() . getLocalPath("modules/{$this->MODULE_ID}/install/components/"),
            Application::getDocumentRoot() . "/bitrix/components/",
            true, true
        );
        return true;
    }

    function UnInstallFiles()
    {
        Directory::deleteDirectory(Application::getDocumentRoot() . "/bitrix/components/tests.randomuser/");
        return true;
    }

    function getDBFilePatch($file,$DBType)
    {
        $filePatch = "";
        $filePatch .= Application::getDocumentRoot();
        $filePatch .= getLocalPath("modules/{$this->MODULE_ID}/install/db/".$DBType."/".$file);
        return $filePatch;
    }

    function runSqlFile($file)
    {
        $connection = Application::getConnection();
        $file=new File($this->getDBFilePatch($file,$connection->getType()));
        $connection->executeSqlBatch($file->getContents());
    }

    function InstallDB()
    {
        $this->runSqlFile("install.sql");
        return true;
    }

    function UnInstallDB()
    {
        $this->runSqlFile("uninstall.sql");
        return true;
    }
}
