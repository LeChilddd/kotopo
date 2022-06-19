<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: UserLanguageLevel::class)]
    private $userLanguageLevels;

    public function __construct()
    {
        $this->userLanguageLevels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, UserLanguageLevel>
     */
    public function getUserLanguageLevels(): Collection
    {
        return $this->userLanguageLevels;
    }

    public function addUserLanguageLevel(UserLanguageLevel $userLanguageLevel): self
    {
        if (!$this->userLanguageLevels->contains($userLanguageLevel)) {
            $this->userLanguageLevels[] = $userLanguageLevel;
            $userLanguageLevel->setLevel($this);
        }

        return $this;
    }

    public function removeUserLanguageLevel(UserLanguageLevel $userLanguageLevel): self
    {
        if ($this->userLanguageLevels->removeElement($userLanguageLevel)) {
            // set the owning side to null (unless already changed)
            if ($userLanguageLevel->getLevel() === $this) {
                $userLanguageLevel->setLevel(null);
            }
        }

        return $this;
    }
}
