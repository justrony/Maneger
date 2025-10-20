@extends('layouts.app')

@section('title', 'Meus Cartões')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">MCA</h1>{{-- Meus Cartões Ativos--}}

{{--            <a href="" class="btn btn-primary shadow-sm">--}}
{{--                <i class="fas fa-plus-circle"></i> Adicionar Novo Cartão--}}
{{--            </a>--}}
        </div>

        <div class="row">
            @forelse ($cards as $card)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow card-hover" style="background-color: {{$card->theme}}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-white">{{$card->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Dia {{$card->maturity}}</h6>

                            <p class="card-text font-monospace my-3 text-white">
                                **** **** **** {{$card->last_four}}
                            </p>

                            <a href="" class="btn btn-outline-light mt-auto">
                                Ver Fatura e Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <h4 class="alert-heading">Nenhum cartão cadastrado!</h4>
                        <p>Você ainda não adicionou nenhum cartão de crédito. Que tal começar agora?</p>
                        <hr>
                        <a href="{{ route('cards.create') }}" class="btn btn-success">Adicionar meu primeiro cartão</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-hover {
            transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
    </style>
@endsection
