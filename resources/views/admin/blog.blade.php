<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo Admin Dashboard - Blog</title>
    <link rel="stylesheet" href="{{ asset('css/admin/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/userlist.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        @include('partials.sidebar')

        <div class="main-content">
            <div class="blog-table">
                <h2>Blog Posts</h2>
                <table>
                    <thead>
                        <tr>
                            <th>IMAGE</th>
                            <th>TITLE</th>
                            <th>CONTENT</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr data-id="{{ $blog->id }}">
                                <td><img src="{{ asset('storage/' . $blog->cover_image) }}" alt="Blog" class="blog-image"></td>
                                <td>{{ $blog->title }}</td>
                                <td class="blog-content">{{ Str::limit($blog->content, 100) }}</td>
                                <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <i class="fas fa-edit edit-icon" onclick="editBlog({{ $blog->id }})"></i>
                                    <i class="fas fa-trash-alt delete-icon" onclick="deleteBlog({{ $blog->id }})"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="add-button" onclick="openPopup(false)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="popup-overlay" id="blogPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h3>Add New Blog Post</h3>
                <button class="close-button" onclick="closePopup()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="blog-form" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Cover Image</label>
                    <div class="image-upload">
                        <input type="file" id="blogImage" name="cover_image" accept="image/*" required onchange="previewImage(event)">
                        <label for="blogImage" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Click to upload cover image</span>
                        </label>
                    </div>
                    <div id="imagePreviewContainer" style="display: none;">
                        <img id="imagePreview" src="" alt="Preview" style="max-width: 100%; margin-top: 10px;">
                    </div>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Enter blog title" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" placeholder="Write your blog content here..." rows="10" required></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
                    <button type="submit" class="submit-btn">Publish Post</button>
                </div>
            </form>
        </div>
    </div>

    <div class="notification-popup" id="notificationPopup">
        <div class="notification-content">
            <p id="notificationMessage"></p>
            <button class="close-notification" onclick="closeNotificationPopup()">Close</button>
        </div>
    </div>

    @if(session('success'))
        <div class="notification-popup success">
            <div class="notification-content">
                <p>{{ session('success') }}</p>
                <button class="close-notification" onclick="this.parentElement.parentElement.style.display='none'">Close</button>
            </div>
        </div>
    @endif


    <script>
        function openPopup(isEdit = false, blogData = null) {
            document.getElementById('blogPopup').classList.add('active');
            document.body.style.overflow = 'hidden';

            const popupHeader = document.querySelector('.popup-header h3');
            const submitButton = document.querySelector('.submit-btn');
            const form = document.querySelector('.blog-form');

            // Kondisi untuk menampilkan form tambah atau edit
            if (isEdit && blogData) {
                popupHeader.textContent = 'Edit Blog Post';
                submitButton.textContent = 'Update Post';

                // Isi form dengan data yang akan diedit
                document.querySelector('input[name="title"]').value = blogData.title;
                document.querySelector('textarea[name="content"]').value = blogData.content;
                const imagePreview = document.getElementById('imagePreview');
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');

                imagePreview.src = `/storage/${blogData.cover_image}`;
                imagePreviewContainer.style.display = 'block';

                // Ubah action URL untuk update
                form.action = `/admin/blog/${blogData.id}`;
                form.method = 'POST';

                // Tambahkan input hidden untuk method PUT
                let methodInput = form.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';
            } else {
                popupHeader.textContent = 'Add New Blog Post';
                submitButton.textContent = 'Publish Post';

                // Reset form untuk input baru
                form.reset();
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                imagePreviewContainer.style.display = 'none';

                // Set action URL untuk store
                form.action = '/admin/blog';
                form.method = 'POST';

                // Hapus input hidden jika ada
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) {
                    methodInput.remove();
                }
            }
        }

        function closePopup() {
            document.getElementById('blogPopup').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const imagePreview = document.getElementById('imagePreview');
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function deleteBlog(blogId) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/blog/${blogId}`;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        function editBlog(blogId) {
            const blogRow = document.querySelector(`tr[data-id="${blogId}"]`);

            // Ambil data blog dari elemen baris
            const title = blogRow.querySelector('td:nth-child(2)').innerText;
            const content = blogRow.querySelector('td:nth-child(3)').innerText;
            const coverImage = blogRow.querySelector('img').getAttribute('src');

            // Panggil fungsi `openPopup` dengan mode edit
            openPopup(true, {
                id: blogId,
                title: title,
                content: content,
                cover_image: coverImage.replace('/storage/', '') // Hapus prefix jika ada
            });
        }


    </script>

</body>
</html>
