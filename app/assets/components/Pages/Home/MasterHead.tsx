import React from 'react';

const MasterHead: React.FC = () => {
    const checkListGifPath = '/build/appPages/home/checklist.gif';

    return (
        <>
            <header className="masthead my-5">
                <div className="container px-5">
                    <div className="row px-5 align-items-center">
                        <div className="col-lg-6">
                            <div className="mb-5 mb-lg-0 text-center text-lg-start">
                                <h1 className="display-1 lh-1 mb-3">Track your task easier with Todotab</h1>
                                <p className="lead fw-normal text-muted mb-5">
                                    With Todotab, manage your task will become easier. For that reason, your career will
                                    be boosted and you wil achieve your dream as soon as possible.
                                </p>
                            </div>
                        </div>
                        <div className="col-lg-6">
                            <div className="masthead-device-mockup">
                                <img src={checkListGifPath} alt={'checklist'}/>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </>
    )
}

export default MasterHead;
