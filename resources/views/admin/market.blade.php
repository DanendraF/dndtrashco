<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo Admin Dashboard - Market</title>
    <link rel="stylesheet" href="{{ asset('css/admin/market.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/userlist.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        @include('partials.sidebar')

        <div class="main-content">
            <div class="market-table">
                <h2>Market Items</h2>
                <table>
                    <thead>
                        <tr>
                            <th>IMAGES</th>
                            <th>ITEM NAME</th>
                            <th>PRICE</th>
                            <th>DESCRIPTION</th>
                            <th>SELLER INFO</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marketItems as $item)
                        <tr data-id="{{ $item->id }}">
                            <!-- Kolom Gambar -->
                            <td>
                                <div class="product-images">
                                    @foreach(json_decode($item->images) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="product-image">
                                    @endforeach
                                    <div class="image-count">+{{ count(json_decode($item->images)) - 1 }}</div>
                                </div>
                            </td>

                            <td>{{ $item->item_name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="product-desc">{{ $item->description }}</td>
                            <td>
                                <div class="seller-info">
                                    <p><strong>{{ $item->seller_name }}</strong></p>
                                    <p>{{ $item->phone_number }}</p>
                                    <p class="seller-address">{{ $item->address }}</p>
                                </div>
                            </td>

                            <!-- Kolom Status -->
                            <td>
                                <span class="status-badge {{ $item->status == 'sold' ? 'sold' : 'available' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <!-- Kolom Aksi -->
                            <td>
                                <!-- Form Mark as Sold/Available -->
                                <form action="{{ route('admin.market.updateStatus', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="mark-sold-btn">
                                        <i class="fas fa-check"></i>
                                        {{ $item->status == 'sold' ? 'Mark as Available' : 'Mark as Sold' }}
                                    </button>
                                </form>

                                <!-- Form Delete -->
                                <form action="{{ route('admin.market.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-trash-alt delete-icon"></i>
                                    </button>
                                </form>

                                <!-- Edit Button -->
                                <span class="edit-icon" onclick="openEditPopup({{ $item }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="add-button" onclick="openAddPopup()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Market Item Popup -->
    <div class="popup-overlay" id="marketPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h3 id="popup-title">Add New Market Item</h3>
                <button class="close-button" onclick="closePopup()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="market-form" id="marketForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="POST" id="form-method">
                <input type="hidden" name="id" id="item-id">

                <div class="form-group">
                    <label>Product Images (4 images required)</label>
                    <div class="image-upload-container">
                        <div class="image-upload-section">
                            <input type="file" name="images[]" accept="image/*" required>
                            <span>Image 1</span>
                        </div>
                        <div class="image-upload-section">
                            <input type="file" name="images[]" accept="image/*" required>
                            <span>Image 2</span>
                        </div>
                        <div class="image-upload-section">
                            <input type="file" name="images[]" accept="image/*" required>
                            <span>Image 3</span>
                        </div>
                        <div class="image-upload-section">
                            <input type="file" name="images[]" accept="image/*" required>
                            <span>Image 4</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="item_name" id="item-name" placeholder="Enter item name" required>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <div class="price-input">
                        <span class="currency">Rp</span>
                        <input type="number" name="price" id="item-price" placeholder="Enter price" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="item-description" placeholder="Enter item description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="status-input">
                        <label>
                            <input type="radio" name="status" value="available" id="status-available" required>
                            Available
                        </label>
                        <label>
                            <input type="radio" name="status" value="sold" id="status-sold" required>
                            Sold
                        </label>
                    </div>
                </div>

                <div class="seller-form-group">
                    <h4>Seller Information</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="seller_name" id="seller-name" placeholder="Enter seller name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone_number" id="seller-phone" placeholder="Enter phone number" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" id="seller-address" placeholder="Enter complete address" rows="2" required></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
                    <button type="submit" class="submit-btn" id="submit-btn">Save Item</button>
                </div>
            </form>
        </div>
    </div>

    <div class="popup-overlay" id="statusPopup" style="display: none;">
        <div class="popup-content">
            <div class="popup-header">
                <h3 id="status-popup-title"></h3>
                <button class="close-button" onclick="closeStatusPopup()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p id="status-popup-message"></p>
        </div>
    </div>

    <script>
        function openAddPopup() {
            resetPopup();
            document.getElementById('marketPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function openEditPopup(item) {
            document.getElementById('popup-title').innerText = 'Edit Market Item';
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('marketForm').action = `/admin/market/${item.id}`;
            document.getElementById('item-id').value = item.id;
            document.getElementById('item-name').value = item.item_name;
            document.getElementById('item-price').value = item.price;
            document.getElementById('item-description').value = item.description;
            document.getElementById('seller-name').value = item.seller_name;
            document.getElementById('seller-phone').value = item.phone_number;
            document.getElementById('seller-address').value = item.address;
            document.getElementById(`status-${item.status}`).checked = true;

            document.getElementById('marketPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('marketPopup').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function resetPopup() {
            document.getElementById('popup-title').innerText = 'Add New Market Item';
            document.getElementBy

            document.getElementById('form-method').value = 'POST';
            document.getElementById('marketForm').action = '/admin/market';
            document.getElementById('marketForm').reset();
        }

        @if(session('status'))
        document.getElementById('status-popup-title').innerText = 'Success';
        document.getElementById('status-popup-message').innerText = '{{ session('status') }}';
        document.getElementById('statusPopup').style.display = 'block';
        document.body.style.overflow = 'hidden';
    @elseif(session('error'))
        document.getElementById('status-popup-title').innerText = 'Error';
        document.getElementById('status-popup-message').innerText = '{{ session('error') }}';
        document.getElementById('statusPopup').style.display = 'block';
        document.body.style.overflow = 'hidden';
    @endif

    function closeStatusPopup() {
        document.getElementById('statusPopup').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    </script>
</body>
</html>

