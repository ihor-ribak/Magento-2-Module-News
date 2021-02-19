<?php
/**
 * Ihor News
 */
namespace Ihor\News\Controller\Adminhtml\Story;

use Ihor\News\Api\StoryRepositoryInterface;
use Ihor\News\Model\StoryFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 *
 * Ihor News Backend Story Edit Controller.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Controller\Adminhtml\Stories
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ihor_News::story_save';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var StoryFactory
     */
    protected $storyFactory;

    /**
     * @var StoryRepositoryInterface
     */
    protected $storyRepository;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param StoryFactory $storyFactory
     * @param StoryRepositoryInterface $storyRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        StoryFactory $storyFactory,
        StoryRepositoryInterface $storyRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->storyFactory = $storyFactory;
        $this->storyRepository = $storyRepository;
    }

    /**
     * execute
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ihor_News::content_news_story');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('News'), __('News'));
        $resultPage->getConfig()->getTitle()->prepend(__('News Stories'));

        // get ID and prepare object
        $id = $this->getRequest()->getParam('story_id');
        try {
            if ($id) {
                // load the object
                $story = $this->storyRepository->getById($id);
                if (!$story || !$story->getId()) {
                    $this->messageManager->addErrorMessage(__('This story no longer exists.'));
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/');
                }
                $resultPage->addBreadcrumb(__('Edit Story'), __('Edit Story'));
            } else {
                $story = $this->storyFactory->create();
                $resultPage->addBreadcrumb(__('Add Story'), __('Add Story'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was an error when preparing the story.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        // build edit form
        $this->coreRegistry->register('ihor_news_story', $story);
        return $resultPage;
    }
}
