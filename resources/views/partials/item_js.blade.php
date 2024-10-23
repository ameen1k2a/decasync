<script>
    $(document).ready(function() {
            $('#itemList').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route('items.list') }}',
                    dataSrc: ''
                },
                columns: [
                    { data: 'name' },
                    { data: 'inventory_location' },
                    { data: 'brand' },
                    { data: 'category' },
                    { data: 'supplier_name' }, 
                    { data: 'stock_unit_name' },
                    { data: 'unit_price' },
                    { data: 'status' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success edit-item" data-id="${row.id}" data-toggle="modal" data-target="#editItemModal">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger delete-item" data-id="${row.id}" data-name="${row.name}" data-toggle="modal" data-target="#deleteItemModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            `;
                        }
                    }
                ]
            });
        });
    
        $(document).ready(function () {
            $('#addItemForm').on('submit', function (e) {
                e.preventDefault(); 
                var formData = new FormData(this);
    
                $.ajax({
                    url: '/items_add',
                    type: 'POST',
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting content type header
                    success: function (response) {
                        showAlert(response.success, 'success');
                        $('#itemadd').modal('hide'); // Hide the modal
                        $('#addItemForm')[0].reset(); // Reset the form fields
                        $('#itemList').DataTable().ajax.reload(); 
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMsg = '';
                        for (const error in errors) {
                            errorMsg += errors[error][0] + '\n'; // Collect error messages
                        }
                        showAlert(errorMsg || 'An error occurred.', 'danger');
                    }
                });
            });
        });
    
    
    
        
    
        $(document).on('click', '.edit-item', function() {
            var itemId = $(this).data('id');
    
            // Fetch item data using Ajax
            $.ajax({
                url: '/items_edit/' + itemId + '/edit',
                type: 'GET',
                success: function(response) {
                    // Fill the modal with item data
                    $('#editItemId').val(response.id);
                    $('#editName').val(response.name);
                    $('#editInventoryLocation').val(response.inventory_location);
                    $('#editBrand').val(response.brand);
                    $('#editCategory').val(response.category);
                    $('#editSupplierId').val(response.supplier_id);
                    $('#editStockUnit').val(response.stock_unit);
                    $('#editUnitPrice').val(response.unit_price);
                    $('#editStatus').val(response.status);
                    
                    // Show the modal
                    $('#editItemModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching item data:', error);
                }
            });
        });
    
        // Handle form submission for editing items
        $('#editItemForm').on('submit', function(e) {
            e.preventDefault();
            
            var itemId = $('#editItemId').val();
            var formData = $(this).serialize();
            
            $.ajax({
                url: '/items_update/' + itemId,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    $('#editItemModal').modal('hide');
                    showAlert('Item updated successfully', 'success');
                    $('#itemList').DataTable().ajax.reload(); // Refresh DataTable
                },
                error: function(xhr, status, error) {
                    console.error('Error updating item:', error);
                    showAlert('Error updating item', 'danger');
                }
            });
        });
    
        $(document).on('click', '.delete-item', function() {
            var itemId = $(this).data('id');
            var itemName = $(this).data('name');
    
            // Set the item name in the modal
            $('#deleteItemName').text(itemName);
            $('#confirmDeleteItem').data('id', itemId);
        });
    
        $(document).on('click', '#confirmDeleteItem', function() {
            var itemId = $(this).data('id');
    
            $.ajax({
                url: '/items_delete/' + itemId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // CSRF token for protection
                },
                success: function(response) {
                    $('#deleteItemModal').modal('hide');
                    showAlert('Item deleted successfully!', 'success');
                    $('#itemList').DataTable().ajax.reload(); // Reload the DataTable
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting item:', error);
                    showAlert('Error deleting item', 'danger');
                }
            });
        });

        $(function () {
        // Function to add a new image upload input
            $(this).on('click', '#add-product-image', function () {
                var form = `
                    <div class="form-group">
                        <div class="Image-upload">
                            <span class="image-option-close">&times;</span>
                            <label for="product_images"> Upload Image </label>
                            <input type="file" accept="image/*" name="product_images[]" onchange="readURL(this);">
                            <img src="" class="item_images" alt="">
                        </div>
                    </div>`;
                $('.product-image').append(form);
            });
        
            // Function to remove an image upload input
            $(this).on('click', '.image-option-close', function () {
                $(this).closest('.form-group').remove();
            });
        });
        
        // Function to preview the selected image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Find the corresponding image element and set the source
                    $(input).siblings('.item_images').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    
    
        
    </script>
    
    
   