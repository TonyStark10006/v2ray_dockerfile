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

use App\Lib\GRPCInterface;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

// use Swoft\View\Bean\Annotation\View;
// use Swoft\Http\Message\Server\Response;

use V2ray\Core\App\Stats\Command\StatsServiceClient;
use V2ray\Core\App\Stats\Command\GetStatsRequest;

/**
 * Class GRPCController
 * @Controller(prefix="/gRPC")
 * @package App\Controllers
 */
class GRPCController implements GRPCInterface
{
    /**
     * @var $connection
     * v2ray gRPC连接
     */
    protected static $connection;

    /**
     * @var
     */
    protected static $instance;

    /**
     * @return GRPCController
     * 初始化连接信息
     */
    public static function init() : self
    {
        if (!self::$connection) {
            self::$connection = new StatsServiceClient(env("V2RAY_SN"), []);
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }

    /**
     *  启动v2ray gRPC客户端
     */
    public static function start() : void
    {
        self::$connection->isRunning() ?: self::$connection->start();
    }

    /**
     *  停止v2ray gRPC客户端
     */
    public static function stop() : void
    {
        if (self::$connection->isRunning()) self::$connection->stop();
    }

    /**
     * @param array $name
     * @param bool $reset
     * @return GetStatsRequest
     * 构造请求参数对象
     */
    public static function setStatRequest(array $name, bool $reset) : GetStatsRequest
    {
        switch ($name[0]) {
            case 1:
                $type = 'inbound';
                break;
            case 2:
                $type = 'outbound';
                break;
            default:
                $type = 'user';
        }

        switch ($name[2]) {
            case 1:
                $direction = 'uplink';
                break;
            default:
                $direction = 'downlink';
        }
        $fullName = $type . '>>>' .  (string) $name[1] . '>>>traffic>>>' . $direction;
        return (new GetStatsRequest())->setName($fullName)->setReset($reset);
    }

    /**
     * @param GetStatsRequest $request
     * @return array
     * 发送请求参数对象并解析响应内容
     */
    public static function getStat(GetStatsRequest $request) : array
    {
        self::start();
        list($reply, $status) = self::$connection->GetStats($request);
        $name = explode('>>>', $reply->getStat()->getName());
        return [
            'name' => $name[1],
            'value' => (string)round(($reply->getStat()->getValue()) / 1048576 ,3) . "MiB"
        ];
    }

    /**
     * @return StatsServiceClient
     * 手动重新打开gRPC连接
     */
    public function reconnect() : StatsServiceClient
    {
        return new StatsServiceClient(env("V2RAY_SN"), []);
    }

    /**
     *  手动关闭gRPC连接
     */
    public function disconnect(): void
    {
        self::$connection->close();
        self::$connection = null;
    }
}
