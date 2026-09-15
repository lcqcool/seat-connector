<div class="col-md-3">
  <div class="small-box bg-gray">
    <div class="inner">
      <h4 class="text-uppercase">
        <strong>{{ $metadata['name'] }}</strong>
      </h4>
      <div class="row">
        <div class="col-4 text-right">
          <b>Name</b>
        </div>
        <div class="col-8">
          @if($identity = $identities->where('connector_type', $driver)->first())
            <i>{{ $identity->display_name }}</i>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-4 text-right">
          <b>Unique ID</b>
        </div>
        <div class="col-8">
          @if($identity = $identities->where('connector_type', $driver)->first())
            <i>{{ $identity->unique_id }}</i>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-4 text-right">
          <b>Created on</b>
        </div>
        <div class="col-8">
          @if($identity = $identities->where('connector_type', $driver)->first())
            <i>{{ $identity->created_at }}</i>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-4 text-right">
          <b>Status</b>
        </div>
        <div class="col-8">
          @if($identities->where('connector_type', $driver)->isNotEmpty())
            <span class="badge badge-success p-1">
              <i class="fas fa-check-circle mr-1"></i> Registered
            </span>
          @else
            <span class="badge badge-danger p-1">
              <i class="fas fa-times-circle mr-1"></i> Unregistered
            </span>
          @endif
        </div>
      </div>
    </div>
    @if(array_key_exists('icon', $metadata))
      <div class="icon">
        <i class="{{ $metadata['icon'] }}"></i>
      </div>
    @endif
    @if($identities->where('connector_type', $driver)->isNotEmpty())
      <a class="small-box-footer" href="#" data-toggle="modal" data-target="#identity-name-modal-{{ $driver }}">
        <i class="fa fa-pen"></i>
        {{ trans('seat-connector::seat.edit_display_name') }}
      </a>
    @endif
    <a class="small-box-footer" href="{{ route(sprintf('seat-connector.drivers.%s.registration', $driver)) }}" target="_blank">
      <i class="fa fa-arrow-circle-right"></i>
      Join Server
    </a>
  </div>
</div>

@if($identity = $identities->where('connector_type', $driver)->first())
  <div class="modal fade" id="identity-name-modal-{{ $driver }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{ route('seat-connector.identities.name') }}">
        @csrf
        <input type="hidden" name="connector_type" value="{{ $driver }}">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ $metadata['name'] }} - {{ trans('seat-connector::seat.edit_display_name') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name-override-{{ $driver }}">{{ trans('seat-connector::seat.name_override') }}</label>
              <input type="text" class="form-control" id="name-override-{{ $driver }}" name="name_override" value="{{ $identity->name_override }}" placeholder="{{ trans('seat-connector::seat.enter_custom_name') }}">
              <small class="form-text text-muted">{{ trans('seat-connector::seat.name_override_hint') }}</small>
            </div>
            <p class="text-muted mb-0">{{ trans('seat-connector::seat.current_display_name') }}: <i>{{ $identity->display_name }}</i></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('seat-connector::seat.cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('seat-connector::seat.save') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endif