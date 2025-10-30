<div class="modal fade" id="viewPurchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Detalhes da Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p><strong>ID:</strong> <span id="modalPurchaseId">{{$purchase->id}}</span></p>
                <p><strong>Nome:</strong> <span id="modalPurchaseName">{{$purchase->name}}</span></p>
                <p><strong>Loja:</strong> <span id="modalPurchaseStore">{{$purchase->store}}</span></p>
                <p><strong>Preço:</strong> <span id="modalPurchasePrice">{{$purchase->price}}</span></p>

                <div id="modalDescriptionWrapper">
                    <p><strong>Descrição:</strong></p>
                    <p><span id="modalPurchaseDescription">{{$purchase->description}}</span></p>
                </div>

                <hr>
                <small class="text-muted">
                    <strong>Cadastrado em:</strong> <span id="modalPurchaseCreatedAt">{{$purchase->created_at->format('d/m/Y')}}</span><br>
                </small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
