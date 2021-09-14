import React from 'react';
import {Link} from "react-router-dom";

const Hero: React.FC = () => {
    return (
        <div id="hero" className="home">
            <div className="container">
                <div className="hero-content">
                    <h1>I'm a Backend Developer.</h1>
                    <p>
                        My name is Lam Kim Phu. I am a developer.<br/>
                        Most of my work time, I will spend to analysis, design architecture, system, write web
                        service and testing.<br/>
                        In my free time, I really enjoy to create a new application.<br/>
                        So that I can improve my skill and learn new thing as my product is grown.<br/>
                        Nice to meet you. Welcome to my Todotab.<br/>
                    </p>

                    <ul className="list-unstyled list-social">
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
                    </ul>
                </div>
            </div>
        </div>
    )
}

export default Hero;
