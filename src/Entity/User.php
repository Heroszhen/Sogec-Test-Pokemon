<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\RegistrationController;
use App\Validator\Constraints\CheckPassword; 
//use App\Controller\ConnectionController;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un utilisateur avec ce mail")
 * @ApiResource(
 *      normalizationContext={"group"={"read"}},
 *      denormalizationContext={"groups"={"logup"}},
 *      collectionOperations={
 *          "registration" = {
 *              "method" = "POST",
 *              "path" = "/users/registration",
 *              "controller" = RegistrationController::class,
 *              "openapi_context"={"summary"="logup"}
 *          }
 *      },
 *      itemOperations={}
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"logup","read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, options={"default":""})
     * @Groups({"logup"})
     * @Assert\Email(message = "Le mail '{{ value }}' que vous avez entré n'est pas un mail validé",checkMX = true)
     * @Assert\NotBlank(message = "Veuillez mettre un mail")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read"})
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * 
     * @CheckPassword
     * @ORM\Column(type="string", options={"default":""})
     * @Groups({"logup"})
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"read"})
     */
    private $created;

    /**
     * (type="string", length=255)
     */
    private $username;

    public function __construct(){
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
