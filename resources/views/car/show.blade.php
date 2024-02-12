<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mostrar Coches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{ asset($ruta.$car->image) }}" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$car->marca}} {{$car->model}}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Matricula: {{$car->plate}}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Año: {{$car->year}}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Precio: {{$car->price}}€</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>