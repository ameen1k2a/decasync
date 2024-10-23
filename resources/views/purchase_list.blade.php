<x-layout>
    <!-- Content right -->
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Purchase List</strong></h5>

        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
            <!-- Item Listing -->
            <div class="item-list">
                <div class="row border-bottom mb-4">
                    <div class="col-sm-8 pt-2">
                        <h6 class="mb-4 bc-header">Purchase Listing</h6>
                    </div>
                </div>

                <div class="table-responsive purchase-list">
                    <table class="table table-bordered table-striped mt-0" id="purchaseList">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Order Date</th>
                                <th>Item Total</th>
                                <th>Discount </th>
                                <th>Net Amount</th>
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

            <div class="modal fade" id="deletePurchaseModal" tabindex="-1" role="dialog" aria-labelledby="deletePurchaseModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletePurchaseModalLabel">Delete Purchase</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete Purchase Order #<span id="deleteOrderNo"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeletePurchase">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            

            
        </div>
    
</x-layout>
