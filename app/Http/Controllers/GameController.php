<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function rouletteSpin(Request $request)
    {
        $request->validate(['bet_amount' => 'required|numeric|min:0.1']);
        $user = $request->user();
        if ($user->balance < $request->bet_amount) {
            return response()->json(['error' => 'Saldo insuficiente.'], 400);
        }
        $user->balance -= $request->bet_amount;
        $winningNumber = rand(0, 36);
        $winAmount = 0;
        if (isset($request->bet_number) && $request->bet_number == $winningNumber) {
            $winAmount = $request->bet_amount * 35;
            $user->balance += $winAmount;
        }
        $user->save();
        return response()->json([
            'winning_number' => $winningNumber,
            'win' => $winAmount > 0,
            'win_amount' => $winAmount,
            'balance' => $user->balance,
        ]);
    }
    
    public function crashStart(Request $request)
    {
        $crashPoint = (rand(100, 800) / 100);
        return response()->json([
            'game_id' => uniqid('crash_'),
            'crash_point' => $crashPoint
        ]);
    }
    
    public function minesPlay(Request $request)
    {
        $request->validate(['bet_amount' => 'required|numeric', 'mines_count' => 'required|integer']);
        $isBomb = (bool) (rand(1, 100) > 75);
        if ($isBomb) {
            return response()->json(['is_bomb' => true, 'payout' => 0, 'message' => 'Você encontrou uma bomba!']);
        }
        $payoutMultiplier = 1.25;
        $winAmount = $request->bet_amount * $payoutMultiplier;
        return response()->json(['is_bomb' => false, 'payout' => $winAmount]);
    }
}
