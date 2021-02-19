<?php
/**
 * Ihor News
 */
namespace Ihor\News\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

/**
 * Class InstallSchema
 *
 * Ihor News SQL Installer.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * InstallSchema constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    /**
     * install
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // start the setup process
        $setup->startSetup();

        // prepare the table for the entity "story"
        $tableStory = $setup->getConnection()->newTable($setup->getTable('ihor_news_story'));

        // create columns
        try {
            $tableStory->addColumn(
                'story_id',
                Table::TYPE_INTEGER,
                null,
                array('nullable' => false, 'identity' => true, 'primary' => true),
                'News Story ID'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                128,
                array('nullable' => false),
                'News Story Title'
            )->addColumn(
                'thumbnail_path',
                Table::TYPE_TEXT,
                128,
                array('nullable' => true),
                'News Story Thumbnail Path'
            )->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                array('nullable' => false),
                'News Story Content'
            )->addColumn(
                'status',
                Table::TYPE_BOOLEAN,
                null,
                array('nullable' => false, 'default' => 0),
                'News Story Status'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                array('default' => Table::TIMESTAMP_INIT),
                'News Story Created At'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                array('default' => Table::TIMESTAMP_INIT_UPDATE),
                'News Story Updated At'
            )->setComment('Ihor News Stories');
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }

        // create tables
        try {
            $setup->getConnection()->createTable($tableStory);
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }

        // end the setup process
        $setup->endSetup();
    }
}
