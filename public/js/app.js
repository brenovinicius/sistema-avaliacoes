$('#delete-dialog').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var id = button.data('id');
	var action = button.data('url');
	var modal = $(this);
	var form = modal.find('form');
	if (!action.endsWith('/')) {
		action += '/';
	}
	form.attr('action', action + id);
});
