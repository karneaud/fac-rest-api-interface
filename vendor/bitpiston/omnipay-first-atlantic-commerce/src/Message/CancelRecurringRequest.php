<?php

namespace Omnipay\FirstAtlanticCommerce\Message;

use Omnipay\FirstAtlanticCommerce\Message\TransactionModificationResponse as Response;
/**
 * FACPG2 Cancel Recurring Request
 *
 * Required Parameters:
 * transactionId - Corresponds to the merchant's transaction ID
 * amount - eg. "10.00"
 */
class CancelRecurringRequest extends AbstractTransactionModificationRequest
{
    /**
     * Flag as a Cancel Recurring
     *
     * @var int;
     */
    protected $modificationType = 4;
    
    /**
     * Return the transaction modification response object
     *
     * @param \SimpleXMLElement $xml Response xml object
     *
     * @return ResponseInterface
     */
    protected function newResponse($xml)
    {
        return new Response($this, $xml);
    }
}
