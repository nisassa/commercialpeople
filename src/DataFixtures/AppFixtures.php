<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\{Team, League};

class AppFixtures extends Fixture
{   
    /**
     * @var array $teams
     */
    private $teams = [];

    /**
     * @var array array
     */
    private $leagues = [];
    
    public function __construct()
    {   
        $this->leagues = [];

        $this->teams = [
            "Arsenal" => [
                "league" => "Premier League",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Liverpool" => [
                "league" => "Premier League",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Chelsea" => [
                "league" => "Premier League",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Leicester City" => [
                "league" => "Premier League",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Everton" => [
                "league" => "Premier League",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Barcelona" => [
                "league" => "La Liga",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Real Madrid" => [
                "league" => "La Liga",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "Juventus" => [
                "league" => "Serie A",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ], "A.C. Milan" => [
                "league" => "Serie A",
                "strip" => "RED: HEX COLOR: #EF0107; RGB: (239,1,7); HSL(356, 90%, 49%);",
            ]
        ];
    }

    public function load(ObjectManager $manager)
    {   

        foreach ($this->teams as $name => $data) {
  
            $leagueName = $data["league"];
            $league = ! empty($this->leagues[$leagueName]) ? $this->leagues[$leagueName] : null;
            if (! $league instanceof League) {
                $league = new League();
                $league->setName($leagueName);
                $manager->persist($league);

                $this->leagues[$leagueName] = $league;
            }
           
            $team = new Team();
            $team
                ->setName($name)
                ->setStrip($data["strip"])
                ->setLeague($league)
            ;            
            $manager->persist($team);
            $manager->flush();
        }
    }
}
