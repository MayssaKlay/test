<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


class UploadedFile extends \SplFileInfo
{
}


/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id_event;

    /**
     * @return mixed
     */
    public function getid_event()
    {
        return $this->id_event;
    }

    /**
     * @Assert\NotBlank(message="nom doit être non vide")
     * @Assert\Length(
     *     min = 5,
     *     minMessage="Entrer un nom au mininmum de 5 caractéres"
     *
     * )
     * @ORM\Column(type="string", length=255)
     */
    public $event_name;

    /**
     * @Assert\NotBlank (message="description doit être non vide")
     * @Assert\Length (
     *     min = 7,
     *     max = 100,
     *     minMessage = " doit être >=7 ",
     *     maxMessage = " doit être <=100 ")
     * @ORM\Column(type="string", length=2000)
     */
    public $description;

    /**
     * @ORM\Column(type="date")
     */
    public $event_date;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank(message="Please upload an image")
     * Assert\File(mimeTypes={"image/png", "image/jpeg"})
     */
    private $image;


    public function getevent_name(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): self
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * @param mixed $event_date
     */
    public function setEventDate($event_date): void
    {
        $this->event_date = $event_date;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }


}
