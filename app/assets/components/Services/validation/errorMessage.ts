export const errorMessage = {
    incorrectInfo: {
        enError: "Incorrect email and password",
    },
    limitAndSpecialLetter: {
        enError:
            "8 characters minimum with at least 1 number, lowercase letter, uppercase letter and a special character",
    },
    email: {
        presence: {
            enError: "Email cannot be empty",
        },
        invalid: {
            enError: "Invalid email",
        },
    },
    password: {
        presence: {
            enError: "Password cannot be empty",
        },
    },
    username: {
        presence: {
            enError: "Username cannot be empty"
        }
    }
};

export const passwordRule = [
    "At least 8 characters",
    "At least 1 number",
    "At least 1 special character",
    "At least 1 capital letter",
    "At least 1 lowercase letter",
    "Passwords must be the same",
];
