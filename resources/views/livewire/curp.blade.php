<div class="container mt-5">
    <div class="row mb-4">
        <div class="col">
            <input type="text" wire:model.defer="searchClave" wire:keydown.enter="buscar" class="form-control"
                placeholder="Buscar por clave...">
        </div>
        <div class="col">
            <input type="text" wire:model.defer="searchNombre" wire:keydown.enter="buscar" class="form-control"
                placeholder="Buscar por nombre...">
        </div>
        <div class="col">
            <input type="text" wire:model.defer="searchCorreo" wire:keydown.enter="buscar" class="form-control"
                placeholder="Buscar por correo...">
        </div>
        <div class="col">
            <input type="text" wire:model.defer="searchTelefono" wire:keydown.enter="buscar" class="form-control"
                placeholder="Buscar por teléfono...">
        </div>
        <div class="col">
            <button class="btn btn-primary" wire:click="buscar">Buscar</button>
            <button class="btn btn-secondary" wire:click="limpiar">Limpiar</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="mb-3">
                @if($datos->total() >= 0)
                    {{ __('Showing') }}
                    @if(!$datos->firstItem())
                        {{ $datos->firstItem() }}
                    @else
                        {{ __('of') }}
                    @endif
                    @if($datos->firstItem())
                        {{ $datos->firstItem() }}
                    @else
                        0
                    @endif
                    {{ __('to') }}
                    @if($datos->lastItem())
                        {{ $datos->lastItem() }}
                    @else
                        0
                    @endif
                    {{ __('of') }} {{ $datos->total() }} {{ __('entradas') }}
                @endif
            </p>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Clave cliente</th>
                        <th>Nombre contacto</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono contacto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->clave }}</td>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->correo }}</td>
                            <td>{{ $dato->telefono }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datos->links() }}
        </div>
    </div>
</div>
