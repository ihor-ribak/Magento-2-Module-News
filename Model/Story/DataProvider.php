<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model\Story;

use Ihor\News\Helper\Data;
use Ihor\News\Model\ResourceModel\Story\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 *
 * Ihor News Story Data Provider.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model\Story
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Ihor\News\Model\ResourceModel\Story\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param Data $helper
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        Data $helper,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * prepareMeta
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * getData
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        // prepare media url
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $thumbnailUrl = $mediaUrl . $this->helper->getConfigData('images_uploader/folder');

        /** @var $item \Ihor\News\Model\Story */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();

            if ($item->getThumbnailPath()) {
                $it['thumbnail_path'][0]['name'] = $item->getThumbnailPath();
                $it['thumbnail_path'][0]['url'] = $thumbnailUrl . $item->getThumbnailPath();
                $this->loadedData[$item->getId()] = array_merge($this->loadedData[$item->getId()], $it);
            }
        }

        $data = $this->dataPersistor->get('ihor_news_story');
        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($data);
            $this->loadedData[$item->getId()] = $item->getData();
            $this->dataPersistor->clear('ihor_news_story');
        }

        return $this->loadedData;
    }
}
