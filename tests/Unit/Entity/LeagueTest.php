<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\{Team, League};

class LeagueTest extends TestCase
{
    public function testToArray()
    {   
        $league = new League();
        $league->setName("La Liga");
        
        $team = new Team();
        $team->setName("Athletic Bilbao");
        $team->setStrip("strip");
        $team->setLeague($league);
    
        $team2 = new Team();
        $team2->setName("Atalanta");
        $team2->setStrip("strip");
        $team2->setLeague($league);
        
        $league->addTeam($team);
        $league->addTeam($team2);
    
        $this->assertEquals(2, count($league->toArray()));
        $this->assertEquals($league->getName(), $league->toArray()["name"]);
        $this->assertEquals(2, count($league->toArray()["teams"]));
        $this->assertContains($team->getName(), $league->toArray()["teams"][0]);
        $this->assertContains($team2->getName(), $league->toArray()["teams"][1]);
    }
}