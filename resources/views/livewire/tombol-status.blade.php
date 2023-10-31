<div>
    <div class="form-check form-switch">
        <input class="form-check-input" wire:model.lazy="isActive" type="checkbox" role="switch"
            @if ($isActive) checked @endif data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-custom-class="custom-tooltip" data-bs-title="{{ $isActive === true ? 'Aktif' : 'Tidak Aktif' }}">
    </div>
</div>
