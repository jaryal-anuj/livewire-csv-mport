<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customers') }}
            </h2>
            <button x-data x-on:click="window.livewire.emitTo('csv-importer','toggle')">Import</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-1" >
                        <livewire:datatable model="App\Models\Customer" paginate="10" exclude="vip,updated_at"/>
                    </div>
                </div>
            </div>
        </div>
        <livewire:csv-importer :model="App\Models\Customer::class" :columnsToMap="['id', 'first_name', 'last_name', 'email']" :requiredColumns="['id', 'first_name', 'last_name', 'email']" :columnLabels="['id'=>'ID','first_name'=>'First name', 'last_name'=> 'Last name', 'email'=>'Email']" />
    </div>
</x-app-layout>
