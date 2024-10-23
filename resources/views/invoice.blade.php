<x-layout>
    <!-- Content right -->
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Invoice</strong></h5>
        
        {{-- <span class="text-secondary">Pages <i class="fa fa-angle-right"></i> Invoice</span> --}}
        
        <div class="row mt-3" id="invoice_div">
            <div class="col-sm-12">
                <!--Invoice-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm lh-sm">
                    <h3 class="m-3">Invoice #INVC-{{ $purchaseOrder->order_no }}</h3>

                    <div class="dropdown-divider"></div>

                    <div class="row mt-3 mb-4">
                        <!-- Address -->
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="invoice-from">
                               
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="invoice-to text-right">
                               

                                <address>
                                    <p><small>Supplier</small></p>                                           
                                    <strong>{{ $purchaseOrder->supplier->name }}</strong>
                                    <p class="mt-1 mb-0">{{ $purchaseOrder->supplier->address }}</p>
                                    
                                </address>
                            </div>
                        </div>
                    </div>
                    <!-- /Address -->

                    <!--Invoice Order-->
                    <div class="table-responsive mt-5">
                        <table class="table">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit cost</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($purchaseOrder->items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->order_qty }}</td>
                                        <td>${{ number_format($item->unit_price, 2) }}</td>
                                        <td>${{ number_format($item->order_qty * $item->unit_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right mt-4 p-4">
                            <p><strong>Sub - Total amount: ${{ number_format($purchaseOrder->item_total, 2) }}</strong></p>
                            <p><strong>Discount: ${{ number_format($purchaseOrder->discount, 2) }}</strong></p>
                            <h4 class="mt-2"><strong>Total: ${{ number_format($purchaseOrder->net_amount, 2) }}</strong></h4>
                        </div>

                        <div class="dropdown-divider"></div>


                        <div class="form-group text-right p-3">
                            <button type="button" class="btn btn-theme ml-1" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                            <a href="{{ route('purchase.export', $purchaseOrder->id) }}" class="btn btn-primary ml-1"><i class="fa fa-file-excel"></i> Export to Excel</a>
                        </div>
                        

                    </div>
                    <!--/Invoice Order-->
                </div>
                <!--/Invoice-->
            </div>
        </div>
    {{-- </div> --}}
</x-layout>
