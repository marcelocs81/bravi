<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\Service;


use Mcs\Bravi\Repository\SettingsRepository;
use Mcs\Bravi\ValueObject\SettingApi;

class SettingsService
{

    /**
     * @var FavoriteRepository
     */
    private $repository;

    /**
     * FavoriteService constructor.
     */
    public function __construct()
    {
        $this->repository = new SettingsRepository();
    }

    /**
     * @return SettingApi
     */
    public function find()
    {
        return $this->repository->find();
    }

    public function savePost($post)
    {

        $setting = new SettingApi();
        $setting->setId($post['api_id']);
        $setting->setUrl($post['api_url']);
        $setting->setKey($post['api_key']);

        return $this->repository->save($setting);
    }
}