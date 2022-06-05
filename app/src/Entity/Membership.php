<?php

namespace App\Entity;

use App\Repository\MembershipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
class Membership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'memberships')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'memberships')]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice_id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $validity_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $expired_at;

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

    public function getInvoiceId(): ?Invoice
    {
        return $this->invoice_id;
    }

    public function setInvoiceId(?Invoice $invoice_id): self
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    public function getValidityAt(): ?\DateTimeImmutable
    {
        return $this->validity_at;
    }

    public function setValidityAt(\DateTimeImmutable $validity_at): self
    {
        $this->validity_at = $validity_at;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeImmutable
    {
        return $this->expired_at;
    }

    public function setExpiredAt(\DateTimeImmutable $expired_at): self
    {
        $this->expired_at = $expired_at;

        return $this;
    }
}
