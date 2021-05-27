<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Pizzeria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class PizzeriaRepository
 */
class PizzeriaRepository extends ServiceEntityRepository
{
    /**
     * PizzeriaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizzeria::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        // exécution de la requête
        return parent::findAll();
    }

    /**
     * @param int $pizzeriaId
     * @return Pizzeria
     */
    public function findCartePizzeria($pizzeriaId): Pizzeria
    {

        if (!is_numeric($pizzeriaId) || $pizzeriaId <= 0) {
            throw new \Exception("Impossible de d'obtenir le détail de la pizzeria ({$pizzeriaId}).");
        }

        $qb = $this->createQueryBuilder("pa");

        $qb
            ->addSelect(["carte", "num"])
            ->innerJoin("pa.pizzas", "carte")
            ->innerJoin("qte.numTelephone", "num")
            ->where("pa.id = :idPizzeria")
            ->setParameter("idPizzeria", $pizzeriaId)
        ;

        return $qb->getQuery()->getSingleResult();

    }
}
