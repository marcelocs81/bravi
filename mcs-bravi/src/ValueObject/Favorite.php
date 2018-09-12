<?php

namespace Mcs\Bravi\ValueObject;

/**
 * Created by Marcelo
 */
class Favorite
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $imdbID;

    /**
     * @var int
     */
    private $userID;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Favorite constructor.
     * @param string $imdbID
     */
    public function __construct($imdbID = NULL)
    {
        $this->imdbID = $imdbID;
    }

    /**
     * @param \stdClass $favoriteStdClass
     * @return Favorite
     */
    public static function initStdClass($favoriteStdClass)
    {
        $favorite = new Favorite();
        $favorite->setId((int) $favoriteStdClass->id);
        $favorite->setImdbID($favoriteStdClass->imdb_id);
        $favorite->setUserID((string) $favoriteStdClass->user_id);

        $createdAt = new \DateTime($favoriteStdClass->created_at);
        $favorite->setCreatedAt($createdAt);

        return $favorite;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Favorite
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * @param string $imdbID
     * @return Favorite
     */
    public function setImdbID($imdbID)
    {
        $this->imdbID = $imdbID;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     * @return Favorite
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Favorite
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}