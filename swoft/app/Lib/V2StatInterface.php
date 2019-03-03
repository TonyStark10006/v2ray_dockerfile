<?php
namespace App\Lib;

/**
 * Interface V2RayStatInterface
 * @package App\Lib
 */
interface V2StatInterface
{
    /**
     * @param string $id
     * @return array
     */
    public function getUserDownlinkStat(string $id) : array ;

    /**
     * @param string $id
     * @return array
     */
    public function getUserUplinkStat(string $id) : array ;

    /**
     * @return array
     */
    public function getUsersDownlinkStat() : array ;

    /**
     * @return array
     */
    public function getUsersUplinkStat() : array ;
}
