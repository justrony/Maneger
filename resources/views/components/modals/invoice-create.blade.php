<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Adicionar Nova Fatura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('invoice.store')}}" method="POST">
                @csrf
                <input type="hidden" name="card_id" value="{{ $card->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="invoiceName" class="form-label">Nome/Referência</label>
                        <input type="text" class="form-control" id="invoiceName" name="name" placeholder="Ex: Fatura de Janeiro" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Fatura</button>
                </div>
            </form>
        </div>
    </div>
</div>
