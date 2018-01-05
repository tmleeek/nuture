<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-report
 * @version   1.2.27
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\Report\Model\Query\Column\Date;

use Magento\Framework\ObjectManagerInterface;
use Mirasvit\Report\Model\Config\Map;
use Mirasvit\Report\Model\Query\Column;
use Mirasvit\Report\Api\Repository\MapRepositoryInterface;

class Hour extends Column
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        MapRepositoryInterface $mapRepository,
        $name,
        $data = []
    ) {
        parent::__construct($filterBuilder, $mapRepository, $name, $data);
        $this->dataType = false;
        $this->setExpression('HOUR(%1)');
    }

    /**
     * @param string $value
     * @return string
     */
    public function prepareValue($value)
    {
        if (strlen($value) == 1) {
            $value = '0' . $value;
        }

        return $value . ':00';
    }
}
