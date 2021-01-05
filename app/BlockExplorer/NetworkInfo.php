<?php

namespace App\BlockExplorer;

/**
 * Fetch network/wallet information from altcoin/bitcoin deamon
 *
 * @author Lukas Mestan
 * @copyright MIT
 * @see https://en.bitcoin.it/wiki/Original_Bitcoin_client/API_calls_list
 * @version 1.1.2
 */
class NetworkInfo extends DaemonData
{

    /**
     * Get information about the wallets network and block chain
     *
     * @access public
     * @return array
     */
    public function getInfo()
    {
        return $this->getData('getinfo');
    }

    public function getAddressBal($add)
    {
      
       return $this->getData("getreceivedbyaddress",array(
        $add,1
       ));
      
    }

    /**
     * Get data about each connected node.
     *
     * @access public
     * @internal from bitcoin version 0.7
     * @return array
     */
    public function getPeerInfo()
    {
        return $this->getData('getpeerinfo');
    }

    /**
     * Returns an object containing mining-related information:
     * blocks, currentblocksize, currentblocktx, difficulty, errors,
     * generate, genproclimit, hashespersec, pooledtx, testnet
     *
     * @access public
     * @return array
     */
    public function getMiningInfo()
    {
        return $this->getData('getmininginfo');
    }

    /**
     * Returns a recent hashes per second performance measurement while generating
     *
     * @access public
     * @return array
     */
    public function getHashesPerSecond()
    {
        return $this->getData('gethashespersec');
    }

    /**
     * Get calculated network hash rate for the latest block
     *
     * @access public
     * @param string $blockIndex
     * @return array
     */
    public function getNetworkHashForLatestBlock($blockIndex = NULL)
    {
        if( isset($blockIndex) )
        {
            return $this->getData('getnetworkhashps', array(
                $blockIndex
            ));
        }

        return $this->getData('getnetworkhashps');
    }
    public function getnewAddress($account = NULL)
    {
        if( isset($account) )
        {
            return $this->getData('getnewaddress', array(
                $account
            ));
        }

        return $this->getData('getnewaddress');
    }
   
    public function getBalance($account = NULL)
    {
        if( isset($account) )
        {
            return $this->getData('getbalance', array(
                $account
            ));
        }

        return $this->getData('getbalance');
    }
     public function callCoin($fn,$array)
    {
        if( count($array)==0)
        {
            return $this->getData($fn);
        }
        else if( count($array)==1)
        {
            return $this->getData($fn, array(
                $array[0]
            ));
        }
        else if( count($array)==2)
        {
            return $this->getData($fn, array(
                $array[0],$array[1]
            ));
        }
         else if( count($array)==3)
        {
            return $this->getData($fn, array(
                $array[0],$array[1],$array[2]
            ));
        }
         else if( count($array)==4)
        {
            return $this->getData($fn, array(
                $array[0],$array[1],$array[2],$array[3]
            ));
        }
          else if( count($array)==5)
        {
            return $this->getData($fn, array(
                $array[0],$array[1],$array[2],$array[3],$array[4]
            ));
        }
        else if( count($array)==6)
        {
            return $this->getData($fn, array(
                $array[0],$array[1],$array[2],$array[3],$array[4],$array[5]
            ));
        }
        else

        {
            return $this->getData($fn, array(
                $array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6]
            ));
        }
        
    }
}
