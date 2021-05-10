<div style="margin-bottom: 30px;">
  <div class="flex-row justify-content-between align-items-center p-2 bg-white border">
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
                        @foreach($categoryNames as $category)
                        <option @if($categoryName==$category) selected @endif>{{$category}}</option>
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
                      @if($task->status!="pending")
                      <x-jet-button type="submit" disabled>Editar</x-jet-button>
                      @else
                      <x-jet-button type="submit">Editar</x-jet-button>
                      @endif
                    </div>
                    <div class="mt-3 mr-3" @if($task->status!="pending")disabled @endif>
                      @if($task->status!="pending")
                      <x-jet-button type="submit" disabled>Limpiar</x-jet-button>
                      @else
                      <x-jet-button type="submit">Limpiar</x-jet-button>
                      @endif
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @elseif($task->status == "done" && now() < $task->end_date && !$approved)
            <div class="mt-3 mr-3">
              <a href="{{ route('rating', ['task'=>$task->id]) }}">
                <x-jet-button wire:click.stop="doneTask">
                  Validar Tarea
                </x-jet-button>
              </a>

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
              @elseif($done && !isset($approved))
              <div class="alert alert-warning">
                Tarea realizada a la espera de ser aprobada.
              </div>
              @elseif($done && isset($approved) && $approved != 1)
              <div class="alert alert-warning">
                Tarea realizada sin éxito.
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
    <div class="d-flex flex-column comment-section" id="myGroup-{{$task->id}}">

      <div class="p-2 p-2 border-bottom">
        <div class="d-flex flex-row fs-12">
          <div class="p-2 cursor collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseComments-{{$task->id}}" wire:click="manageCollapse" aria-expanded:="true" aria-controls="#collapseComments-{{$task->id}}" data-bs-collapse aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-comments-o"><span id="commentsCounter-{{$task->id}}" class="badge badge-light" style="color:black">{{$nComments}}</span></i>
          </div>
        </div>
      </div>

      <div id="collapseComments-{{$task->id}}" class="collapse @if ($statusGroupOpen) show @endif">

        <div id="comments-{{$task->id}}" class="d-flex flex-column p-2">
          @if(isset($comments) && !$comments->isEmpty())
          @foreach($comments as $comment)
          <div class="" id="comment-{{$comment->id}}">
            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
              <x-jet-dropdown align="center" width="48">
                <x-slot name="trigger">

                  <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                    </button>
                  </span>
                </x-slot>
                <x-slot name="content">
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    <button wire:click="deleteComment({{$comment->id}})"> {{ __('Eliminar') }} </button>
                  </div>
                </x-slot>
              </x-jet-dropdown>
            </div>
            <div class="d-flex flex-column flex-wrap ml-2">
              <span class="font-weight-bold"><b>Usuario</b>:
                <a href="{{ route('dashboard', ['user_id'=> $commentUsers[$comment->id]->id]) }}" class="underline">{{$commentUsers[$comment->id]->name}}</a>
              </span>
              <span class="text-black-50 time">Fecha: {{$comment->created_at}}</span>
              <span class="font-weight-bold"><b>Comentó:</b> </br>{{$comment->description}}</span>
            </div>
          </div>

          <div class="border-t border-gray-100"></div>
          @endforeach
          @endif
        </div>

        <div class=" d-flex flex-row align-items-start" style="margin-top: 20px;">
          <div class='circle-img img-circle rounded-circle'>
          </div>
          <textarea class="form-control ml-1 shadow-none textarea" id="comment-message-{{$task->id}}" placeholder="Escriba un comentario..." wire:model="commentText"></textarea><br />

        </div>

        <div class="mt-2 text-right action-collapse">
          <x-jet-input-error for="commentText" class="mt-2" />
          <x-jet-button type="button" id="comment-button-{{$task->id}}" wire:click.stop="createComment">Comment</x-jet-button>
          <x-jet-button wire:click="clearComment" class="shadow-none" role="button" data-bs-toggle="collapse" data-bs-target="#collapseComments-{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
            Cancel
          </x-jet-button>
        </div>

      </div>
    </div>
  </div>

</div>