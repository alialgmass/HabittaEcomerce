<?php

namespace App\Http\Controllers\admin\review;

use App\Http\Controllers\Controller;
use App\Models\review\Review;
use Response;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::paginate(25);

        $reviews->load('product', 'user');
        return view('AdminPanel.reviews.index', [
            'active' => 'reviews',
            'title' => trans('common.reviews'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.reviews'),
                ],
            ],
        ], compact('reviews'));
    }

    public function show(Review $review)
    {
        return view('AdminPanel.reviews.show', [
            'active' => 'reviews',
            'title' => trans('common.reviews'),
            'breadcrumbs' => [
                [
                    'url' => route('reviews.index'),
                    'text' => trans('common.reviews'),
                ],
                [
                    'url' => '',
                    'text' => trans('common.details'),
                ],
            ],
        ], compact('review'));
    }

    public function destroy(Review $review)
    {
        if ($review) {
            $review->delete();
            return Response::json($review->id);
        } else {
            return Response::json(false);
        }
    }
}
