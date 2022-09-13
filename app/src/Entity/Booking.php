<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    const RECURRENCE_TYPE_NEVER = 0;
    const RECURRENCE_TYPE_DAY = 1;
    const RECURRENCE_TYPE_WEEK = 2;
    const RECURRENCE_TYPE_MONTH = 3;
    const FUNDING_TYPE_LABEL =[
        self::RECURRENCE_TYPE_NEVER => "Jamais",
        self::RECURRENCE_TYPE_DAY => "Tous les jours",
        self::RECURRENCE_TYPE_WEEK => "Toutes les semaines",
        self::RECURRENCE_TYPE_MONTH => "Tous les mois",
    ];


    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $beginDate = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $endDate = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $recurrenceDate = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $recurrenceType = 0;

    #[ORM\OneToMany(mappedBy: 'booking', targetEntity: Subscriber::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $subscribers;

    public function __construct()
    {
        $this->subscribers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBeginDate(): ?\DateTime
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTime $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getRecurrenceDate(): \DateTime
    {
        return $this->recurrenceDate;
    }

    public function setRecurrenceDate(?\DateTime $recurrenceDate): void
    {
        $this->recurrenceDate = $recurrenceDate;
    }

    public function getRecurrenceType(): ?int
    {
        return $this->recurrenceType;
    }

    public function setRecurrenceType(?int $recurrenceType): void
    {
        $this->recurrenceType = $recurrenceType;
    }

    /**
     * @return Collection<int, Subscriber>
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscriber(Subscriber $subscriber): self
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers->add($subscriber);
            $subscriber->setBooking($this);
        }

        return $this;
    }

    public function removeSubscriber(Subscriber $subscriber): self
    {
        if ($this->subscribers->removeElement($subscriber)) {
            // set the owning side to null (unless already changed)
            if ($subscriber->getBooking() === $this) {
                $subscriber->setBooking(null);
            }
        }

        return $this;
    }
}
