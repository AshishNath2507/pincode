// jQuery.validator.addMedthod("noSpace", (value, element) => {
//     return value == '' || value.trim().length != 0
// }, "Spaces are not allowed");

jQuery("#registerForm").validate({
    rules: {
        fname: {
            required: true,
            pattern:  /^[a-zA-Z]$/,
        },
        lname: {
            required: true,
            noSpace: true
        },
        phone: {
            required: true,
            minlength: 10,
        },
        addr: {
            required: true,
            minlength: 6,
            maxlength: 100,
        },
        gender: {
            required: true
        },        
        district: {
            required: true
        },
        state: {
            required: true
        },

        pincode: {
            required: true,
            minlength: 6,
            maxlength: 6
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 4
        },
        cpassword:{
            required: true,
            // equalTo: "#password"
        }
    },
    messages:{
        fname: {
            required: "Please enter First name",
            pattern: "Cannot use numbers"
        },
        lname: {
            required: "Please enter Last name",
        },
        phone: {
            required: "Please enter phone number",
            minlength: "Phone number is not 10 digit long",
        },
        addr: {
            required: "Please enter address",
            minlength: "Address not long enough",
            maxlength: "Address too long",
        },
        gender: {
            required: "Please select",
        }, 
        district: {
            required: "Please select",
        }, 
        state: {
            required: "Please select",
        }, 
        pincode: {
            required: "Please enter pincode",
            minlength: "Pincode not long enough",
            maxlength: "Pincode too long",
        },
        email: {
            required: "Please enter email",
            email: "Email format is wrong",
        },
        password: {
            required: "Please enter your password",
            minlength: "Password must be 4 char long"
        },
        cpassword:{
            required: "Please enter your password again",
            // equalTo: "Confirm password mismatch"
        }
    }
})


