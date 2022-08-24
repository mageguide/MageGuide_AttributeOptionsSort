<?php


namespace MageGuide\AttributeOptionsSort\Model\Sort;

use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Eav\Model\Config;


class Alphabetically
{

    /**
     * @var ProductAttributeRepositoryInterface
     */
    protected $_productAttributeRepository;

    /**
     * @var Config
     */
    protected $_eavConfig;

    public function __construct(
        ProductAttributeRepositoryInterface $productAttributeRepository,
        Config $eavConfig
    )
    {
        $this->_productAttributeRepository = $productAttributeRepository;
        $this->_eavConfig = $eavConfig;
    }

    public function sort($output,$name){
        try{
            $attribute = $this->_eavConfig->getAttribute('catalog_product', $name);
            $attr_options = $attribute->getSource()->getAllOptions();
            foreach ($attr_options as $key => $value) {
                $options[$value['label']] = $value['value'];
            }
            ksort($options);
            $sortOrder = 1;
            $sorted = [];
            foreach ($options as $option){
               $sorted[$option] = $sortOrder;
               $sortOrder++;
            }
            $attr = $this->_productAttributeRepository->get($name);
            $options = $attr->getOptions();
            $finalOptions = [];
            foreach ($options as $opt) {
                if($opt->getValue()){
                    if(array_key_exists($opt->getValue(),$sorted)){
                        $opt->setSortOrder($sorted[$opt->getValue()]);
                        array_push($finalOptions,$opt);
                    }

                }
            }
            $attr->setOptions($finalOptions);
            $this->_productAttributeRepository->save($attr);
        }catch (\Exception $e){
            $output->writeln($e->getMessage());
        }
    }
}