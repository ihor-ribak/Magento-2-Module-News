<?php
/**
 * Ihor News
 */
namespace Ihor\News\Controller\Adminhtml\Story;

use Ihor\News\Model\Story;
use Ihor\News\Model\ResourceModel\Story as ResourceModel;
use Ihor\News\Model\ResourceModel\Story\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;

/**
 * Class MassEnable
 *
 * Ihor News Story Controllers.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Controlle\Adminhtml
 */
class MassEnable extends Action
{
    /**
     * ADMIN_RESOURCE
     */
    const ADMIN_RESOURCE = 'Ihor_News::story_save';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * MassEnable constructor.
     * @param Context $context
     * @param Filter $filter
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Filter $filter,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger
    ) {
        $this->filter = $filter;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * execute
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            throw new \Exception($e);
        }

        /** @var Story $item */
        foreach ($collection as $item) {
            try {
                $item->setStatus(true);
                $this->resourceModel->save($item);
            } catch (\Exception $e) {
                $this->logger->critical($e);
                throw new \Exception($e);
            }
        }

        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been enabled.', $collection->getSize())
        );

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
