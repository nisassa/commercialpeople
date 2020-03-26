<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\{Team, League};

class TeamTest extends TestCase
{
    public function testToArray()
    {   
        $league = new League();
        $league->setName("La Liga");
        
        $team = new Team();
        $team->setName("Athletic Bilbao");
        $team->setStrip("strip");
        $team->setLeague($league);

        $this->assertEquals(3, count($team->toArray()));
        $this->assertContains("Athletic Bilbao", $team->toArray());
        $this->assertEquals($league->getName(), $team->toArray()["league"]);
    }
}