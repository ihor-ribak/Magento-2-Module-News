<?php
/**
 * Ihor News
 */
namespace Ihor\News\Controller\Story;

use Ihor\News\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class View
 *
 * Ihor News Story View Controller.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Controller\Story
 */
class View extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var $helper
     */
    protected $helper;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $helper
    ) {
        $this->pageFactory = $pageFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        // // verify if this module is enabled and redirect to home
        // if (!$this->helper->isEnabled()) {
        //     return $this->_redirect('/');
        // }

        // create page and adds a title
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set((__('News | Story')));
        return $page;
    }
}
