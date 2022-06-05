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
    private $id;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: Service::class, orphanRemoval: true)]
    private $service_id;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: User::class, orphanRemoval: true)]
    private $user_id;

    #[ORM\Column(type: 'float')]
    private $total;

    #[ORM\Column(type: 'boolean')]
    private $payed;

    #[ORM\Column(type: 'datetime')]
    private $invoice_date;

    #[ORM\OneToMany(mappedBy: 'invoice_id', targetEntity: InvoicePayment::class, orphanRemoval: true)]
    private $invoicePayments;

    #[ORM\OneToMany(mappedBy: 'invoice_id', targetEntity: LessonInvoice::class, orphanRemoval: true)]
    private $lessonInvoices;

    #[ORM\OneToMany(mappedBy: 'invoice_id', targetEntity: Membership::class, orphanRemoval: true)]
    private $memberships;

    public function __construct()
    {
        $this->service_id = new ArrayCollection();
        $this->user_id = new ArrayCollection();
        $this->invoicePayments = new ArrayCollection();
        $this->lessonInvoices = new ArrayCollection();
        $this->memberships = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServiceId(): Collection
    {
        return $this->service_id;
    }

    public function addServiceId(Service $serviceId): self
    {
        if (!$this->service_id->contains($serviceId)) {
            $this->service_id[] = $serviceId;
            $serviceId->setInvoice($this);
        }

        return $this;
    }

    public function removeServiceId(Service $serviceId): self
    {
        if ($this->service_id->removeElement($serviceId)) {
            // set the owning side to null (unless already changed)
            if ($serviceId->getInvoice() === $this) {
                $serviceId->setInvoice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setInvoice($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getInvoice() === $this) {
                $userId->setInvoice(null);
            }
        }

        return $this;
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

    public function getPayed(): ?bool
    {
        return $this->payed;
    }

    public function setPayed(bool $payed): self
    {
        $this->payed = $payed;

        return $this;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoice_date;
    }

    public function setInvoiceDate(\DateTimeInterface $invoice_date): self
    {
        $this->invoice_date = $invoice_date;

        return $this;
    }

    /**
     * @return Collection<int, InvoicePayment>
     */
    public function getInvoicePayments(): Collection
    {
        return $this->invoicePayments;
    }

    public function addInvoicePayment(InvoicePayment $invoicePayment): self
    {
        if (!$this->invoicePayments->contains($invoicePayment)) {
            $this->invoicePayments[] = $invoicePayment;
            $invoicePayment->setInvoiceId($this);
        }

        return $this;
    }

    public function removeInvoicePayment(InvoicePayment $invoicePayment): self
    {
        if ($this->invoicePayments->removeElement($invoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($invoicePayment->getInvoiceId() === $this) {
                $invoicePayment->setInvoiceId(null);
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
            $lessonInvoice->setInvoiceId($this);
        }

        return $this;
    }

    public function removeLessonInvoice(LessonInvoice $lessonInvoice): self
    {
        if ($this->lessonInvoices->removeElement($lessonInvoice)) {
            // set the owning side to null (unless already changed)
            if ($lessonInvoice->getInvoiceId() === $this) {
                $lessonInvoice->setInvoiceId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Membership>
     */
    public function getMemberships(): Collection
    {
        return $this->memberships;
    }

    public function addMembership(Membership $membership): self
    {
        if (!$this->memberships->contains($membership)) {
            $this->memberships[] = $membership;
            $membership->setInvoiceId($this);
        }

        return $this;
    }

    public function removeMembership(Membership $membership): self
    {
        if ($this->memberships->removeElement($membership)) {
            // set the owning side to null (unless already changed)
            if ($membership->getInvoiceId() === $this) {
                $membership->setInvoiceId(null);
            }
        }

        return $this;
    }
}
