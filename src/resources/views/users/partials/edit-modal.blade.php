<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('seat-connector::seat.edit_user_mapping') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('seat-connector.users.edit') }}" method="POST">
                    @csrf()
                    <input type="hidden" name="user_id">
                    <div class="form-group">
                        <label for="connector-id">{{ trans('seat-connector::seat.connector_id') }}</label>
                        <input type="text" class="form-control mb-1" id="connector-id" name="connector_id" placeholder="{{ trans('seat-connector::seat.enter_connector_id') }}">
                        <small class="form-text text-muted">{{ trans('seat-connector::seat.connector_id_hint') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="name-override">{{ trans('seat-connector::seat.name_override') }}</label>
                        <input type="text" class="form-control mb-1" id="name-override" name="name_override" placeholder="{{ trans('seat-connector::seat.enter_custom_name') }}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="name_override_enable" id="name-override-enable">
                            <label class="form-check-label" for="name-override-enable">
                                {{ trans('seat-connector::seat.enable_name_override') }}
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ trans('seat-connector::seat.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('seat-connector::seat.close') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script>
        $('#userModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget)
            const modal = $(this)

            modal.find('.modal-body input[name="user_id"]').val(button.data('user-id'))
            modal.find('.modal-body input[name="connector_id"]').val(button.data('connector-id'))
            modal.find('.modal-body input[name="name_override"]').val(button.data('name-override'))

            const name_override = button.data('name-override')
            const has_override = name_override !== undefined && name_override !== null && name_override !== ''
            modal.find('.modal-body input[name="name_override_enable"]').prop('checked', has_override)
        })

        $('#name-override').on('input', function (e) {
            const modal = $('#userModal')
            modal.find('.modal-body input[name="name_override_enable"]').prop('checked', $(this).val().length > 0)
        })
    </script>
@endpush
