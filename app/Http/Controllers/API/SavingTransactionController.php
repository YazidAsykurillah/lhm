<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\SavingTransaction;
use App\Http\Resources\SavingTransactionResource;
use Illuminate\Http\JsonResponse;

class SavingTransactionController extends BaseController
{
    public function index():JsonResponse
    {

        $saving_transactions = SavingTransaction::query()
            ->where('user_id', '=',auth()->user()->id)
            ->get();
        return $this->sendResponse(SavingTransactionResource::collection($saving_transactions), 'Saving transactions list');
    }
}
