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
