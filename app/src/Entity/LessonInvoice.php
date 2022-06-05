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

    #[ORM\ManyToOne(targetEntity: Session::class, inversedBy: 'lessonInvoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $session_id;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'lessonInvoices')]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice_id;

    #[ORM\Column(type: 'integer')]
    private $number_of_session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?Session
    {
        return $this->session_id;
    }

    public function setSessionId(?Session $session_id): self
    {
        $this->session_id = $session_id;

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

    public function getNumberOfSession(): ?int
    {
        return $this->number_of_session;
    }

    public function setNumberOfSession(int $number_of_session): self
    {
        $this->number_of_session = $number_of_session;

        return $this;
    }
}
