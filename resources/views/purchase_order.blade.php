<x-layout>
    <!--Content right-->
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Purchase</strong></h5>

        <form id="purchaseOrderForm">
            @csrf
            <div class="form-group">
                <label for="order_no">Order No</label>
                <input type="text" class="form-control" id="order_no" name="order_no" readonly value="{{ $orderNo }}">
            </div>
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" class="form-control datepicker" id="order_date" name="order_date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier Name</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

             <!-- Add Line Item Button -->
             <button type="button" id="addLineItem" class="btn btn-success mb-3">Add Line Item</button>

            <!-- Table for line items -->
            <table id="lineItemTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Stock Unit</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Packing Unit</th>
                        <th>Discount</th>
                        <th>Net Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows for line items will be dynamically added -->
                </tbody>
            </table>

           

            <!-- Summary fields -->
            <div class="form-group">
                <label for="item_total">Item Total</label>
                <input type="text" class="form-control" id="item_total" name="item_total" readonly>
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount" readonly>
            </div>
            <div class="form-group">
                <label for="net_amount">Net Amount</label>
                <input type="text" class="form-control" id="net_amount" name="net_amount" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Submit Purchase Order</button>
        </form>

        <!-- Include any modal, if necessary -->
        @include('partials.purchase_modal')
    {{-- </div> --}}
</x-layout>
