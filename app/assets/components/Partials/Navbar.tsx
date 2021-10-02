import React from 'react';
import {NavLink, Link, Redirect, useHistory} from 'react-router-dom';
import jwt from 'jwt-decode';
import useToken from "../CustomHooks/useToken";

const Navbar: React.FC = () => {
    const [token, setToken] = useToken();
    const history = useHistory();
    let rightNavbar;
    let leftNavbar;
    let navBrandLink = '/';

    const handleOnClickLogout = () => {
        localStorage.removeItem('token');
        setToken('');
        history.push('/');
    }

    if (!token) {
        rightNavbar = (
            <ul className={'nav d-flex justify-content-between'} style={{width: '180px'}}>
                <li className={'nav-item'}>
                    <NavLink className={'btn btn-outline-light'} to="/signup">Sign Up</NavLink>
                </li>
                <li className={'nav-item'}>
                    <NavLink className={'btn btn-outline-light'} to="/signin">Sign In</NavLink>
                </li>
            </ul>
        );

        leftNavbar = (
            <ul className="navbar-nav me-auto">
                <li className={'nav-item'}>
                    <NavLink className={'nav-link'} to="/about">About</NavLink>
                </li>
            </ul>
        )
    } else if (token) {
        type UserDecode = {
            username: string
        }
        const user: UserDecode = jwt(token);
        rightNavbar = (
            <div className="dropdown">
                <a className="text-white dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false" role="button">
                    {user.username}
                </a>
                <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a className="dropdown-item" href="#">Profile</a></li>
                    <li><Link className="dropdown-item" to={'/todos'}>My Todos</Link></li>
                    <li>
                        <hr className="dropdown-divider"/>
                    </li>
                    <li>
                        <a className="dropdown-item" href="#" onClick={handleOnClickLogout}>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        )
        leftNavbar = (
            <ul className="navbar-nav me-auto">
            </ul>
        )
        navBrandLink = '/todos'
    }


    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-gradient-primary-to-secondary">
            <div className="container-fluid">
                <NavLink className="navbar-brand" to={navBrandLink}>Todotab</NavLink>
                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"/>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    {leftNavbar}
                    {rightNavbar}
                </div>
            </div>
        </nav>
    )
};

export default Navbar;
