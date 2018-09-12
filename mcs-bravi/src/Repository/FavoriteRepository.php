<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\Repository;


use Mcs\Bravi\ValueObject\Favorite;
use Mcs\Bravi\ValueObject\SettingApi;

class FavoriteRepository
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
     * FavoriteRepository constructor.
     * @param \wpdb $wpdb
     */
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->tableName = $this->wpdb->prefix . SettingApi::TABLE_FAVORITE;
    }

    public function findAllByUserID($userId)
    {
        global $wpdb;

        $queryString = 'SELECT id, user_id, imdb_id, created_at FROM %s where user_id = %d';

        $querySql = sprintf($queryString, $this->tableName, $userId);

        /** @var array $dados */
        $dados = $wpdb->get_results($querySql);

        $favorites = [];
        if (is_array($dados) && count($dados) > 0) {
            foreach ($dados as $row) {
                $favorites[] = Favorite::initStdClass($row);
            }
        }

        return $favorites;

    }

    /**
     * @param $userId
     * @param $imbdId
     * @return \Mcs\Bravi\ValueObject\Favorite|null
     */
    public function findByUserAndImdb($userId, $imbdId)
    {
        $queryString = "SELECT id, user_id, imdb_id, created_at FROM %s where user_id = %d AND imdb_id = '%s'";

        $querySql = sprintf($queryString, $this->tableName, $userId, $imbdId);

        /** @var array $dados */
        $dados = $this->wpdb->get_results($querySql);

        if (is_array($dados) && count($dados) > 0) {
            foreach ($dados as $row) {
                return Favorite::initStdClass($row);
            }
        }

        return NULL;

    }

    public function save(Favorite $favorite)
    {

        $retorno = $this->wpdb->insert($this->tableName, [
            'user_id' => $favorite->getUserID(),
            'imdb_id' => $favorite->getImdbID(),
            'created_at' => $favorite->getCreatedAt()->format('Y-m-d H:i:s')
        ]);

        if(! $retorno){
            throw new \Exception($this->wpdb->last_error);
        }

        return $retorno;

    }

    public function remove(Favorite $favorite)
    {
        $retorno = $this->wpdb->delete($this->tableName, [
            'user_id' => $favorite->getUserID(),
            'imdb_id' => $favorite->getImdbID()
        ]);

        if(! $retorno){
            throw new \Exception($this->wpdb->last_error);
        }

        return $retorno;

    }


}