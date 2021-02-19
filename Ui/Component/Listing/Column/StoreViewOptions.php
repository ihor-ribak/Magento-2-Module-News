<?php
/**
 * Ihor News
 */
namespace Ihor\News\Ui\Component\Listing\Column;

use Magento\Store\Ui\Component\Listing\Column\Store\Options;

/**
 * Class StoreViewOptions
 *
 * Ihor News Store View Options Component.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Ui\Component\Listing\Column
 */
class StoreViewOptions extends Options
{
    /**
     * ALL_STORE_VIEWS
     */
    const ALL_STORE_VIEWS = '0';

    /**
     * toOptionArray
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->currentOptions['All Store Views']['label'] = __('All Store Views');
        $this->currentOptions['All Store Views']['value'] = self::ALL_STORE_VIEWS;

        $this->generateCurrentOptions();
        $this->options = array_values($this->currentOptions);
        return $this->options;
    }
}
