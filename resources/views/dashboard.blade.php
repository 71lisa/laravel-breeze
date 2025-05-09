<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="mb-4 text-lg font-semibold">Table Mahasiswa</h3>

                    <!-- Toggle Modal -->
                    <button onclick="toggleModal()" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" data-modal-toggle="defaultModal">Tambah Mahasiswa</button>

                    <!-- Modal Tambah Mahasiswa -->
                    <div id="addMahasiswaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                                <h2 class="mb-4 text-lg font-semibold">Tambah Mahasiswa</h2>
                                <form action="{{ route('mahasiswa.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" id="nama" name="nama" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="nim" class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                                        <input type="text" id="nim" name="nim" pattern="\d{9}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="toggleModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                function toggleModal() {
                    const modal = document.getElementById('addMahasiswaModal');
                    modal.classList.toggle('hidden');
                }
                </script>

                <!-- TABLE -->
                <table class="w-full border border-collapse border-gray-300 table-auto">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                            <th class="border border-gray-300 px-4 py-2">NIM</th>
                            <th class="border border-gray-300 px-4 py-2">~</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $mhs)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$mhs->nama}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$mhs->nim}}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button onclick="toggleDeleteModal({{ $mhs->id }})" class="text-2xl text-red-500 hover:text-red-700"><i class="bi bi-trash-fill"></i></button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div> 
    </div> 

    <script>
        function toggleDeleteModal(id) {
            const modalDelete = document.getElementById('deleteModal-' + id);
            modalDelete.classList.toggle('hidden');
        }

        function toggleEditModal(id) {
            const modalEdit = document.getElementById('editMahasiswaModal-' + id);
            modalEdit.classList.toggle('hidden');
        }

        @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            }
        @endif
    </script>

</x-app-layout>
