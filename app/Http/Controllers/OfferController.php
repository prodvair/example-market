<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Seller;
use App\Models\Product;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResources;

class OfferController extends Controller
{
    public function index(OfferRequest $request)
    {
        $query = Product::query()

            ->when($request->query('view', 'list'), function($query, $view) {
                if ($view === 'group') {
                    $query->with(['offers' => function ($query) {
                        $query->leftJoin('sellers', 'sellers.id', '=', 'offers.seller_id');
                    }]);
                } else {
                    $query->select([
                        'products.id as id',
                        'products.name as name',
                        'description',
                        'products.image as image',
                        'article',
                        'amount',
                        'count',
                        'sellers.name as seller_name',
                        'sellers.image as seller_image',
                        'products.created_at as created_at',
                        'products.updated_at as updated_at',
                    ])
                    ->leftJoin('offers', 'offers.id', '=', 'products.id')
                    ->leftJoin('sellers', 'sellers.id', '=', 'offers.seller_id');
                }
            })
            ->when($request->search, function($query, $search) {
                $query->whereRelation('product', 'name', 'like', "%{$search}%");
            })
            ->when($request->max_price, function($query, $max_price) {
                $query->whereRelation('offers', 'amount', '<=', (float) $max_price);
            })
            ->when($request->sort_by, function($query) use ($request) {
                $query->whereRelation($request->sort_by, $request->query('sort_type', 'asc'));
            });
            // ->select(
            //     'products.id as id',
            //     'products.name as name',
            //     'description',
            //     'products.image as image',
            //     'article',
            //     'amount',
            //     'count',
            //     'sellers.name as seller_name',
            //     'sellers.image as seller_image',
            //     'products.created_at as created_at',
            //     'products.updated_at as updated_at',
            // )
            // with(['offers' => function ($query) {
            //     $query->leftJoin('sellers', 'sellers.id', '=', 'offers.seller_id')->groupBy('offers.id', 'sellers.id');
            // }]);
            // ->leftJoin('sellers', 'sellers.id', '=', 'offers.seller_id');
        $perPage = $request->query('per_page', config("app.limit"));
        $maxPerPage = config("app.max_limit");


        $limit = config("app.limit");

        if ($perPage > $maxPerPage) {
            $perPage = $maxPerPage;
        }

        return OfferResources::collection($query->paginate($perPage));
    }
}
