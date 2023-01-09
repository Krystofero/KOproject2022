
function toggleCheckbox(checkbox1, checkbox2) {
    checkbox1.addEventListener('change', function() {
        if (this.checked) {
            checkbox2.checked = false;
        } else {
            this.checked = true;
        }
    });
    checkbox2.addEventListener('change', function() {
        if (this.checked) {
            checkbox1.checked = false;
        } else {
            this.checked = true;
        }
    });
}

var checkbox1 = document.getElementById('basic');
var checkbox2 = document.getElementById('insurance');
toggleCheckbox(checkbox1, checkbox2);
