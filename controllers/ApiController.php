<?php

class ApiBridgeMagento_ApiController extends \Pimcore\Controller\Action\Frontend
{
    /**
     * pimcore api user name
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
    protected $apiModel;

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

        // init api
        $this->apiModel = new ApiBridgeMagento_Api();
    }

    /**
     * @return bool
     */
    protected function validateApiKey()
    {
        return $this->apiKey === $this->allParam['paramApiKey'];
    }

    /**
     * api gateway
     */
    public function gatewayAction()
    {
        $res = [];
        if (method_exists($this->apiModel, $this->allParam['paramCommand'])) {
            $res = $this->apiModel->{$this->allParam['paramCommand']}($this->allParam);
        }

        echo json_encode($res);
        die;
    }
}
