<?php

namespace App\Service\Team;

use App\Entity\{Team, League};
use Doctrine\ORM\EntityManagerInterface;

class TeamManager
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
     * Get team entity by id
     * 
     * @var int $id
     */
    public function loadById(int $id): ?Team
    {   
        return $this->em->getRepository(Team::class)->findOneById($id);
    }

    /**
     * Create new team
     * 
     * @param string $name
     * @param string $strip
     * @param League $league
     * @return Team
     */
    public function createTeam(string $name, string $strip, League $league): Team
    {
        $team = new Team();
        $team
            ->setName($name)
            ->setStrip($strip)
            ->setLeague($league)
        ;
        $this->persist($team);
        return $team;
    }
        
    /**
     * Update existent team
     * 
     * @param string $name
     * @param string $strip
     * @param League $league
     * @return Team
     */
    public function updateTeam(Team $team, string $name, string $strip, League $league): Team
    {
        $team
            ->setName($name)
            ->setStrip($strip)
            ->setLeague($league)
        ;
        $this->persist($team);
        return $team;
    }

    /**
     * persist 
     * @param Team $team
     * @return null
     */
    private function persist($team)
    {
        $this->em->persist($team);
        $this->em->flush();
    }
}
