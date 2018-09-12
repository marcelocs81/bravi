<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\Repository;


use Mcs\Bravi\ValueObject\SettingApi;

class SettingsRepository
{

    /**
     * @var \wpdb
     */
    private $wpdb;

    /**
     * @var string
     */
    private $tableName;

    /**
     * SettingsRepository constructor.
     * @param \wpdb $wpdb
     */
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->tableName = $this->wpdb->prefix . SettingApi::TABLE_SETTINGS;
    }

    /**
     * @return SettingApi
     * @throws \Exception
     */
    public function find()
    {
        $queryString = 'SELECT id, api_url, api_key FROM %s ORDER BY ID desc LIMIT 1';

        $querySql = sprintf($queryString, $this->tableName);

        /** @var array $dados */
        $dados = $this->wpdb->get_results($querySql);

        if (is_array($dados) && count($dados) == 1) {
            $config = $dados[0];

            $setting = new SettingApi();
            $setting->setId($config->id);
            $setting->setUrl($config->api_url);
            $setting->setKey($config->api_key);

            return $setting;
        }

        throw new \Exception('Não foi possivel obter parametros de configuração');
    }

    public function save(SettingApi $settingApi)
    {

        $result = FALSE;

        if (empty($settingApi->getId())) {
            $result = $this->wpdb->insert($this->tableName, [
                'api_url' => $settingApi->getUrl(),
                'api_key' => $settingApi->getKey()
            ]);
        } else {
            $result = $this->wpdb->update($this->tableName, [
                'api_url' => $settingApi->getUrl(),
                'api_key' => $settingApi->getKey()
            ], ['id' => $settingApi->getId()]);
        }

        if(! $result){
            throw new \Exception($this->wpdb->last_error);
        }

        return $result;

    }

}