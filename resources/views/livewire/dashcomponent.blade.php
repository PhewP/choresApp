<div>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="mt-8 bg-white dark:bg-gray-800  shadow sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div>

                    @if($user->id == auth()->user()->id)
                    <div class="mt-8 text-2xl">
                        Bienvenida/o {{ucfirst($user->name)}} !<br />
                        Has realizado {{count($this->trateList)}} tareas en total.
                    </div>
                    @else
                    <div class="mt-8 text-2xl">
                        Perfil de {{ucfirst($user->name)}}<br />
                        Ha realizado {{count($this->trateList)}} tareas en total.
                    </div>
                    @endif

                    <div class="mt-6 text-gray-500">
                        En este dashboard encontrarás información sobre tí o de los demás usuarios cuando visites su perfil,
                        recuerda validar las tareas de manera honesta ya que tu puntuación se verá reflejada en la información que se puede
                        ver más abajo y es totalmente pública y repercutirá en la generación de coins.
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <i class="fas fa-medal fa-2x"></i>
                            <div class="ml-4 text-lg leading-7 font-semibold">Puntuación media del usuario</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{$score}}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <i class="fas fa-tachometer-alt fa-2x"></i>
                            <div class="ml-4 text-lg leading-7 font-semibold">Rapidez</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{$speed}}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <i class="fas fa-people-carry fa-2x"></i>
                            <div class="ml-4 text-lg leading-7 font-semibold">Eficacia</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{$accuracy}}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <i class="fas fa-crosshairs fa-2x"></i>
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Efectividad</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{$performance}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>