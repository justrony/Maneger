@extends('layouts.app')

@section('title', 'Adicionar Novo Cartão')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Adicionar Novo Cartão</h1>
            <a href="{{ route('cards.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Voltar para Meus Cartões
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Preencha os dados do seu novo cartão</h5>


                <form action="{{ route('cards.store') }}" method="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome do Cartão</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ex: Nubank, Inter, XP" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_four" class="form-label">Últimos 4 dígitos</label>
                            <input type="text" class="form-control @error('last_four') is-invalid @enderror" id="last_four" name="last_four" placeholder="Ex: 1234" value="{{ old('last_four') }}" required pattern="\d{4}" title="Digite exatamente 4 números.">
                            @error('last_four')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="maturity" class="form-label">Dia de Vencimento da Fatura</label>
                            <input type="number" class="form-control @error('maturity') is-invalid @enderror" id="maturity" name="maturity" min="1" max="31" placeholder="Ex: 15" value="{{ old('maturity') }}" required>
                            @error('maturity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="theme" class="form-label">Cor do Tema</label>
                            <input type="color" class="form-control form-control-color @error('theme') is-invalid @enderror" id="theme" name="theme" value="{{ old('theme', '#6c757d') }}" title="Escolha uma cor para o cartão">
                            @error('theme')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Cartão
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
