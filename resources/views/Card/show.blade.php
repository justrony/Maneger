@extends('layouts.app')

@section('title', 'Detalhes do Cartão')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="h2 mb-2 mb-md-0">Detalhes do Cartão</h1>
            <a href="{{ route('cards.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Voltar para Meus Cartões
            </a>
        </div>

        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card h-100 shadow" style="background-color: {{ $card->theme }}; min-height: 220px;">
                    <div class="card-body d-flex flex-column text-white p-4">
                        <h4 class="card-title">{{ $card->name }}</h4>
                        <h6 class="card-subtitle mb-2" style="color: rgba(255,255,255,0.8);">Vencimento dia {{ $card->maturity }}</h6>

                        <div class="my-auto">
                            <p class="card-text font-monospace fs-4 text-center">
                                **** **** **** {{ $card->last_four }}
                            </p>
                        </div>

                        <p class="card-text mt-auto text-end opacity-75">
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Informações e Ações</h5>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status
                                @if($card->active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo/Arquivado</span>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Nome:</strong> {{ $card->name }}</li>
                            <li class="list-group-item"><strong>Final:</strong> {{ $card->last_four }}</li>
                            <li class="list-group-item"><strong>Vencimento da Fatura:</strong> Dia {{ $card->maturity }} de cada mês</li>
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Editar Cartão
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="h3 mb-2 mb-md-0">Faturas do Cartão</h2>
            <a href="#" class="btn btn-success shadow-sm">
                <i class="fas fa-plus-circle"></i> Adicionar Nova Fatura
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Referência</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end pe-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($card->invoices->sortByDesc('reference_year')->sortByDesc('reference_month') as $invoice)
                            <tr>
                                <td class="ps-4 align-middle">{{ date('F/Y', mktime(0, 0, 0, $invoice->reference_month, 1, $invoice->reference_year)) }}</td>
                                <td class="align-middle">R$ {{ number_format($invoice->amount, 2, ',', '.') }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}</td>
                                <td class="align-middle">
                                    @if($invoice->status == 'paid')
                                        <span class="badge bg-success">Paga</span>
                                    @elseif(\Carbon\Carbon::parse($invoice->due_date)->isPast() && $invoice->status != 'paid')
                                        <span class="badge bg-danger">Atrasada</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Aberta</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="#" class="btn btn-sm btn-info" title="Ver Detalhes da Fatura">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center p-4">
                                        <h5 class="text-muted">Nenhuma fatura encontrada!</h5>
                                        <p>Este cartão ainda não possui faturas cadastradas. Que tal adicionar a primeira?</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
