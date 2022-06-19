<?php

namespace App\Entity;

use App\Repository\LessonInvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonInvoiceRepository::class)]
class LessonInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $numberOfSession;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'lessonInvoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice;

    #[ORM\ManyToOne(targetEntity: Session::class, inversedBy: 'lessonInvoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfSession(): ?int
    {
        return $this->numberOfSession;
    }

    public function setNumberOfSession(int $numberOfSession): self
    {
        $this->numberOfSession = $numberOfSession;

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

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }
}
