<?php

namespace App\Service\League;

use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;

class LeagueManager
{   
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Contructor
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    

    /**
     * Get league entity by id
     * 
     * @var int $id
     */
    public function loadById(int $id): ?League
    {   
        return $this->em->getRepository(League::class)->findOneById($id);
    }

    /**
     * Delete League
     * @param League $league
     */
    public function delete(League $league)
    {
        $this->em->remove($league);
        $this->em->flush();
    }
}
