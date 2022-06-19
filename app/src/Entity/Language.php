<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: UserLanguageLevel::class)]
    private $userLanguageLevels;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Session::class)]
    private $sessions;

    public function __construct()
    {
        $this->userLanguageLevels = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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
            $userLanguageLevel->setLanguage($this);
        }

        return $this;
    }

    public function removeUserLanguageLevel(UserLanguageLevel $userLanguageLevel): self
    {
        if ($this->userLanguageLevels->removeElement($userLanguageLevel)) {
            // set the owning side to null (unless already changed)
            if ($userLanguageLevel->getLanguage() === $this) {
                $userLanguageLevel->setLanguage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setLanguage($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getLanguage() === $this) {
                $session->setLanguage(null);
            }
        }

        return $this;
    }
}
