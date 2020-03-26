<?php

namespace App\Tests\Unit\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\League\LeagueManager;
use App\Entity\League;

class LeagueManagerTest extends KernelTestCase
{   
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var LeagueManager
     */
    private $leagueManager;

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
        $this->leagueManager = new LeagueManager($this->entityManager);
    }
    
    public function testLoadById()
    {   
        // case when league exists in db
        $league = $this->leagueManager->loadById(1);
        $this->assertInstanceOf(League::class, $league);

        // case when league doesn't exist in db
        $league = $this->leagueManager->loadById(-1);
        $this->assertNull($league);
    }

    public function testCreateNewAndDelete()
    {   

        $league = new League();
        $league->setName("Bundesliga");
    
        $this->entityManager->persist($league);
        $this->entityManager->flush();
        
        // test if the new legue it's been created 
        $this->assertNotNull($league->getId());
        
        // test delete league
        $this->leagueManager->delete($league);    
        $this->assertNull($league->getId());
    }
}