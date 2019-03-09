<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers;

use App\Lib\V2StatInterface;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
// use Swoft\View\Bean\Annotation\View;
// use Swoft\Http\Message\Server\Response;

/**
 * Class V2StatController
 * @Controller(prefix="/stat")
 * @package App\Controllers
 */
class V2StatController implements V2StatInterface
{
    /**
     * @RequestMapping(route="user/{type}/{direction}/{name}", method=RequestMethod::GET)
     * @return array
     */
    public function user(): array
    {
        return ['item0' => 0, 'item1' => 1, 'item2' => 2, 'item3' => 3];

    }

    /**
     * @RequestMapping(route="users/{name}", method=RequestMethod::GET)
     * @return array
     */
    public function users(): array
    {
        return ['item0' => 0, 'item1' => 1, 'item2' => 2, 'item3' => 3];

    }


    /**
     * 测试接口
     * @RequestMapping(route="/v2ray/test", method=RequestMethod::GET)
     *
     */
    public function test()
    {
        return self::getUsersLinkStat('proxy');
//        return GRPCController::getQueryStat(
//            GRPCController::init()->setQueryStatRequest('123', false));
    }

    public function getUserDownlinkStat(string $name): array
    {
        return GRPCController::getStat(
            GRPCController::init()->setStatRequest([3, $name, 2], false));
    }

    public function getUserUplinkStat(string $name): array
    {
        return GRPCController::getStat(
            GRPCController::init()->setStatRequest([3, $name, 1], false));
    }

    public function getUserLinkStat(string $name): array
    {
//        $stat = (float)substr(self::getUserDownlinkStat($name)[1], strlen(self::getUserDownlinkStat($name)[1]) - 3)
//            + (float)substr(self::getUserUplinkStat($name)[1], strlen(self::getUserUplinkStat($name)[1]) - 3);
        $stats = GRPCController::getQueryStat(
            GRPCController::init()->setQueryStatRequest($name, false)
        );
        $stat = 0;
        foreach ($stats as $item) {
            $stat += $item;
        }
        return [
            "name" => substr($key = array_keys($stats)[0], 0, strlen($key) - 9),
            "value" => $stat// . "MiB"
        ];
    }

    public function getUsersDownlinkStat(string $proxy): array
    {
        return GRPCController::getStat(
            GRPCController::init()->setStatRequest([3, $proxy, 2], false));
    }

    public function getUsersUplinkStat(string $proxy): array
    {
        return GRPCController::getStat(
            GRPCController::init()->setStatRequest([3, $proxy, 2], false));
    }

    public function getUsersLinkStat(string $proxy): array
    {
        $stats = GRPCController::getQueryStat(
            GRPCController::init()->setQueryStatRequest($proxy, false)
        );
        $stat = 0;
        foreach ($stats as $item) {
            $stat += $item;
        }
        return [
            "name" => substr($key = array_keys($stats)[0], 0, strlen($key) - 9),
            "value" => $stat// . "MiB"
        ];
    }


}
