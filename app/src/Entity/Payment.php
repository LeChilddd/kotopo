<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\ManyToOne(targetEntity: PayementMethod::class, inversedBy: 'payments')]
    #[ORM\JoinColumn(nullable: false)]
    private $payment_method_id;

    #[ORM\OneToMany(mappedBy: 'payment_id', targetEntity: InvoicePayment::class, orphanRemoval: true)]
    private $invoicePayments;

    public function __construct()
    {
        $this->invoicePayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPaymentMethodId(): ?PayementMethod
    {
        return $this->payment_method_id;
    }

    public function setPaymentMethodId(?PayementMethod $payment_method_id): self
    {
        $this->payment_method_id = $payment_method_id;

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
            $invoicePayment->setPaymentId($this);
        }

        return $this;
    }

    public function removeInvoicePayment(InvoicePayment $invoicePayment): self
    {
        if ($this->invoicePayments->removeElement($invoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($invoicePayment->getPaymentId() === $this) {
                $invoicePayment->setPaymentId(null);
            }
        }

        return $this;
    }
}
