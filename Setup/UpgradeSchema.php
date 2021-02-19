<?php
/**
 * Ihor News
 */
namespace Ihor\News\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Psr\Log\LoggerInterface;

/**
 * Class UpgradeSchema
 *
 * Ihor News SQL Upgrade Script.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * UpgradeSchema constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // updates between 1.0.0 and 1.0.2
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->logger->info('Ihor_News: updating to the version 1.0.2');
            $this->addIndexesToEntities($setup);
        }

        $setup->endSetup();
    }

    /**
     * addIndexesToEntities
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addIndexesToEntities(SchemaSetupInterface $setup)
    {
        try {
        
            // adds story index to be used on fulltext search
            $setup->getConnection()->addIndex(
                $setup->getTable('ihor_news_story'),
                $setup->getConnection()->getIndexName(
                    $setup->getTable('ihor_news_story'),
                    ['title', 'content'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['title', 'content'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
        return $this;
    }
}
