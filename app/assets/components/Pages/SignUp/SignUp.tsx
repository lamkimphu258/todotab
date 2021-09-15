import React, {FormEvent, useState} from 'react';
import {errorMessage} from "../../Services/validation/errorMessage";
import Validator from "../../Services/validation/validation";
import axios from 'axios';
import PopUp from 'reactjs-popup';
import 'reactjs-popup/dist/index.css';
import { Link } from 'react-router-dom';

type FormInput = {
    value: string,
    error: boolean,
    errorMessage: string,
};

type FormState = {
    email: FormInput,
    password: FormInput,
    username: FormInput
};

const initialState: FormState = {
    email: {
        value: '',
        error: false,
        errorMessage: '',
    },
    password: {
        value: '',
        error: false,
        errorMessage: '',
    },
    username: {
        value: '',
        error: false,
        errorMessage: '',
    }
}

type ValidateFunc = (input: FormInput) => boolean;

const SignUp: React.FC = () => {
    const [formState, setFormState] = useState<FormState>(initialState);
    const [togglePassword, setTogglePassword] = useState<string>('password');
    const [togglePasswordText, setTogglePasswordText] = useState<string>('Show');

    const validateEmail: ValidateFunc = (email: FormInput) => {
        if (Validator.checkEmpty(email.value)) {
            email.error = true;
            email.errorMessage = errorMessage.email.presence.enError;
            return false;
        }

        if (!Validator.checkValidEmail(email.value)) {
            email.error = true;
            email.errorMessage = errorMessage.email.invalid.enError;
            return false;
        }

        email.error = false;
        email.errorMessage = '';
        return true;
    }

    const validatePassword: ValidateFunc = (password: FormInput) => {
        if (Validator.checkEmpty(password.value)) {
            password.error = true;
            password.errorMessage = errorMessage.password.presence.enError;
            return false;
        }

        const PASSWORD_MIN_LENGTH = 8;
        const LIMIT = 'min';
        if (
            Validator.checkLength(password.value, PASSWORD_MIN_LENGTH, LIMIT) ||
            !Validator.checkHasLowerCase(password.value) ||
            !Validator.checkHasUpperCase(password.value) ||
            !Validator.checkHasNumber(password.value) ||
            !Validator.checkHasSpecialChar(password.value)
        ) {
            password.error = true;
            password.errorMessage = errorMessage.limitAndSpecialLetter.enError;
            return false;
        }

        password.error = false;
        password.errorMessage = '';
        return true;
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

    const handleSubmit: (e: FormEvent<HTMLFormElement>) => void = (e: FormEvent) => {
        e.preventDefault();

        setFormState({...formState})
        if (
            !validateEmail(formState.email) ||
            !validatePassword(formState.password) ||
            !validateUsername(formState.username)
        ) {
            return;
        }

        axios.post(
            '/api/rest/v1/auth/register',
            {
                email: formState.email.value,
                password: formState.password.value,
                username: formState.username.value
            }
        )
            .then((response) => console.log('response', response))
            .catch((error) => {
                const tempState = {...formState};
                tempState.email.error = true;
                tempState.email.errorMessage = error.response.data.detail;
                setFormState(tempState);
            });
    }

    const handleOnChange = (e: FormEvent<HTMLInputElement>) => {
        const name: string = e.currentTarget.name;
        if (name === 'email' || name === 'password' || name === 'username') {
            setFormState({
                ...formState,
                [name]: {
                    ...formState[name],
                    value: e.currentTarget.value,
                },
            })
        }
    }

    const handleOnClick = (e: FormEvent<HTMLSpanElement>) => {
        setTogglePasswordText(togglePasswordText === 'Show' ? 'Hide' : 'Show');
        setTogglePassword(togglePasswordText === 'Show' ? 'text' : 'password');
    }

    return (
        <>
            <h1 className={'text-center'}>Sign Up</h1>
            <form method={"POST"} onSubmit={handleSubmit} noValidate={true}
                  className={"security-form mx-auto shadow-lg p-3 my-5 bg-white rounded"}>
                <div className="mb-3">
                    <label htmlFor="email">Email</label>
                    <input type="email" className={"form-control"} id={"email"} name={"email"}
                           onChange={handleOnChange}/>
                    <p className={`text-danger error-message ${formState.email.error && 'visible'}`}>
                        {formState.email.errorMessage}
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
                <div className="mb-3">
                    <label htmlFor="username">Username</label>
                    <input type="username" className={"form-control"} id={"username"} name={"username"}
                           onChange={handleOnChange}/>
                    <p className={`text-danger error-message ${formState.username.error && 'visible'}`}>
                        {formState.username.errorMessage}
                    </p>
                </div>
                <div className="mb-3 text-end">
                    Already have account? <Link to="/signin">Sign in now</Link>
                </div>
                <div className="mb-3">
                    <button className="btn btn-gradient-primary-to-secondary rounded-pill w-100" type="submit">Sign Up
                    </button>
                </div>
                <p className={"text-center"}>
                    By creating an account, you agree to the
                    <PopUp trigger={<span className={"link-primary term"}> Terms of Service</span>} modal nested>
                        <h1 className="header">Term of Service</h1>
                        <div className={"content"}>
                            <p>
                                This is just a placeholder of term of service to show that my web app have a term of
                                service ;). If you really want to know what is this, then please follow this link
                                <a href="https://en.wikipedia.org/wiki/Lorem_ipsum">What is lorem ipsum?</a>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto
                                aspernatur
                                atque autem blanditiis consequuntur debitis dolore eos esse id, minus numquam
                                perferendis
                                quasi recusandae repudiandae saepe, sit tempore ut.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid corporis deleniti
                                earum
                                error facere, facilis illum laudantium nobis officia possimus quaerat quasi quidem
                                quisquam quo ratione tenetur velit veniam voluptatibus.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae earum perferendis quam
                                reprehenderit. Amet animi consectetur, excepturi laborum laudantium libero minus
                                mollitia natus nihil officiis repudiandae tempora velit voluptates, voluptatibus.
                            </p>
                        </div>
                    </PopUp>
                    .
                </p>
            </form>
        </>
    )
}

export default SignUp;
