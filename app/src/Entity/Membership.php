<?php

namespace App\Entity;

use App\Repository\MembershipRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
class Membership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'membership', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'membership')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Invoice $invoice;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $validityAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $expiredAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getValidityAt(): ?DateTimeImmutable
    {
        return $this->validityAt;
    }

    public function setValidityAt(DateTimeImmutable $validityAt): self
    {
        $this->validityAt = $validityAt;

        return $this;
    }

    public function getExpiredAt(): ?DateTimeImmutable
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(DateTimeImmutable $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }
}
