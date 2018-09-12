<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\Repository;

use Curl\Curl;
use Mcs\Bravi\Exception\BusinessException;
use Mcs\Bravi\Utils\StringToBoolean;
use Mcs\Bravi\ValueObject\SettingApi;


class MovieRepository
{
    /**
     * @var Curl;
     */
    private $curl;

    /**
     * @var SettingApi
     */
    private $settingApi;

    /**
     * FavoriteRepository constructor.
     * @param \wpdb $wpdb
     */
    public function __construct()
    {

        $this->settingApi = SettingApi::init();

        $this->curl = new Curl();


    }

    public function find($id)
    {

        $this->curl->get($this->settingApi->getUrl(), array(
            'apikey' => $this->settingApi->getKey(),
            'i' => $id,
        ));

        if ($this->curl->error) {
            throw new \Exception('Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage);
        } else {

            $response = $this->curl->response;
            if ($response instanceof \stdClass) {
                $resposta = StringToBoolean::convert($this->curl->response->Response);
                if ($resposta) {
                    return $this->curl->response;
                } else {
                    throw new BusinessException($response->Error);
                }
            }

        }

        throw new BusinessException('Não foi possivel obter o filme desejado, tente novamente');

    }


}