import React from 'react';
import { Slide, Bounce } from "react-awesome-reveal";

const MasterHead: React.FC = () => {
    const checkListGifPath = '/build/appPages/home/checklist.svg';

    return (
        <>
            <header className="masthead my-5">
                <div className="container px-5">
                    <div className="row px-5 align-items-center">
                        <Slide triggerOnce className="col-lg-6">
                            <div className="mb-5 mb-lg-0 text-center text-lg-start">
                                <h1 className="display-1 lh-1 mb-3">Track your task easier with Todotab</h1>
                                <p className="lead fw-normal text-muted mb-5">
                                    With Todotab, manage your task will become easier. For that reason, your career will
                                    be boosted and you wil achieve your dream as soon as possible.
                                </p>
                            </div>
                        </Slide>
                        <Bounce triggerOnce className="col-lg-6">
                            <div className="masthead-device-mockup">
                                <a className={'invisible'} href='https://www.freepik.com/vectors/calendar'>Calendar vector created by vectorjuice - www.freepik.com</a>
                                <img src={checkListGifPath} alt={'checklist'}/>
                            </div>
                        </Bounce>
                    </div>
                </div>
            </header>
        </>
    )
}

export default MasterHead;
