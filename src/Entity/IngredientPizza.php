<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nombre_ingredient_par_pizza")
 * @ORM\Entity(repositoryClass="App\Repository\IngredientPizzaRepository")
 */
class IngredientPizza
{
    /** @var float */
    const GRAMME_VERS_KILO = 0.001;

    /**
     * @var int
     * @ORM\Column(name="id_ingredient_pizza", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * La quanité de l'ingrédient en gramme
     * @var int
     * @ORM\Column(name="quantite", type="integer")
     */
    private int $quantite;

    /**
     * @var Ingredient
     * @ORM\ManyToOne(targetEntity="App\Entity\Ingredient")
     * @ORM\JoinColumn(
     *     name="ingredient_id",
     *     referencedColumnName="id_ingredient"
     * )
     */
    private Ingredient $ingredient;

    /**
     * @ORM\OneToMany(targetEntity=Pizza::class, mappedBy="IngredientPizza")
     */
    private $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
    }

    /**
     * @param float $grammes
     * @return float
     */
    public static function convertirGrammeEnKilo($grammes)
    {
        return (float) $grammes * self::GRAMME_VERS_KILO;
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
     * @return IngredientPizza
     */
    public function setId(int $id): IngredientPizza
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     * @return IngredientPizza
     */
    public function setQuantite(int $quantite): IngredientPizza
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Ingredient
     */
    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    /**
     * @param Ingredient $ingredient
     * @return IngredientPizza
     */
    public function setIngredient(Ingredient $ingredient): IngredientPizza
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * @return Collection|Pizza[]
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->setIngredientPizza($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            // set the owning side to null (unless already changed)
            if ($pizza->getIngredientPizza() === $this) {
                $pizza->setIngredientPizza(null);
            }
        }

        return $this;
    }
}
