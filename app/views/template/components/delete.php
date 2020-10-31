<div class="modal fade"
	id="delete-dialog" role="dialog" tabindex="-1"
	data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="POST">
		<input type="hidden" name="_method" value="DELETE">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Confirmar Exclusão</h3>
				</div>
				<div class="modal-body">
					<span>Tem certeza que deseja apagar o registro?</span>
				</div>
				<div class="modal-footer">
					<button type="submit" id="confirmar-exclusao" class="btn btn-primary">Confirmar</button>
					<button type="button" id="cancelar-exclusao" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</form>
	</div>
</div>
