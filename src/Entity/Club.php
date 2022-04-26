<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="nom doit être non vide")
     * @Assert\Length(
     *     min = 5,
     *     minMessage="Entrer un nom au mininmum de 5 caractéres"
     *
     * )
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


    /**
     * @ORM\Column(name="access" ,type="boolean" ,options={"default":true})
     */
    private $access;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="club" , orphanRemoval=true)
     */
    private $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }




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

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access): void
    {
        $this->access = $access;
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

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setClub($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getClub() === $this) {
                $evenement->setClub(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return(string)$this->getNom_club();
    }



}
