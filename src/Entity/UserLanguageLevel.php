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
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userLanguageLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'userLanguageLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $language_id;

    #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'userLanguageLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $level_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getLanguageId(): ?Language
    {
        return $this->language_id;
    }

    public function setLanguageId(?Language $language_id): self
    {
        $this->language_id = $language_id;

        return $this;
    }

    public function getLevelId(): ?Level
    {
        return $this->level_id;
    }

    public function setLevelId(?Level $level_id): self
    {
        $this->level_id = $level_id;

        return $this;
    }
}
