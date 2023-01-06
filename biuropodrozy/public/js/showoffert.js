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

 $(".card2").on("mouseenter", function() {
    $(this).addClass("active");
  });
  
  $(".card2").on("mouseleave", function() {
    $(this).removeClass("active");
  });