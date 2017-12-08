<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LikeProduto;
class LikeProdutoController extends Controller
{
    public function curtir(Request $request)
    {
    	$userId = request()->user()->id;

    	if (LikeProduto::where('user_id', $userId)->where('product_id', $request->produto_id)->count() > 0) {
    		LikeProduto::where('user_id', $userId)
    					->where('product_id', $request->produto_id)
    					->delete();
    	} else {
    		LikeProduto::create(['user_id' => $userId, 'product_id' => $request->produto_id]);
    	}

      	$likes 	= LikeProduto::where('product_id', $request->produto_id)->get();

      	return ['likes' => $likes];

    }

}
