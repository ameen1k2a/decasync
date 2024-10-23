<x-layout>
    <!-- Content right -->
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Items </strong></h5>

        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
            <!-- Item Listing -->
            <div class="item-list">
                <div class="row border-bottom mb-4">
                    <div class="col-sm-8 pt-2">
                        <h6 class="mb-4 bc-header">Item Listing</h6>
                    </div>
                    <div class="col-sm-4 text-right pb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addItemModal">Add <i class="fa fa-plus-square"></i></button>
                    </div>
                </div>

                <div class="table-responsive item-list">
                    <table class="table table-bordered table-striped mt-0" id="itemList">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Inventory Location</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Stock Unit</th>
                                <th>Unit Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here by DataTable -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Item Listing -->

            <!-- Modals (Add, Edit, Delete) -->
            @include('partials.item_modals')
        </div>
    
</x-layout>
