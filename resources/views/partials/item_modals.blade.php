<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="inventory_location">Inventory Location</label>
                        <input type="text" class="form-control" id="inventory_location" name="inventory_location" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="stock_unit">Stock Unit</label>
                        <input type="text" class="form-control" id="stock_unit" name="stock_unit" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="stock_unit">Stock Unit</label>
                        <select class="form-control" id="stock_unit" name="stock_unit" required>
                            @foreach($stockUnits as $stockUnit)
                                <option value="{{ $stockUnit->id }}">{{ $stockUnit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input type="number" class="form-control" id="unit_price" name="unit_price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                    </div>

                    
                    <div class="container">
                        <h4>Upload Item Images</h4>
                        <a id="add-product-image" class="btn btn-primary">Add Image</a>

                        <div class="product-image">
                            <!-- Existing image upload section -->
                            <div class="form-group">
                                <div class="Image-upload">
                                    <span class="image-option-close">&times;</span>
                                    <label for="product_images"> Upload Image </label>
                                    <input type="file" accept="image/*" name="product_images[]" id="product_images" value="" onchange="readURL(this);">
                                    <img  src="" class="item_images" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="item_add">Add Item</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editItemId" name="id">
                    <div class="form-group">
                        <label for="editName">Item Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editInventoryLocation">Inventory Location</label>
                        <input type="text" class="form-control" id="editInventoryLocation" name="inventory_location" required>
                    </div>
                    <div class="form-group">
                        <label for="editBrand">Brand</label>
                        <input type="text" class="form-control" id="editBrand" name="brand" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category</label>
                        <input type="text" class="form-control" id="editCategory" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="editSupplierId">Supplier</label>
                        <select class="form-control" id="editSupplierId" name="supplier_id" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editStockUnit">Stock Unit</label>
                        <select class="form-control" id="editStockUnit" name="stock_unit" required>
                            @foreach($stockUnits as $stockUnit)
                                <option value="{{ $stockUnit->id }}">{{ $stockUnit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editUnitPrice">Unit Price</label>
                        <input type="number" class="form-control" id="editUnitPrice" name="unit_price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Item Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span id="deleteItemName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteItem">Delete</button>
            </div>
        </div>
    </div>
</div>
