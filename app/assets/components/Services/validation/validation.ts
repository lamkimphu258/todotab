class Validator {
    public static specialCharacter = /[@#$!%*?&]+/;

    public static checkValidEmail(inputValue: string): boolean {
        const regrex = /\S+@\S+\.\S+/;
        return regrex.test(inputValue);
    }

    public static checkHasUpperCase(inputValue: string): boolean {
        const regrex = /[A-Z]/;
        return regrex.test(inputValue);
    }

    public static checkHasLowerCase(inputValue: string): boolean {
        const regrex = /[a-z]/;
        return regrex.test(inputValue);
    }

    public static checkHasNumber(inputValue: string): boolean {
        const regrex = /\d+/;
        return regrex.test(inputValue);
    }

    public static checkEmpty(inputValue: string): boolean {
        if (!inputValue || inputValue.trim() === "") {
            return true;
        }
        return false;
    }

    public static checkHasSpecialChar(inputValue: string): boolean {
        return this.specialCharacter.test(inputValue);
    }

    public static checkLength(
        inputValue: string,
        length: number,
        limit: string
    ): boolean {
        switch (limit) {
            case "min":
                return inputValue.length < length;
            case "max":
                return inputValue.length > length;
            default:
                console.warn("error checkInputLength");
                return false;
        }
    }
}

export default Validator;
