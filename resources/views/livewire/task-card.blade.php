<div class="bg-white border mt-2">
    <div id="post-header-{{$task->id}}" class=" d-flex flex-row justify-content-between align-items-center p-3 ">
        <div class="d-flex flex-row align-items-center feed-text">
            <div id="post-info" class="d-flex flex-column flex-wrap ml-2">
                <span class="font-weight-bold">Usuario: {{$user->name}}</span>
                <span class="font-weight-bold">Tarea: <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a></span>

                <span class="text-black-50 time">Fecha de Inicio: {{$task->ini_date}}</span>
                <span class="text-black-50 time">Fecha de Finalización: {{$task->end_date}}</span>
            </div>
        </div>
    </div>

    <div id="post-content-{{$task->id}}"></div>
    <span class="p-2 px-3" id="post-message">Descripción: {{$task->description}}</span>
    <div class="d-flex flex-column comment-section" id="myGroup-{{$task->id}}">
        <div class="p-2 p-2 border-bottom">
            <div class="d-flex flex-row fs-12">
                <div class="like p-2 cursor" id="likeBtn-{{$task->id}}" role='button' wire:click.stop="addLike">
                    <i class="fa fa-thumbs-up"><span id="likesCounter" class="badge badge-light" style="color:black">{{$likes}}</span></i>
                </div>
                <div class="p-2 cursor" role="button" data-bs-toggle="collapse" data-bs-target="#collapseComments-{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-comments-o"><span id="commentsCounter" class="badge badge-light" style="color:black">{{$nComments}}</span></i>
                </div>
            </div>
        </div>
        <div id="collapseComments-{{$task->id}}" class="collapse">
            <div id=" comments" class="d-flex flex-column p-2">
                @if(isset($comments) && !$comments->isEmpty())
                @foreach($comments as $comment)
                <div class="d-flex flex-row align-items-center feed-text px-2" id="comment-{{$comment->id}}">
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
                                    <button wire:click="deleteComment({{$comment->id}}" )> {{ __('Eliminar') }} </button>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>

                <div class="d-flex flex-column flex-wrap ml-2">
                    <span class="font-weight-bold"><b>Usuario:</b></span>
                    <span class="text-black-50 time">Fecha: {{$comment->created_at}}</span>
                    <span class="font-weight-bold"><b>Comentó:</b>{{$comment->description}}</span>
                </div>
                <div class="border-t border-gray-100"></div>
                @endforeach
                @endif
            </div>
            <div class=" d-flex flex-row align-items-start" style="margin-top: 20px;">
                <div class='circle-img img-circle rounded-circle'>
                </div>
                <textarea class="form-control ml-1 shadow-none textarea" id="comment-message" placeholder="Escriba un comentario..." wire:model.lazy="commentText"></textarea>
            </div>
            <div class="mt-2 text-right action-collapse">
                <x-jet-button type="button" id="comment-button" wire:click="createComment">Comment</x-jet-button>
                <x-jet-button wire:click="clearComment" class="shadow-none" role="button" data-bs-toggle="collapse" data-bs-target="#collapseComments-{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
                    Cancel
                </x-jet-button>
            </div>

        </div>
    </div>


</div>