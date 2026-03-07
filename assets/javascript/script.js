document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn.delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this product?')) {
                e.preventDefault();
            }
        });
    });
    
    const productForm = document.querySelector('.product-form form');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            const nameFr = document.getElementById('name_fr').value.trim();
            const nameAr = document.getElementById('name_ar').value.trim();
            const price = document.getElementById('price').value;
            
            if (!nameFr || !nameAr) {
                alert('Both French and Arabic names are required');
                e.preventDefault();
                return;
            }
            
            if (isNaN(price) || parseFloat(price) <= 0) {
                alert('Please enter a valid price');
                e.preventDefault();
                return;
            }
        });
    }
});



