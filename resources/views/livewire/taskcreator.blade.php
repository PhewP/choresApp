<div style="margin-bottom: 30px;">
  <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
    <div class="feed-text px-2">
      <h6 class="mt-2">Crear tarea</h6>
    </div>
    <i id="plusButton" class="fa fa-plus" role="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded:="true" aria-controls="collapseExample">
    </i>
  </div>
  <div class="collapse.show" id="collapseExample">

    <div>
      <div class="card card-body">

        <form wire:submit.prevent="createTask">

          <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="title" value="{{ __('Título') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" />
            <x-jet-input-error for="title" class="mt-2" />
          </div>

          <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Descripción') }}" />
            <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model="description" />
            <x-jet-input-error for="description" class="mt-2" />
          </div>

          <div class="form-group">
            <x-jet-label for="categoryName" value="{{ __('Categoría') }}" />
            <select required class="form-control" wire:model="categoryName">
              <option selected hidden>Selecciona una opción</option>
              @foreach($categoryNames as $category)
              <option>{{$category}}</option>
              @endforeach
            </select>
            <x-jet-input-error for="categoryName" class="mt-2" />
          </div>


          <div class="field">
            <x-jet-label for="ini_date" value="{{ __('Fecha inicio') }}" />
            <div class="control">
              <x-jet-input id="ini_date" wire:model="ini_date" class="mt-1 block w-full" type="date" min={{now()}} />
              <x-jet-input-error for="ini_date" class="mt-2" />
            </div>
          </div>

          <div class="field">
            <x-jet-label for="end_date" value="{{ __('Fecha limite') }}" />
            <div class="control">
              <x-jet-input id="end_date" wire:model="end_date" class="mt-1 block w-full" type="date" min={{now()}} />
              <x-jet-input-error for="end_date" class="mt-2" />
            </div>
          </div>

          <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="reward" value="{{ __('Recompensa') }}" />
            <x-jet-input id="reward" type="number" class="mt-1 block w-full" wire:model="reward" />
            <x-jet-input-error for="reward" class="mt-2" />
          </div>

          <div class="mt-3 mr-3">
            <x-jet-button type="submit">Crear</x-jet-button>
          </div>
          <div class="mt-3 mr-3">
            <x-jet-button type="submit">Limpiar</x-jet-button>
          </div>

        </form>
      </div>
    </div>
  </div>


</div>