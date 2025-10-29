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
                        <h4 class="text-primary mb-0">R$ {{ number_format($invoice->amount, 2, ',', '.') }}</h4>
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
                            <th scope="col" class="ps-4">Descrição</th>
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
                                    <button class="btn btn-sm btn-info text-white" title="Editar Compra">
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
                                <td colspan="2" class="ps-4 text-end">Total Calculado:</td>
                                <td>R$ {{ number_format($invoice->purchase->sum('price'), 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="ps-4 text-end text-danger">Valor (Fatura):</td>
                                <td class="text-danger">R$ {{ number_format($invoice->amount, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addPurchaseModal" tabindex="-1" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPurchaseModalLabel">Adicionar Nova Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('purchase.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="purchaseName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="purchaseName" name="name" placeholder="Nome do produto" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="purchasePrice" class="form-label">Valor (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="purchasePrice" name="price" placeholder="19.90" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purchaseStore" class="form-label">Loja</label>
                                <input type="text" class="form-control" id="purchaseStore" name="store" placeholder="Ex: iFood, Uber, Supermercado" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaseDescription" class="form-label">Descrição</label>
                            <textarea class="form-control" id="purchaseDescription" name="description" placeholder="Ex: Sobre" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
