<div class="modal fade" id="editPurchaseModal" tabindex="-1" aria-labelledby="editPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPurchaseModalLabel">Adicionar Nova Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPurchaseForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="purchaseNameEdit" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="purchaseNameEdit" name="name" placeholder="Nome do produto" value="" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purchasePriceEdit" class="form-label">Valor (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="purchasePriceEdit" name="price" placeholder="19.90" value="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="purchaseStoreEdit" class="form-label">Loja</label>
                            <input type="text" class="form-control" id="purchaseStoreEdit" name="store" placeholder="Ex: iFood, Uber, Supermercado" value="" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="purchaseDescriptionEdit" class="form-label">Descrição</label>
                        <textarea class="form-control" id="purchaseDescriptionEdit" name="description" placeholder="Ex: Sobre" required></textarea>
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
