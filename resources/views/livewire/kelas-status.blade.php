<div>
    <div class="form-check form-switch">
        <input class="form-check-input" wire:model.lazy="isActive" type="checkbox" role="switch"
            @if ($isActive) checked @endif> {{ $isActive === true ? 'aktif' : 'Tidak Aktif' }}
    </div>
</div>
