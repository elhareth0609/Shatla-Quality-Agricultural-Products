const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


var translations = {
  "en": {
    "No data available in table": "No data available in table",
    "No matching records found": "No matching records found",
    "to" : "to",
    "from" : "from",
    "Submit" : "Submit",
    "Cancel" : "Cancel",
    "Ok" : "Ok",
    "Do you really want to delete this Category?": "Do you really want to delete this Category?",
    "Do you really want to delete this Coupon?": "Do you really want to delete this Coupon?",
    "Do you really want to delete this Plan?": "Do you really want to delete this Plan?",
    "Do you really want to delete this Blog?": "Do you really want to delete this Blog?",
    "Do you really want to delete this Article?": "Do you really want to delete this Article?",
    "Do you really want to delete this Publication?" : "Do you really want to delete this Publication?",
    "Do you really want to delete this Product?": "Do you really want to delete this Product?",
    "Do you really want to delete this SubCategory?": "Do you really want to delete this SubCategory?",
    "Do you really want to Pay For This Plan?" : "Do you really want to Pay For This Plan?",
    "No Plan Selected" : "No Plan Selected",
    "Please select a plan before proceeding." : "Please select a plan before proceeding.",
    "Drag and drop files here or click to upload" : "Drag and drop files here or click to upload",
    "month" : "month",
    "today" : "today",
    "week" : "week",
    "day" : "day",
    "Add Event" : "Add Event",
    "Do you really want to delete this Photo?" : "Do you really want to delete this Photo?",
    "Successfully copied the URL!" : "Successfully copied the URL!",
    "Copy" : "Copy",
    "Just Now" : "Just Now",
    "Error" : "Error"


  },
  "ar": {
    "No data available in table": "لا تتوفر بيانات في الجدول",
    "No matching records found": "لم يتم العثور على سجلات مطابقة",
    "to" : "من",
    "from" : "إلى",
    "Submit" : "موافق",
    "Cancel" : "إلغاء",
    "Ok" : "حسنا",
    "Do you really want to delete this Category?": "هل ترغب حقًا في حذف هذا التصنيف؟",
    "Do you really want to delete this Coupon?": "هل ترغب حقًا في حذف هذا الكوبون؟",
    "Do you really want to delete this Plan?": "هل ترغب حقًا في حذف هذه الخطة؟",
    "Do you really want to delete this Blog?": "هل ترغب حقًا في حذف هذه المدونة؟",
    "Do you really want to delete this Article?": "هل ترغب حقًا في حذف هذا المقال؟",
    "Do you really want to delete this Publication?" : "هل ترغب حقًا في حذف هذا المنشور؟",
    "Do you really want to delete this Product?": "هل ترغب حقًا في حذف هذا المنتج؟",
    "Do you really want to delete this SubCategory?": "هل ترغب حقًا في حذف هذه الفئة؟",
    "Do you really want to Pay For This Plan?" : "هل ترغب حقًا في شراء هذه الخطة؟",
    "No Plan Selected" : "لم يتم اختيار أي خطة",
    "Please select a plan before proceeding." : "يرجى اختيار خطة قبل المتابعة",
    "Drag and drop files here or click to upload" : "اسحب وأفلت الملفات هنا أو انقر للتحميل أو إضغط للرفع",
    "month" : "شهر",
    "today" : "اليوم",
    "week" : "أسبوع",
    "day" : "يوم",
    "Add Event" : "إضافة حدث",
    "Do you really want to delete this Photo?" : "هل ترغب حقًا في حذف هذه الصورة",
    "Successfully copied the URL!" : "تم نسخ الرابط بنجاح",
    "Copy" : "نسخ",
    "Just Now" : "الأن",
    "Error" : "خطأ"


  }
};


function __(key,lang) {
  if (translations.hasOwnProperty(lang) && translations[lang].hasOwnProperty(key)) {
    return translations[lang][key];
  } else {
    return key;
  }
}

function updateQuantity(productId, newQuantity) {
  $('.input-price-cart[data-product-id="' + productId + '"]').val(newQuantity);

  var price = parseFloat($('#price-item-' + productId).text().trim());
  var newsub = price * newQuantity;
  $('#subtotal-item-' + productId).text(newsub.toFixed(2));
  $(document).trigger('subtotalUpdated');

  $.ajax({
      url: '/cart/update-quantity',
      type: 'POST',
      data: {
          id: productId,
          quantity: newQuantity,
          _token: csrfToken
      },
      success: function(response) {
          console.log('Quantity updated successfully:', response);
      },
      error: function(xhr, status, error) {
          console.error('Error updating quantity:', xhr.responseText);
      }
  });
}




