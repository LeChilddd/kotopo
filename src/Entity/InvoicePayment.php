<?php

namespace App\Entity;

use App\Repository\InvoicePaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoicePaymentRepository::class)]
class InvoicePayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'invoicePayments')]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice_id;

    #[ORM\ManyToOne(targetEntity: Payment::class, inversedBy: 'invoicePayments')]
    #[ORM\JoinColumn(nullable: false)]
    private $payment_id;

    #[ORM\Column(type: 'float')]
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceId(): ?Invoice
    {
        return $this->invoice_id;
    }

    public function setInvoiceId(?Invoice $invoice_id): self
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    public function getPaymentId(): ?Payment
    {
        return $this->payment_id;
    }

    public function setPaymentId(?Payment $payment_id): self
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
