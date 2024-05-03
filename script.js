$(document).ready(function() {
    // Function to fetch and display product list
    function fetchProductList() {
        $.ajax({
            url: 'a.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var productListHTML = '<table class="table table-bordered"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Actions</th></tr></thead><tbody>';
                $.each(response, function(index, product) {
                    productListHTML += '<tr><td>' + product.id + '</td><td>' + product.name + '</td><td>' + product.price + '</td><td>' + product.description + '</td><td><button class="btn btn-primary edit-product-btn" data-id="' + product.id + '">Edit</button> <button class="btn btn-danger delete-product-btn" data-id="' + product.id + '">Delete</button></td></tr>';
                });
                productListHTML += '</tbody></table>';
                $('#productList').html(productListHTML);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product list:', status, error);
            }
        });
    }

    // Fetch product list when page loads
    fetchProductList();
    
    // AJAX to add new product
    $('#addProductForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'b.php',
            type: 'POST',
            data: formData,
            dataType: 'html',
            success: function(response) {
                alert(response);
                fetchProductList(); // Reload product list after adding new product
                window.location.href = 'index.html';
            },
            error: function(xhr, status, error) {
                console.error('Error adding product:', status, error);
            }
        });
    });

    // AJAX to edit a product
    $('#editProductForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'c.php',
            type: 'POST',
            data: formData,
            dataType: 'html',
            success: function(response) {
                alert(response);
                window.location.href = 'index.html'; // Redirect to index.html after successful edit
            },
            error: function(xhr, status, error) {
                console.error('Error editing product:', status, error);
            }
        });
    });

    // Function to delete a product
    $(document).on('click', '.delete-product-btn', function() {
        var productId = $(this).data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: 'd.php?id=' + productId,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    fetchProductList(); // Reload product list after deleting product
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting product:', status, error);
                }
            });
        }
    });

   
    $(document).on('click', '.edit-product-btn', function() {
        var productId = $(this).data('id');
        window.location.href = 'c.php?id=' + productId;
    });


});
