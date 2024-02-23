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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?int $identification_number = null;

    #[ORM\Column]
    private ?float $balance = null;

    #[ORM\OneToMany(targetEntity: Directorio::class, mappedBy: 'user')]
    private Collection $agenda;

    #[ORM\OneToMany(targetEntity: Transacciones::class, mappedBy: 'user')]
    private Collection $pago;

    public function __construct($id=null, $username=null, $roles=null, $password=null, $phone=null, $identification_number=null, $balance=null)
    {
        
        $this->id = $id;
        $this->username = $username;
        #$this->roles = $roles;
        $this->password = $password;
        $this->phone = $phone;
        $this->identification_number = $identification_number;
        $this->balance = $balance;
        $this->agenda = new ArrayCollection();
        $this->pago = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIdentificationNumber(): ?int
    {
        return $this->identification_number;
    }

    public function setIdentificationNumber(int $identification_number): static
    {
        $this->identification_number = $identification_number;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return Collection<int, Directorio>
     */
    public function getAgenda(): Collection
    {
        return $this->agenda;
    }

    public function addAgenda(Directorio $agenda): static
    {
        if (!$this->agenda->contains($agenda)) {
            $this->agenda->add($agenda);
            $agenda->setUser($this);
        }

        return $this;
    }

    public function removeAgenda(Directorio $agenda): static
    {
        if ($this->agenda->removeElement($agenda)) {
            // set the owning side to null (unless already changed)
            if ($agenda->getUser() === $this) {
                $agenda->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transacciones>
     */
    public function getPago(): Collection
    {
        return $this->pago;
    }

    public function addPago(Transacciones $pago): static
    {
        if (!$this->pago->contains($pago)) {
            $this->pago->add($pago);
            $pago->setUser($this);
        }

        return $this;
    }

    public function removePago(Transacciones $pago): static
    {
        if ($this->pago->removeElement($pago)) {
            // set the owning side to null (unless already changed)
            if ($pago->getUser() === $this) {
                $pago->setUser(null);
            }
        }

        return $this;
    }
}
