<?php

namespace App\Entity;

use App\Repository\MonsterRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MonsterRepository::class)
 * @ApiResource(
 *      attributes={
 *          "pagination_client_items_per_page"=true,
 *          "pagination_items_per_page"=50
 *      },
 *      denormalizationContext={"groups"={"write"}},
 *      collectionOperations={"get"},
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('MONSTER_UPDATE', object) and object.getIslegendary() == false", 
 *              "security_message"="Vous ne pouvez pas modifier un monstre légendaire ou le type n'existe pas"
 *          },
 *          "delete"={"security"="object.getIslegendary() == false", "security_message"="Vous ne pouvez pas supprimer un monstre légendaire"}
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial","type1": "ipartial","type2": "ipartial"})
 * @ApiFilter(BooleanFilter::class, properties={"islegendary"})
 * @ApiFilter(NumericFilter::class, properties={"generation"})
 */
class Monster
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $number = 0;

    /**
     * @ORM\Column(type="string", length=255, options={"default": ""})
     * @Groups({"write"})
     */
    private $name = "";

    /**
     * @ORM\Column(type="string", length=255, options={"default": ""})
     * @Groups({"write"})
     */
    private $type1 = "";

    /**
     * @ORM\Column(type="string", length=255, options={"default": ""})
     */
    private $type2 = "";

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $total = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $hp = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $attack = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $defense = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $spatk = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $spdef = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $speed = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"write"})
     */
    private $generation = 0;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     * @Groups({"write"})
     */
    private $islegendary = false;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created;

    public function __construct(){
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType1(): ?string
    {
        return $this->type1;
    }

    public function setType1(string $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?string
    {
        return $this->type2;
    }

    public function setType2(string $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getSpatk(): ?int
    {
        return $this->spatk;
    }

    public function setSpatk(int $spatk): self
    {
        $this->spatk = $spatk;

        return $this;
    }

    public function getSpdef(): ?int
    {
        return $this->spdef;
    }

    public function setSpdef(int $spdef): self
    {
        $this->spdef = $spdef;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getIslegendary(): ?bool
    {
        return $this->islegendary;
    }

    public function setIslegendary(bool $islegendary): self
    {
        $this->islegendary = $islegendary;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
