// Load our customized validationjs library
import ValidatorPlus from '../validator-plus'

let form = document.getElementById("create-post")
let rules = {
    "body": "required",
    "upload": "required",
    "latitude": "required|numeric",
    "longitude": "required|numeric",
    "visibility": "required",
}
var MyValidator = new ValidatorPlus(form, rules, "alert alert-danger")