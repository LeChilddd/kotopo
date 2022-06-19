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
    private int $id;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: PaymentMethod::class)]
    private $paymentMethod;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: InvoicePayment::class)]
    private $invoicePayments;

    public function __construct()
    {
        $this->paymentMethod = new ArrayCollection();
        $this->invoicePayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function getPaymentMethod(): Collection
    {
        return $this->paymentMethod;
    }

    public function addPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->paymentMethod->contains($paymentMethod)) {
            $this->paymentMethod[] = $paymentMethod;
            $paymentMethod->setPayment($this);
        }

        return $this;
    }

    public function removePaymentMethod(PaymentMethod $paymentMethod): self
    {
        if ($this->paymentMethod->removeElement($paymentMethod)) {
            // set the owning side to null (unless already changed)
            if ($paymentMethod->getPayment() === $this) {
                $paymentMethod->setPayment(null);
            }
        }

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
            $invoicePayment->setPayment($this);
        }

        return $this;
    }

    public function removeInvoicePayment(InvoicePayment $invoicePayment): self
    {
        if ($this->invoicePayments->removeElement($invoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($invoicePayment->getPayment() === $this) {
                $invoicePayment->setPayment(null);
            }
        }

        return $this;
    }
}
