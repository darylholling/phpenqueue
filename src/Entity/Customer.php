<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    public const FREE_CUSTOMER = 'free_customer';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var array
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $marking;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getMarking(): array
    {
        return $this->marking;
    }

    /**
     * @param array $marking
     */
    public function setMarking(array $marking): void
    {
        $this->marking = $marking;
    }

}