document.addEventListener("DOMContentLoaded", function() {
  const repeatButtons = document.querySelectorAll('.repeat-btn');

  repeatButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      const showcase = this.closest('.showcase');
      const activeItem = showcase.querySelector('.carousel-item.active');
      let nextItem = activeItem.nextElementSibling;
      if (!nextItem) {
        nextItem = showcase.querySelector('.carousel-item:first-child');
      }
      showcase.querySelectorAll('.carousel-item').forEach(function(item) {
        item.classList.remove('active');
      });
      nextItem.classList.add('active');
    });
  });
});


function updateFavorites(data) {
  var truncatedTitle = data.name && data.name.length > 100 ? data.name.substring(0, 100) + '...' : data.name;
  var truncatedDescription = data.description && data.description.length > 100 ? data.description.substring(0, 100) + '...' : data.description;

  var itemHtml = `
      <div class="favorites-item mb-2" data-product-id="${data.id}">
          <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                  <img src="${data.photo}" alt="item-image" class="d-block my-w-110 my-h-110 rounded" />
                  <div class="button-wrapper">
                      <button type="button" class="btn btn-outline-info">
                          <i class="mdi mdi-reload d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">visit</span>
                      </button>
                      <button type="button" class="btn btn-icon btn-outline-danger btn-remove-favorite">
                          <span class="tf-icons mdi mdi-trash-can-outline"></span>
                      </button>
                      <div class="text-muted small mt-3">${truncatedTitle}</div>
                      <div class="text-muted small mt-3 d-flex">
                          <p>${truncatedDescription}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>`;

  $('.favorite-items').append(itemHtml);
}


$(document).on('click', '.favorite-btn', function() {
    var itemId = $(this).closest('.showcase').data('item-id');
    var url = '/favorite/create';

    var hover = $(this).find('.mdi-hover');
    if (hover.hasClass('mdi-heart-outline')) {
      hover.removeClass('mdi-heart-outline').addClass('mdi-heart');
    } else {
      hover.removeClass('mdi-heart').addClass('mdi-heart-outline');
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: itemId,
            _token: csrfToken
        },
        success: function(response) {
          $('.favoriteCount').text(response.count);
          if (response.state == true) {
            updateFavorites(response.data);
          }
          if (response.delete) {
            var productId = response.delete;
            $(`.favorite-items [data-product-id="${productId}"]`).remove();
          }
        },
        error: function(xhr, status, error) {
          if (xhr.status === 401) {
            window.location.href = '/auth/login-basic';
          } else {
            console.error('Error:', xhr.responseText);
          }
        }
    });
});


$(document).on('click', '.btn-plus-cart', function() {
  var inputQuantity = $(this).siblings('.input-price-cart');
  var maxQuantity = parseInt(inputQuantity.attr('data-max'));
  var productId = inputQuantity.attr('data-product-id');

  if (parseInt(inputQuantity.val()) < maxQuantity) {
      inputQuantity.val(parseInt(inputQuantity.val()) + 1);
      updateQuantity(productId, inputQuantity.val());
  }
});


$(document).on('click', '.btn-minus-cart', function() {
  var inputQuantity = $(this).siblings('.input-price-cart');
  var productId = inputQuantity.attr('data-product-id');

  if (parseInt(inputQuantity.val()) > 1) {
      inputQuantity.val(parseInt(inputQuantity.val()) - 1);
      updateQuantity(productId, inputQuantity.val());
  }
});


$(document).on('change', '.input-price-cart', function() {
  var newValue = parseInt($(this).val());

  if (newValue <= 0 || isNaN(newValue)) {
      newValue = 1;
      $(this).val(newValue);
  }

  var productId = $(this).attr('data-product-id');

  updateQuantity(productId, newValue);
});


$(document).on('click', '.btn-remove-favorite', function() {
  var productId = $(this).closest('.favorites-item').data('product-id');
  $(this).prop('disabled', true);

  $.ajax({
      url: '/favorite/delete',
      type: 'DELETE',
      data: {
          id: productId,
          _token: csrfToken
      },
      success: function(response) {
        $('.favoriteCount').text(response.count);
        if (response.success) {
          $(`.favorites-item[data-product-id="${productId}"]`).remove();
          $(`.favorite-btn[data-item-id="${productId}"] i`).removeClass('mdi-heart').addClass('mdi-heart-outline');
        } else {
          $('.btn-remove-favorite').prop('disabled', false);
        }
      },
      error: function() {
          $('.btn-remove-favorite').prop('disabled', false);
      }
  });
});


