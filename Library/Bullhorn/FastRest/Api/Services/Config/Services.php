<?php
namespace Bullhorn\FastRest\Api\Services\Config;
use Bullhorn\FastRest\Api\Services\Model\Manager as ModelsManager;
use Bullhorn\FastRest\Api\Services\Database\Connections;
use Bullhorn\FastRest\DependencyInjection;
use Phalcon\Config;
use Phalcon\Di\InjectionAwareInterface;

class Services implements InjectionAwareInterface {
    use DependencyInjection;

    /**
     * initialize
     * @param Config $config
     * @return void
     */
    public function initialize(Config $config) {
        $di = $this->getDi();

        $di->setShared(
            Connections::DI_NAME,
            function() {
                return new Connections();
            }
        );


        $this->getDi()->setShared(
            'modelsManager',
            function() {
                return new ModelsManager();
            }
        );

        $this->addApiConfig();
    }

    /**
     * addApiConfig
     * @return void
     */
    private function addApiConfig() {
        $this->getDi()->setShared(ApiConfig::DI_NAME, new ApiConfig());
    }
}