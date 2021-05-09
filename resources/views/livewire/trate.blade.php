<div style="margin-bottom: 30px;">
    <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
        <div class="feed-text px-2">
            <h4 class="mt-2">Califique la tarea</h4>
            <h6 class="mt-2">Del 1 al 10 siendo 10 la máxima puntuación y 0 la mínima</h6>
        </div>
    </div>
    <div class="collapse.in" id="collapseExample">

        <div>
            <div class="card card-body">

                <form wire:submit.prevent="createRate">

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="score" value="{{ __('Califique la tarea (1 - 10)') }}" />
                        <x-jet-input id="score" type="number" class="mt-1 block w-full" wire:model="score" />
                        <x-jet-input-error for="score" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="speed" value="{{ __('Califique la rapidez (1 - 10)') }}" />
                        <x-jet-input id="speed" type="number" class="mt-1 block w-full" wire:model="speed" />
                        <x-jet-input-error for="speed" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="accuracy" value="{{ __('Califique la precisión (1 - 10)') }}" />
                        <x-jet-input id="accuracy" type="number" class="mt-1 block w-full" wire:model="accuracy" />
                        <x-jet-input-error for="accuracy" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="performance" value="{{ __('Califique la ejecución (1 - 10)') }}" />
                        <x-jet-input id="performance" type="number" class="mt-1 block w-full" wire:model="performance" />
                        <x-jet-input-error for="performance" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="comment" value="{{ __('Deja tu comentario (Opcional)') }}" />
                        <x-jet-input id="comment" type="text" class="mt-1 block w-full" wire:model="comment" />
                        <x-jet-input-error for="comment" class="mt-2" />
                    </div>

                    <div class="mt-3 mr-3">
                        <x-jet-button type="submit" wire:click="aceptar()">
                            <a href="{{ route('myTask') }}" class="underline">Aceptar</a>
                        </x-jet-button>
                    </div>
                    <div class="mt-3 mr-3">
                        <x-jet-button type="submit" wire:click="rechazar()">
                            <a href="{{ route('myTask') }}" class="underline">Rechazar</a>
                        </x-jet-button>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>