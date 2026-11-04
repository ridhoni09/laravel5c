<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $today = Carbon::today();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd = $today->copy()->endOfWeek();

        $stats = [
            'recipes' => $user->recipes()->count(),
            'favorites' => $user->favoriteRecipes()->count(),
            'reviews' => $user->reviews()->count(),
            'meal_plans' => $user->mealPlans()->count(),
        ];

        $recentRecipes = Recipe::query()
            ->with(['user:id,name', 'category:id,name'])
            ->where(function ($query) use ($user): void {
                $query->where('is_public', true)
                    ->orWhere('user_id', $user->id);
            })
            ->latest()
            ->limit(6)
            ->get();

        $activePlan = $user->mealPlans()
            ->whereDate('start_date', '<=', $today->toDateString())
            ->whereDate('end_date', '>=', $today->toDateString())
            ->latest('start_date')
            ->first();

        $weekMeals = collect();
        if ($activePlan) {
            $weekMeals = $activePlan->recipes()
                ->wherePivotBetween('planned_date', [
                    $weekStart->toDateString(),
                    $weekEnd->toDateString(),
                ])
                ->orderByPivot('planned_date')
                ->get()
                ->groupBy(fn ($recipe) => Carbon::parse($recipe->pivot->planned_date)->toDateString());
        }

        $weekDays = collect(range(0, 6))->map(fn ($offset) => $weekStart->copy()->addDays($offset));

        return view('dashboard', compact('user', 'stats', 'recentRecipes', 'activePlan', 'weekMeals', 'weekDays'));
    }
}
