<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nom_club;

    /**
     * @ORM\Column(type="date")
     */
    public $date_creation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $club_owner;

    /**
     * @ORM\Column(type="integer")
     */
    public $nbr_members;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank(message="Please upload an image")
     * Assert\File(mimeTypes={"image/png", "image/jpeg"})
     */
    private $imageclb;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom_club(): ?string
    {
        return $this->nom_club;
    }

    public function setNomClub(string $nom_club): self
    {
        $this->nom_club = $nom_club;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getclub_owner(): ?string
    {
        return $this->club_owner;
    }

    public function setClubOwner(string $club_owner): self
    {
        $this->club_owner = $club_owner;

        return $this;
    }

    public function getnbr_members(): ?int
    {
        return $this->nbr_members;
    }

    public function setNbrMembers(int $nbr_members): self
    {
        $this->nbr_members = $nbr_members;

        return $this;
    }


    public function getImageclb()
    {
        return $this->imageclb;
    }


    public function setImageclb($imageclb)
    {
        $this->imageclb = $imageclb;
        return $this;
    }



}
