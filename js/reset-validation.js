const validation = new JustValidate("#reset", {
    tooltip: {
      position: 'top',
    },
  });
  
validation
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
        document.getElementById("reset").submit();
    });
