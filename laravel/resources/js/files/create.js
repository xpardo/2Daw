import Validator from '../validator'
 
// Submit form ONLY when validation is OK
const form = document.getElementById("create")
 
form.addEventListener("submit", function( event ) {
   // Reset errors messages
   // ...
   var errors = '';
    //File
    if ($('#file').val() == '') {
        errors += '<p><i class="fas fa-times"></i>col·loca una imatge</p>';
        $('#file').css("border-bottom-color", "#f14b4b");
    } else {
        $('#file').css("border-bottom-color", "#d1d1d1");
    }

   // Create validation

   let data = {
       "upload": document.getElementsByName("upload")[0].value,
   }
   let rules = {
       "upload": "required",
   }
   let validation = new Validator(data, rules)
   // Validate fields
   if (validation.passes()) {
       // Allow submit form (do nothing)
       console.log("Validation OK")
    } else {
       // Get error messages
       let errors = validation.errors.all()
       console.log(errors)
       // Show error messages
       for(let inputName in errors) {
            if (errors == '' == false) {
                var misatgeModal = '<div class="modal_wrap">' +
                    '<div class="misatge_modal">' +
                    '<h3>Errors Trobats</h3>' +
                    errors +
                    '<span id="btnClose">Tancar</span>' +
                    '</div>' +
                    '</div>'
                $('body').append(misatgeModal);
            }
            //TANCA MODAL =====
            $('#btnClose').click(function() {
                $('.modal_wrap').remove();
            });
        }
       // Avoid submit
       event.preventDefault()
       return false

    }
})
