<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    /**
     * Summary of createReview
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     */
    public function createReview(Model $model, array $data)
    {
        return $model->review()->create([
            'user_id' => Auth::id(),
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);
    }

    /**
     * Summary of getReviewsByType
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection<int, Review>
     */
    public function getReviewsByType(string $type)
    {
        return Review::with(['user', 'reviewable'])
            ->where('reviewable_type', $type)
            ->latest()
            ->get();
    }

    /**
     * Summary of getAllReviews
     * @return \Illuminate\Database\Eloquent\Collection<int, Review>
     */
    public function getAllReviews()
    {
        return Review::with(['user', 'reviewable'])->latest()->get();
    }

    /**
     * Summary of getBestRatedItem
     * @param string $type
     * @param mixed $modelClass
     */
    public function getBestRatedItem(string $type, $modelClass)
    {
        $bestId = Review::where('reviewable_type', $type)
            ->select('reviewable_id', DB::raw('AVG(rating) as avg_rating'))
            ->groupBy('reviewable_id')
            ->orderByDesc('avg_rating')
            ->value('reviewable_id');

        return $bestId ? $modelClass::find($bestId) : null;
    }
}