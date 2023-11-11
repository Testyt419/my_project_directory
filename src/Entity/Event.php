<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descr = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $sDate = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $rDate = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'events')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: PrizeNames::class)]
    private Collection $Prizes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->Prizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): static
    {
        $this->descr = $descr;

        return $this;
    }

    public function getSDate(): ?\DateTimeInterface
    {
        return $this->sDate;
    }

    public function setSDate(\DateTimeInterface $sDate): static
    {
        $this->sDate = $sDate;

        return $this;
    }

    public function getRDate(): ?\DateTimeInterface
    {
        return $this->rDate;
    }

    public function setRDate(\DateTimeInterface $rDate): static
    {
        $this->rDate = $rDate;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, PrizeNames>
     */
    public function getPrizes(): Collection
    {
        return $this->Prizes;
    }

    public function addPrize(PrizeNames $prize): static
    {
        if (!$this->Prizes->contains($prize)) {
            $this->Prizes->add($prize);
            $prize->setEvent($this);
        }

        return $this;
    }

    public function removePrize(PrizeNames $prize): static
    {
        if ($this->Prizes->removeElement($prize)) {
            // set the owning side to null (unless already changed)
            if ($prize->getEvent() === $this) {
                $prize->setEvent(null);
            }
        }

        return $this;
    }
}
