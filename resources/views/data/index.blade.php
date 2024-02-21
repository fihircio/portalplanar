
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          

                    <!-- Add your grid list component here -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @foreach($dataItemsByContent as $contentId => $dataItems)
                   
                        <!-- Example data item -->
                        <div class="bg-gray-100 p-4 rounded-md">
                        <h4 class="text-lg font-bold mb-2">Content ID: {{ $contentId }}</h4>
                        @if($dataItems->isNotEmpty()) {{-- Check if there are data items --}} 
                        <!-- Table -->
                            <table id="data-table-{{ $contentId }}" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-black flex items-center">
                                        <button onclick="addData('{{ $contentId }}')" class="ml-2 px-2 py-1 bg-green-500 text-white rounded-md">+ Add Data</button>                          
                                        </th>
                                        <th class="text-black">Key</th>
                                        <th class="text-black">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Hidden row template -->
                                    <tr id="data-row-template-{{ $contentId }}" style="display: none;">
                                        <td class="flex space-x-2">
                                        <button class="px-2 py-1 bg-green-500 text-white rounded-md" onclick="confirmData(this.parentNode.parentNode)"data-key-selector="#data-key-select"
                                            data-value-selector="#data-value-input" class="px-2 py-1 bg-green-500 text-white rounded-md">Confirm</button>
                                        <button onclick="confirmDeleteRow(this.parentNode.parentNode)" class="px-2 py-1 bg-red-500 text-white rounded-md">Delete</button>
                                        
                                    </td>
                                        <td>
                                            <select class="text-black">
                                                <!-- Add your dropdown options -->
                                                <option value="data1">Position</option>
                                                <option value="data2">Rotation</option>
                                                <option value="data3">Scale</option>
                                                <option value="data4">Category</option>
                                                <option value="data5">Light</option>
                                            </select>
                                        </td>
                                        <td> 
                                            <input type="text" class="text-black border rounded-md p-2 w-full">
                                        </td>
                                    </tr>
                            
                                @foreach($dataItems as $dataItem)
                                @if($dataItem->exists) {{-- Check if the data item still exists --}}
                                      
                                        <tr data-id="{{ $dataItem->id }}">
                                          
                                            <td class="flex space-x-2">
                                                <button class="px-2 py-1 bg-green-500 text-white rounded-md">Edit</button>
                                                <button class="px-2 py-1 bg-red-500 text-white rounded-md" onclick="confirmDelete(this)" data-id="{{ $dataItem->id }}">Delete</button>
                                            </td>
                                                <td>{{ $dataItem->key }}</td>
                                                <td>{{ $dataItem->value }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                    <!-- Add more rows as needed -->
                                </tbody>
                                </table>
                            </table>
                              <!-- Additional text elements -->
                              <div class="mt-4">
                        
                                    <p class="text-sm font-bold text-black">Entry Key:</p>
                                    <p class="text-sm text-black"><td>{{ $dataItem->entry_key }}</td></p>
                                </div>
                                @else
                                
                                <thead>
                                    <tr>
                                        <th class="text-black flex items-center">
                                            <button id="add-data-button" class="ml-2 px-2 py-1 bg-green-500 text-white rounded-md">+ Add Data</button>
                                        </th>
                                        <th class="text-black">Key</th>
                                        <th class="text-black">Value</th>
                                    </tr>
                                </thead>
                                
                                @endif
                            </div>
                        <!-- Repeat the above block for each data item -->
                        <!-- Add more data items as needed -->
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
