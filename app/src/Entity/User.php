<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'integer')]
    private int $cardNumber;

    #[ORM\Column(type: 'string', length: 100)]
    private string $firstname;

    #[ORM\Column(type: 'string', length: 100)]
    private string $lastname;

    #[ORM\Column(type: 'string', length: 25)]
    private string $gender;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Membership::class, cascade: ['persist', 'remove'])]
    private ?Membership $membership;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserLanguageLevel::class)]
    private ArrayCollection $userLanguageLevels;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Invoice::class)]
    private ArrayCollection $invoices;

    #[ORM\OneToMany(mappedBy: 'userTeacher', targetEntity: Session::class)]
    private ArrayCollection $sessions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserSession::class)]
    private ArrayCollection $userSessions;

    public function __construct()
    {
        $this->userLanguageLevels = new ArrayCollection();
        $this->invoices = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->userSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCardNumber(): ?int
    {
        return $this->cardNumber;
    }

    public function setCardNumber(int $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getMembership(): ?Membership
    {
        return $this->membership;
    }

    public function setMembership(Membership $membership): self
    {
        // set the owning side of the relation if necessary
        if ($membership->getUser() !== $this) {
            $membership->setUser($this);
        }

        $this->membership = $membership;

        return $this;
    }

    /**
     * @return Collection<int, UserLanguageLevel>
     */
    public function getUserLanguageLevels(): Collection
    {
        return $this->userLanguageLevels;
    }

    public function addUserLanguageLevel(UserLanguageLevel $userLanguageLevel): self
    {
        if (!$this->userLanguageLevels->contains($userLanguageLevel)) {
            $this->userLanguageLevels[] = $userLanguageLevel;
            $userLanguageLevel->setUser($this);
        }

        return $this;
    }

    public function removeUserLanguageLevel(UserLanguageLevel $userLanguageLevel): self
    {
        if ($this->userLanguageLevels->removeElement($userLanguageLevel)) {
            // set the owning side to null (unless already changed)
            if ($userLanguageLevel->getUser() === $this) {
                $userLanguageLevel->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setUser($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getUser() === $this) {
                $invoice->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setUserTeacher($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getUserTeacher() === $this) {
                $session->setUserTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserSession>
     */
    public function getUserSessions(): Collection
    {
        return $this->userSessions;
    }

    public function addUserSession(UserSession $userSession): self
    {
        if (!$this->userSessions->contains($userSession)) {
            $this->userSessions[] = $userSession;
            $userSession->setUser($this);
        }

        return $this;
    }

    public function removeUserSession(UserSession $userSession): self
    {
        if ($this->userSessions->removeElement($userSession)) {
            // set the owning side to null (unless already changed)
            if ($userSession->getUser() === $this) {
                $userSession->setUser(null);
            }
        }

        return $this;
    }
}
