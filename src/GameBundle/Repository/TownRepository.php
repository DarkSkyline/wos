<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Repository;

/**
 * TownRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TownRepository extends \Doctrine\ORM\EntityRepository
{
    public function getRessource($id) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT tr, r FROM GameBundle:TownRessource tr
                 JOIN tr.ressource r
                 WHERE tr.town = :id'
            )
            ->setParameter('id', $id)
            ->getResult();
    }
}
