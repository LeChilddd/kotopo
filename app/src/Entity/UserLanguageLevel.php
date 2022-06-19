<?php

namespace App\Entity;

use App\Repository\UserLanguageLevelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLanguageLevelRepository::class)]
class UserLanguageLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userLanguageLevels')]
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'userLanguageLevels')]
    private ?Language $language;

    #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'userLanguageLevels')]
    private ?Level $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }
}
