<?php

class ApiBridgeMagento_ApiController extends \Pimcore\Controller\Action\Frontend
{
    /**
     * api user name
     *
     * @var string
     */
    protected $userApiBridgeMagento = 'api-bridge-magento';

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

        // set api key
        $this->apiKey = isset($this->apiKey) ? $this->apiKey : \Pimcore\Model\User::getByName($this->userApiBridgeMagento)->getApiKey();

        if (!$this->validateApiKey()) {
            die; // no any error info provided
        }
    }

    /**
     * @return bool
     */
    protected function validateApiKey()
    {
        return $this->apiKey === $this->allParam['apiKey'];
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
        foreach ($scheme as $key) {
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
            'sku',
            'info',
        ];

        // fetch data logic
        $list = new \Pimcore\Model\Object\MagentoBaseProduct\Listing();
        $list->setCondition("o_type = 'object' and o_className = 'MagentoBaseProduct' and sku = '$sku'");
        $ob = array_pop($list->getObjects());

        return $this->applyData($res, $ob);
    }
}
