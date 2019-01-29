<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // This property is used by the marking store
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $currentPlace;

    /**
     * @ORM\Column(type="string")
     */
    public $title;

    /**
     * @ORM\Column(type="string")
     */
    public $content;

    /**
     * @ORM\Column(type="datetime")
     */
    public $datetime;

    /**
     * BlogPost constructor.
     * @param string $title
     * @throws \Exception
     */
    public function __construct($title = 'Title')
    {
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    /**
     * @param mixed $currentPlace
     */
    public function setCurrentPlace($currentPlace): void
    {
        $this->currentPlace = $currentPlace;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }
}
