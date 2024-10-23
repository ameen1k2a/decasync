<script>
    $(document).ready(function() {
        // Fetch items when supplier changes
        function fetchItemsBySupplier(supplierId) {
            if (supplierId) {
                $.ajax({
                    url: '/get-items-by-supplier/' + supplierId,
                    method: 'GET',
                    success: function(response) {
                        updateItemDropdown(response.items);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching items:', error);
                    }
                });
            }
        }
    
        // Event when supplier is changed
        $('#supplier_id').change(function() {
            const supplierId = $(this).val();
            fetchItemsBySupplier(supplierId);
        });
    
        // Event on page load if supplier is preselected
        const initialSupplierId = $('#supplier_id').val();
        if (initialSupplierId) {
            fetchItemsBySupplier(initialSupplierId);
        }
    
        // Update item dropdown for the latest added row
        function updateItemDropdown(items) {
            console.log(items);
            const itemSelect = $('#lineItemTable tbody tr:last .item-select');
            itemSelect.empty();
            itemSelect.append('<option value="">Select Item</option>');
            items.forEach(item => {
                itemSelect.append(`<option value="${item.id}" data-price="${item.unit_price}" data-stock-unit="${item.stock_unit_name}">${item.name}</option>`);
            });
        }
    
        // Add a new row for item selection
        $('#addLineItem').click(function() {
            addItemRow();
        });



        function addItemRow() {
            const rowIndex = $('#lineItemTable tbody tr').length; // Get the current number of rows for indexing

            const newRow = `
                <tr>
                    <td>
                        <select class="form-control item-select" name="items[${rowIndex}][id]">
                            <option value="">Select Item</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control stock-unit" name="items[${rowIndex}][stock_unit]" readonly></td>
                    <td><input type="text" class="form-control unit-price" name="items[${rowIndex}][unit_price]" readonly></td>
                    <td><input type="number" class="form-control order-qty" name="items[${rowIndex}][quantity]" value="0" min="0"></td>
                    <td><select class="form-control packing-unit-select" name="items[${rowIndex}][packing_unit]">
                            <option value="">Select Packing Unit</option>
                            <option value="box">Box</option>
                            <option value="carton">Carton</option>
                            <option value="pallet">Pallet</option>
                            <option value="crate">Crate</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control discount" name="items[${rowIndex}][discount]" value="0"></td>
                    <td><input type="text" class="form-control net-amount" name="items[${rowIndex}][net_amount]" readonly></td>
                    <td><button type="button" class="btn btn-danger remove-line-item">Remove</button></td>
                </tr>
            `;
            $('#lineItemTable tbody').append(newRow);
            var supplierIdfetch = $('#supplier_id').val();
            fetchItemsBySupplier(supplierIdfetch);
            calculateTotals();
        }


    
        // Remove item row
        $(document).on('click', '.remove-line-item', function() {
            $(this).closest('tr').remove();
            calculateTotals();
        });
    
        
        $(document).on('change', '.item-select', function() {
            const selectedItem = $(this).find('option:selected');
            const unitPrice = selectedItem.data('price');
            const stockUnit = selectedItem.data('stock-unit');
    
            $(this).closest('tr').find('.unit-price').val(unitPrice);
            $(this).closest('tr').find('.stock-unit').val(stockUnit);
            calculateLineItem($(this).closest('tr'));
        });
    
        // Calculate line item net amount when quantity or discount changes
        $(document).on('input', '.order-qty, .discount', function() {
            calculateLineItem($(this).closest('tr'));
        });
    
        // Calculate the totals of line items
        function calculateLineItem(row) {
            const qty = parseFloat(row.find('.order-qty').val()) || 0;
            const unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
            const discount = parseFloat(row.find('.discount').val()) || 0;
    
            const itemAmount = qty * unitPrice;
            const netAmount = itemAmount - discount;
    
            row.find('.net-amount').val(netAmount.toFixed(2));
    
            calculateTotals();
        }
    
        // Calculate Item Total, Discount, and Net Amount
        function calculateTotals() {
            let itemTotal = 0;
            let totalDiscount = 0;
            let netTotal = 0;
    
            $('#lineItemTable tbody tr').each(function() {
                const netAmount = parseFloat($(this).find('.net-amount').val()) || 0;
                const discount = parseFloat($(this).find('.discount').val()) || 0;
                itemTotal += netAmount + discount;
                totalDiscount += discount;
                netTotal += netAmount;
            });
    
            $('#item_total').val(itemTotal.toFixed(2));
            $('#discount').val(totalDiscount.toFixed(2));
            $('#net_amount').val(netTotal.toFixed(2));
        }
    
        // Submit form handler
     

        $('#purchaseOrderForm').submit(function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            $.ajax({
                url: '/purchase_orders',
                method: 'POST',
                data: formData,
                success: function(response) {
                    showAlert('Purchase order submitted successfully!', 'success');
                    $('#purchaseOrderForm')[0].reset();
                    $('#lineItemTable tbody').empty();
                    calculateTotals();

                    setTimeout(function() {
                        window.location.href = '{{ route("purchases.list") }}';
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    // Handle validation errors returned by Laravel
                    if (xhr.status === 422) { // 422 Unprocessable Entity is the status for validation errors
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        // Loop through validation errors and build the message
                        $.each(errors, function(key, value) {
                            errorMessage += value + '\n'; // Add each error to the message
                        });

                        showAlert(errorMessage, 'danger'); // Display error messages using showAlert
                    } else {
                        showAlert('Error submitting purchase order: ' + error, 'danger');
                    }
                }
            });
        });

    });


    $(document).ready(function() {
            $('#purchaseList').DataTable({
                processing: true,
                serverSide: false,  
                ajax: {
                    url: '{{ route('purchases.list_view') }}', 
                    dataSrc: ''
                },
                columns: [
                    { data: 'order_no' },  // Order No column
                    { data: 'order_date' },  // Order Date column
                    { data: 'item_total' },  // Item Total column
                    { data: 'discount' },  // Discount column
                    { data: 'net_amount' },  // Net Amount column
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <a href="/invoices/${row.id}" class="btn btn-primary view-invoice">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <button class="btn btn-danger delete-purchase" data-id="${row.id}" data-order-no="${row.order_no}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            `;
                        }
                    }
                ]
            });


            // Handle Delete Purchase button click
            $(document).on('click', '.delete-purchase', function() {
                var purchaseId = $(this).data('id');
                var orderNo = $(this).data('order-no');
                
                // Populate the modal with the purchase info
                $('#deletePurchaseModal #deleteOrderNo').text(orderNo);
                
                // Attach the purchase ID to the confirm delete button
                $('#confirmDeletePurchase').data('id', purchaseId);
                
                // Show the modal
                $('#deletePurchaseModal').modal('show');
            });

            $(document).on('click', '#confirmDeletePurchase', function() {
                var purchaseId = $(this).data('id');
                
                $.ajax({
                    url: '/purchases/' + purchaseId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for protection
                    },
                    success: function(response) {
                        $('#deletePurchaseModal').modal('hide');
                        showAlert('Purchase deleted successfully!', 'success');
                        $('#purchaseList').DataTable().ajax.reload(); // Reload the DataTable
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting purchase:', error);
                        showAlert('Error deleting purchase', 'danger');
                    }
                });
            });


        });

</script>
    