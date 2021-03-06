<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine {

  public $em = null;
  
  /**
   * Enabled doctrine connection with database/
   */
  public function __construct()
  {
    // load database configuration from CodeIgniter
    require_once APPPATH.'config/database.php';

    // Set up class loading. You could use different autoloaders, provided by your favorite framework,
    // if you want to.
    require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

    $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
    $doctrineClassLoader->register();
    $entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
    $entitiesClassLoader->register();
    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
    $proxiesClassLoader->register();

    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
    $config->setMetadataDriverImpl($driverImpl);
    $config->setQueryCacheImpl($cache);

    $config->setQueryCacheImpl($cache);

    // Proxy configuration
    $config->setProxyDir(APPPATH.'/models/proxies');
    $config->setProxyNamespace('Proxies');

    // Set up logger
    // $logger = new EchoSQLLogger;
    // $config->setSQLLogger($logger);
    $config->addEntityNamespace("Entity", "models\Entities");
    $config->setAutoGenerateProxyClasses( TRUE );

    // Database connection information
    $connectionOptions = array(
        'driver' => 'pdo_mysql',
        'user' =>     $db['default']['username'],
        'password' => $db['default']['password'],
        'host' =>     $db['default']['hostname'],
        'dbname' =>   $db['default']['database']
    );

    // Create EntityManager
    $this->em = EntityManager::create($connectionOptions, $config);
  }
  
  /**
   * Generates database.
   */
  public function generateDatabase(){
      $em = $this->em;
	    $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        
      $classes = array(
          $em->getClassMetadata("Entity:User"),  
          $em->getClassMetadata("Entity:Story"),
          $em->getClassMetadata("Entity:Category"),
          $em->getClassMetadata("Entity:Comment"),
          $em->getClassMetadata("Entity:Image"),
          $em->getClassMetadata("Entity:Tag"),
          $em->getClassMetadata("Entity:Page"),
          $em->getClassMetadata("Entity:Slide")
      );
      $tool->updateSchema($classes);
      exit("done");
  }
}