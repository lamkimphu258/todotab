import React from 'react';

const AppFeature = () => {
    return (
        <>
            <section id="features">
                <div className="container px-5">
                    <div className="row py-5 align-items-center">
                        <div className="col-lg-7 order-lg-1 mb-5 pl-5 mb-lg-0">
                            <div className="container-fluid px-5">
                                <div className="row gx-5">
                                    <div className="col-md-6 mb-5">
                                        <div className="text-center">
                                            <i className="bi-phone icon-feature text-gradient d-block mb-3"/>
                                            <h3 className="font-alt">Device Compatible</h3>
                                            <p className="text-muted mb-0">
                                                Compatible with variant device so you can use Todotab everywhere.
                                            </p>
                                        </div>
                                    </div>
                                    <div className="col-md-6 mb-5">
                                        <div className="text-center">
                                            <i className="bi-camera icon-feature text-gradient d-block mb-3"/>
                                            <h3 className="font-alt">Easy To Use</h3>
                                            <p className="text-muted mb-0">
                                                We provide a friendly and simple UI so that you can use Todotab immediately.
                                                You don't need to read a long manual.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-6 mb-5 mb-md-0">
                                        <div className="text-center">
                                            <i className="bi-gift icon-feature text-gradient d-block mb-3"/>
                                            <h3 className="font-alt">Free to Use</h3>
                                            <p className="text-muted mb-0">
                                                As always, this app is free to use for any purpose!
                                            </p>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="text-center">
                                            <i className="bi-patch-check icon-feature text-gradient d-block mb-3"/>
                                            <h3 className="font-alt">Open Source</h3>
                                            <p className="text-muted mb-0">
                                                Since this theme is MIT licensed, you can use it commercially!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-5 order-lg-0">
                            <div className="features-device-mockup">
                                <img src="/build/appPages/home/checklist2.gif" alt="checklist2"/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default AppFeature;
