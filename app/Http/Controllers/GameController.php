<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Image;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = 2;
        $top6 = Image::orderByDesc('rank')->orderByDesc('score')->take(6)->get();
        $images = Image::inRandomOrder()->limit(2)->get();
        if (count($images)) {
            return view('pages.game', compact('images', 'top6'));
        }
        return redirect('images');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $winner = Image::find($request->winner);
        $loser = Image::find($request->loser);

        $wins = $winner->wins + 1;
        $winner_expected_score = Game::expected($loser->score, $winner->score);
        $winner_new_score = Game::win($winner->score, $winner_expected_score);
        $winner_rank = Game::rank($winner_new_score, $winner->losses, $winner->wins);


        $winner->update([
            'score' => $winner_new_score,
            'wins' => $wins,
            'rank' => $winner_rank
        ]);


        $losses = $loser->losses + 1;
        $loser_expected_score = Game::expected($winner->score, $loser->score);

        $loser_new_score = Game::loss($loser->score, $loser_expected_score);
        $loser_rank = Game::rank($loser_new_score, $loser->losses, $loser->wins);

        //dd(["expected score", $winner_expected_score], ["winner new score", $winner_new_score], ["winner rank", $winner_rank], ["expected loser score", $loser_expected_score], ["loser new score", $loser_new_score], ["loser rank", $loser_rank]);

        $loser->update([
            'score' => $loser_new_score,
            'losses' => $losses,
            'rank' => $loser_rank
        ]);


        Game::create([
            'winner' => $request->winner,
            'loser' => $request->loser,
        ]);
        // dd($winner_expected_score);
        // dd($winner);

        return redirect()->back()->with('success', 'Score table updated. Lets continue.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
