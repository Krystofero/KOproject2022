    $(document).ready(function (e) {
     
       $('#image').change(function(){
        // $('#preview-image-before-upload').show();       
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       
       });
       
    });

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

    // get the input elements
    const startDateInput = document.getElementById('startdateturnus');
    const endDateInput = document.getElementById('enddateturnus');

    // get the element where you want to display the number of days
    const numDaysOutput = document.getElementById('nights');

    // define the onchange function
    function calculateNumDays() {
        console.log("mam");
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
        // Get the textarea using its id
        var el = document.getElementById(id);
        
        // Check if the textarea is not empty
        if (el.value.trim()) {
            // Enable the textarea
            el.disabled = false;
        }
    }

    window.onload = function() {
        enableOnLoad('promotionprice');
        enableOnLoad('allindescription');
    };