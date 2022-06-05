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
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_teacher_id;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private $language_id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'session_id', targetEntity: LessonInvoice::class, orphanRemoval: true)]
    private $lessonInvoices;

    #[ORM\OneToMany(mappedBy: 'session_id', targetEntity: UserSession::class, orphanRemoval: true)]
    private $userSessions;

    public function __construct()
    {
        $this->lessonInvoices = new ArrayCollection();
        $this->userSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserTeacherId(): ?User
    {
        return $this->user_teacher_id;
    }

    public function setUserTeacherId(?User $user_teacher_id): self
    {
        $this->user_teacher_id = $user_teacher_id;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $lessonInvoice->setSessionId($this);
        }

        return $this;
    }

    public function removeLessonInvoice(LessonInvoice $lessonInvoice): self
    {
        if ($this->lessonInvoices->removeElement($lessonInvoice)) {
            // set the owning side to null (unless already changed)
            if ($lessonInvoice->getSessionId() === $this) {
                $lessonInvoice->setSessionId(null);
            }
        }

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
            $userSession->setSessionId($this);
        }

        return $this;
    }

    public function removeUserSession(UserSession $userSession): self
    {
        if ($this->userSessions->removeElement($userSession)) {
            // set the owning side to null (unless already changed)
            if ($userSession->getSessionId() === $this) {
                $userSession->setSessionId(null);
            }
        }

        return $this;
    }
}
