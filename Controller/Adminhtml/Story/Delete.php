<?php
/**
 * Ihor News
 */
namespace Ihor\News\Controller\Adminhtml\Story;

use Ihor\News\Api\StoryRepositoryInterface;
use Ihor\News\Model\StoryFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * Class Delete
 *
 * Ihor News Backend Story Delete Controller.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Controller\Adminhtml\Stories
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ihor_News::story_delete';

    /**
     * @var StoryFactory
     */
    protected $storyFactory;

    /**
     * @var StoryRepositoryInterface
     */
    protected $storyRepository;

    /**
     * Delete constructor.
     * @param Context $context
     * @param StoryFactory $storyFactory
     * @param StoryRepositoryInterface $storyRepository
     */
    public function __construct(
        Context $context,
        StoryFactory $storyFactory,
        StoryRepositoryInterface $storyRepository
    ) {
        parent::__construct($context);
        $this->storyFactory = $storyFactory;
        $this->storyRepository = $storyRepository;
    }

    /**
     * execute
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        // get ID and prepare object
        $id = $this->getRequest()->getParam('story_id');
        if (!$id) {
            $this->messageManager->addErrorMessage(__('There was an error when processing the request.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        try {
            // load the object
            $story = $this->storyRepository->getById($id);
            if (!$story || !$story->getId()) {
                $this->messageManager->addErrorMessage(__('This story no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }

            // delete the object
            $this->storyRepository->delete($story);

            // set success message
            $this->messageManager->addSuccessMessage(__('The story has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was an error when preparing the story.'));
            $resultRedirect = $this->resultRedirectFactory->create();
        }
        return $resultRedirect->setPath('*/*/');
    }
}
