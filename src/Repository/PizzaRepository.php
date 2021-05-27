<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class PizzaRepository
 */
class PizzaRepository extends ServiceEntityRepository
{
    /**
     * PizzaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizza::class);
    }

    /**
     * @param int $pizzaId
     * @return Pizza
     */
    public function findPizzaAvecDetailComplet($pizzaId): Pizza
    {
        // test si l'id de la pizza est bien un nombre supérieur à 0
        if (!is_numeric($pizzaId) || $pizzaId <= 0) {
            throw new \Exception("Impossible de d'obtenir le détail de la pizza ({$pizzaId}).");
        }

        // création du query builder avec l'alias p pour pizza
        $qb = $this->createQueryBuilder("p");

        // création de la requête
        $qb
            ->addSelect(["qte", "ing"])
            ->innerJoin("p.quantiteIngredients", "qte")
            ->innerJoin("qte.ingredient", "ing")
            ->where("p.id = :idPizza")
            ->setParameter("idPizza", $pizzaId)
        ;

        // exécution de la requête
        return $qb->getQuery()->getSingleResult();
    }


}
