<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{

        public function store(Request $request){
        $rules =  [
            'name' => 'required|string|max:255',
            'store' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0|decimal:2',
            'invoice_id' => 'required|integer',
        ];
        $messages = [
            '*.required' => 'O :attribute é obrigatorio.',
            '*.max' => 'O :attribute precisa ter 255 caracteres.',
            'price.numeric' => 'O campo valor precisa ser numerico.',
            'price.min' => 'O valor precisa ser valido.',
            'price.decimal:2' => 'O campo valor precisa ter duas casas decimais.',
        ];

        $invoiceId = $request->input('invoice_id');
        $validated = $request->validate($rules, $messages);

        DB::beginTransaction();
        try{
            Purchase::create($validated);
            DB::commit();
            return redirect()->route('invoice.show', $invoiceId);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();

            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar a compra.');
        }
    }
    public function update(Request $request, Purchase $purchase)
    {
        $rules =  [
            'name' => 'required|string|max:255',
            'store' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0|decimal:2',
            'invoice_id' => 'required|integer',
        ];
        $messages = [
            '*.required' => 'O :attribute é obrigatorio.',
            '*.max' => 'O :attribute precisa ter 255 caracteres.',
            'price.numeric' => 'O campo valor precisa ser numerico.',
            'price.min' => 'O valor precisa ser valido.',
            'price.decimal:2' => 'O campo valor precisa ter duas casas decimais.',
        ];
        $invoiceId = $request->input('invoice_id');
        $validated = $request->validate($rules, $messages);
        DB::beginTransaction();

        try{
            $purchase->update($validated);
            DB::commit();

            return redirect()->route('invoice.show', $invoiceId);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();

            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a compra.');
        }
    }
}
