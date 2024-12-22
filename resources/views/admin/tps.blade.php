<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TrashCo Admin Dashboard - TPS</title>
    <link rel="stylesheet" href="{{ asset('css/admin/tps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/userlist.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="tps-table">
                <h2>TPS List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>LOCATION</th>
                            <th>RATING</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tpsList as $tps)
                            <tr data-id="{{ $tps->id }}">
                                <td>
                                    <img src="{{ asset('storage/' . $tps->image) }}" alt="TPS" class="tps-image">
                                </td>
                                <td>{{ $tps->name }}</td>
                                <td>{{ $tps->location }}</td>
                                <td>
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star{{ $i < $tps->rating ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <span class="edit-icon" onclick="editTps({{ $tps->id }})">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="delete-icon" onclick="deleteTps({{ $tps->id }})">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="add-button" onclick="openPopup()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Popup Form -->
    <div class="popup-overlay" id="addTpsPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h3>Add New TPS</h3>
                <button class="close-button" onclick="closePopup()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="tps-form" action="{{ route('admin.tps.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>TPS Image</label>
                    <div class="image-upload">
                        <input type="file" name="image" id="tpsImage" accept="image/*" onchange="previewImage(event)">
                        <label for="tpsImage" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Click to upload image</span>
                        </label>
                        <div id="imagePreviewContainer">
                            <img id="imagePreview" style="display: none; width: 100%; margin-top: 15px;" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>TPS Name</label>
                    <input type="text" name="name" placeholder="Enter TPS name" required>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="Enter TPS location" required>
                </div>

                <div class="form-group">
                    <label>Link Maps</label>
                    <input type="text" name="link_maps" placeholder="Enter Google Maps link" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Enter TPS description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Operating Hours</label>
                    <div class="hours-input">
                        <input type="time" name="open_time" required>
                        <span>to</span>
                        <input type="time" name="close_time" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
                    <button type="submit" class="submit-btn">Add TPS</button>
                </div>
            </form>
        </div>
    </div>

    <div id="successPopup" class="popup-notification" style="display: none;">
        <p id="successMessage"></p>
        <button onclick="closeSuccessPopup()">Close</button>
    </div>


    <script>
        function openPopup() {
            document.getElementById('addTpsPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('addTpsPopup').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function showSuccessPopup(message) {
            const popup = document.getElementById('successPopup');
            const messageElement = document.getElementById('successMessage');

            messageElement.innerText = message;
            popup.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Mencegah scrolling
        }

        function closeSuccessPopup() {
            const popup = document.getElementById('successPopup');
            popup.style.display = 'none';
            document.body.style.overflow = 'auto'; // Memungkinkan scrolling
}

        function deleteTps(tpsId) {
            if (confirm('Are you sure you want to delete this TPS?')) {
                fetch(`/tps/${tpsId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`tr[data-id="${tpsId}"]`).remove();
                        showSuccessPopup(data.message);
                    } else {
                        alert('Error deleting TPS.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error while deleting the TPS.');
                });
            }
        }



        function editTps(tpsId) {
            fetch(`/tps/${tpsId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('input[name="name"]').value = data.name;
                    document.querySelector('input[name="location"]').value = data.location;
                    document.querySelector('textarea[name="description"]').value = data.description;
                    document.querySelector('input[name="open_time"]').value = data.open_time;
                    document.querySelector('input[name="close_time"]').value = data.close_time;
                    document.querySelector('input[name="link_maps"]').value = data.link_maps;

                    document.querySelector('#imagePreview').src = `/storage/${data.image}`;
                    document.querySelector('#imagePreview').style.display = 'block';

                    const form = document.querySelector('.tps-form');
                    form.action = `/tps/${data.id}`;
                    form.method = 'POST';

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);

                    openPopup();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error loading the TPS data.');
                });
        }


        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
