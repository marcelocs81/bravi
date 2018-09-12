<?php

namespace Mcs\Bravi\Service;

use Mcs\Bravi\Repository\FavoriteRepository;
use Mcs\Bravi\ValueObject\Favorite;
use Mcs\Bravi\ValueObject\Movie;

/**
 * Created by Marcelo
 */
class FavoriteService
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
        $this->repository = new FavoriteRepository();
    }

    /**
     * @return array
     */
    public function getListFavorites()
    {
        $userId = get_current_user_id();
        return $this->repository->findAllByUserID($userId);
    }

    public function save($imdbId)
    {

        $favoriteDB = $this->repository->findByUserAndImdb(get_current_user_id(), $imdbId);

        if(NULL == $favoriteDB) {
            $favorite = new Favorite($imdbId);
            $favorite->setUserID(get_current_user_id());
            $favorite->setCreatedAt(new \DateTime());

            return $this->repository->save($favorite);
        }

        return TRUE;
    }

    public function remove($imdbId)
    {

        $favorite = new Favorite($imdbId);
        $favorite->setUserID(get_current_user_id());

        return $this->repository->remove($favorite);
    }

}