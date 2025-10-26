 <div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-labelledby="editInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInvoiceModalLabel">Editar Fatura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editInvoiceForm" action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="card_id" value="{{ $card->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editInvoiceName" class="form-label">Nome/Referência</label>
                            <input type="text" class="form-control" id="editInvoiceName" name="name" required>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input type="hidden" name="open" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   role="switch"
                                   id="editInvoiceOpen"
                                   name="open"
                                   value="1">
                            <label class="form-check-label" for="editInvoiceOpen">Fatura Aberta</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
