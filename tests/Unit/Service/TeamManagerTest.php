<?php

namespace App\Tests\Unit\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\Team\TeamManager;
use App\Entity\{Team, League};

class TeamManagerTest extends KernelTestCase
{   
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var TeamManager
     */
    private $teamManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
        $this->teamManager = new TeamManager($this->entityManager);
    }
    
    public function testLoadById()
    {   
        // case when team exists in db
        $team = $this->teamManager->loadById(3);
        $this->assertInstanceOf(Team::class, $team);

        // case when team doesn't exist in db
        $team = $this->teamManager->loadById(-1);
        $this->assertNull($team);
    }

    public function testCreateNewTeam()
    {   
        $league = $this->entityManager->getRepository(League::class)->findOneById(1);
        
        // test create new team
        $team = $this->teamManager->createTeam("Manchester City Test", "red and white", $league);
        $this->assertInstanceOf(Team::class, $team);
        
        // test update team
        $team = $this->teamManager->updateTeam($team, "Manchester United Rest", "Red", $league);
        $this->assertEquals("Manchester United Rest", $team->getName());

        // test delete team
        $this->teamManager->delete($team);    
        $this->assertNull($team->getId());
    }
}