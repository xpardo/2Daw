import Validator from '../validator'
 
// Submit form ONLY when validation is OK
const form = document.getElementById("create")
 
form.addEventListener("submit", function( event ) {
   // Reset errors messages
   document.getElementById("error").reset();
   // ...
    var error = document.getElementById("error")
    
    //...
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
            //-----
            if (isNaN(document.getElementById("file").value))
            {
                // Changing content and color of content
                error.textContent = "col·loca una imatge"
                error.style.color = "red"
            } else {
                error.textContent = ""
            }
            //-----
        }

        
       // Avoid submit
       event.preventDefault()
       return false

    }
})
