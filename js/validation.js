const validation = new JustValidate("#signup", {
    tooltip: {
      position: 'top',
    },
  });
  
validation
    .addField("#name", [
        {
            rule: "required",
            errorMessage: "Name is required"
        }
    ])
    .addField("#email", [
        {
            rule: "required",
            errorMessage: "Email is required"
        },
        {
            rule: "email",
            errorMessage: "Please enter a valid email address"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "Email already taken"
        }
    ])
    .addField("#pass", [
        {
            rule: "required",
            errorMessage: "Password is required"
        },
        {
            rule: "password",
            errorMessage: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character"
        }
    ])
    .addField("#pass_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#pass"].elem.value;
            },
            errorMessage: "Passwords do not match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
