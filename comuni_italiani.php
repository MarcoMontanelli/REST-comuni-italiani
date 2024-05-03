<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Table and Form Card</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@^1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="dark:bg-gray-800 dark:text-gray-200">

    <!-- Delete Confirmation Modal -->
    <!-- Delete Confirmation Modal -->
<div id="delete-confirm-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto h-full w-full" onclick="closeModal('popup-modal')">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20" onclick="event.stopPropagation()">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" onclick="closeModal('delete-confirm-modal')" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal('popup-modal')">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Sei sicuro di voler eliminare la entry?</h3>
                <button type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2" onclick="confirmDelete(); closeModal('popup-modal');">
                    Sì
                </button>
                <button type="button" onclick="closeModal('delete-confirm-modal')" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300 dark:border-gray-600" onclick="closeModal('popup-modal')">
                    No
                </button>
            </div>
        </div>
    </div>
</div>



    <div id="add-entry-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 overflow-y-auto h-full w-full transition ease-in-out"
        onclick="closeModal('add-entry-modal')">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-700"
            onclick="event.stopPropagation()">
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500 dark:text-white">Aggiungi Nuova Entry</p>
                <div class="modal-close cursor-pointer z-50" onclick="closeModal('add-entry-modal')">
                    <svg class="fill-current text-gray-500 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                        width="18" height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-gray-500 dark:text-gray-200">
                <input type="text" id="add-localita"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Località">
                <input type="text" id="add-provincia"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Provincia">
                <input type="text" id="add-cap"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="CAP">
                <input type="text" id="add-regione"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Regione">
                <button class="mt-3 px-4 py-2 bg-blue-500 text-white w-full hover:bg-blue-700 rounded">Aggiungi</button>
            </div>
        </div>
    </div>

    <!-- Edit Entry Modal -->
    <div id="edit-entry-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 overflow-y-auto h-full w-full"
        onclick="closeModal('edit-entry-modal')">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-700"
            onclick="event.stopPropagation()">
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500 dark:text-white">Modifica Entry</p>
                <div class="modal-close cursor-pointer z-50" onclick="closeModal('edit-entry-modal')">
                    <svg class="fill-current text-gray-500 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                        width="18" height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-gray-500 dark:text-gray-200">
                <input type="text" id="edit-localita"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Località">
                <input type="text" id="edit-provincia"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Provincia">
                <input type="text" id="edit-cap"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="CAP">
                <input type="text" id="edit-regione"
                    class="mb-4 px-4 py-2 w-full border rounded bg-gray-200 dark:bg-gray-600" placeholder="Regione">
                <button class="mt-3 px-4 py-2 bg-blue-500 text-white w-full hover:bg-blue-700 rounded">Aggiungi</button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg m-4">
        <div class="flex justify-between mb-4">
            <h1 class="text-white text-center font-bold text-3xl">CAP comuni italiani con approccio REST</h1>
            <button onclick="prepareModalForAdd()"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors">Aggiungi
                Entry</button>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center p-4">
            <div class="flex-grow md:flex md:items-center">
                <div class="relative w-full">
                    <input type="search" id="default-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search entries...">
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
                <div class="ml-4">
                    <label for="categories" class="sr-only">Categories</label>
                    <select id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option selected>Choose a category</option>
                        <option value="1">CAP</option>
                        <option value="2">Comune</option>
                        
                    </select>
                </div>
            </div>
            
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Cap</th>
                    <th scope="col" class="py-3 px-6">Comune</th>
                    <th scope="col" class="py-3 px-6 ">Azione</th><!-- 5th column for actions -->
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6">Data 1</td>
                    <td class="py-4 px-6">Data 2</td>
                    
                    <td class="py-4 px-6 text-center">
                        <button onclick="openDeleteModal()" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="text-blue-500 hover:text-blue-700"
                            onclick="editEntry('Data 1', 'Data 2', 'Data 3', 'Data 4')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <!-- Repeat <tr> for more rows as needed -->
            </tbody>
        </table>
    </div>

    <script>

        function confirmDelete() {
            // Place logic here for deletion if needed, e.g., API call
            closeModal('delete-confirm-modal');
        }

        // Function to open the delete confirmation modal
        function openDeleteModal() {
            openModal('delete-confirm-modal');
        }


        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function confirmDelete() {
    // Add your deletion logic here
    alert("Item deleted successfully!"); // Example action
}

// Example setup to open the delete confirmation modal
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', () => openModal('popup-modal'));
});


        function prepareModalForAdd() {
            document.getElementById('add-localita').value = '';
            document.getElementById('add-provincia').value = '';
            document.getElementById('add-cap').value = '';
            document.getElementById('add-regione').value = '';
            openModal('add-entry-modal');
        }

        function editEntry(localita, provincia, cap, regione) {
            document.getElementById('edit-localita').value = localita;
            document.getElementById('edit-provincia').value = provincia;
            document.getElementById('edit-cap').value = cap;
            document.getElementById('edit-regione').value = regione;
            openModal('edit-entry-modal');
        }

        function submitAddEntry() {
            // Implement submission logic here
            closeModal('add-entry-modal');
        }

        function submitEditEntry() {
            // Implement update logic here
            closeModal('edit-entry-modal');
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@^1.6.0/dist/flowbite.min.js"></script>
</body>

</html>