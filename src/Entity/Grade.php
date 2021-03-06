<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 */
class Grade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $album_title;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="string")
     */
    private $picture_name;

    /**
     * @var File
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getArtistName(): ?string
    {
        return $this->artist_name;
    }

    public function setArtistName(string $artist_name): self
    {
        $this->artist_name = $artist_name;

        return $this;
    }

    public function getAlbumTitle(): ?string
    {
        return $this->album_title;
    }

    public function setAlbumTitle(string $album_title): self
    {
        $this->album_title = $album_title;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPictureName()
    {
        return $this->picture_name;
    }

    public function setPictureName($picture_name): void
    {
        $this->picture_name = $picture_name;
    }

    public function getPicture(): ?File
    {
        return $this->picture;
    }

    public function setPicture(File $picture): void
    {
        $this->picture = $picture;
    }

}
