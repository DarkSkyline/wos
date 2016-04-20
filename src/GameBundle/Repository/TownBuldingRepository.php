<?php

namespace GameBundle\Repository;

/**
 * TownBuldingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TownBuldingRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBuilding($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT tb, b, r, bt FROM GameBundle:TownBuilding tb
                     JOIN tb.building b
                     LEFT JOIN b.required r
                     JOIN b.buildingType bt
                     JOIN b.towns on
                     WHERE b.id = :id'
            )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function getLvl($id) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT PARTIAL tb.{id, lvl} FROM GameBundle:TownBuilding tb
                 JOIN tb.building b
                 WHERE b.id = :id'
            )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function exist($batiment, $town) {
        return true;
    }

    public function building($batiment, $town) {
        $i = 0;
        $where = '';
        foreach($batiment as $b) {
            if($i == 0) {
                $where = $where.'tb.building = :building'.$i;
            }
            else
                $where = $where.' OR tb.building = :building'.$i;
            $i++;
        }
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(tb.id) FROM GameBundle:TownBuilding tb
                 WHERE tb.town = :town AND ('.$where.')'
            );
        $i = 0;
        foreach($batiment as $b) {
            $q = $query->setParameter('building'.$i, $b->getBuildingFather());
            $i++;
        }

        return $q->setParameter('town', $town)
            ->getSingleScalarResult();
    }
}
