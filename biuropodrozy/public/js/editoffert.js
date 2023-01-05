$(document).ready(function (e) {
     
    $('#image').change(function(){      
     let reader = new FileReader();
  
     reader.onload = (e) => { 
  
       $('#mainimage').attr('src', e.target.result); 
     }
     reader.readAsDataURL(this.files[0]); 
    
    });
    
 });

 
 function openModal(id) {
     var modal = document.getElementById("myModal"+id);
     var img = document.getElementById(id);
     var modalImg = document.getElementById("img"+id);
     img.onclick = function(){
         modal.style.display = "block";
         modalImg.src = this.src;
         captionText.innerHTML = this.alt;
     }

     closeModal(id);
 }

//  function closeModal(id) {
//      var modal = document.getElementById("myModal"+id);
//      var closeButton = document.getElementById("close"+id);
//      closeButton.onclick = function() {
//          modal.style.display = "none";
//      }
//  }

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
             input.value = null;
         }
     }
 }
 
 function enableInput2(el1,el2,el3) {
    // Get the checkbox and the input field using their ids
    var checkbox = document.getElementById(el1);
    var input = document.getElementById(el2);
    var val2 = document.getElementById(el3);
    
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
            input.value = null;
            val2.value = null;
        }
    }
}

// get the input elements
const startDateInput = document.getElementById('startdateturnus');
const endDateInput = document.getElementById('enddateturnus');

// get the element where you want to display the number of days
const numDaysOutput = document.getElementById('nights');

// define the onchange function
function calculateNumDays() {
    // console.log("mam");
    // get the start and end dates from the input elements
    let startDate = new Date(startDateInput.value);
    let endDate = new Date(endDateInput.value);

    // check if the start date is after the end date
    if (startDate > endDate) {
        // if it is, swap the start and end dates
        [startDate, endDate] = [endDate, startDate];

        // update the input elements with the new start and end dates
        startDateInput.value = startDate.toISOString().substr(0, 10);
        endDateInput.value = endDate.toISOString().substr(0, 10);
    }

    // calculate the difference in milliseconds
    const diffInMilliseconds = endDate - startDate;

    // calculate the number of days by dividing the difference in milliseconds by the number of milliseconds in a day
    const numDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

    // update the output element with the number of days
    numDaysOutput.value = numDays;
}

// attach the onchange function to the input elements
startDateInput.onchange = calculateNumDays;
endDateInput.onchange = calculateNumDays;

function enableOnLoad(id) {
    // Get the element using its id
    var el = document.getElementById(id);
    
    // Check if the element is not empty
    if (el.value.trim()) {
        // Enable the textarea
        el.disabled = false;
    }
}

window.onload = function() {
    // enableOnLoad('promotionprice');
    enableOnLoad('allindescription');
    enableOnLoad('promo');
};

//function for calculating promo values
function calculateValue(el1,el2) {
    // Get the checkbox and the input field using their ids
    var promo = document.getElementById(el1);
    var promoprice = document.getElementById(el2);
    var price = document.getElementById('price').value;

    if(promo.value != null){
        // get the value of the input element
        const percent = parseFloat(promo.value);
        
        var newprice = price * ((100 - percent) / 100);
        // round the value to 2 decimal places
        const roundedValue = Math.round(newprice * 100) / 100;

        promoprice.value = roundedValue;
    }
    if(price == 0) {console.log("mam");
        document.getElementById('promotion').checked = false;
        promo.value = null;
        promoprice.value = null;
        promo.disabled = true;
    }
}

//function for checking min max values
function enforceMinMax(el) {
    if (el.value != "") {
      if (parseInt(el.value) < parseInt(el.min)) {
        el.value = el.min;
      }
      else if (parseInt(el.value) > parseInt(el.max)) {
        el.value = el.max;
      }
    }
  }

