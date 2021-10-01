import React from 'react';
import {NavLink} from 'react-router-dom';
import jwt from 'jwt-decode';

type Props = {
    userToken: string
}

const Navbar: React.FC<Props> = ({userToken}) => {
    let rightNavbar;

    const handleOnClickLogout = () => {
        localStorage.removeItem('token');
        window.location.href = '/';
    }

    if (!userToken) {
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
    } else if (userToken) {
        type UserDecode = {
            username: string
        }
        const user: UserDecode = jwt(userToken);
        rightNavbar = (
            <div className="dropdown">
                <button className="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    {user.username}
                </button>
                <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a className="dropdown-item" href="#">Profile</a></li>
                    <li><a className="dropdown-item" href="#">My Todos</a></li>
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
    }


    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-gradient-primary-to-secondary">
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
                    {rightNavbar}
                </div>
            </div>
        </nav>
    )
};

export default Navbar;
