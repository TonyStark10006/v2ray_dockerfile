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
 * @Controller(prefix="/v2Stat")
 * @package App\Controllers
 */
class V2StatController implements V2StatInterface
{
    /**
     * this is a example action. access uri path: /v2Stat
     * @RequestMapping(route="/v2Stat", method=RequestMethod::GET)
     * @return array
     */
    public function index(): array
    {
        return ['item0' => 0, 'item1' => 1, 'item2' => 2, 'item3' => 3];

    }

    /**
     * @param string $id
     * @return array
     */
    public function getUserDownlinkStat(string $id): array
    {

    }

    public function getUserUplinkStat(string $id): array
    {
        // TODO: Implement getUserUplinkStat() method.
    }

    public function getUsersDownlinkStat(): array
    {
        // TODO: Implement getUsersDownlinkStat() method.
    }

    public function getUsersUplinkStat(): array
    {
        // TODO: Implement getUsersUplinkStat() method.
    }
}
