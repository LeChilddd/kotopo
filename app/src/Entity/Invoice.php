<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'float')]
    private float $total;

    #[ORM\Column(type: 'boolean')]
    private bool $isPayed;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $service;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: Membership::class)]
    private $membership;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: LessonInvoice::class)]
    private $lessonInvoices;

    public function __construct()
    {
        $this->membership = new ArrayCollection();
        $this->lessonInvoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function isIsPayed(): ?bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(bool $isPayed): self
    {
        $this->isPayed = $isPayed;

        return $this;
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

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection<int, Membership>
     */
    public function getMembership(): Collection
    {
        return $this->membership;
    }

    public function addMembership(Membership $membership): self
    {
        if (!$this->membership->contains($membership)) {
            $this->membership[] = $membership;
            $membership->setInvoice($this);
        }

        return $this;
    }

    public function removeMembership(Membership $membership): self
    {
        if ($this->membership->removeElement($membership)) {
            // set the owning side to null (unless already changed)
            if ($membership->getInvoice() === $this) {
                $membership->setInvoice(null);
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
            $lessonInvoice->setInvoice($this);
        }

        return $this;
    }

    public function removeLessonInvoice(LessonInvoice $lessonInvoice): self
    {
        if ($this->lessonInvoices->removeElement($lessonInvoice)) {
            // set the owning side to null (unless already changed)
            if ($lessonInvoice->getInvoice() === $this) {
                $lessonInvoice->setInvoice(null);
            }
        }

        return $this;
    }
}
