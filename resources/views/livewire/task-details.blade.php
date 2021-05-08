<div style="margin-bottom: 30px;">
  <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
    <div class="feed-text px-2">
      <div class="container">
        <center>
          <h3>{{$task->title}}</h3>
          <b>Descripción:</b>
          {{$task->description}}
          <br>
          <b>Disponible a partir de:</b>
          {{$task->ini_date}}
          <br>
          <b>Disponible hasta:</b>
          {{$task->end_date}}
          <br>
          <b>Recompensa:</b>
          {{$task->reward}} coins
          <br>
          <b>Estado:</b>
          {{$task->status}}
          @if($task->creator_id == Auth::id())
            @if($task->status != "done")
              <div class="mt-3 mr-3">
                <div style="margin-bottom: 30px;">

                  <div>
                    <div class="card card-body">

                      <form wire:submit.prevent="modifyTask">

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
                            <option selected hidden value="{{ $task->category }}"></option>
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
                          <x-jet-button type="submit">Editar</x-jet-button>
                        </div>
                        <div class="mt-3 mr-3">
                          <x-jet-button type="submit">Limpiar</x-jet-button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            @elseif(!$accepted && !$done)
            <div class="mt-3 mr-3">
              <x-jet-button wire:click.stop="acceptTask">
                Aceptar.
                <!-- <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a> -->
              </x-jet-button>
              @elseif(!$done)
              <div class="alert alert-success">
                Tarea Aceptada.
              </div>
              <x-jet-button wire:click.stop="doneTask">
                Terminar Tarea
              </x-jet-button>
              @elseif($accepted && $expired)
              <div class="alert alert-warning">
                La tarea ha expirado.
              </div>
              @elseif($done)
              <div class="alert alert-warning">
                Tarea realizada a la espera de ser aprobada.
              </div>
              @elseif(isset($approved) && $approved)
              <div class="alert alert-success">
                Tarea realizada con éxito.
              </div>
            </div>
          @endif
        </center>
      </div>
    </div>
  </div>

</div>