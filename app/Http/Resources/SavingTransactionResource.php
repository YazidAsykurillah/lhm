<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'transaction_source' => $this->transaction_source,
            'sender_name' => $this->sender_name,
            'bank_account_id' => $this->bank_account_id,
            'bank_account_name' => $this->bank_account->name,
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date,
            'transaction_receipt' => $this->transaction_receipt,
            'is_confirmed' => $this->is_confirmed,
            'confirmator_id' => $this->confirmator_id,
            'umrah_manifest_id' => $this->umrah_manifest_id,
            'umrah_batch_id' => $this->umrah_manifest->umrah_batch->id,
            'umrah_batch_code' => $this->umrah_manifest->umrah_batch->code_batch,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            //'bearer_token'=>$request->bearertoken(),
            //'user'=>$request->user()
        ];
    }
}
