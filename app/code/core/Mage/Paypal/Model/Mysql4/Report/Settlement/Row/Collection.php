<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Paypal
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 *
 * Resource collection for report rows
 *
 */
class Mage_Paypal_Model_Mysql4_Report_Settlement_Row_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Resource initializing
     */
    protected function _construct ()
    {
        $this->_init('paypal/report_settlement_row');
    }

    /**
     * Join reports info table
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()
            ->join(
                array('report' => $this->getTable('paypal/settlement_report')),
                'report.report_id = main_table.report_id',
                array('report.account_id', 'report.report_date')
            );
        return $this;
    }

    /**
     * Filter items collection by account ID
     *
     * @param string $accountID The account hash as returned by paypal
     * @return Mage_Paypal_Model_Mysql4_Report_Settlement_Row_Collection
     */
    public function addAccountFilter($accountId)
    {
        $this->getSelect()->where('report.account_id = ?', $accountId);
        return $this;
    }
}