function truncateString(str, maxLength) {
  if (str.length > maxLength) {
      return str.substring(0, maxLength) + '...';
  } else {
      return str;
  }
}


function updateCarts(data) {
  var truncatedTitle = data.name && data.name.length > 100 ? data.name.substring(0, 90) + '...' : data.name;

  // Create HTML for the favorited item
  var itemHtml = `
  <div class="carts-item mb-2" data-product-id="${data.id}">
  <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
      <img src="${data.photoUrl}" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" />
      <div class="button-wrapper">
        <div class="btn-group" role="group" aria-label="Second group" dir="ltr">
          <button type="button" class="btn btn-icon btn-primary btn-plus-cart">
            <span class="tf-icons mdi mdi-plus"></span>
          </button>
          <input type="text" class="form-control text-center p-0 rounded-0 my-w-5 input-price-cart" data-max="${data.quantity}" value="${data.quantityPivot}" name="quantity" data-product-id="${data.id}">
          <button type="button" class="btn btn-icon btn-primary btn-minus-cart">
            <span class="tf-icons mdi mdi-minus"></span>
          </button>
        </div>
        <button type="button" class="btn btn-icon btn-outline-danger btn-remove-cart">
          <span class="tf-icons mdi mdi-trash-can-outline"></span>
        </button>
        <div class="text-muted small mt-3">${truncatedTitle}</div>
        <div class="text-muted small mt-3 d-flex justify-content-between">
          <p>${data.price}</p>
        </div>
      </div>
    </div>
  </div>
</div> `;

  $('.cart-items').append(itemHtml);
}


$(document).on('click', '.cart-btn', function() {
  var itemId = $(this).closest('.showcase').data('item-id');
    var url = '/cart/create';

    var hover = $(this).find('.mdi-hover');
    if (hover.hasClass('mdi-cart-outline')) {
      hover.removeClass('mdi-cart-outline').addClass('mdi-cart');
    } else {
      hover.removeClass('mdi-cart').addClass('mdi-cart-outline');
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: itemId,
            _token: csrfToken
        },
        success: function(response) {
          $('.cartCount').text(response.count);
          if (response.state == true) {
            updateCarts(response.data);
          }
          if (response.delete) {
            var productId = response.delete;
            $(`.cart-items [data-product-id="${productId}"]`).remove();
          }
        },
        error: function(xhr, status, error) {
          if (xhr.status === 401) {
            // Redirect user to login page
            window.location.href = '/auth/login-basic';
          } else {
            // Handle other errors
            console.error('Error:', xhr.responseText);
          }
        }
    });
});


$(document).on('click', '.btn-remove-cart', function() {
  var productId = $(this).closest('.carts-item').data('product-id');
  $(this).prop('disabled', true);

  $.ajax({
      url: '/cart/delete',
      type: 'DELETE',
      data: {
          id: productId,
          _token: csrfToken
      },
      success: function(response) {
        if (response.success) {
            $('.cartCount').text(response.count);
              $(`.carts-item[data-product-id="${productId}"]`).remove();
              $(`.cart-btn[data-item-id="${productId}"] i`).removeClass('mdi-cart').addClass('mdi-cart-outline');
              // updateCartInformation();
        } else {
              $('.btn-remove-cart').prop('disabled', false);
        }
      },
      error: function() {
          $('.btn-remove-cart').prop('disabled', false);
      }
  });
});


$(document).on('click', '#add-cart-btn', function() {
  var quantity = $('input[name="productQuantity"]').val(); // Get the quantity from the input field
  var id = $('input[name="id"]').val(); // Get the quantity from the input field

  var url = '/cart/update';

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: id,
            quantity: quantity,
            _token: csrfToken
        },
        success: function(response) {
          $('.cartCount').text(response.count);
          if (response.state == true) {
            updateCarts(response.data);
          }
          if (response.update) {
            var quantity = response.update;
            var inputField = $(`.carts-item[data-product-id="${id}"] input[name="quantity"]`);
            inputField.val(quantity);
          }

        },
        error: function(xhr, status, error) {
          if (xhr.status === 401) {
            window.location.href = '/auth/login-basic';
          } else {
            console.error('Error:', xhr.responseText);
          }
        }
    });
});
