<?php

namespace Mcs\Bravi\ValueObject;

/**
 * Created by Marcelo
 */
class Movie
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $year;

    /**
     * @var string
     */
    private $thumbnail;

    /**
     * @param \stdClass $movieStdClass
     * @return Movie
     */
    public static function initStdClass($movieStdClass)
    {
        $movie = new Movie();
        $movie->setId($movieStdClass->imdbID);
        $movie->setTitle($movieStdClass->Title);
        $movie->setYear($movieStdClass->Year);
        $movie->setThumbnail($movieStdClass->Poster);

        return $movie;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Movie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Movie
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return Movie
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }
}