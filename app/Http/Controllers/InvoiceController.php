<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }

    public function create(){
        return view('invoice.create');
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|string|max:50',
            'card_id' => 'required|integer|exists:card,id',
            'status' => 'boolean|nullable',
        ];
        $messages = [
            '*.required' => 'Os campos obrigatorios devem ser preenchidos!',
            'name.max' => 'O nome deve ter no maximo 50 caracteres!',
        ];

        $validated = $request->validate($rules, $messages);

        DB::beginTransaction();

        try{
            Invoice::create($validated);
            DB::commit();

            return redirect()->route('invoice.index')
                ->with('success', 'Fatura aberta com sucesso!');
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }

    }
        public function show()
        {
            return view('invoice.show');
        }

        public function edit(){
            return view('invoice.edit');
        }

        public function update(Request $request, Invoice $invoice){

            $rules = [
                'name' => 'required|string|max:50',
                'card_id' => 'required|integer|exists:card,id',
                'status' => 'boolean|nullable',
            ];
            $messages = [
                '*.required' => 'Os campos obrigatorios devem ser preenchidos!',
                'name.max' => 'O nome deve ter no maximo 50 caracteres!',
            ];

            $validated = $request->validate($rules, $messages);

            DB::beginTransaction();

            try{
                $invoice::update($validated);
                DB::commit();

                return redirect()->route('invoice.index')
                    ->with('success', 'Fatura Atualizada com sucesso!');
            }catch(\Exception $e){
                DB::rollback();
                Log::error($e->getMessage());

                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        public function destroy(Invoice $invoice){
            DB::beginTransaction();
            try{
                $invoice->delete();
                DB::commit();
                return redirect()->route('invoice.index')
                    ->with('success', 'Fatura deletada com sucesso!');
            }catch (\Exception $e){
                DB::rollback();
                Log::error($e->getMessage());

                return redirect()->back()->with('error', $e->getMessage());
            }
        }
}
