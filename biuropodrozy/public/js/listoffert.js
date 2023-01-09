$(document).ready(function() {
    // console.log(promotion);
    if (promotion == 1) {
        $('#promotion').prop('checked', true);
        $('#filters').trigger('input');
    }
    if (lastminute == 1) {
        $('#lastminute').prop('checked', true);
        $('#filters').trigger('input');
    }
    if (allinclusive == 1) {
        $('#allinclusive').prop('checked', true);
        $('#filters').trigger('input');
    }
    if (lato == 1) {
        $('#startdate').val(latostart);
        $('#enddate').val(latoend);
        $('#filters').trigger('input');
    }
    if (ccountry != null) {
        $('#filters').trigger('input');
    }
});


$('#filters').on('input', function() {
    var country = $('#country').val();
    var city = $('#city').val();
    var region = $('#region').val();
    var price = $('#price').val();
    $('#price-value').text(price + ' - 10000 zł');
    var startDate = $('#startdate').val();
    var endDate = $('#enddate').val();
    var promotion = $('#promotion').prop('checked');
    var promo = $('#promo').val();
    $('#promo-value').text(promo + ' - 100 %');
    var lastMinute = $('#lastminute').prop('checked');
    var allInclusive = $('#allinclusive').prop('checked');
    var persnum = $('#persnum').val();
    $('#persnum-value').text(persnum + ' - 10 osób');

    $('#offerts .card').each(function() {
        var offerCountry = $(this).data('country');
        var offerCity = $(this).data('city');
        var offerRegion = $(this).data('region');
        var offerPrice = $(this).data('price');
        var offerStartDate = $(this).data('startdate');
        var offerEndDate = $(this).data('enddate');
        var offerPromotion = $(this).data('promotion');
        var offerPromo = $(this).data('promo');
        var offerLastMinute = $(this).data('lastminute');
        var offerAllInclusive = $(this).data('allinclusive');
        var offerPersnum = $(this).data('persnum');
        if ((country == '' || country == offerCountry) && (city == '' || city == offerCity) &&
         (region == '' || region == offerRegion) && (price == '' || offerPrice >= price) && 
         (promo == 0 || offerPromo >= promo) && (persnum == '' || offerPersnum >= persnum) &&
          (startDate == '' || startDate <= offerStartDate) && (endDate == '' || endDate >= offerEndDate) &&
           (promotion == '' || promotion == offerPromotion) && (lastMinute == '' || lastMinute == offerLastMinute) &&
            (allInclusive == '' || allInclusive == offerAllInclusive)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});

$('#filters').on('keyup', function() {
    var search = $('#search').val().toLowerCase();

    $('#offerts .card').each(function() {
        var country = $(this).data('country').toLowerCase();
        var city = $(this).data('city').toLowerCase();
        var region = $(this).data('region').toLowerCase();
        if (country.includes(search) || city.includes(search) || region.includes(search))
            {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

function openModal(id) {
    var modal = document.getElementById("myModal"+id);
    var img = document.getElementById(id);
    var modalImg = document.getElementById("img"+id);
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
    }

    closeModal(id);
}

 function closeModal(id) {
       var modal = document.getElementById("myModal"+id);
       var closeButton = document.getElementById("close"+id);
       closeButton.onclick = function() {
           modal.style.display = "none";
       }
       window.onclick = function(event) {
           if (event.target == modal) {
           modal.style.display = "none";
           }
       }
   }

   function enableInput(el1,el2) {
    // Get the checkbox and the input field using their ids
    var checkbox = document.getElementById(el1);
    var input = document.getElementById(el2);
    
    // Check if the checkbox is checked
    if (checkbox.checked) {
        // Enable the input field
        input.disabled = false;
    } else {
        if (!input.value.trim() && !checkbox.checked) {
            // Prevent the checkbox from being unchecked
            event.preventDefault();
        }
        else{
            // Disable the input field
            input.disabled = true;
            input.value = 0;
            $('#filters').trigger('input');
        }
    }
}
