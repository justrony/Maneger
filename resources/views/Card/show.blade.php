@extends('layouts.app')

@section('title', 'Detalhes do Cartão')

@section('content')
    <style>
        .table-responsive {
            overflow: visible !important;
        }

        td {
            overflow: visible !important;
        }
    </style>
    <div class="container mt-5">

        @include('error.notifier')

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="h2 mb-2 mb-md-0">Detalhes do Cartão</h1>
            <a href="{{ route('card.home') }}" class="btn btn-secondary shadow-sm">
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
                        <p class="card-text mt-auto text-end opacity-75"></p>
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
                            <a href="{{ route('card.edit', $card) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Editar Cartão
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="h3 mb-2 mb-md-0">Faturas do Cartão</h2>

            <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addInvoiceModal">
                <i class="fas fa-plus-circle"></i> Adicionar Nova Fatura
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Referência</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end pe-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td class="ps-4 align-middle">{{ date('F/Y', mktime(0, 0, 0, $invoice->reference_month, 1, $invoice->reference_year)) }}</td>
                                <td class="align-middle">R$ {{ number_format($invoice->amount, 2, ',', '.') }}</td>
                                <td class="align-middle">
                                    @if($invoice->open)
                                        <span class="badge bg-success">Aberta</span>
                                    @else
                                        <span class="badge bg-danger">Fechada</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <ul class="list-unstyled d-flex justify-content-end">
                                        <li>
                                            <a href="{{route('invoice.show',$invoice)}}" class="btn btn-sm btn-warning" title="Ver Detalhes da Fatura">
                                                <i class="fas fa-eye text-white"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <button class="text-white btn btn-primary btn-sm ms-1"
                                                    id="btnDropdown"
                                                    data-bs-container="body"
                                                    role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="{{route('invoice.destroy',$invoice)}}">Deletar</a></li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="#"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#editInvoiceModal"
                                                       data-bs-form-action="{{ route('invoice.update', $invoice) }}"
                                                       data-bs-invoice-name="{{ $invoice->name }}"
                                                       data-bs-invoice-open="{{ $invoice->open ? 'true' : 'false' }}">
                                                        Editar / Fechar Fatura
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
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

        @include('components.modals.invoice-create')
        @include('components.modals.invoice-update')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editInvoiceModal = document.getElementById('editInvoiceModal');

            editInvoiceModal.addEventListener('show.bs.modal', function (event) {

                var button = event.relatedTarget;

                var formAction = button.getAttribute('data-bs-form-action');
                var invoiceName = button.getAttribute('data-bs-invoice-name');
                var invoiceOpen = button.getAttribute('data-bs-invoice-open');

                var modalForm = document.getElementById('editInvoiceForm');
                var modalNameInput = document.getElementById('editInvoiceName');
                var modalOpenSwitch = document.getElementById('editInvoiceOpen');

                modalForm.action = formAction;
                modalNameInput.value = invoiceName;
                modalOpenSwitch.checked = (invoiceOpen === 'true');
            });
        });
    </script>
@endsection
