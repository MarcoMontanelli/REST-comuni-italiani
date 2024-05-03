<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codici postali italiani con approccio REST</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-black text-gray-200 font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <h1 class="text-4xl font-bold mb-6">CAP con approccio REST</h1>
        <button onclick="fetchData()" class="mb-6 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Recupera dati database</button>
        <div id="results" class="shadow overflow-hidden border-b border-gray-700 rounded-lg w-full max-w-4xl"></div>
        <div class="w-full max-w-4xl p-4 mt-8 mb-8 space-y-4 rounded-lg border-gray-600 bg-gray-900">
            <div>
                <h2 class="text-2xl font-bold">Aggiungi Entry</h2>
                <input type="text" id="addCap" placeholder="CAP" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <input type="text" id="addComune" placeholder="Comune" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <button onclick="addData()" class="mt-3 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Aggiungi</button>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Modifica Entry</h2>
                <input type="number" id="editId" placeholder="ID" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <input type="text" id="editCap" placeholder="CAP" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <input type="text" id="editComune" placeholder="Comune" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <button onclick="editData()" class="mt-3 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Modifica</button>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Elimina Entry</h2>
                <input type="number" id="deleteId" placeholder="ID" class="mt-1 block w-full px-3 py-2 bg-gray-700 text-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-500">
                <button onclick="deleteData()" class="mt-3 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Elimina</button>
            </div>
        </div>
    </div>
    <script>
        function fetchData() {
            fetch('http://localhost/comuni%20rest%20montanelli/server/GET')
            .then(response => response.json())
            .then(data => {
                const result = document.getElementById('results');
                let output = `<div class="table w-full"><table class="min-w-full leading-normal border-gray-600"><thead><tr class="text-left bg-gray-900">
                    <th class="px-5 py-3 border-b-2 border-gray-600 text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-600 text-xs font-semibold text-gray-300 uppercase tracking-wider">CAP</th>
                    <th class="px-5 py-3 border-b-2 border-gray-600 text-xs font-semibold text-gray-300 uppercase tracking-wider">Comune</th>
                </tr></thead><tbody>`;
                data.forEach(item => {
                    output += `<tr class="bg-gray-950 border-gray-700">
                        <td class="px-5 py-2 border-b border-gray-700 text-sm">${item.id}</td>
                        <td class="px-5 py-2 border-b border-gray-700 text-sm">${item.CodicePostale}</td>
                        <td class="px-5 py-2 border-b border-gray-700 text-sm">${item.Comune}</td>
                    </tr>`;
                });
                output += `</tbody></table></div>`;
                result.innerHTML = output;
            }).catch(error => console.error('Error:', error));
        }

        function addData() {
            const cap = document.getElementById('addCap').value;
            const comune = document.getElementById('addComune').value;
            fetch('http://localhost/comuni%20rest%20montanelli/server/ADD', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ CodicePostale: cap, Comune: comune })
            }).then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                fetchData(); // Refresh data
            }).catch(error => console.error('Error:', error));
        }

        function editData() {
            const id = document.getElementById('editId').value;
            const cap = document.getElementById('editCap').value;
            const comune = document.getElementById('editComune').value;
            fetch(`http://localhost/comuni%20rest%20montanelli/server/EDIT/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ CodicePostale: cap, Comune: comune })
            }).then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                fetchData(); // Refresh data
            }).catch(error => console.error('Error:', error));
        }

        function deleteData() {
            const id = document.getElementById('deleteId').value;
            fetch(`http://localhost/comuni%20rest%20montanelli/server/DELETE/${id}`, {
                method: 'DELETE'
            }).then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                fetchData(); // Refresh data
            }).catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

