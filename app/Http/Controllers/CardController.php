<?php

namespace App\Http\Controllers;

use App\Models\Card;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function index(): View
    {
        $cards = Card::where('active', true)->get();

        return view('card.home', compact('cards'));
    }

    public function create(): View
    {
        return view('card.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:card',
            'maturity' => 'required|integer|between:1,31',
            'last_four' => 'required|integer|digits:4',
            'theme' => 'required|max:50',
        ];
        $message = [
            '*.required' => 'O campos obrigatorios não podem ser vazios!',
            'name.unique' => 'O nome já existe!',
            'maturity.integer' => 'A validade tem que ser um numero valido!',
            'maturity.between' => 'A validade tem que ser um dia valido!',
            'last_four.integer' => 'Os ultimos 4 tem que ser um numero valido!',
            'last_four.digits' => 'Os ultimos 4 tem que ter 4 numeros!',
            'theme.max' => 'O campo tem que ter 50 caracteres!',
        ];
        $validated = $request->validate($rules, $message);

        DB::beginTransaction();
        try {
            Card::create($validated);
            DB::commit();

            return redirect()->route('card.home')
                ->with('success', 'Cartão cadastrado com sucesso!');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show(Card $card): View
    {
        return view('card.show', compact('card'));
    }

    public function edit(Card $card): View
    {
        return view('card.edit', compact('card'));
    }
    public function update(Request $request, Card $card){
        $rules = [
            'name' => 'required|string|unique:card',
            'maturity' => 'required|numeric',
            'last_four' => 'required|numeric|digits:4',
            'theme' => 'required|string|max:50',
        ];
        $message = [
            '*.required' => 'Os campos obrigatorios devem ser preenchidos!',
            'name.unique' => 'O nome já existe!',
            'maturity.numeric' => 'A validade tem que ser numerico!',
            'last_four.numeric' => 'Os ultimos 4 tem que ser numerico!',
            'last_four.digits' => 'Os ultimos 4 tem que ter 4 numeros!',
            'theme.max' => 'O campo tem que ter 50 caracteres!',
        ];
        $validated = $request->validate($rules, $message);

        DB::beginTransaction();
        try {
            $card->update($validated);
            DB::commit();

            return redirect()->route('card.home')
                ->with('success', 'Cartão atualizado com sucesso!');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Card $card){
        DB::beginTransaction();
        try{
            $card->delete();
            DB::commit();
            return redirect()->route('card.home')
                ->with('success', 'Cartão deletado com sucesso!');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
