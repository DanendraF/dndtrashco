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

                <button class="add-button" onclick="openPopup()">
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
                    <div class="rich-text-editor">
                        <div class="editor-toolbar">
                            <button type="button"><i class="fas fa-bold"></i></button>
                            <button type="button"><i class="fas fa-italic"></i></button>
                            <button type="button"><i class="fas fa-list-ul"></i></button>
                            <button type="button"><i class="fas fa-list-ol"></i></button>
                            <button type="button"><i class="fas fa-link"></i></button>
                        </div>
                        <textarea name="content" placeholder="Write your blog content here..." rows="10" required></textarea>
                    </div>
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

    <script>
        function openPopup() {
            document.getElementById('blogPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('blogPopup').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function editBlog(blogId) {
            fetch(`/admin/blog/${blogId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('input[name="title"]').value = data.title;
                    document.querySelector('textarea[name="content"]').value = data.content;
                    document.querySelector('#imagePreview').src = '/storage/' + data.cover_image;
                    document.querySelector('#imagePreviewContainer').style.display = 'block';
                    let form = document.querySelector('.blog-form');
                    form.action = `/admin/blog/${data.id}`;
                    form.method = 'POST';

                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);

                    openPopup();
                })
                .catch(error => {
                    showNotification('Failed to load blog data for editing.', false);
                });
        }

        document.querySelector('.blog-form').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(this.action, {
                method: this.method,
                body: new FormData(this),
            })
            .then(response => response.json())
            .then(data => {
                showNotification('Blog post created/updated successfully!');
                closePopup();
                location.reload(); // Reload page to see the changes
            })
            .catch(error => {
                showNotification('Failed to create/update the blog post.', false);
            });
        });

        function deleteBlog(blogId) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                fetch(`/admin/blog/${blogId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Blog post deleted successfully!');
                        const row = document.querySelector(`tr[data-id="${blogId}"]`);
                        if (row) row.remove(); // Remove row from table
                    } else {
                        showNotification('Failed to delete the blog post.', false);
                    }
                })
                .catch(error => {
                    showNotification('Failed to delete the blog post.', false);
                });
            }
        }

        function showNotification(message, isSuccess = true) {
            const popup = document.getElementById('notificationPopup');
            const messageElement = document.getElementById('notificationMessage');
            messageElement.textContent = message;
            popup.classList.add(isSuccess ? 'success' : 'error');
            popup.style.display = 'block';
        }

        function closeNotificationPopup() {
            const popup = document.getElementById('notificationPopup');
            popup.style.display = 'none';
            popup.classList.remove('success', 'error');
        }
    </script>
</body>
</html>
