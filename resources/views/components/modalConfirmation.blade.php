<div class="modal fade" id="deleteModal{{ $objId }}" tabindex="-1"
    aria-labelledby="modalLabel{{ $objId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $objId }}">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir <strong>{{ $objNome }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-4" data-bs-dismiss="modal">Cancelar</button>

                <form action="{{ route($action, $objId) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
