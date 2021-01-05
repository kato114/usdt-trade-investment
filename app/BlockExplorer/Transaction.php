<?php

namespace App\BlockExplorer;

/**
 * Fetch transactions information from altcoin/bitcoin deamon
 *
 * @author Lukas Mestan
 * @copyright MIT
 * @see https://en.bitcoin.it/wiki/Original_Bitcoin_client/API_calls_list
 * @version 1.1.2
 */
class Transaction extends DaemonData
{

    /**
     * Get an object about the given transaction
     *
     * @access public
     * @param string $txId
     * @return array
     */
    public function getTransaction($txId)
    {
        return $this->getData('gettransaction', array(
            $txId
        ));
    }

    /**
     * Get block hash value for the specified block in the chain
     *
     * @access public
     * @internal from bitcoin version 0.7
     * @param string $txId
     * @param integer|string $verbose
     * @return array
     */
    public function getRawTransaction($txId, $verbose = 1)
    {
        return $this->getData('getrawtransaction', array(
            $txId,
            $verbose
        ));
    }

}
