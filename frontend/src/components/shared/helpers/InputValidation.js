export function validateEmail(email) {
    // regular expression for email validation: test@gmail.com
    const regex = new RegExp('^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$');
    return regex.test(email);
}

export function validatePassword(password) {
    // regular expression for password validation: 1 uppercase, 1 lowercase, 1 number, 1 special character, 8-20 characters
    const regex = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\\$%\\^&\\*])(?=.{8,20})');
    return regex.test(password);
}

export function validateUsername(name) {
    // regular expression for name validation: John Doe
    const regex = new RegExp('^[a-zA-Z]+ [a-zA-Z]+$');
    return regex.test(name);
}

// In order to confirm the password when logging in
export function doesPasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
}