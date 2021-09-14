import React from 'react';
import {NavLink} from 'react-router-dom';

const Navbar: React.FC = () => {
    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-gradient-primary-to-secondary fixed-top">
            <div className="container-fluid">
                <NavLink className="navbar-brand" to="/">Todotab</NavLink>
                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"/>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav me-auto">
                        <li className={'nav-item'}>
                            <NavLink className={'nav-link'} to="/about">About</NavLink>
                        </li>
                    </ul>
                    <ul className={'nav d-flex justify-content-between'} style={{width: '180px'}}>
                        <li className={'nav-item'}>
                            <NavLink className={'btn btn-outline-light'} to="/signUp">Sign Up</NavLink>
                        </li>
                        <li className={'nav-item'}>
                            <NavLink className={'btn btn-outline-light'} to="/signIn">Sign In</NavLink>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    )
};

export default Navbar;
