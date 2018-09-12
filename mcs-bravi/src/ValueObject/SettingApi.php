<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\ValueObject;


use Mcs\Bravi\Service\SettingsService;

class SettingApi
{

    const TABLE_SETTINGS = 'mcs_settings';

    const TABLE_FAVORITE = 'mcs_favorites';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $key;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SettingApi
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return SettingApi
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return SettingApi
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Obtem os parametros de configuração da API
     * @return SettingApi
     */
    public static function init()
    {
        $service = new SettingsService();

        return $service->find();
    }

    public function getUrlComplete()
    {
        return $this->url . '?apikey=' . $this->key;
    }

}