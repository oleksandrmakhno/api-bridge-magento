<?php

class ApiBridgeMagento_ApiController extends \Pimcore\Controller\Action\Frontend
{
    /**
     * @var
     */
    protected $apiKey;

    /**
     * @var
     */
    protected $apiKeyClient;

    /**
     * @var
     */
    protected $allParam;

    public function init()
    {
        $this->allParam = $this->getAllParams();
        //var_dump($this->allParam);

        // set api key
        if (!isset($this->apiKey) && isset($this->allParam['apiKey'])) {
            $this->apiKey = $this->apiKeyClient;
        }

        if (!$this->validateApiKey()) {
            die; // no any error info provided
        }
    }

    protected function validateApiKey()
    {
        return true; // TODO add api key validation
    }

    /**
     * api gateway
     */
    public function gatewayAction()
    {
        $res = [];
        if (method_exists($this, $this->allParam['commandName'])) {
            $res = $this->{$this->allParam['commandName']}($this->allParam['sku']);
        }

        echo json_encode($res);
        die;
    }

    /**
     * @param array $scheme
     * @param $ob
     * @return array
     */
    protected function applyData(array $scheme, $ob)
    {
        $res = [];
        foreach ($scheme as $key => $value) {
            $getter = 'get' . ucfirst($key);
            $res[$key] = $ob->$getter();
        }

        return $res;
    }

    /**
     * @param $sku
     * @return array
     */
    protected function getProduct($sku)
    {
        // list needed fields here
        $res = [
            'sku' => $sku,
            'info' => '',
        ];

        $list = new \Pimcore\Model\Object\MagentoBaseProduct\Listing();
        $list->setCondition("o_type = 'object' and o_className = 'MagentoBaseProduct' and sku='$sku'");
        $ob = array_pop($list->getObjects());

        return $this->applyData($res, $ob);
    }
}
