import React from 'react';
import {Link} from 'react-router-dom';

const Footer = () => {
    return (
        <footer className="bg-dark text-center text-white bg-gradient-primary-to-secondary">
            <div className="container p-4">
                <section className="mb-4">
                    <Link className="btn btn-outline-light btn-floating m-1"
                       to="https://twitter.com/LamKimPhu1"
                       role="button"
                    ><i className="fab fa-twitter"/></Link>

                    <Link className="btn btn-outline-light btn-floating m-1"
                          to="https://www.linkedin.com/in/l%C3%A2m-kim-ph%C3%BA-57b0371b4/" role="button"
                    ><i className="fab fa-linkedin-in"/></Link>

                    <Link className="btn btn-outline-light btn-floating m-1"
                          to="https://github.com/lamkimphu258" role="button"
                    ><i className="fab fa-github"/></Link>
                </section>

                <section className="">
                    <form action="">
                        <div className="row d-flex justify-content-center">
                            <div className="col-auto">
                                <p className="pt-2">
                                    <strong>Sign up for our newsletter</strong>
                                </p>
                            </div>

                            <div className="col-md-5 col-12">
                                <div className="form-outline form-white mb-4">
                                    <input type="email" id="form5Example2" className="form-control"/>
                                </div>
                            </div>

                            <div className="col-auto">
                                <button type="submit" className="btn btn-outline-light mb-4">
                                    Subscribe
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                <section className="mb-4">
                    <p>
                        Subscribe our newsletter so that you will not miss any good tips to boost your career faster
                    </p>
                </section>
            </div>

            <div className="text-center pb-2">
                &copy; {new Date().getFullYear()} Copyright:
                <a href="https://github.com/lamkimphu258?tab=repositories" className={'text-white'}>
                    Lam Kim Phu
                </a>
            </div>
        </footer>
    )
}

export default Footer;
