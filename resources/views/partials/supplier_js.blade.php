<script>
    $(document).ready(function () {
                $('#addSupplierForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent the default form submission
    
                    $.ajax({
                        url: '/suppliers_add', 
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (response) {
                            // Handle success response
                            showAlert(response.success, 'success');
                            $('#supplieradd').modal('hide'); // Hide the modal
                            $('#addSupplierForm')[0].reset(); // Reset the form fields
                            $('#productList').DataTable().ajax.reload(); 
                            // Optionally, refresh the supplier list or update the UI
                        },
                        error: function (xhr) {
                            // Handle error response
                            const errors = xhr.responseJSON.errors;
                            let errorMsg = '';
                            for (const error in errors) {
                                errorMsg += errors[error][0] + '\n'; // Collect error messages
                            }
                            //alert(errorMsg); // Show error messages
                            //showAlert(errorMsg, 'danger');
                            showAlert(errorResponse.message || 'An error occurred.', 'danger');
                        }
                    });
                });
            });
    
        
        $(document).ready(function() {
            $('#productList').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route('suppliers.list') }}',
                    dataSrc: ''
                },
                columns: [
                    { data: 'name' },
                    { data: 'tax_no' },
                    { data: 'country_name' },
                    { data: 'mobile_no' },
                    { data: 'email' },
                    { data: 'status' },
                    {
                        data: null,
                        
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success edit-supplier" data-id="${row.id}" data-name="${row.name}" data-toggle="modal" data-target="#editSupplierModal">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger delete-supplier" data-id="${row.id}" data-name="${row.name}" data-toggle="modal" data-target="#deleteSupplierModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            `;
                        }
    
                    }
                ]
            });
        });
    
        $(document).on('click', '.edit-supplier', function() {
            var supplierId = $(this).data('id');

            // Fetch supplier data using Ajax
            $.ajax({
                url: '/suppliers_edit/' + supplierId + '/edit', // Adjust this route to match your routes
                type: 'GET',
                success: function(response) {
                    // Fill the modal with the supplier data
                    $('#editSupplierId').val(response.id);
                    $('#editName').val(response.name);
                    $('#editAddress').val(response.address);
                    $('#editTaxNo').val(response.tax_no);
                    $('#editMobileNo').val(response.mobile_no);
                    $('#editEmail').val(response.email);
                    $('#editStatus').val(response.status);
                    
                    // Fetch countries to populate the dropdown
                    $.ajax({
                        url: '/countries', // Adjust this URL based on your routes
                        type: 'GET',
                        success: function(countries) {
                            var countrySelect = $('#edit_country'); // Assuming this is the correct select ID
                            countrySelect.empty(); // Clear previous options
                            countrySelect.append('<option value="">Select a country</option>'); // Default option
                            
                            countries.forEach(function(country) {
                                // Append country options
                                countrySelect.append('<option value="' + country.id + '">' + country.country_name + '</option>');
                            });

                            // Pre-select the supplier's country
                            countrySelect.val(response.country); // Assuming country is the correct field for the supplier's country
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching countries:', error);
                        }
                    });

                    // Show the modal
                    $('#editSupplierModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching supplier data:', error);
                }
            });
        });

        // Handle form submission for editing
        $('#editSupplierForm').on('submit', function(e) {
            e.preventDefault();
            
            var supplierId = $('#editSupplierId').val();
            var formData = $(this).serialize();
            
            $.ajax({
                url: '/suppliers_update/' + supplierId, // Adjust this route to match your update route
                type: 'PUT',
                data: formData,
                success: function(response) {
                    $('#editSupplierModal').modal('hide');
                    showAlert('Supplier updated successfully', 'success');
                    $('#productList').DataTable().ajax.reload(); // Refresh DataTable
                },
                error: function(xhr, status, error) {
                    console.error('Error updating supplier:', error);
                }
            });
        });
    
        $(document).on('click', '.delete-supplier', function() {
            var supplierId = $(this).data('id');
            var supplierName = $(this).data('name');
    
            // Set the supplier name in the modal
            $('#deleteSupplierName').text(supplierName);
    
            // Set the supplier ID to a global variable or store it as a data attribute
            $('#confirmDeleteSupplier').data('id', supplierId);
        });
    
        $(document).on('click', '#confirmDeleteSupplier', function() {
            var supplierId = $(this).data('id');
    
            $.ajax({
                url: '/suppliers_delete/' + supplierId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hide the modal
                    $('#deleteSupplierModal').modal('hide');
    
                    // Show success message
                    showAlert('Supplier deleted successfully!', 'success');
    
                    // Reload the DataTable to reflect the changes
                    $('#productList').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting supplier:', error);
                    showAlert('Error deleting supplier', 'danger');
                }
            });
        });
    
        $(document).ready(function () {
        // Fetch countries for Add Supplier form
          

            $.ajax({
                url: '/countries', // Adjust this URL based on your routes
                type: 'GET',
                success: function (response) {
                    var countrySelect = $('#country');
                    response.forEach(function (country) {
                        // Append the correct field from the response
                        countrySelect.append('<option value="' + country.id + '">' + country.country_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching countries:', error);
                }
            });

        });
    
    
        //supplier end 
    </script>