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
        $productQuery = Product::query()
            ->select(
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
            )
            ->leftJoin('offers', 'products.id', '=', 'offers.product_id')
            ->leftJoin('sellers', 'sellers.id', '=', 'offers.seller_id')
            ->groupBy('product.id', 'products.name', 'description', 'products.image');
        $where = [];
        $orderBy = [];

        if ($request->has('search') && $request->search != '') {
            array_push($where, ['products.name', 'LIKE', "%{$request->search}%"]);
        }

        if ($request->has('sortBy') && $request->sortBy != '') {
            if ($request->has('sortType') && $request->sortType != '') {
                $productQuery->orderBy($request->sortBy, $request->sortType);
            } else {
                $productQuery->orderBy($request->sortBy, 'DESC');
            }
        }

        $limit = config("app.limit");

        if ($request->per_page && (int) $request->per_page <= config("app.max_limit")) {
            $limit = (int) $request->per_page;
        }

        return OfferResources::collection($productQuery->having($where)->paginate($limit));
    }
}
