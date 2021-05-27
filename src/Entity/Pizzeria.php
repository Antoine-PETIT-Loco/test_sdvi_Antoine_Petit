<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pizzeria")
 * @ORM\Entity(repositoryClass="App\Repository\PizzeriaRepository")
 */
class Pizzeria
{
    /**
     * @var int
     * @ORM\Column(name="id_pizzeria", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private string $nom;

    /**
     * La marge de la pizzeria en % (> 0.0, 1.0 = 100%)
     * @var float
     * @ORM\Column(name="marge", type="float")
     */
    private float $marge;

    /**
     * @var string
     * @ORM\Column(name="num_telephone", type="string", length=20)
     */
    private string $numTelephone;

    /**
     * @var Collection
     */
    private Collection $pizzas;

    /**
     * @var Collection
     */
    private Collection $pizzaiolos;

    /**
     * @ORM\ManyToMany(targetEntity=Pizza::class, inversedBy="pizzerias")
     */
    private $pizza;

    /**
     * @ORM\OneToMany(targetEntity=Pizzaiolo::class, mappedBy="pizzeria")
     */
    private $pizzaiolo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->pizzaiolos = new ArrayCollection();
        $this->pizza = new ArrayCollection();
        $this->pizzaiolo = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pizzeria
     */
    public function setId(int $id): Pizzeria
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Pizzeria
     */
    public function setNom(string $nom): Pizzeria
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return float
     */
    public function getMarge(): ?float
    {
        return $this->marge;
    }

    /**
     * @param float $marge
     * @return Pizzeria
     */
    public function setMarge(float $marge): Pizzeria
    {
        $this->marge = $marge;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumTelephone(): ?string
    {
        return $this->numTelephone;
    }

    /**
     * @param string $numTelephone
     * @return Pizzeria
     */
    public function setNumTelephone(string $numTelephone): Pizzeria
    {
        $this->numTelephone = $numTelephone;

        return $this;
    }

    /**
     * @param Pizza $pizza
     * @return Pizzeria
     */
    public function addPizza(Pizza $pizza): Pizzeria
    {
        $this->pizzas[] = $pizza;

        return $this;
    }

    /**
     * @param Pizza $pizza
     */
    public function removePizza(Pizza $pizza): void
    {
        $this->pizzas->removeElement($pizza);
    }

    /**
     * @return Collection
     */
    public function getPizzas() :Collection
    {
        return $this->pizzas;
    }

    /**
     * @param Pizzaiolo $pizzaiolo
     * @return Pizzeria
     */
    public function addPizzaiolo(Pizzaiolo $pizzaiolo): Pizzeria
    {
        $this->pizzaiolos[] = $pizzaiolo;

        return $this;
    }

    /**
     * @param Pizzaiolo $pizzaiolo
     */
    public function removePizzaiolo(Pizzaiolo $pizzaiolo): void
    {
        $this->pizzaiolos->removeElement($pizzaiolo);
    }

    /**
     * @return Collection
     */
    public function getPizzaiolos() :Collection
    {
        return $this->pizzaiolos;
    }

    /**
     * @return Collection|Pizza[]
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    /**
     * @return Collection|Pizzaiolo[]
     */
    public function getPizzaiolo(): Collection
    {
        return $this->pizzaiolo;
    }
}
