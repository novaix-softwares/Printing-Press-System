/**
 * ORDER PRICE CALCULATOR
 * Handles real-time price calculation for printing orders
 */

document.addEventListener('DOMContentLoaded', function() {
    // Price configuration (in Pakistani Rupees)
    const priceConfig = {
        // Product base prices
        products: {
            'business-card': 500,
            'flex-banner': 1500,
            'flyer': 800,
            'brochure': 1200,
            'poster': 1000,
            'wedding-card': 2000,
            'custom': 3000
        },
        
        // Size multipliers
        sizes: {
            'small': 1.0,
            'medium': 1.5,
            'large': 2.0,
            'xlarge': 3.0
        },
        
        // Paper type multipliers
        paper: {
            'standard': 1.0,
            'premium': 1.8,
            'glossy': 2.2,
            'matte': 1.5,
            'cardstock': 2.5
        },
        
        // Color options
        colors: {
            'bw': 1.0,
            'color': 1.5,
            'full-color': 2.0
        },
        
        // Delivery charges
        delivery: {
            'pickup': 0,
            'delivery': 300
        }
    };
    
    // Get DOM elements
    const productSelect = document.getElementById('productType');
    const sizeSelect = document.getElementById('size');
    const quantityInput = document.getElementById('quantity');
    const paperSelect = document.getElementById('paperType');
    const colorSelect = document.getElementById('colorOption');
    const deliverySelect = document.getElementById('deliveryMethod');
    const fileInput = document.getElementById('fileUpload');
    
    // Price display elements
    const basePriceEl = document.getElementById('basePrice');
    const sizePriceEl = document.getElementById('sizePrice');
    const paperPriceEl = document.getElementById('paperPrice');
    const colorPriceEl = document.getElementById('colorPrice');
    const deliveryPriceEl = document.getElementById('deliveryPrice');
    const totalPriceEl = document.getElementById('totalPrice');
    
    // File upload handling
    const fileInfo = document.getElementById('fileInfo');
    let fileUploadPrice = 0;
    
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileSizeMB = file.size / (1024 * 1024);
                fileUploadPrice = fileSizeMB > 10 ? 200 : 0;
                
                if (fileInfo) {
                    fileInfo.textContent = `File: ${file.name} (${fileSizeMB.toFixed(2)} MB)`;
                    if (fileUploadPrice > 0) {
                        fileInfo.innerHTML += ` <span class="text-warning">(Large file processing fee applied)</span>`;
                    }
                }
                
                calculateTotal();
            }
        });
    }
    
    // Add event listeners for price calculation
    [productSelect, sizeSelect, quantityInput, paperSelect, colorSelect, deliverySelect].forEach(element => {
        if (element) {
            element.addEventListener('change', calculateTotal);
        }
    });
    
    if (quantityInput) {
        quantityInput.addEventListener('input', calculateTotal);
    }
    
    // Initial calculation
    calculateTotal();
    
    function calculateTotal() {
        // Get values from form
        const product = productSelect?.value || 'business-card';
        const size = sizeSelect?.value || 'medium';
        const quantity = parseInt(quantityInput?.value) || 100;
        const paper = paperSelect?.value || 'standard';
        const color = colorSelect?.value || 'color';
        const delivery = deliverySelect?.value || 'pickup';
        
        // Calculate base price
        const basePricePerUnit = priceConfig.products[product] || priceConfig.products['business-card'];
        const sizeMultiplier = priceConfig.sizes[size] || 1.0;
        const paperMultiplier = priceConfig.paper[paper] || 1.0;
        const colorMultiplier = priceConfig.colors[color] || 1.0;
        
        // Calculate price per unit
        const pricePerUnit = basePricePerUnit * sizeMultiplier * paperMultiplier * colorMultiplier;
        
        // Calculate totals
        const basePrice = pricePerUnit * quantity;
        const sizePrice = (basePricePerUnit * (sizeMultiplier - 1)) * quantity;
        const paperPrice = (pricePerUnit * (paperMultiplier - 1)) * quantity;
        const colorPrice = (pricePerUnit * (colorMultiplier - 1)) * quantity;
        const deliveryPrice = priceConfig.delivery[delivery] || 0;
        
        const totalPrice = basePrice + deliveryPrice + fileUploadPrice;
        
        // Update display
        if (basePriceEl) basePriceEl.textContent = formatCurrency(basePrice);
        if (sizePriceEl) sizePriceEl.textContent = formatCurrency(sizePrice);
        if (paperPriceEl) paperPriceEl.textContent = formatCurrency(paperPrice);
        if (colorPriceEl) colorPriceEl.textContent = formatCurrency(colorPrice);
        if (deliveryPriceEl) deliveryPriceEl.textContent = formatCurrency(deliveryPrice);
        if (totalPriceEl) totalPriceEl.textContent = formatCurrency(totalPrice);
        
        // Update order summary
        updateOrderSummary(product, size, quantity, paper, color, delivery, totalPrice);
    }
    
    function updateOrderSummary(product, size, quantity, paper, color, delivery, totalPrice) {
        const summaryElement = document.getElementById('orderSummary');
        if (!summaryElement) return;
        
        // Product name mapping
        const productNames = {
            'business-card': 'Business Cards',
            'flex-banner': 'Flex Banner',
            'flyer': 'Flyers',
            'brochure': 'Brochures',
            'poster': 'Posters',
            'wedding-card': 'Wedding Cards',
            'custom': 'Custom Printing'
        };
        
        // Size name mapping
        const sizeNames = {
            'small': 'Small',
            'medium': 'Medium',
            'large': 'Large',
            'xlarge': 'Extra Large'
        };
        
        // Paper type mapping
        const paperNames = {
            'standard': 'Standard',
            'premium': 'Premium',
            'glossy': 'Glossy',
            'matte': 'Matte',
            'cardstock': 'Cardstock'
        };
        
        // Color option mapping
        const colorNames = {
            'bw': 'Black & White',
            'color': 'Standard Color',
            'full-color': 'Full Color'
        };
        
        summaryElement.innerHTML = `
            <div class="alert alert-info">
                <h6 class="alert-heading">Order Summary</h6>
                <hr>
                <p><strong>Product:</strong> ${productNames[product]}</p>
                <p><strong>Size:</strong> ${sizeNames[size]}</p>
                <p><strong>Quantity:</strong> ${quantity} units</p>
                <p><strong>Paper Type:</strong> ${paperNames[paper]}</p>
                <p><strong>Color:</strong> ${colorNames[color]}</p>
                <p><strong>Delivery:</strong> ${delivery === 'delivery' ? 'Home Delivery' : 'Store Pickup'}</p>
                <hr>
                <p class="mb-0"><strong>Total:</strong> ${formatCurrency(totalPrice)}</p>
            </div>
        `;
    }
    
    function formatCurrency(amount) {
        return 'Rs. ' + amount.toLocaleString('en-PK', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }
    
    // Form submission handling
    const orderForm = document.getElementById('orderForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate required fields
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                showToast('Please fill in all required fields.', 'warning');
                return;
            }
            
            // Validate file upload
            if (fileInput && !fileInput.files.length) {
                showToast('Please upload your design file.', 'warning');
                fileInput.classList.add('is-invalid');
                return;
            }
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            submitButton.disabled = true;
            
            // Simulate form submission (replace with actual AJAX call)
            setTimeout(() => {
                // In production, this would be an AJAX call to process-order.php
                // For now, show success message
                showToast('Order submitted successfully! We will contact you soon.', 'success');
                
                // Reset form
                this.reset();
                calculateTotal();
                
                // Reset button
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                
                // Scroll to top
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 2000);
        });
    }
});