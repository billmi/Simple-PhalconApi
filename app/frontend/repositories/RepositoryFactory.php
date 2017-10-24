<?php


namespace Marser\App\Frontend\Repositories;

class RepositoryFactory
{
    private static $_spaceName = "Repository";

    private static $_repositories = array();

    public static function get_repository($repositoryName)
    {
        $repositoryName = __NAMESPACE__ . "\\" . ucfirst($repositoryName) . self::$_spaceName;
        if (!class_exists($repositoryName)) {
            throw new \Exception("{$repositoryName}类不存在");
        }
        if (!isset(self::$_repositories[$repositoryName]) || empty(self::$_repositories[$repositoryName])) {
            self::$_repositories[$repositoryName] = new $repositoryName();
        }
        return self::$_repositories[$repositoryName];
    }
}
