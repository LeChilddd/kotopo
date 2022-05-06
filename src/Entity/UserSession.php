<?php

namespace App\Entity;

use App\Repository\UserSessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSessionRepository::class)]
class UserSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userSessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: Session::class, inversedBy: 'userSessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $session_id;

    #[ORM\Column(type: 'boolean')]
    private $is_present;

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

    public function getSessionId(): ?Session
    {
        return $this->session_id;
    }

    public function setSessionId(?Session $session_id): self
    {
        $this->session_id = $session_id;

        return $this;
    }

    public function getIsPresent(): ?bool
    {
        return $this->is_present;
    }

    public function setIsPresent(bool $is_present): self
    {
        $this->is_present = $is_present;

        return $this;
    }
}
