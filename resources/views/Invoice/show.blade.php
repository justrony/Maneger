@extends('layouts.app')

@section('title', 'Detalhes da Fatura')

@section('content')
    <div class="container mt-5">

        @include('error.notifier')
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="h2 mb-2 mb-md-0">Detalhes da Fatura</h1>
            <a href="{{ route('card.show', $invoice->card) }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Voltar para o Cartão
            </a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $invoice->name }}</h5>
                @if($invoice->open)
                    <span class="badge bg-success">Aberta</span>
                @else
                    <span class="badge bg-danger">Fechada</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Cartão:</strong>
                        <p>{{ $invoice->card->name }} (Final {{ $invoice->card->last_four }})</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Referência:</strong>
                        <p>{{ date('F/Y', mktime(0, 0, 0, $invoice->reference_month, 1, $invoice->reference_year)) }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Valor Total:</strong>
                        <h4 class="text-primary mb-0">R$ {{ number_format($invoice->purchase->sum('price'), 2, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="h3 mb-2 mb-md-0">Compras Registradas</h2>
            <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addPurchaseModal">
                <i class="fas fa-plus-circle"></i> Adicionar Nova Compra
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Produto</th>
                            <th scope="col">Data</th>
                            <th scope="col">Valor</th>
                            <th scope="col" class="text-end pe-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoice->purchase as $purchase)
                            <tr>
                                <td class="ps-4 align-middle">{{ $purchase->name }}</td>
                                <td class="align-middle">{{ $purchase->created_at->format('d/m/Y') }}</td>
                                <td class="align-middle">R$ {{ number_format($purchase->price, 2, ',', '.') }}</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-info text-white" title="Detalhes da Compra" data-bs-toggle="modal" data-bs-target="#viewPurchaseModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning text-white" title="Editar Compra" data-bs-toggle="modal" data-bs-target="#editPurchaseModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Excluir Compra">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-center p-4">
                                        <h5 class="text-muted">Nenhuma compra registrada!</h5>
                                        <p>Esta fatura ainda não possui compras lançadas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        @if($invoice->purchase->count() > 0)
                            <tfoot class="table-group-divider fw-bold">
                            <tr>
                                <td colspan="2" class="ps-4 text-end">Total:</td>
                                <td>R$ {{ number_format($invoice->purchase->sum('price'), 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('components.modals.purchase-create')
    @include('components.modals.purchase-update')
    @include('components.modals.purchase-show')
@endsection
