<?php

namespace App\BlockExplorer;

/**
 * Fetch block information from altcoin/bitcoin deamon
 *
 * @author Lukas Mestan
 * @copyright MIT
 * @see https://en.bitcoin.it/wiki/Original_Bitcoin_client/API_calls_list
 * @version 1.1.2
 */
class BlockChain extends DaemonData
{

    /**
     * Get data for the specified block hash
     *
     * @access public
     * @param string $blockHash
     * @return array
     */
    public function getBlock($blockHash)
    {
        return $this->getData('getblock', array(
            $blockHash
        ));
    }

    /**
     * Get hash of the best (tip) block in the longest block chain.
     *
     * @access public
     * @internal from bitcoin version 0.9
     * @return array
     */
    public function getBestBlockHash()
    {
        return $this->getData('getbestblockhash');
    }

    /**
     * Returns the number of blocks in the longest block chain
     *
     * @access public
     * @return array
     */
    public function getBlockCount()
    {
        return $this->getData('getblockcount');
    }

    /**
     * Get hash value for the specified block in the chain
     *
     * @access public
     * @param string $blockIndex
     * @return array
     */
    public function getBlockHash($blockIndex)
    {
        return $this->getData('getblockhash', array(
            $blockIndex
        ));
    }

}
