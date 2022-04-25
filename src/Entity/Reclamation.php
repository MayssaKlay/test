<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="le titre doit etre non vide")
     * @Assert\Length(
     *     min = 4,
     *     minMessage=" il faut min 4 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Assert\NotBlank(message="Message doit etre non vide")
     * @Assert\Length(
     *     min = 7,
     *     max = 100,
     *     minMessage="doit etre >=7",
     *     maxMessage="doit etre <=100",
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="reclamations")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }


}
