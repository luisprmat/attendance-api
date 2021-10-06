<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            Estudiantes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table>
                    <div class="p-4 flex flex-col justify-items-start sm:flex-row sm:items-center sm:justify-between">
                        <x-jet-input type="search" placeholder="Buscar estudiante..." wire:model="search"
                            class="sm:flex-1 mb-4 sm:mb-0 sm:mr-2" />
                        <x-button type="button" wire:click="$set('openCreate', true)" color="indigo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nuevo estudiante
                        </x-button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grado
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $student->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $student->course->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <span wire:click="edit({{ $student }})"
                                            class="text-indigo-600 hover:text-indigo-900 cursor-pointer">Editar</span>
                                        <span wire:click="destroy({{ $student }})"
                                            class="ml-4 text-red-600 hover:text-red-900 cursor-pointer">Eliminar</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($students->hasMorePages())
                        <div class="p-4">
                            {{ $students->links() }}
                        </div>
                    @endif
                </x-table>
            </div>
        </div>
    </div>

    {{-- Modal for create Student --}}
    <x-jet-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            Nuevo estudiante
        </x-slot>
        <x-slot name="content">
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="mb-4 sm:col-span-2">
                    <x-jet-label for="name" value="Nombre estudiante" />
                    <x-jet-input id="name" wire:model.defer="name" type="text" class="w-full" />
                    <x-jet-input-error for="name" />
                </div>

                <div class="mb-4">
                    <x-jet-label for="course_id" value="Curso" />
                    <x-select id="course_id" wire:model.defer="course_id" class="w-full">
                        @foreach ($courses as $key => $course)
                            <option value="{{ $key }}">{{ $course }}</option>
                        @endforeach
                    </x-select>
                    <x-jet-input-error for="course_id" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openCreate', false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal for edit Student --}}
    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Editar estudiante
        </x-slot>
        <x-slot name="content">
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="mb-4 sm:col-span-2">
                    <x-jet-label for="student.name" value="Nombre estudiante" />
                    <x-jet-input id="student.name" wire:model.defer="student.name" type="text" class="w-full" />
                    <x-jet-input-error for="student.name" />
                </div>

                <div class="mb-4">
                    <x-jet-label for="student.course_id" value="Curso" />
                    <x-select id="student.course_id" wire:model.defer="student.course_id" class="w-full">
                        @foreach ($courses as $key => $course)
                            <option value="{{ $key }}">{{ $course }}</option>
                        @endforeach
                    </x-select>
                    <x-jet-input-error for="student.course_id" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openEdit', false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Student Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingStudentDeletion">
        <x-slot name="title">
            Eliminar estudiante
        </x-slot>

        <x-slot name="content">
            ¿Está seguro de borrar el estudiante '{{ $this->student->name }}'? Esta acción no se puede revertir
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingStudentDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteStudent" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
