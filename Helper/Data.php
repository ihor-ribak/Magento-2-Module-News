<?php
/**
 * Ihor News
 */
namespace Ihor\News\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 *
 * Ihor News Main Helper.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Helper
 */
class Data extends AbstractHelper
{
    /**
     * getConfigData
     * @param string $path
     * @param string $scope
     * @return mixed
     */
    public function getConfigData($path, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'ihor_news/' . $path,
            $scope
        );
    }

    /**
     * isEnabled
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->getConfigData('general/enabled');
    }

    /**
     * getAllowedFiles
     * @return array
     */
    public function getAllowedFiles()
    {
        $allowedFiles = $this->getConfigData('images_uploader/allowed_files');
        return explode(',', $allowedFiles);
    }
}
