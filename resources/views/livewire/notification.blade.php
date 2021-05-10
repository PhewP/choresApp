<div wire:poll="refresh">
    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="48">

            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        Notificaciones <span class="badge bg-secondary ml-2 ">{{$nNotifications}}</span>
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </x-slot>


            <x-slot name="content">
                <!-- Account Management -->
                <div class=" block px-4 py-2 text-xs text-gray-400 ">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                {{ __('Notificaciones') }}
                            </div>
                            <div class="col">
                                @if($nNotifications > 2)
                                <button wire:click="deleteAllNotifications" type=" button" class="btn-close" aria-label="Close"></button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="scroll" style="height: 200px;overflow-y:auto; overflow-x:hidden">
                    @if(isset($notifications) && !$notifications->isEmpty())
                    @foreach($notifications as $notification)
                    <div class="container">
                        <div class=" row">
                            <div class="col">
                                <div class="border-t border-gray-100"></div>
                                <div class="" id="notification-{{$notification->id}}">
                                    <div class="d-flex flex-column flex-wrap ml-2">
                                        @if($users[$notification->id]->id != Auth::id())
                                        <span class="font-weight-bold"><b>Usuario:</b> <a href="{{ route('dashboard', ['user_id' => $users[$notification->id]->id]) }}" class="underline">{{$users[$notification->id]->name}}</a></span>
                                        </link>
                                        </span>
                                        @endif
                                        <span class="text-black-50 time">Fecha: {{$notification->created_at}}</span>

                                        <span class="font-weight-bold">
                                            <b>
                                                @if($notification->type=="status")
                                                Actualizó la
                                                @elseif($notification->type=="comment")
                                                Comentó la
                                                @endif
                                                Tarea
                                                :</b> <a href="{{ route('task_detail',['task' => $tasks[$notification->id]->id]) }}" class="underline">{{$tasks[$notification->id]->title}}</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <button id="notification-{{$notification->id}}" wire:click="deleteNotification({{$notification->id}})" type=" button" class="btn-close" aria-label="Close"></button>
                            </div>
                            <div class="border-t border-gray-100"></div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="">
                        <div class="d-flex flex-column flex-wrap ml-2">
                            <span class="font-weight-bold"><b>No tiene notificaciones sin leer</b>
                        </div>
                    </div>
                    @endif
                </div>
            </x-slot>
        </x-jet-dropdown>
    </div>
</div>