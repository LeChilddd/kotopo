<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $language;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $userTeacher;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: UserSession::class)]
    private $userSessions;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: LessonInvoice::class)]
    private $lessonInvoices;

    public function __construct()
    {
        $this->userSessions = new ArrayCollection();
        $this->lessonInvoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserTeacher(): ?User
    {
        return $this->userTeacher;
    }

    public function setUserTeacher(?User $userTeacher): self
    {
        $this->userTeacher = $userTeacher;

        return $this;
    }

    /**
     * @return Collection<int, UserSession>
     */
    public function getUserSessions(): Collection
    {
        return $this->userSessions;
    }

    public function addUserSession(UserSession $userSession): self
    {
        if (!$this->userSessions->contains($userSession)) {
            $this->userSessions[] = $userSession;
            $userSession->setSession($this);
        }

        return $this;
    }

    public function removeUserSession(UserSession $userSession): self
    {
        if ($this->userSessions->removeElement($userSession)) {
            // set the owning side to null (unless already changed)
            if ($userSession->getSession() === $this) {
                $userSession->setSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LessonInvoice>
     */
    public function getLessonInvoices(): Collection
    {
        return $this->lessonInvoices;
    }

    public function addLessonInvoice(LessonInvoice $lessonInvoice): self
    {
        if (!$this->lessonInvoices->contains($lessonInvoice)) {
            $this->lessonInvoices[] = $lessonInvoice;
            $lessonInvoice->setSession($this);
        }

        return $this;
    }

    public function removeLessonInvoice(LessonInvoice $lessonInvoice): self
    {
        if ($this->lessonInvoices->removeElement($lessonInvoice)) {
            // set the owning side to null (unless already changed)
            if ($lessonInvoice->getSession() === $this) {
                $lessonInvoice->setSession(null);
            }
        }

        return $this;
    }
}
