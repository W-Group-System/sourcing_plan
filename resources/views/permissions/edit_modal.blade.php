<div class="modal fade" id="assign_permissions{{ $user->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('users.permissions.update', $user->id) }}">
                @csrf
                <div class="modal-body">
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                class="form-check-input"
                                {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-3">Save Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>
