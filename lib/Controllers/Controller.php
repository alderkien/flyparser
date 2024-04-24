<?php
namespace Controllers;

use Config\Config;

use Parser\Parser;
use Models\Food;

class Controller
{
    private $config;

    public function __construct()
    {
        $this->config = Config::getInstance();
    }
    public function execute()
    {
        $config = $this->config;

        if(!empty($_POST['url'])) {
            $parser = new Parser($config->getVar('TARGET_SITE'));
            $data = $parser->getFoodData($_POST['url']);

            $foods = [];

            foreach ($data as $d) {
                $foods[] = new Food($d['title'], $d['price'], $d['pic'], $d['description']);
            }

            if(isset($_POST['as_json'])) {
                return $this->renderJson($config, $foods);
            } else if (isset($_POST['as_table'])){
                return $this->renderTable($config, $foods);
            } 
        } else {
            return $this->renderIndex($config);
        }
    }

    public function renderIndex($config)
    {
        include __DIR__.'/../../views/header.php';
        include __DIR__.'/../../views/_form.php';
        include __DIR__.'/../../views/footer.php';
    }

    public function renderTable($config, $foods)
    {
        include __DIR__.'/../../views/header.php';
        include __DIR__.'/../../views/_form.php';
        include __DIR__.'/../../views/_result.php';
        include __DIR__.'/../../views/footer.php';
    }

    public function renderJson($config, $foods)
    {
        header('Content-Type: application/json');
        echo json_encode($foods);
    }



}
?>