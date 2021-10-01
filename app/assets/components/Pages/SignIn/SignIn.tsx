import React, {FormEvent, useEffect, useState} from "react";
import Validator from "../../Services/validation/validation";
import axios from "axios";
import {errorMessage} from "../../Services/validation/errorMessage";
import {Link, useHistory} from "react-router-dom";

type FormInput = {
    value: string,
    error: boolean,
    errorMessage: string
}

type FormState = {
    username: FormInput,
    password: FormInput
}

const initialState: FormState = {
    username: {
        value: '',
        error: false,
        errorMessage: ''
    },
    password: {
        value: '',
        error: false,
        errorMessage: ''
    }
}

type ValidateFunc = (input: FormInput) => boolean;

type Props = {
    setToken: (token: string) => void;
}

// TODO: add refresh token in backend, private route in frontend to just allow authenticated user can see web page content
const SignIn: React.FC<Props> = ({setToken}) => {
    const [formState, setFormState] = useState<FormState>(initialState);
    const [togglePassword, setTogglePassword] = useState<string>('password');
    const [togglePasswordText, setTogglePasswordText] = useState<string>('Show');
    const [formError, setFormError] = useState<string>('');
    const history = useHistory();

    const handleOnClick = (e: FormEvent<HTMLSpanElement>) => {
        setTogglePasswordText(togglePasswordText === 'Show' ? 'Hide' : 'Show');
        setTogglePassword(togglePasswordText === 'Show' ? 'text' : 'password');
    }

    const handleOnChange = (e: FormEvent<HTMLInputElement>) => {
        const name: string = e.currentTarget.name;
        if (name === 'username' || name === 'password') {
            setFormState({
                ...formState,
                [name]: {
                    ...formState[name],
                    value: e.currentTarget.value,
                },
            })
        }
    }

    const validateUsername: ValidateFunc = (username: FormInput) => {
        if (Validator.checkEmpty(username.value)) {
            username.error = true;
            username.errorMessage = errorMessage.username.presence.enError;
            return false;
        }

        username.error = false;
        username.errorMessage = '';
        return true;
    }

    const validatePassword: ValidateFunc = (password: FormInput) => {
        if (Validator.checkEmpty(password.value)) {
            password.error = true;
            password.errorMessage = errorMessage.password.presence.enError;
            return false;
        }

        password.error = false;
        password.errorMessage = '';
        return true;
    }

    const handleSubmit: (e: FormEvent<HTMLFormElement>) => void = (e) => {
        e.preventDefault();

        setFormError('');

        setFormState({...formState});
        if (
            !validateUsername(formState.username) ||
            !validatePassword(formState.password)
        ) {
            return;
        }

        axios.post(
            '/api/rest/v1/auth/login_check',
            {
                username: formState.username.value,
                password: formState.password.value,
            }
        )
            .then((response) => {
                setToken(response.data.token);
                history.goBack();
            })
            .catch((error) => {
                setFormError(error.response.data.message);
            })
    }

    return (
        <>
            <h1 className={"text-center"}>Sign In</h1>
            <form method={"POST"} noValidate={true} onSubmit={handleSubmit}
                  className={"security-form mx-auto shadow-lg p-3 my-5 bg-white rounded"}>
                {formError &&
                <div className="alert alert-danger" role="alert">
                    {formError}
                </div>
                }
                <div className="mb-3">
                    <label htmlFor="username">Username</label>
                    <input type="text" className={"form-control"} id={"username"} name={"username"}
                           onChange={handleOnChange}/>
                    <p className={`text-danger error-message ${formState.username.error && 'visible'}`}>
                        {formState.username.errorMessage}
                    </p>
                </div>
                <div className="mb-3">
                    <label htmlFor="password">Password</label>
                    <div className="input-group">
                        <input type={togglePassword} className={"form-control"} id={"password"} name={"password"}
                               onChange={handleOnChange}/>
                        <span id="show-password" className={"input-group-text"}
                              onClick={handleOnClick}>{togglePasswordText}</span>
                    </div>
                    <p className={`text-danger error-message ${formState.password.error && 'visible'}`}>
                        {formState.password.errorMessage}
                    </p>
                </div>
                <div className="mb-3 text-end">
                    New to Todotab? <Link to="/signup">Create new account</Link>
                </div>
                <div className="mb-3">
                    <button className="btn btn-gradient-primary-to-secondary rounded-pill w-100" type="submit">Sign In
                    </button>
                </div>
            </form>
        </>
    )
}

export default SignIn;
