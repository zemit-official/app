<?php

namespace Zemit\Backend;

use Zemit\Tag;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * @author Julien Turbide <jturbide@nuagerie.com>
 * @version 1.0.0
 */
class Module implements ModuleDefinitionInterface {
    
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null) {
        $loader = new Loader();
        $config = $di['config'];
    
        $loader->registerNamespaces(array(
            'Zemit\\Backend\\Controllers' => $config->application->modulesDir . 'backend/controllers/',
            'Zemit\\Api\\Controllers' => $config->application->modulesDir . 'api/controllers/',
            'Zemit\\Api\\Models' => $config->application->modelsDir,
            'Zemit' => $config->application->libraryDir . 'Zemit/',
            'jTurbide' => $config->application->libraryDir . 'jTurbide/',
        ), true);
    
        $loader->registerFiles([
            $config->application->vendorDir . 'autoload.php'
        ]);
    
        $loader->register();
        
        $di['loader'] = $loader;
    }
    
    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di) {
        $config = $di['config'];
        
        $di['url']->setBaseUri('/');
        $di['url']->setStaticBaseUri('/backend/');
        
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            return $view;
        };
        
        $router = $di['router'];
        $router->setDefaults(array('namespace' => 'Zemit\\Backend\\Controllers', 'controller' => 'index', 'action' => 'index'));
        $router->notFound(array('controller' => 'errors', 'action' => 'notFound'));
        $router->removeExtraSlashes(true);
        $di['router'] = $router;
    }
    
}