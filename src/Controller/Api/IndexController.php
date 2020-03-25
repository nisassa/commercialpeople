<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\{League\LeagueManager, Team\TeamManager};
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};

/**
  * @Route("/api") 
  */
class IndexController extends AbstractController
{   
    /**
     * Get all teams in given league
     * 
     * @Route("/league/{id}/teams", name="get_league_teams", methods={"POST"})
     */
    public function getLeagueTeams(int $id, LeagueManager $leagueManager)
    {   
        $league = $leagueManager->loadById($id);
        if (! $league) {
            return new JsonResponse('League not found.', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            "teams" => $league->toArray()["teams"],  
        ]);
    }

     /**
     * Delete a league
     * 
     * @Route("/league/{id}/delete", name="delete_league", methods={"POST"})
     */
    public function deleteLeague(int $id, LeagueManager $leagueManager)
    {   
        $league = $leagueManager->loadById($id);
        if (! $league) {
            return new JsonResponse('League not found.', Response::HTTP_NOT_FOUND);
        }

        $leagueManager->delete($league);
        
        return new JsonResponse([
            "message" => "OK!",  
        ]);
    }

    /**
     * Create new team
     * 
     * @Route("/new/team", name="add_new_team", methods={"POST"})
     */
    public function newTeam(Request $request, TeamManager $teamManager, LeagueManager $leagueManager)
    {   
        $request = $request->request;
        if (! $request->has("name") or ! $request->has("strip") or ! $request->has("league_id"))  {
            return new JsonResponse('Missing parameters.', Response::HTTP_BAD_REQUEST);
        }

        $league = $leagueManager->loadById((int) $request->get("league_id"));
        if (! $league) {
            return new JsonResponse('League not found.', Response::HTTP_NOT_FOUND);
        }

        $team = $teamManager->createTeam((string) $request->get("name"), (string) $request->get("strip"), $league);
        return new JsonResponse([
            "team" => $team->toArray()
        ]);
    }

    /**
     * Update team
     * 
     * @Route("/update/team/{id}", name="update_team", methods={"POST"})
     */
    public function updateTeam(Request $request, TeamManager $teamManager, LeagueManager $leagueManager, int $id)
    {       
        $request = $request->request;
        if (! $request->has("name") or ! $request->has("strip") or ! $request->has("league_id"))  {
            return new JsonResponse('Missing parameters.', Response::HTTP_BAD_REQUEST);
        }

        $team = $teamManager->loadById($id);
        if (! $team) {
            return new JsonResponse('Team not found.', Response::HTTP_NOT_FOUND);
        }

        $league = $leagueManager->loadById((int) $request->get("league_id"));
        if (! $league) {
            return new JsonResponse('League not found.', Response::HTTP_NOT_FOUND);
        }

        $team = $teamManager->updateTeam($team, (string) $request->get("name"), (string) $request->get("strip"), $league);
        return new JsonResponse([
            "team" => $team->toArray()
        ]);
    }
}
