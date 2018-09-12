<?php

namespace Mcs\Bravi\Service;

use Mcs\Bravi\Repository\MovieRepository;
use Mcs\Bravi\ValueObject\Favorite;
use Mcs\Bravi\ValueObject\Movie;

/**
 * Created by Marcelo
 */
class MovieService
{

    /**
     * @var MovieRepository
     */
    private $repository;

    /**
     * @var FavoriteService
     */
    private $favoriteService;

    /**
     * MovieService constructor.
     */
    public function __construct()
    {
        $this->repository = new MovieRepository();
        $this->favoriteService = new FavoriteService();
    }

    public function getMovieByID($id)
    {
        /** @var \stdClass $movieJson */
        $movieStd = $this->repository->find($id);

        $movie = Movie::initStdClass($movieStd);

        return $movie;
    }

    public function getListMovieFavorite()
    {

        $movies = [];
        $listFavorites = $this->favoriteService->getListFavorites();
        /** @var Favorite $favorite */
        foreach ($listFavorites as $favorite) {
            /** @var \stdClass $movieJson */
            $movieStd = $this->repository->find($favorite->getImdbID());
            $movies[] = Movie::initStdClass($movieStd);
        }

        return $movies;
    }

}