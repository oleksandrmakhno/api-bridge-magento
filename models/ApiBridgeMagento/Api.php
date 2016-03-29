<?php

class ApiBridgeMagento_Api
{
    /**
     * @var string
     */
    protected $commandPrefix = 'command';

    /**
     * @var string
     */
    protected $magentoBaseProductClass = 'MagentoBaseProduct';

    /**
     * @var string
     */
    protected $pimcoreObjectType = 'object'; 

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
     * all api command list available shown in magento
     *
     * @param array $param
     * @return array
     */
    public function commandGetApiCommandList(array $param)
    {
        $res = [];

        foreach (get_class_methods($this) as $item) {
            if (mb_substr($item, 0, mb_strlen($this->commandPrefix)) == $this->commandPrefix) {
                $res[] = $item;
            }
        }

        return $res;
    }

    /**
     * @param array $param
     * @return array
     */
    public function commandGetProduct(array $param)
    {
        // list needed fields here
        $res = [
            'sku',
            'info',
            'imageMain', 
        ];

        // fetch data logic
        $list = new \Pimcore\Model\Object\MagentoBaseProduct\Listing();
        $list->setCondition("o_type = '{$this->pimcoreObjectType}' and o_className = '{$this->magentoBaseProductClass}' and sku = '{$param['paramSku']}'");
        $ob = array_pop($list->getObjects());

        return $this->applyData($res, $ob);
    }

    // TODO please add new api commands here
}
