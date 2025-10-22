@extends('layouts.app')

@section('title', 'Editar Cartão')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Editar Cartão: <span class="text-primary">{{ $card->name }}</span></h1>
            <a href="{{ route('card.home') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Voltar para Meus Cartões
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Altere os dados do seu cartão</h5>

                <form action="{{ route('card.update', $card->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome do Cartão</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $card->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_four" class="form-label">Últimos 4 dígitos</label>
                            <input type="text" class="form-control @error('last_four') is-invalid @enderror" id="last_four" name="last_four" value="{{ old('last_four', $card->last_four) }}" required pattern="\d{4}">
                            @error('last_four') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="maturity" class="form-label">Dia de Vencimento da Fatura</label>
                            <input type="number" class="form-control    @error('maturity') is-invalid @enderror" id="maturity" name="maturity" min="1" max="31" value="{{ old('maturity', $card->maturity) }}" required>
                            @error('maturity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="theme" class="form-label">Cor do Tema</label>
                            <input type="color" class="form-control form-control-color @error('theme') is-invalid @enderror" id="theme" name="theme" value="{{ old('theme', $card->theme) }}">
                            @error('theme') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" @if(old('active', $card->active)) checked @endif>
                        <label class="form-check-label" for="active">Manter Cartão Ativo</label>
                        <small class="d-block text-muted">Desative esta opção para arquivar o cartão. Ele não aparecerá na lista principal.</small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

